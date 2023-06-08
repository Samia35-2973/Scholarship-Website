<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
$host = 'localhost';
$dbname = 'scholarship-website';
$username = 'root';
$password = '';

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle database connection errors
    echo "Connection failed: " . $e->getMessage();
    exit;
}
$scholarshipId = $_GET['id'];

// Prepare and execute a SQL query to retrieve the scholarship details
$sql = "SELECT * FROM scholarships WHERE scholarship_id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $scholarshipId);
$stmt->execute();
$scholarship = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the scholarship exists
if (!$scholarship) {
    echo '<script>
        alert("Sorry, the page you request is not found!");
        // Redirect to another page
        window.location.href = "../scholarshipList.php";
     </script>';
    exit;
}
$stemail = $_SESSION['get_email'];

$query = "SELECT student_id FROM students WHERE email = :email";
$stmnt = $pdo->prepare($query);
$stmnt->bindValue(':email', $stemail);
$stmnt->execute();
$result = $stmnt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    $studentId = $result['student_id'];
}


?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Scholarship - Scholars Journey</title>
    <link rel="shortcut icon" href="images/blogs/logo.png" type="image/x-icon">
    <!-- Linking CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/scholarship.css">
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
                        <h1><?php echo $scholarship['scholarship_name']; ?></h1>
                        <p><?php echo $scholarship['scholarship_description']; ?></p>
                        <div class="input-group">
                            <a class="btn" href="<?php echo $scholarship['URL']; ?>">VIEW SCHOLARSHIP SITE</a>
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
                        <h2>Organizational Details</h2>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-subtitle mb-2">Organization: <span style="color: #000000;"><?php echo $scholarship['organization_name']; ?></span></h5>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-subtitle mb-2">Country: <span style="color: #000000;"><?php echo $scholarship['organization_country']; ?></span></h5>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-subtitle mb-2">Email: <span style="color: #000000;"><?php echo $scholarship['organization_email']; ?></span></h5>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-subtitle mb-2">Phone: <span style="color: #000000;"><?php echo $scholarship['organization_phone']; ?></span></h5>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-subtitle mb-2">Officer: <span style="color: #000000;"><?php echo $scholarship['officer_name']; ?></span></h5>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-subtitle mb-2">Address: <span style="color: #000000;"><?php echo $scholarship['organization_address']; ?></span></h5>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <section class="scholarship-section">
            <div class="container d-flex flex-column align-items-center">
                <div class="row g-5 d-flex align-items-center">
                    <div class="col-md-6">
                        <h2>Scholarship Details</h2>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Application Process</h5>
                                <h6 class="card-subtitle mb-2"><?php echo $scholarship['organization_name']; ?></h6>
                                <div class="card-details">
                                    <p><?php echo $scholarship['application_process']; ?></p>
                                </div>
                                <div class="button-group">
                                    <?php
                                        if(isset($_SESSION['login_done'])){
                                            if($_SESSION['user_type'] == "student") {
                                                echo '<form method="POST" action="php/scholarship_redirect.php">
                                                    <input type="hidden" name="scholarshipId" value="' . $scholarshipId . '">
                                                    <input type="hidden" name="studentId" value="' . $studentId . '">
                                                    <button class="btn cus-btn" name="apply-red-btn" style="font-size: 15px; height: fit-content;">APPLY</button>
                                                    <button class="btn cus-btn" name="withdr-red-btn" style="font-size: 15px; height: fit-content;">WITHDRAW</button>
                                                </form>';

                                            }
                                            else{
                                                echo '<form method="POST" action="php/scholarship_redirect.php">
                                                <input type="hidden" name="scholarshipId" value="' . $scholarshipId . '">
                                                <button class="btn cus-btn" name="list-red-btn" style="font-size: 15px; height: fit-content;">VIEW LIST</button>
                                                <button class="btn cus-btn" name="dlt-red-btn" style="font-size: 15px; height: fit-content;">DELETE</button>
                                                </form>';
                                            }
                                        }
                                        else echo "Login to get started!"
                                    ?>
                                    <!-- <a href="application.php" class="btn cus-btn"
                                        style="font-size: 15px; height: fit-content;">APPLY</a>
                                    <a href="application.php" class="btn cus-btn"
                                        style="font-size: 15px; height: fit-content;">WITHDRAW</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-details">
                                    <ul>
                                        <li>
                                            <h6>
                                                <i class="fa-solid fa-hand-holding-dollar"> <?php echo $scholarship['num_scholarships_available']; ?></i>
                                            </h6>
                                        </li>
                                        <li>
                                            <h6>
                                                <i class="fa-solid fa-clock"> <?php echo $scholarship['scholarship_duration']; ?></i>
                                            </h6>
                                        </li>
                                        <li>
                                            <h6><i class="fa-sharp fa-solid fa-money-bill"></i> <?php echo $scholarship['scholarship_amount']; ?></h6>
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
                </div>
            </div>
        </section>
        <section class="eligibility-section" id="eligibilitySection">
            <h2>Eligibility Criteria</h2>
            <div class="container d-flex flex-column align-items-center">
                <div class="row g-5 d-flex align-items-center">
                    <div class="col-md-6 card-body-func">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-subtitle mb-2">Academic Requirements: </h5>
                                <p class="card-text"><?php echo $scholarship['academic_requirements']; ?></p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-subtitle mb-2">Transcript Requirements: </h5>
                                <p class="card-text"><?php echo $scholarship['transcript_requirements']; ?></p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-subtitle mb-2">Letter of Recommendation Requirements: </h5>
                                <p class="card-text"><?php echo $scholarship['recommendation_letter_requirements']; ?></p>

                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-subtitle mb-2">Essay Requirement: </h5>
                                <p class="card-text"><?php echo $scholarship['essay_requirements']; ?></p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-subtitle mb-2">Field of Study: </h5>
                                <p class="card-text"><?php echo $scholarship['field_of_study']; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <img src="https://static.vecteezy.com/system/resources/previews/011/125/363/original/cute-globe-cartoon-icon-png.png"
                            alt="" width="60%">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-subtitle mb-2">Country: <span style="color: #000000;"><?php echo $scholarship['organization_country']; ?></span></h5>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-subtitle mb-2">City: <span style="color: #000000;"><?php echo $scholarship['organization_city']; ?></span>
                                </h5>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-subtitle mb-2">Zip Code: <span style="color: #000000;"><?php echo $scholarship['organization_zip_code']; ?></span>
                                </h5>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-subtitle mb-2">Address: <span style="color: #000000;"><?php echo $scholarship['organization_address']; ?></span></h5>
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