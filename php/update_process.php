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
        // Get the application ID and updated values from the form
        $applicationId = $_POST['applicationId'];
        $scholarshipId = $_POST['scholarshipId'];
        $studentId = $_POST['studentId'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $gender = $_POST['gender'];
        $birthday = $_POST['birthday'];
        $email = $_POST['email'];
        $currentDegree = $_POST['currentDegree'];
        $program = $_POST['program'];
        $institution = $_POST['institution'];
        $graduationDate = $_POST['graduationDate'];
        $address = $_POST['address'];
        $country = $_POST['country'];
        $zipCode = $_POST['zipCode'];
        $city = $_POST['city'];
        $applicationStatus = $_POST['applicationStatus'];

        // Prepare the SQL query to update the application
        $sql = "UPDATE applications SET 
                scholarship_id = :scholarshipId,
                student_id = :studentId,
                first_name = :firstName,
                last_name = :lastName,
                gender = :gender,
                birthday = :birthday,
                email = :email,
                current_degree = :currentDegree,
                program = :program,
                institution = :institution,
                graduation_date = :graduationDate,
                address = :address,
                country = :country,
                zip_code = :zipCode,
                city = :city,
                application_status = :applicationStatus
                WHERE application_id = :applicationId";

        // Execute the query
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':scholarshipId', $scholarshipId, PDO::PARAM_INT);
        $stmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);
        $stmt->bindParam(':firstName', $firstName, PDO::PARAM_STR);
        $stmt->bindParam(':lastName', $lastName, PDO::PARAM_STR);
        $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
        $stmt->bindParam(':birthday', $birthday, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':currentDegree', $currentDegree, PDO::PARAM_STR);
        $stmt->bindParam(':program', $program, PDO::PARAM_STR);
        $stmt->bindParam(':institution', $institution, PDO::PARAM_STR);
        $stmt->bindParam(':graduationDate', $graduationDate, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':country', $country, PDO::PARAM_STR);
        $stmt->bindParam(':zipCode', $zipCode, PDO::PARAM_STR);
        $stmt->bindParam(':city', $city, PDO::PARAM_STR);
        $stmt->bindParam(':applicationStatus', $applicationStatus, PDO::PARAM_STR);
        $stmt->bindParam(':applicationId', $applicationId, PDO::PARAM_INT);
        $stmt->execute();

        echo "Application updated successfully.";
    } else {
        echo "Invalid request.";
    }
} catch (PDOException $e) {
    // Handle database connection errors
    echo "Database connection failed: " . $e->getMessage();
}
?>
