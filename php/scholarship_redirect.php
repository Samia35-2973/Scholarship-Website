<?php
session_start();
@include 'config.php';
if (isset($_POST['apply-red-btn'])) {
    $scholarshipId = $_POST['scholarshipId'];
    $studentId = $_POST['studentId'];
    // Redirect to the application page with parameters in the URL
    header('location: ../application.php?scholarshipId=' . $scholarshipId . '&studentId=' . $studentId);
}
elseif (isset($_POST['withdr-red-btn'])) {
    header('location: ../application.php');
}
elseif (isset($_POST['list-red-btn'])) {
    header('location: ../app-list.php');
}
elseif (isset($_POST['dlt-red-btn'])) {
    $scholarshipId = $_POST['scholarshipId'];
    // Database connection details
    $host = 'localhost';
    $dbname = 'scholarship-website';
    $username = 'root';
    $password = '';

    try {
        // Create a new PDO instance
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check if the scholarship ID is provided
        if (isset($_POST['scholarshipId'])) {
            // Get the scholarship ID from the query string
            $scholarshipId = $_POST['scholarshipId'];

            // Prepare the SQL query to delete the scholarship
            $sql = "DELETE FROM scholarships WHERE scholarship_id = :scholarshipId";

            // Execute the query
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':scholarshipId', $scholarshipId);
            $stmt->execute();
            echo '<script>
        alert("Scholarship deleted successfully.");
        // Redirect to another page
        window.location.href = "../scholarshipList.php";
     </script>';
        } else {
            echo '<script>
        alert("Invalid Scholarship");
        // Redirect to another page
        window.location.href = "../scholarshipList.php";
     </script>';
        }
        header('location: ');
    } catch (PDOException $e) {
        // Handle database connection errors
        echo "Database connection failed: " . $e->getMessage();
    }
}
?>
