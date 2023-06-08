<?php
session_start();
@include 'config.php';
if (isset($_POST['sign-red-btn'])) {
    header('location: ../student-form.php');
}
?>
