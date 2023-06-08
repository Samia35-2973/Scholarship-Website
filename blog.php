<?php

session_start();

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blogs - Scholars Journey</title>
    <link rel="shortcut icon" href="images/blogs/logo.png" type="image/x-icon">
    <!-- Linking CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/blog.css">
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
                    <form action="" class="login-form">
                        <h1>Write a Scholarship Blog</h1>
                        <input type="text" id="bloggerName" name="blogger-name" required placeholder="Enter Your Name">
                        <input type="text" id="blogTitle" name="blog-title" required placeholder="Blog Title">
                        <textarea name="blog" id="blogText" cols="48" rows="5"
                            placeholder="Write your blog here"></textarea>
                        <button type="submit" class="btn shadow">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </header>
    <main>
        <section class="blog-section">
            <div class="container">
                <div class="row g-5">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Blog Title</h5>
                                <h6 class="card-subtitle mb-2">User Name, 23 July 2023</h6>
                                <p class="card-text">"Unlocking Opportunities: Your Guide to Scholarships" is an
                                    exceptional resource for students. With a user-friendly interface and personalized
                                    recommendations, it streamlines the scholarship search process. Their commitment to
                                    guiding students and eliminating financial barriers shines through. Highly
                                    recommended for accessing valuable funding opportunities and achieving academic
                                    dreams.</p>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn card-link" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    View More
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Blog Title</h1>
                                            </div>
                                            <div class="modal-body">
                                                <h6 class="card-subtitle mb-2">User Name, 23 July 2023</h6>
                                                <p class="card-text">"Unlocking Opportunities: Your Guide to
                                                    Scholarships" is an
                                                    exceptional resource for students. With a user-friendly interface
                                                    and personalized
                                                    recommendations, it streamlines the scholarship search process.
                                                    Their commitment to
                                                    guiding students and eliminating financial barriers shines through.
                                                    Highly
                                                    recommended for accessing valuable funding opportunities and
                                                    achieving academic
                                                    dreams.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Blog Title</h5>
                                <h6 class="card-subtitle mb-2">User Name, 23 July 2023</h6>
                                <p class="card-text">"Unlocking Opportunities: Your Guide to Scholarships" is an
                                    exceptional resource for students. With a user-friendly interface and personalized
                                    recommendations, it streamlines the scholarship search process. Their commitment to
                                    guiding students and eliminating financial barriers shines through. Highly
                                    recommended for accessing valuable funding opportunities and achieving academic
                                    dreams.</p>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn card-link" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    View More
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Blog Title</h1>
                                            </div>
                                            <div class="modal-body">
                                                <h6 class="card-subtitle mb-2">User Name, 23 July 2023</h6>
                                                <p class="card-text">"Unlocking Opportunities: Your Guide to
                                                    Scholarships" is an
                                                    exceptional resource for students. With a user-friendly interface
                                                    and personalized
                                                    recommendations, it streamlines the scholarship search process.
                                                    Their commitment to
                                                    guiding students and eliminating financial barriers shines through.
                                                    Highly
                                                    recommended for accessing valuable funding opportunities and
                                                    achieving academic
                                                    dreams.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Blog Title</h5>
                                <h6 class="card-subtitle mb-2">User Name, 23 July 2023</h6>
                                <p class="card-text">"Unlocking Opportunities: Your Guide to Scholarships" is an
                                    exceptional resource for students. With a user-friendly interface and personalized
                                    recommendations, it streamlines the scholarship search process. Their commitment to
                                    guiding students and eliminating financial barriers shines through. Highly
                                    recommended for accessing valuable funding opportunities and achieving academic
                                    dreams.</p>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn card-link" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    View More
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Blog Title</h1>
                                            </div>
                                            <div class="modal-body">
                                                <h6 class="card-subtitle mb-2">User Name, 23 July 2023</h6>
                                                <p class="card-text">"Unlocking Opportunities: Your Guide to
                                                    Scholarships" is an
                                                    exceptional resource for students. With a user-friendly interface
                                                    and personalized
                                                    recommendations, it streamlines the scholarship search process.
                                                    Their commitment to
                                                    guiding students and eliminating financial barriers shines through.
                                                    Highly
                                                    recommended for accessing valuable funding opportunities and
                                                    achieving academic
                                                    dreams.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Blog Title</h5>
                                <h6 class="card-subtitle mb-2">User Name, 23 July 2023</h6>
                                <p class="card-text">"Unlocking Opportunities: Your Guide to Scholarships" is an
                                    exceptional resource for students. With a user-friendly interface and personalized
                                    recommendations, it streamlines the scholarship search process. Their commitment to
                                    guiding students and eliminating financial barriers shines through. Highly
                                    recommended for accessing valuable funding opportunities and achieving academic
                                    dreams.</p>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn card-link" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop">
                                    View More
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Blog Title</h1>
                                            </div>
                                            <div class="modal-body">
                                                <h6 class="card-subtitle mb-2">User Name, 23 July 2023</h6>
                                                <p class="card-text">"Unlocking Opportunities: Your Guide to
                                                    Scholarships" is an
                                                    exceptional resource for students. With a user-friendly interface
                                                    and personalized
                                                    recommendations, it streamlines the scholarship search process.
                                                    Their commitment to
                                                    guiding students and eliminating financial barriers shines through.
                                                    Highly
                                                    recommended for accessing valuable funding opportunities and
                                                    achieving academic
                                                    dreams.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                        <li><a href="index.php#reviewSection">Reviews</a></li>
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
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>