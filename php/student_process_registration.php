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
    $degree = clean_data($_POST['degree']);
    $program = clean_data($_POST['program']);
    $institution = clean_data($_POST['institute']);
    $graduation = clean_data($_POST['grad-day']);
    $address = clean_data($_POST['address']);
    $country = clean_data($_POST['country']);
    $zipcode = clean_data($_POST['zipcode']);
    $city = clean_data($_POST['city']);
    $pass_word = clean_data($_POST['pass']);
    $confirmPassword = clean_data($_POST['cpass']);
    $notification1 = isset($_POST['not-pre-1']) ? $_POST['not-pre-1'] : "";
    $notification2 = isset($_POST['not-pre-2']) ? $_POST['not-pre-2'] : "";
    $terms = isset($_POST['terms']) ? $_POST['terms'] : "";


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

    // Validate degree
    if (empty($degree)) {
        $errors[] = "Current degree is required";
    }

    // Validate program
    if (empty($program)) {
        $errors[] = "Program is required";
    }

    // Validate institution
    if (empty($institution)) {
        $errors[] = "Institution is required";
    }

    // Validate graduation date
    if (empty($graduation)) {
        $errors[] = "Graduation date is required";
    }

    // Validate address
    if (empty($address)) {
        $errors[] = "Address is required";
    }

    // Validate country
    if (empty($country)) {
        $errors[] = "Country is required";
    }

    // Validate zip code
    if (empty($zipcode)) {
        $errors[] = "Zip code is required";
    }

    // Validate city
    if (empty($city)) {
        $errors[] = "City is required";
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
    if (empty($terms)) {
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
            $stmt = $pdo->prepare("INSERT INTO `students` (`first_name`, `last_name`, `gender`, `birthday`, `email`, `current_degree`, `program`, `institution`, `graduation_date`, `address`, `country`, `zip_code`, `city`, `password`) VALUES (:fname, :lname, :gen, :bdate, :eMail, :deg, :prgrm, :instte, :grad, :addr, :cntry, :zcode, :cty, :pass)");
            $pass_word = md5($pass_word);
            // Bind the parameters
            $stmt->bindValue(':fname', $firstName);
            $stmt->bindValue(':lname', $lastName);
            $stmt->bindValue(':gen', $gender);
            $stmt->bindValue(':bdate', $birthday);
            $stmt->bindValue(':eMail', $email);
            $stmt->bindValue(':deg', $degree);
            $stmt->bindValue(':prgrm', $program);
            $stmt->bindValue(':instte', $institution);
            $stmt->bindValue(':grad', $graduation);
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
        window.location.href = "../student-form.php";
     </script>';
            exit;
        } catch (PDOException $e) {
            // Display error message or redirect to an error page
            echo '<script>
        alert("Error Occured!");
        // Redirect to another page
        window.location.href = "../student-form.php";
     </script>';
            exit;
        }
    }
} else {
    // If the form was not submitted, redirect the user to the registration page
    echo '<script>
        alert("Error Occured!");
        // Redirect to another page
        window.location.href = "../student-form.php";
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
