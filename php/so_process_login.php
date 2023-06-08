<?php
//check error
session_start();
@include 'config.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $usermail = clean_data($_POST['user-mail']);
    $pass_word = clean_data($_POST['pass']);

    //Perform validation on the form data
    $errors = [];

    // Validate email
    if (empty($usermail)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($usermail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    // Validate password
    if (empty($pass_word)) {
        $errors[] = "Password is required";
    }

    // Check if there are any errors
    if (count($errors) > 0) {
        // Display the errors
        foreach ($errors as $error) {
            echo "<p>Error: $error</p>";
        }
    } 
    else {
        $pass_word = md5($pass_word);
        $select = "SELECT * FROM scholarship_officers WHERE email = '$usermail' && password = '$pass_word'";
        $result = mysqli_query($conn, $select);
        if (mysqli_num_rows($result) > 0) {
            $query  = "SELECT last_name FROM scholarship_officers WHERE email = '$usermail' && password = '$pass_word'";
            $result2 = mysqli_query($conn, $query);
            $row = $result->fetch_assoc();
            $_SESSION['login_done'] = $row['last_name'];
            $_SESSION['user_type'] = "scholarship_officers";
            $_SESSION['get_email'] = $row['email'];
            header('location: ../so-dashboard.php');
        }
        else {
            // If the form was not submitted, redirect the user to the registration page
            echo '<script>
                alert("Error Occured!");
                // Redirect to another page
                window.location.href = "../so-form.php";
             </script>';
            exit;
        }
    }
}
else {
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
