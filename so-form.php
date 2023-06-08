<?php

session_start();

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Officer Form - Scholars Journey</title>
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
                        <ul>
                            <li class="item1 active">LOGIN</li>
                            <li class="item2">REGISTRATION</li>
                        </ul>
                        <h6>Are you a <a href="student-form.php">Student</a> or a <a href="so-form.php">Scholarship
                                Officer</a>?
                        </h6>
                    </div>
                </div>
                <div class="row g-5">
                    <div class="col-md-12">
                        <div class="tab-1">
                            <form action="php/so_process_login.php" method="POST" class="a-form">
                                <div class="row g-5">
                                    <div class="col-md-12">
                                        <input type="text" name="user-mail" placeholder="Enter your email*" required
                                            id="userMail">
                                    </div>
                                </div>
                                <br>
                                <div class="row g-5">
                                    <div class="col-md-12">
                                        <input type="password" name="pass" placeholder="Password*" required
                                            id="user-pass">
                                    </div>
                                </div>
                                <br>
                                <div class="d-flex flex-row justify-content-center">
                                    <button class="btn cus-btn" type="submit">LOGIN</button>
                                    <a class="btn cus-btn" href="">Forgot Password</a>
                                </div>
                            </form>
                        </div>
                        <div class="tab-2">
                            <form action="php/so_process_registration.php" method="POST" class="a-form">
                                <p>Personal Information</p>
                                <div class="row g-5">
                                    <div class="col-md-6">
                                        <input type="text" name="first-name" placeholder="Enter your first name*"
                                            required id="firstName">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="last-name" placeholder="Enter your last name*" required
                                            id="lastName">
                                    </div>
                                    <div class="col-md-6" style="display: flex;
                                    justify-content: space-between;">
                                        <p class="cus-design"><label>Gender*: </label></p>
                                        <p class="cus-design"><input type="radio" name="gender" id="user-male"
                                                value="male"><label for="user-male">Male</label></p>
                                        <p class="cus-design"><input type="radio" name="gender" id="user-female"
                                                value="female"><label for="user-female">Female</label></p>
                                        <p class="cus-design"><input type="radio" name="gender" id="user-others"
                                                value="others"><label for="user-others">Others</label></p>
                                    </div>
                                    <div class="col-md-6" style="display: flex;
                                    justify-content: flex-start;">
                                        <p>Birthday*: <input type="date" id="birthday" name="birth-day"></p>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" name="mail" placeholder="Enter your Email*" required
                                            id="e-mail">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" name="c-mail" placeholder="Confirm your Email*" required
                                            id="c-e-mail">
                                    </div>
                                </div>
                                <br>
                                <p>Professional Information</p>
                                <div class="row g-5">
                                    <div class="col-md-6">
                                        <input type="url" name="site-url" placeholder="Website*" required id="website">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="so-designation" placeholder="Designation*" required
                                            id="designation">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="institute" placeholder="Institute*" required
                                            id="user-institute">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="institute-add" placeholder="Institute Address*"
                                            required id="user-institute-add">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="tel" name="phone" placeholder="Contact Number*" required
                                            id="user-phone">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="short-bio" placeholder="Short Bio*" required
                                            id="user-short-bio">
                                    </div>
                                </div>
                                <br>
                                <p>Location</p>
                                <div class="row g-5">
                                    <div class="col-md-6">
                                        <input type="text" name="country" placeholder="Country*" required
                                            id="user-country">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="city" placeholder="City*" required id="user-city">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="address" placeholder="Address*" required
                                            id="user-address">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="zipcode" placeholder="Zip Code*" required
                                            id="user-zipcode">
                                    </div>
                                </div>
                                <br>
                                <p>Secure Account</p>
                                <div class="row g-5">
                                    <div class="col-md-6">
                                        <input type="password" name="pass" placeholder="Password*" required
                                            id="user-pass">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="password" name="cpass" placeholder="Confirm Password*" required
                                            id="user-cpass">
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
                                    <button class="btn cus-btn" type="submit">SIGN UP</button>
                                </div>
                            </form>
                        </div>
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
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

    <!-- jquery tab code -->
    <script>
        $(document).ready(function () {
            $(".tab-2").hide();//only one is active, rests 

            //item1
            $(".item1").on("click", function () {
                $(".tab-1").show();
                $(".tab-2").hide();

                $(".item1").addClass("active");
                $(".item2").removeClass("active");
            });
            //item2
            $(".item2").on("click", function () {
                $(".tab-1").hide();
                $(".tab-2").show();

                $(".item1").removeClass("active");
                $(".item2").addClass("active");
            });
        });
    </script>
</body>

    </html>