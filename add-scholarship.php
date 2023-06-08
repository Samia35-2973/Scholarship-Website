<?php

session_start();

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Scholarship - Scholars Journey</title>
    <link rel="shortcut icon" href="images/blogs/logo.png" type="image/x-icon">
    <!-- Linking CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/form_style.css">
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
                        <h6>Scholarship Form
                        </h6>
                    </div>
                </div>
                <div class="row g-5">
                    <div class="col-md-12">
                        <form action="php/process_app.php" method="POST" class="a-form">
                            <div class="row g-5">
                                <div class="col-md-6">
                                    <input type="text" name="s-name" placeholder="Scholarship Name*" required
                                        id="sName">
                                </div>
                                <div class="col-md-6" style="display: flex;
                                justify-content: flex-start;">
                                    <p>Date*: <input type="date" id="day" name="issue-day" height="0px"></p>
                                </div>
                            </div>
                            <br>
                            <p>Organizational Information</p>
                            <div class="row g-5">
                                <div class="col-md-6">
                                    <input type="text" name="org-name" placeholder="Organization Name*" required
                                        id="orgName">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="officer-name" placeholder="Scholarship Officer's Name*"
                                        required id="officerName">
                                </div>
                                <div class="col-md-6">
                                    <input type="tel" name="org-phone" placeholder="Phone*" required id="orgphone">
                                </div>
                                <div class="col-md-6">
                                    <input type="email" name="org-mail" placeholder="Email*" required id="org-e-mail">
                                </div>
                                <div class="col-md-6">
                                    <input type="url" name="site-url" placeholder="URL*" required id="website">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="country" placeholder="Country*" required id="org-country">
                                </div>
                            </div>
                            <br>
                            <p>Scholarship Information</p>
                            <div class="row g-5">
                                <div class="col-md-6">
                                    <input type="number" name="n-scholarships"
                                        placeholder="Number of Scholarships Available*" required id="n-scols">
                                </div>
                                <div class="col-md-6">
                                    <input type="number" name="scol-amnt" placeholder="Scholarship Amount*" required
                                        id="scol-amnt-value">
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Scholarship Description*"
                                            id="floatingTextarea" name="description" required></textarea>
                                        <label for="floatingTextarea" style="
                                        font-family: Rajdhani, sans-serif;
                                        color: #787878;
                                        font-weight: 600;">Scholarship Description*</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Application Process*"
                                            id="floatingTextarea" name="app-process" required></textarea>
                                        <label for="floatingTextarea" style="
                                        font-family: Rajdhani, sans-serif;
                                        color: #787878;
                                        font-weight: 600;">Application Process*</label>
                                    </div>
                                </div>
                                <div class="col-md-6" style="display: flex;
                                justify-content: flex-start;">
                                    <p>Deadline*: <input type="date" id="deadline" name="deadline-day" height="0px" required></p>
                                </div>
                                <div class="col-md-6" style="display: flex;
                                justify-content: flex-start;">
                                    <p>Duration*: <input type="number" id="duration" name="tot-duration" height="0px" required>
                                    </p>
                                </div>
                            </div>
                            <br>
                            <p>Eligibility Criteria</p>
                            <div class="row g-5">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="eq"
                                            id="floatingTextarea" name="acdemic-req" required></textarea>
                                        <label for="floatingTextarea" style="
                                        font-family: Rajdhani, sans-serif;
                                        color: #787878;
                                        font-weight: 600;">Academic Requirements*</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="eq"
                                            id="floatingTextarea" name="transcript-req" required></textarea>
                                        <label for="floatingTextarea" style="
                                        font-family: Rajdhani, sans-serif;
                                        color: #787878;
                                        font-weight: 600;">Transcript Requirements*</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="eq"
                                            id="floatingTextarea" name="letter-req" required></textarea>
                                        <label for="floatingTextarea" style="
                                        font-family: Rajdhani, sans-serif;
                                        color: #787878;
                                        font-weight: 600;">Letter of recommendation Requirements*</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="eq"
                                            id="floatingTextarea" name="essay-req" required></textarea>
                                        <label for="floatingTextarea" style="
                                        font-family: Rajdhani, sans-serif;
                                        color: #787878;
                                        font-weight: 600;">Essay Requirements*</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="field-name" placeholder="Field of Study*" required
                                        id="fieldName">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="level-name" placeholder="Level of Study*" required
                                        id="levelName">
                                </div>
                            </div>
                            <br>
                            <p>Location</p>
                            <div class="row g-5">
                                <div class="col-md-6">
                                    <input type="text" name="country" placeholder="Country*" required id="user-country">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="city" placeholder="City*" required id="user-city">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="address" placeholder="Address*" required id="user-address">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="zipcode" placeholder="Zip Code*" required
                                        id="user-zipcode">
                                </div>
                            </div>
                            <br>
                            <p>Collaboration(Optional)</p>
                            <div class="row g-5">
                                <div class="col-md-6">
                                    <input type="text" name="col-org" placeholder="Collaboration Organization"
                                        id="colOrg">
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="col-det" placeholder="Collaboration Details" id="colDet">
                                </div>
                            </div>
                            <br>
                            <p>Notification Preference</p>
                            <div class="row g-5">
                                <div class="col-md-6">
                                    <p><input type="checkbox" name="not-pre-1" id="user-not-pre-1" value="agree">
                                        Receive Mail on Latest Scholarships</p>
                                </div>
                                <div class="col-md-6">
                                    <p><input type="checkbox" name="not-pre-2" id="user-not-pre-2" value="agree">
                                        Get notified for scholarships</p>
                                </div>
                            </div>
                            <p><input type="checkbox" name="terms" id="user-terms" value="agree"> I agree with the
                                terms and conditions as a Scholarship Officer. I have read the
                                terms and condition statement.</p>
                            <div class="d-flex flex-row justify-content-center">
                                <button class="btn cus-btn" type="submit">UPDATE</button>
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
    <div class="modal" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Scholarship is Updated</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Scholarship is Deleted</h5>
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