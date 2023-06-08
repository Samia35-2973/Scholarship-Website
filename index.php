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
    <title>Homepage - Scholars Journey</title>
    <link rel="shortcut icon" href="images/blogs/logo.png" type="image/x-icon">
    <!-- Linking CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
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
                        <h1>Unlock Opportunities by Discovering your Path towards Academic Success</h1>
                        <p>Explore a wide range of scholarship options tailored to your unique profile and aspirations,
                            from merit-based awards to specialized scholarships in various fields of study. Our
                            user-friendly platform provides personalized recommendations and expert guidance, ensuring
                            you never miss out on valuable funding opportunities. Take control of your education journey
                            and unlock a brighter future by accessing the tools and resources you need to finance your
                            dreams.</p>
                        <div class="input-group">
                            <a class="btn cus-btn" href="scholarshipList.php">Find Scholarship</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>
        <section class="about-section" id="aboutSection">
            <div class="container">
                <div class="row g-5">
                    <div class="col-md-6">
                        <img src="https://cdni.iconscout.com/illustration/premium/thumb/education-scholarship-6076743-5036711.png?f=webp"
                            alt="" width="75%">
                    </div>
                    <div class="col-md-6">
                        <h2>About Us</h2>
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2"><i class="fa-solid fa-pencil"></i>
                                    Unlock New Doors</h6>
                                <p class="card-text">We are dedicated to empowering students in their pursuit of higher
                                    education by providing comprehensive scholarship resources. Our mission is to unlock
                                    the doors to academic success, ensuring that no deserving student is held back due
                                    to financial constraints.</p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2"><i class="fa-solid fa-pencil"></i>
                                    Institution Match</h6>
                                <p class="card-text">We match you to the right institute according to your preferred
                                    country and education. There will be more than one search result so that there will
                                    be more options for you to explore.</p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2"><i class="fa-solid fa-pencil"></i>
                                    Scholarship Reminders</h6>
                                <p class="card-text">Get notified whenever a new scholarship is added. You can also be
                                    notified for any updates of a scholarship that you applied or liked.</p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-2"><i class="fa-solid fa-pencil"></i>
                                    Start your Journey</h6>
                                <p class="card-text">Start your journey now by registering yourself. Complete your
                                    scholarship profile so that your journey of application doesn’t take long.</p>
                            </div>
                        </div>
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
        <section class="review-section" id="reviewSection">
            <h2>Reviews</h2>
            <div class="container d-flex flex-column align-items-center">
                <div class="row g-5">
                    <div class="col-md-12">
                        <div id="carouselExampleCaptions" class="carousel slide">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="https://assets.stickpng.com/images/585e4bf3cb11b227491c339a.png"
                                        width="30%" class="mx-auto d-block">
                                    <h5>Username</h5>
                                    <p>"With a user-friendly interface and personalized recommendations, it
                                        streamlines the scholarship search process. Their commitment to guiding
                                        students and eliminating financial barriers shines through. Highly
                                        recommended for accessing valuable funding opportunities and achieving
                                        academic dreams.</p>
                                </div>
                                <div class="carousel-item">
                                    <img src="https://assets.stickpng.com/images/585e4bf3cb11b227491c339a.png"
                                        width="30%" class="mx-auto d-block">
                                    <h5>Username-2</h5>
                                    <p>"With a user-friendly interface and personalized recommendations, it
                                        streamlines the scholarship search process. Their commitment to guiding
                                        students</p>
                                </div>
                                <div class="carousel-item">
                                    <img src="https://assets.stickpng.com/images/585e4bf3cb11b227491c339a.png"
                                        width="30%" class="mx-auto d-block">
                                    <h5>Username-3</h5>
                                    <p>"With a user-friendly interface and personalized recommendations, it
                                        streamlines the scholarship search process. Their commitment to guiding
                                        students and eliminating financial barriers shines through.</p>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
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
    <!-- JS -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>