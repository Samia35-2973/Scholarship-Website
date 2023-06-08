<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Set session lifetime to 60 seconds
$session_lifetime = 60;
session_set_cookie_params($session_lifetime);
session_start();

// Check if the user is not logged in or the session has expired
if (!isset($_SESSION['logged_in']) || (isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > $session_lifetime)) {
    // Destroy the session and redirect to the index page
    session_unset();    // Unset all session variables
    session_destroy();  // Destroy the session
    echo '<script>
            alert("Session Timeout!");
            // Redirect to another page
            window.location.href = "../index.php";
        </script>';
    exit();
}

// Update the last activity time for the session
$_SESSION['last_activity'] = time();

// Logout functionality
if (isset($_REQUEST['logout'])) {
    session_unset();    // Unset all session variables
    session_destroy();  // Destroy the session
    echo '<script>
        window.location.href = "../index.php";
    </script>';
    exit();
}
?>
