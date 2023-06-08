<?php
session_start();
@include 'config.php';
if (isset($_POST['profile_red-btn'])) {
    if($_SESSION['user_type'] == "student") header('location: ../st-profile.php');
    else header('location: ../so-profile.php');
}
?>
