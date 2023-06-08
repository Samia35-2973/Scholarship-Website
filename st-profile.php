<?php

session_start();
@include 'php/config.php';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Students Profile - Scholars Journey</title>
    <link rel="shortcut icon" href="images/blogs/logo.png" type="image/x-icon">
    <!-- Linking CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/profile.css">
    <script src="https://kit.fontawesome.com/01b8ea8174.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <nav class="navbar fixed-top navbar-expand-lg navbar-light shadow-sm" style="background-color: #FFFFFF;">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img src="images/blogs/logo.png" alt="Logo" width="100px" height="50px">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <?php
                                echo '<form method="POST" action="php/home_redirect.php">
                                    <button class="nav-link active" aria-current="page" name="home-red-btn">HOME</button>
                                </form>';
                            ?>
                            <!-- <a class="nav-link active" aria-current="page" href="student.php"
                                style="color: #EAA225;">HOME</a> -->
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php#aboutSection">ABOUT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="blog.php">BLOGS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="scholarshipList.php">SCHOLARSHIPS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#footerSection">CONTACT</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" class="nav-link"><i
                                    class="fa-solid fa-bell"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <?php
                                    if(isset($_SESSION['login_done']) && isset($_SESSION['user_type'])){
                                        if($_SESSION['user_type'] == "student") echo "Hi, " . $_SESSION['login_done'];
                                        else echo "Hi, " . $_SESSION['login_done'] . "!";
                                    }
                                    else echo "Login to get started!"
                                ?>
                            </a>
                        </li>
                    </ul>
                    <?php
                        if(isset($_SESSION['login_done'])){
                            echo '<form method="POST" action="php/logout.php">
                            <button class="btn cus-btn" name="logout-btn">LOGOUT</button>
                        </form>';
                        }
                        else {
                            echo '<form method="POST" action="php/login_redirect.php">
                            <button class="btn cus-btn" name="log-red-btn">LOGIN</button>
                        </form>';
                        }
                    ?>
                    <?php
                        if(isset($_SESSION['login_done']) && isset($_SESSION['user_type'])){
                            echo '<form method="POST" action="php/profile_redirect.php">
                            <button class="btn cus-btn" name="profile_red-btn"><i class="fa-solid fa-user"></i></button>
                        </form>';
                        }
                        else {
                            echo '<form method="POST" action="php/signup_redirect.php">
                            <button class="btn cus-btn" name="sign-red-btn">SIGNUP</button>
                        </form>';
                        }
                    ?> 
                </div>
            </div>
        </nav>
    </header>
    <main>
        <section class="tabs">
            <div class="container form-section">
                <div class="row g-5">
                    <div class="col-md-12">
                        <h6>Student Profile
                        </h6>
                    </div>
                </div>
                <?php
                    $myemail = $_SESSION['get_email'];
                    $display = "SELECT * FROM students WHERE email = '$myemail'";
                    $result = mysqli_query($conn, $display);
                    if (mysqli_num_rows($result) > 0) {
                        $row = $result->fetch_assoc();
                    }
                ?>
                <div class="row g-5">
                    <div class="col-md-12">
                        <!-- Form starts here -->
                        <form action="" class="a-form">
                            <h6>Personal Information</h6>
                            <div class="row g-5">
                                <div class="col-md-6 cell-value">
                                    <!-- Students First Name -->
                                    <p>First Name: </p>
                                    <p> <?php echo $row["first_name"]; ?> </p>
                                </div>
                                <div class="col-md-6 cell-value">
                                    <!-- Students Last Name -->
                                    <p>Last Name: </p>
                                    <p><?php echo $row["last_name"]; ?></p>
                                </div>
                                <div class="col-md-6 cell-value">
                                    <!-- Students Gender -->
                                    <p>Gender: </p>
                                    <p><p><?php echo $row["gender"]; ?></p></p>
                                </div>
                                <div class="col-md-6 cell-value">
                                    <!-- Students Birthday -->
                                    <p>Birthday: </p>
                                    <p><p><?php echo $row["birthday"]; ?></p></p>
                                </div>
                                <div class="col-md-6 cell-value">
                                    <!-- Students Email -->
                                    <p>Email: </p>
                                    <p><p><?php echo $row["email"]; ?></p></p>
                                </div>
                            </div>
                            <br>
                            <h6>Educational Information</h6>
                            <div class="row g-5">
                                <div class="col-md-6 cell-value">
                                    <!-- Students Degree -->
                                    <p>Degree: </p>
                                    <p><p><?php echo $row["current_degree"]; ?></p></p>
                                </div>
                                <div class="col-md-6 cell-value">
                                    <!-- Students Program -->
                                    <p>Program: </p>
                                    <p><p><?php echo $row["program"]; ?></p></p>
                                </div>
                                <div class="col-md-6 cell-value">
                                    <!-- Students Institute -->
                                    <p>Institute: </p>
                                    <p><p><?php echo $row["institution"]; ?></p></p>
                                </div>
                                <div class="col-md-6 cell-value">
                                    <!-- Students Graduation Day -->
                                    <p>Graduation Day: </p>
                                    <p><?php echo $row["graduation_date"]; ?></p>
                                </div>
                            </div>
                            <br>
                            <h6>Location</h6>
                            <div class="row g-5">
                                <div class="col-md-6 cell-value">
                                    <!-- Students address -->
                                    <p>Address: </p>
                                    <p><?php echo $row["address"]; ?></p>
                                </div>
                                <div class="col-md-6 cell-value">
                                    <!-- Students Country -->
                                    <p>Country: </p>
                                    <p><?php echo $row["country"]; ?></p>
                                </div>
                                <div class="col-md-6 cell-value">
                                    <!-- Students Zipcode -->
                                    <p>Zipcode: </p>
                                    <p><?php echo $row["zip_code"]; ?></p>
                                </div>
                                <div class="col-md-6 cell-value">
                                    <!-- Students City -->
                                    <p>City: </p>
                                    <p><?php echo $row["city"]; ?></p>
                                </div>
                            </div>
                            <br>
                            <div class="d-flex flex-row justify-content-center">
                                <a class="btn cus-btn" href="update-form.php">UPDATE</a>
                                <!-- <button data-bs-toggle="modal" data-bs-target="#updatestModal" class="btn cus-btn"
                                    type="submit">UPDATE</button> -->
                            </div>
                        </form>
                    </div>
                </div>
        </section>
    </main>
    <footer id="footerSection">
        <div class="container">
            <div class="row footer-section">
                <div class="col-md-3">
                    <h6>Scholars <span style="color: #37A447;">Journey</span></h6>
                    <ul>
                        <li><a href="index.php#aboutSection">About Us</a></li>
                        <li><a href="blog.php">Blogs</a></li>
                        <li><a href="scholarshipList.php">Scholarships</a></li>
                        <li><a href="scholarshipList.php">Countries</a></li>
                        <li><a href="scholarshipList.php">Programs</a></li>
                        <li><a href="#reviewSection">Reviews</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6>Others</h6>
                    <ul>
                        <li><a href="so-form.php">Become a Scholarship Officer</a></li>
                        <li><a href="add-scholarship.php">Missing a Scholarship?</a></li>
                        <a class="btn btn-outline-success shadow" href="add-scholarship.php" role="button">List a
                            Scholarship</a>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6>Contact</h6>
                    <ul>
                        <li><a href="https://facebook.com/">Facebook</a></li>
                        <li><a href="https://www.instagram.com/">Instagarm</a></li>
                        <li><a href="https://twitter.com/">Twitter</a></li>
                        <li><a href="https://www.linkedin.com/">Linkedin</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6>Quick <span style="color: #37A447;">Links</span></h6>
                    <ul>
                        <li><a href="">Terms of Service</a></li>
                        <li><a href="">Privacy Statement</a></li>
                        <li><a href="">Disclaimer</a></li>
                    </ul>
                </div>
            </div>
            <div class="row footer-2">
                <div class="col textcopy">
                    <p>Copyright &copy; All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Modal -->
    <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Scholarship News!</h5>
                            <p class="card-text">A new scholarship Available. It is in Australia
                            </p>
                            <a href="#" class="btn cus-btn">Check out!</a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">New Application!</h5>
                            <p class="card-text">A new student applied on your application
                            </p>
                            <a href="#" class="btn cus-btn">Check out!</a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="updatestModal" tabindex="-1" aria-labelledby="updatestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updatestModalLabel">Your Profile is Updated</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>