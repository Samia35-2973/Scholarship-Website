<?php
session_start();

// Database connection details
$host = 'localhost';
$dbname = 'scholarship-website';
$username = 'root';
$password = '';

// Retrieve scholarship data from the database
try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Retrieve available countries from the database
    $stmt = $pdo->query("SELECT DISTINCT country FROM scholarships");
    $countries = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Retrieve available programs from the database
    $stmt = $pdo->query("SELECT DISTINCT level_of_study FROM scholarships");
    $programs = $stmt->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>List of Scholarships - Scholars Journey</title>
    <link rel="shortcut icon" href="images/blogs/logo.png" type="image/x-icon">
    <!-- Linking CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/scholarshipList.css">
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
        <section class="list-section">
            <div class="container">
                <div class="row g-5">
                    <div class="col-md-4">
                        <form method="POST" action="">
                            <fieldset>
                                <legend>Destination</legend>
                                <?php foreach ($countries as $country) { ?>
                                    <p>
                                        <input type="checkbox" name="country[]" value="<?php echo $country; ?>" id="<?php echo $country; ?>">
                                        <label for="<?php echo $country; ?>"><?php echo $country; ?></label>
                                    </p>
                                <?php } ?>
                            </fieldset>
                            <hr>
                            <fieldset>
                                <legend>Program</legend>
                                <?php foreach ($programs as $program) { ?>
                                    <p>
                                        <input type="checkbox" name="program[]" value="<?php echo $program; ?>" id="<?php echo $program; ?>">
                                        <label for="<?php echo $program; ?>"><?php echo $program; ?></label>
                                    </p>
                                <?php } ?>
                            </fieldset>
                            <button type="submit" class="btn cus-btn mx-auto">Apply</button>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <div class="row g-5">
                            <?php
                            // Retrieve the selected filters
                            $selectedCountries = isset($_POST['country']) ? $_POST['country'] : array();
                            $selectedPrograms = isset($_POST['program']) ? $_POST['program'] : array();

                            // Generate the placeholders for the selected filters
                            $countryPlaceholders = implode(',', array_fill(0, count($selectedCountries), '?'));
                            $programPlaceholders = implode(',', array_fill(0, count($selectedPrograms), '?'));

                            // Prepare the SQL query with the filters
                            $sql = "SELECT * FROM scholarships";
                            $params = array();

                            if (!empty($selectedCountries) && !empty($selectedPrograms)) {
                                $sql .= " WHERE country IN ($countryPlaceholders) AND level_of_study IN ($programPlaceholders)";
                                $params = array_merge($params, $selectedCountries, $selectedPrograms);
                            } elseif (!empty($selectedCountries)) {
                                $sql .= " WHERE country IN ($countryPlaceholders)";
                                $params = array_merge($params, $selectedCountries);
                            } elseif (!empty($selectedPrograms)) {
                                $sql .= " WHERE level_of_study IN ($programPlaceholders)";
                                $params = array_merge($params, $selectedPrograms);
                            }

                            try {
                                // Execute the filtered query
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute($params);
                                $scholarships = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                $totalScholarships = count($scholarships);
                                echo '<h3>Total Scholarships Available: ' . $totalScholarships . '</h3>';
                                // Loop through scholarships and generate HTML markup
                                foreach ($scholarships as $scholarship) {
                                    $scholarshipID = $scholarship['scholarship_id'];
                                    $scholarshipName = $scholarship['scholarship_name'];
                                    $scholarshipURL = "scholarship-view.php?id=" . $scholarshipID;
                                    $scholarshipAmount = $scholarship['scholarship_amount'];
                                    $deadline = $scholarship['scholarship_deadline'];
                                    $levelOfStudy = $scholarship['level_of_study'];
                                    $description = $scholarship['scholarship_description'];
                                    ?>
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title"><a href="<?php echo $scholarshipURL ?>" style="color: #359E47; text-decoration: none;"><?php echo $scholarshipName ?></a></h5>
                                                <p class="card-text mb-2"><?php echo $description ?></p>
                                                <div class="card-details">
                                                    <ul>
                                                        <li>
                                                            <h6><i class="fa-sharp fa-solid fa-money-bill"></i> $<?php echo $scholarshipAmount ?></h6>
                                                        </li>
                                                        <li>
                                                            <h6><i class="fa-solid fa-clock"></i> <?php echo $deadline ?></h6>
                                                        </li>
                                                        <li>
                                                            <h6><?php echo $levelOfStudy ?></h6>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                            } catch (PDOException $e) {
                                echo "Error: " . $e->getMessage();
                            }
                            ?>
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