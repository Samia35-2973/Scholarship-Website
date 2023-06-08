<?php
session_start();
@include 'config.php';
if (isset($_POST['log-red-btn'])) {
    header('location: ../student-form.php');
}
?>
