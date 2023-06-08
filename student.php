<?php

session_start();
$host = 'localhost';
$dbname = 'scholarship-website';
$username = 'root';
$password = '';

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve scholarship data from the database
    $stmt = $pdo->query("SELECT * FROM scholarships");
    $scholarships = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $totalScholarships = count($scholarships);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Students Dashboard - Scholars Journey</title>
    <link rel="shortcut icon" href="images/blogs/logo.png" type="image/x-icon">
    <!-- Linking CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/so-dashboard.css">
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
        <div class="container top-section">
            <div class="row">
                <div class="col-lg-6">
                    <div class="top-body">
                        <h1>Hi, Student! Check available scholarships</h1>
                        <p>Explore a wide range of scholarship options tailored to your unique profile and aspirations,
                            from merit-based awards to specialized scholarships in various fields of study. Our
                            user-friendly platform provides personalized recommendations and expert guidance, ensuring
                            you never miss out on valuable funding opportunities. Take control of your education journey
                            and unlock a brighter future by accessing the tools and resources you need to finance your
                            dreams.</p>
                        <div class="input-group">
                            <a class="btn" href="scholarshipList.php">LATEST SCHOLARSHIPS</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>
        <section class="analysis-section" id="analysisSection">
            <div class="container">
                <div class="row g-5">
                    <div class="col-md-6">
                        <h2>Status Of Your Scholarships</h2>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Received</h5>
                                <p class="card-text">X Scholarship</p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Rejected</h5>
                                <p class="card-text">Y Scholarship</p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Accepted</h5>
                                <p class="card-text">Z scholarship</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h2>Scholarships You have enrolled</h2>
                        <h5 class="card-title"><a href="scholarship-view.php"
                                style="color: #359E47; text-decoration: none;">A
                                Scholarship 2023 - A
                                Country</a></h5>
                        <h5 class="card-title"><a href="scholarship-view.php"
                                style="color: #359E47; text-decoration: none;">A
                                Scholarship 2023 - A
                                Country</a></h5>
                    </div>
                </div>
        </section>
        <section class="latest-section">
            <h2>List of Scholarships</h2>
            <div class="container d-flex flex-column align-items-center">
                <div class="row g-5">
                    <?php foreach ($scholarships as $scholarship) { ?>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <?php $scholarshipURL = "scholarship-view.php?id=" . $scholarship['scholarship_id']; ?>
                                    <h5 class="card-title"><a href="<?php echo $scholarshipURL ?>" style="color: #37A447; text-decoration: none;"><?php echo $scholarship['scholarship_name']; ?></a></h5>
                                    <h6 class="card-subtitle mb-2"><?php echo $scholarship['university_name']; ?></h6>
                                    <div class="card-details">
                                        <ul>
                                            <li>
                                                <h6><i class="fa-sharp fa-solid fa-money-bill"></i> $<?php echo $scholarship['scholarship_amount']; ?></h6>
                                            </li>
                                            <li>
                                                <h6><i class="fa-solid fa-clock"></i> <?php echo $scholarship['scholarship_deadline']; ?></h6>
                                            </li>
                                            <li>
                                                <h6><?php echo $scholarship['level_of_study']; ?></h6>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="button-group">
                                        <a href="#"><i class="fa-solid fa-share"></i></a>
                                        <a href=""><i class="fa-solid fa-bookmark"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <a class="btn shadow cus-btn" href="scholarshipList.php" role="button" style="font-family: 'Rajdhani', sans-serif; font-weight: 600; text-align: center; margin: 20px 0px">More</a>
            </div>
        </section>
    </main>
    <footer id="footerSection">
        <div class="container">
            <div class="row footer-section">
                <div class="col-md-3">
                    <h6>Scholars <span style="color: #37A447;">Journey</span></h6>
                    <ul>
                        <li><a href="#aboutSection">About Us</a></li>
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
    <!-- JS -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>