<?php
//check error
// error_reporting(E_ALL);
// ini_set('display_errors', 1);


// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $firstName = clean_data($_POST['first-name']);
    $lastName = clean_data($_POST['last-name']);
    $gender = clean_data($_POST['gender']);
    $birthday = clean_data($_POST['birth-day']);
    $email = clean_data($_POST['mail']);
    $confirmEmail = clean_data($_POST['c-mail']);
    $website = clean_data($_POST['site-url']);
    $designation = clean_data($_POST['so-designation']);
    $institute = clean_data($_POST['institute']);
    $instituteAddress = clean_data($_POST['institute-add']);
    $phoneNumber = clean_data($_POST['phone']);
    $shortBio = clean_data($_POST['short-bio']);
    $country = clean_data($_POST['country']);
    $city = clean_data($_POST['city']);
    $address = clean_data($_POST['address']);
    $zipcode = clean_data($_POST['zipcode']);
    $pass_word = clean_data($_POST['pass']);
    $confirmPassword = clean_data($_POST['cpass']);
    $notificationPref1 = isset($_POST['not-pre-1']) ? clean_data($_POST['not-pre-1']) : '';
    $notificationPref2 = isset($_POST['not-pre-2']) ? clean_data($_POST['not-pre-2']) : '';
    $termsAgreed = isset($_POST['terms']) ? clean_data($_POST['terms']) : '';

    // Perform validation on the form data
    $errors = [];

    // Validate first name
    if (empty($firstName)) {
        $errors[] = "First name is required";
    }

    // Validate last name
    if (empty($lastName)) {
        $errors[] = "Last name is required";
    }

    // Validate gender
    if (empty($gender)) {
        $errors[] = "Gender is required";
    }

    // Validate birthday
    if (empty($birthday)) {
        $errors[] = "Birthday is required";
    }

    // Validate email
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // Validate confirm email
    if (empty($confirmEmail)) {
        $errors[] = "Confirm email is required";
    } elseif ($email !== $confirmEmail) {
        $errors[] = "Email and confirm email do not match";
    }

    // Validate website
    if (empty($website)) {
        $errors[] = "Website is required";
    } elseif (!filter_var($website, FILTER_VALIDATE_URL)) {
        $errors[] = "Invalid website URL";
    }
    // Validate designation
    if (empty($designation)) {
        $errors[] = "Designation is required";
    }

    // Validate institute
    if (empty($institute)) {
        $errors[] = "Institute is required";
    }

    // Validate institute address
    if (empty($instituteAddress)) {
        $errors[] = "Institute address is required";
    }

    // Validate phone number
    if (empty($phoneNumber)) {
        $errors[] = "Contact number is required";
    } elseif (!preg_match('/^[0-9]{11}$/', $phoneNumber)) {
        $errors[] = "Invalid phone number format. Please enter a 10-digit number.";
    }

    // Validate short bio
    if (empty($shortBio)) {
        $errors[] = "Short bio is required";
    }

    // Validate country
    if (empty($country)) {
        $errors[] = "Country is required";
    }

    // Validate city
    if (empty($city)) {
        $errors[] = "City is required";
    }

    // Validate address
    if (empty($address)) {
        $errors[] = "Address is required";
    }

    // Validate zipcode
    if (empty($zipcode)) {
        $errors[] = "Zip code is required";
    }

    // Validate password
    if (empty($pass_word)) {
        $errors[] = "Password is required";
    } elseif (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $pass_word)) {
        $errors[] = "Password must be at least 8 characters long and contain at least one letter, one number, and one special character.";
    }

    // Validate confirm password
    if (empty($confirmPassword)) {
        $errors[] = "Confirm password is required";
    } elseif ($pass_word !== $confirmPassword) {
        $errors[] = "Password and confirm password do not match";
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
            $stmt = $pdo->prepare("INSERT INTO `scholarship_officers` (`first_name`, `last_name`, `gender`, `birthday`, `email`, `personal_website`, `designation`, `institute_name`, `institute_address`, `phone`, `short_bio`, `address`, `country`, `zip_code`, `city`, `password`) VALUES (:fname, :lname, :gen, :bdate, :eMail, :p_site, :design, :instte, :instte_add, :phn, :bio, :addr, :cntry, :zcode, :cty, :pass)");
            $pass_word = md5($pass_word);

            // Bind the parameters
            $stmt->bindValue(':fname', $firstName);
            $stmt->bindValue(':lname', $lastName);
            $stmt->bindValue(':gen', $gender);
            $stmt->bindValue(':bdate', $birthday);
            $stmt->bindValue(':eMail', $email);
            $stmt->bindValue(':p_site', $website);
            $stmt->bindValue(':design', $designation);
            $stmt->bindValue(':instte', $institute);
            $stmt->bindValue(':instte_add', $instituteAddress);
            $stmt->bindValue(':phn', $phoneNumber);
            $stmt->bindValue(':bio', $shortBio);
            $stmt->bindValue(':addr', $address);
            $stmt->bindValue(':cntry', $country);
            $stmt->bindValue(':zcode', $zipcode);
            $stmt->bindValue(':cty', $city);
            $stmt->bindValue(':pass', $pass_word);

            // Execute the insert statement
            $stmt->execute();

            // Display success message or redirect to a success page
            echo '<script>
                    alert("Registration successful! Login to get started!");
                    // Redirect to another page
                    window.location.href = "../so-form.php";
                </script>';
            exit;
        } catch (PDOException $e) {
            // Display error message or redirect to an error page
            echo '<script>
                    alert("Error Occured!");
                    // Redirect to another page
                    window.location.href = "../so-form.php";
                </script>';
            exit;
        }
    }
} else {
    // If the form was not submitted, redirect the user to the registration page
    echo '<script>
        alert("Error Occured!");
        // Redirect to another page
        window.location.href = "../so-form.php";
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
