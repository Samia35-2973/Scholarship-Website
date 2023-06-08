<?php
session_start();
@include 'config.php';
if (isset($_POST['home-red-btn'])) {
    if(isset($_SESSION['login_done'])){
        if($_SESSION['user_type'] == "student") header('location: ../student.php');
        else header('location: ../so-dashboard.php');
    }
    else header('location: ../index.php');
}
?>
