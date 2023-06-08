<?php
//check error
// error_reporting(E_ALL);
// ini_set('display_errors', 1);


// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $scholarshipName = clean_data($_POST["s-name"]);
    $issueDate = clean_data($_POST["issue-day"]);
    $orgName = clean_data($_POST["org-name"]);
    $officerName = clean_data($_POST["officer-name"]);
    $orgPhone = clean_data($_POST["org-phone"]);
    $orgEmail = clean_data($_POST["org-mail"]);
    $website = clean_data($_POST["site-url"]);
    $orgCountry = clean_data($_POST["country"]);
    $numScholarships = clean_data($_POST["n-scholarships"]);
    $scholarshipAmount = clean_data($_POST["scol-amnt"]);
    $scholarshipDescription = $_POST["description"];
    $applicationProcess = $_POST["app-process"];
    $deadline = clean_data($_POST["deadline-day"]);
    $duration = clean_data($_POST["tot-duration"]);
    $academicRequirements = $_POST["acdemic-req"];
    $transcriptRequirements = $_POST["transcript-req"];
    $recommendationRequirements = $_POST["letter-req"];
    $essayRequirements = $_POST["essay-req"];
    $fieldOfStudy = clean_data($_POST["field-name"]);
    $levelOfStudy = clean_data($_POST["level-name"]);
    $country = clean_data($_POST["country"]);
    $city = clean_data($_POST["city"]);
    $address = clean_data($_POST["address"]);
    $zipcode = clean_data($_POST["zipcode"]);
    $collaborationOrganization = clean_data($_POST["col-org"]);
    $collaborationDetails = $_POST["col-det"];
    $termsAgreed = isset($_POST['terms']) ? clean_data($_POST['terms']) : '';

    // Perform validation on the form data
    $errors = [];

    // Validate email
    if (empty($orgEmail)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($orgEmail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // Validate website
    if (empty($website)) {
        $errors[] = "Website is required";
    } elseif (!filter_var($website, FILTER_VALIDATE_URL)) {
        $errors[] = "Invalid website URL";
    }

    // Validate phone number
    if (empty($orgPhone)) {
        $errors[] = "Contact number is required";
    } elseif (!preg_match('/^[0-9]{11}$/', $orgPhone)) {
        $errors[] = "Invalid phone number format. Please enter a 10-digit number.";
    }

    // Validate terms agreement
    if (empty($termsAgreed)) {
        $errors[] = "You must agree to the terms and conditions";
    }

    // Check if there are any errors
    if (count($errors) > 0) {
        // Display the errors
        foreach ($errors as $error) {
            echo "<p>Error: $error</p>";
        }
    } else {
        // If there are no errors, proceed with database insertion

        // Database connection details
        $host = 'localhost';
        $dbname = 'scholarship-website';
        $username = 'root';
        $password = '';

        try {
            // Create a new PDO instance
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Prepare the insert statement
            $stmt = $pdo->prepare("INSERT INTO `scholarships` (`scholarship_name`, `issue_date`, `organization_name`, `officer_name`, `organization_phone`, `organization_email`, `country`, `URL`, `num_scholarships_available`, `scholarship_amount`, `scholarship_description`, `application_process`, `scholarship_deadline`, `scholarship_duration`, `academic_requirements`, `transcript_requirements`, `recommendation_letter_requirements`, `essay_requirements`, `field_of_study`, `level_of_study`, `organization_address`, `organization_country`, `organization_zip_code`, `organization_city`, `collaboration_organization_name`, `collaboration_details`) VALUES (:scholName, :issuedate, :orgname, :officername, :orgphone, :orgemail, :counTry, :webSite, :numscholarships, :scholarshipamount, :scholarshipdescription, :applicationprocess, :deadLine, :duraTion, :academicrequirements, :transcriptrequirements, :recommendationrequirements, :essayrequirements, :fieldofStudy, :levelofStudy, :insaddress, :orgcountry, :zipCode, :ciTy, :collaborationorganization, :collaborationdetails)");
            
            //bind
            $stmt->bindValue(':scholName', $scholarshipName);
            $stmt->bindValue(':issuedate', $issueDate);
            $stmt->bindValue(':orgname', $orgName);
            $stmt->bindValue(':officername', $officerName);
            $stmt->bindValue(':orgphone', $orgPhone);
            $stmt->bindValue(':orgemail', $orgEmail);
            $stmt->bindValue(':counTry', $country);
            $stmt->bindValue(':webSite', $website);
            $stmt->bindValue(':numscholarships', $numScholarships);
            $stmt->bindValue(':scholarshipamount', $scholarshipAmount);
            $stmt->bindValue(':scholarshipdescription', $scholarshipDescription);
            $stmt->bindValue(':applicationprocess', $applicationProcess);
            $stmt->bindValue(':deadLine', $deadline);
            $stmt->bindValue(':duraTion', $duration);
            $stmt->bindValue(':academicrequirements', $academicRequirements);
            $stmt->bindValue(':transcriptrequirements', $transcriptRequirements);
            $stmt->bindValue(':recommendationrequirements', $recommendationRequirements);
            $stmt->bindValue(':essayrequirements', $essayRequirements);
            $stmt->bindValue(':fieldofStudy', $fieldOfStudy);
            $stmt->bindValue(':levelofStudy', $levelOfStudy);
            $stmt->bindValue(':insaddress', $address);
            $stmt->bindValue(':orgcountry', $orgCountry);
            $stmt->bindValue(':zipCode', $zipcode);
            $stmt->bindValue(':ciTy', $city);
            $stmt->bindValue(':collaborationorganization', $collaborationOrganization);
            $stmt->bindValue(':collaborationdetails', $collaborationDetails);
            
            // Execute the insert statement
            $stmt->execute();

            // Display success message or redirect to a success page
            echo '<script>
                    alert("Scholarship Added successfully!");
                    // Redirect to another page
                    window.location.href = "../so-dashboard.php";
                </script>';
            exit;
        } catch (PDOException $e) {
            // Display error message or redirect to an error page
            echo '<script>
                    alert("Error Occured!");
                    // Redirect to another page
                    window.location.href = "../add-scholarship.php";
                </script>';
            exit;
        }
    }
} else {
    // If the form was not submitted, redirect the user to the registration page
    echo '<script>
        alert("Error Occured!");
        // Redirect to another page
        window.location.href = "../add-scholarship.php";
     </script>';
    exit;
}

function clean_data($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
