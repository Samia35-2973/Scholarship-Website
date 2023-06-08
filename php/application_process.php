<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

$host = 'localhost';
$dbname = 'scholarship-website';
$username = 'root';
$password = '';

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle database connection errors
    echo '<script>
            alert("Error occurred while connecting to the database!");
            window.location.href = "../scholarshipList.php";
        </script>';
    exit;
}

$uploadDirectories = [
    'cv' => 'uploads/cv/',
    'essay' => 'uploads/essay/',
    'recommendation_letter' => 'uploads/recommendation_letter/',
    'transcripts' => 'uploads/transcripts/'
];

// Create the upload directories if they don't exist
foreach ($uploadDirectories as $directory) {
    if (!file_exists($directory)) {
        mkdir($directory, 0777, true); // Create the directory recursively
    }
}

function uploadFile($file, $fileType, $studentId, $scholarshipId)
{
    global $uploadDirectories;

    $uploadDirectory = $uploadDirectories[$fileType];

    // Check if file upload encountered any errors
    if ($file['error'] !== UPLOAD_ERR_OK) {
        // Handle file upload error
        return 'File upload failed';
    }

    // Validate the file type
    $allowedFileType = 'application/pdf'; // Restrict to PDF files
    if ($file['type'] !== $allowedFileType) {
        // Handle invalid file type error
        return 'Invalid file type';
    }

    // Extract the original file extension
    $originalExtension = pathinfo($file['name'], PATHINFO_EXTENSION);

    // Generate a unique filename for the uploaded file
    $filename = $fileType . '_std' . $studentId . '_scho' . $scholarshipId . '.' . $originalExtension;
    $destination = $uploadDirectory . $filename;

    // Move the uploaded file to the destination directory
    if (move_uploaded_file($file['tmp_name'], $destination)) {
        return $destination; // Return the file path
    } else {
        // Handle file upload error
        return 'File upload failed';
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $scholarshipId = clean_data($_POST['scholarshipId']);
    $studentId = clean_data($_POST['studentId']);

    // Perform form data validation
    $firstName = clean_data($_POST['first-name']);
    $lastName = clean_data($_POST['last-name']);
    $gender = clean_data($_POST['gender']);
    $birthday = clean_data($_POST['birth-day']);
    $email = clean_data($_POST['mail']);
    $confirmEmail = clean_data($_POST['c-mail']);
    $currentDegree = clean_data($_POST['degree']);
    $program = clean_data($_POST['program']);
    $institution = clean_data($_POST['institute']);
    $graduationDate = clean_data($_POST['grad-day']);
    $address = clean_data($_POST['address']);
    $country = clean_data($_POST['country']);
    $zipCode = clean_data($_POST['zipcode']);
    $city = clean_data($_POST['city']);
    $termsAndConditions = isset($_POST['terms']) ? $_POST['terms'] : '';

    // Perform additional validation as needed (e.g., checking required fields, email format, etc.)
    $errors = [];

    // Validate required fields
    if (empty($termsAndConditions)) {
        $errors[] = 'You have to agree with the terms';
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format';
    }

    // Check if email and confirm email match
    if ($email !== $confirmEmail) {
        $errors[] = 'Email and confirm email must match';
    }

    // Perform file uploads and validation
    $cvFilePath = uploadFile($_FILES['cv'], 'cv', $studentId, $scholarshipId);
    $essayFilePath = uploadFile($_FILES['essay'], 'essay', $studentId, $scholarshipId);
    $recommendationLetterFilePath = uploadFile($_FILES['ltr'], 'recommendation_letter', $studentId, $scholarshipId);
    $transcriptsFilePath = uploadFile($_FILES['trans'], 'transcripts', $studentId, $scholarshipId);

    // Check if any file uploads encountered errors
    if (
        $cvFilePath === 'File upload failed' ||
        $essayFilePath === 'File upload failed' ||
        $recommendationLetterFilePath === 'File upload failed' ||
        $transcriptsFilePath === 'File upload failed'
    ) {
        $errors[] = 'Error uploading files';
    } elseif (
        $cvFilePath === 'Invalid file type' ||
        $essayFilePath === 'Invalid file type' ||
        $recommendationLetterFilePath === 'Invalid file type' ||
        $transcriptsFilePath === 'Invalid file type'
    ) {
        $errors[] = 'Please make sure all files are in PDF format';
    }

    if (count($errors) > 0) {
        // Display the errors to the user or handle them as needed
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
    } else {
        // Insert the application data into the database
        $insertQuery = "INSERT INTO `applications` (`scholarship_id`, `student_id`, `first_name`, `last_name`, `gender`, `birthday`, `email`, `current_degree`, `program`, `institution`, `graduation_date`, `address`, `country`, `zip_code`, `city`, `application_status`, `cv_file_path`, `essay_file_path`, `recommendation_letter_file_path`, `transcripts_file_path`) 
                        VALUES (:scholarshipId, :studentId, :firstName, :lastName, :gender, :birthday, :email, :currentDegree, :program, :institution, :graduationDate, :addre, :country, :zipCode, :city, :applicationStatus, :cvFilePath, :essayFilePath, :recommendationLetterFilePath, :transcriptsFilePath)";
        $stmt = $pdo->prepare($insertQuery);
        $stmt->bindValue(':scholarshipId', $scholarshipId);
        $stmt->bindValue(':studentId', $studentId);
        $stmt->bindValue(':firstName', $firstName);
        $stmt->bindValue(':lastName', $lastName);
        $stmt->bindValue(':gender', $gender);
        $stmt->bindValue(':birthday', $birthday);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':currentDegree', $currentDegree);
        $stmt->bindValue(':program', $program);
        $stmt->bindValue(':institution', $institution);
        $stmt->bindValue(':graduationDate', $graduationDate);
        $stmt->bindValue(':addre', $address);
        $stmt->bindValue(':country', $country);
        $stmt->bindValue(':zipCode', $zipCode);
        $stmt->bindValue(':city', $city);
        $stmt->bindValue(':applicationStatus', 'Pending');
        $stmt->bindValue(':cvFilePath', $cvFilePath);
        $stmt->bindValue(':essayFilePath', $essayFilePath);
        $stmt->bindValue(':recommendationLetterFilePath', $recommendationLetterFilePath);
        $stmt->bindValue(':transcriptsFilePath', $transcriptsFilePath);

        if ($stmt->execute()) {
            echo '<script>
                    alert("Application submitted successfully!");
                    window.location.href = "../scholarshipList.php";
                </script>';
            exit;
        } else {
            // Handle database insertion error
            echo '<script>
                    alert("Error occurred while submitting the scholarshipList!");
                    window.location.href = "../scholarshipList.php";
                </script>';
            exit;
        }
    }
}

function clean_data($data)
{
    // Trim whitespace and remove any HTML tags
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
