<?php
// Database connection details
$host = 'localhost';
$dbname = 'scholarship-website';
$username = 'root';
$password = '';

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the application ID from the form
        $applicationId = $_POST['applicationId'];

        // Prepare the SQL query to fetch the application
        $sql = "SELECT * FROM applications WHERE application_id = :applicationId";

        // Execute the query
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':applicationId', $applicationId, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch the application data
        $application = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the application exists
        if ($application) {
            // Display the update form
            echo "<h2>Update Application - ID: $applicationId</h2>";
            echo "<form action='update_process.php' method='POST'>";
            echo "<input type='hidden' name='applicationId' value='$applicationId'>";

            // Display the fields for updating the application data
            echo "<label>Scholarship ID:</label>";
            echo "<input type='text' name='scholarshipId' value='{$application['scholarship_id']}'><br>";

            echo "<label>Student ID:</label>";
            echo "<input type='text' name='studentId' value='{$application['student_id']}'><br>";

            echo "<label>First Name:</label>";
            echo "<input type='text' name='firstName' value='{$application['first_name']}'><br>";

            echo "<label>Last Name:</label>";
            echo "<input type='text' name='lastName' value='{$application['last_name']}'><br>";

            echo "<label>Gender:</label>";
            echo "<input type='text' name='gender' value='{$application['gender']}'><br>";

            echo "<label>Birthday:</label>";
            echo "<input type='text' name='birthday' value='{$application['birthday']}'><br>";

            echo "<label>Email:</label>";
            echo "<input type='text' name='email' value='{$application['email']}'><br>";

            echo "<label>Current Degree:</label>";
            echo "<input type='text' name='currentDegree' value='{$application['current_degree']}'><br>";

            echo "<label>Program:</label>";
            echo "<input type='text' name='program' value='{$application['program']}'><br>";

            echo "<label>Institution:</label>";
            echo "<input type='text' name='institution' value='{$application['institution']}'><br>";

            echo "<label>Graduation Date:</label>";
            echo "<input type='text' name='graduationDate' value='{$application['graduation_date']}'><br>";

            echo "<label>Address:</label>";
            echo "<input type='text' name='address' value='{$application['address']}'><br>";

            echo "<label>Country:</label>";
            echo "<input type='text' name='country' value='{$application['country']}'><br>";

            echo "<label>Zip Code:</label>";
            echo "<input type='text' name='zipCode' value='{$application['zip_code']}'><br>";

            echo "<label>City:</label>";
            echo "<input type='text' name='city' value='{$application['city']}'><br>";

            echo "<label>Application Status:</label>";
            echo "<input type='text' name='applicationStatus' value='{$application['application_status']}'><br>";

            // Submit button
            echo "<input type='submit' value='Update'>";
            echo "</form>";
        } else {
            echo "Application not found.";
        }
    } else {
        echo "Invalid request.";
    }
} catch (PDOException $e) {
    // Handle database connection errors
    echo "Database connection failed: " . $e->getMessage();
}
?>
