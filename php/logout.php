<?php
session_start();
@include 'config.php';
if (isset($_POST['logout-btn'])) {
    // Check if the logout button was pressed
    session_unset();
    session_destroy();
    header('location: ../index.php');
}
?>
