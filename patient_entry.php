<?php
// Database connection
$servername = "localhost:3306"; // Update with your database server
$username = "root"; // Update with your database username
$password = "Poojitha"; // Update with your database password
$dbname = "hospital_management"; // Update with your database name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success_message = ""; // Initialize success message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $medical_history = $_POST['medical_history'];
    $allergies = $_POST['allergies'];
    $medications = $_POST['medications'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $blood_pressure = $_POST['blood_pressure'];
    $visit_date = $_POST['visit_date'];
    $doctor_name = $_POST['doctor_name'];

    $sql = $conn->prepare("INSERT INTO patients (name, age, gender, phone, email, medical_history, allergies, medications, height, weight, blood_pressure, visit_date, doctor_name) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param("sssisssssssss", $name, $age, $gender, $phone, $email, $medical_history, $allergies, $medications, $height, $weight, $blood_pressure, $visit_date, $doctor_name);

    if ($sql->execute()) {
        $success_message = "Success! The patient's data has been recorded successfully. Thank you for your submission.";
    } else {
        $success_message = "Error: " . $sql->error;
    }

    $sql->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Patient Data Entry for Hospital Management System">
    <title>Patient Data Entry</title>
    <style>
       body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; /* Full viewport height */
    margin: 0; /* Remove default margin */
}

.message {
    text-align: center; /* Center text */
    font-weight: bold;
    color: green;
    font-size: 2em; /* Increase font size for emphasis */
}

    </style>
</head>
<body>
    
        <?php if ($success_message): ?>
            <div class="message"><?php echo $success_message; ?></div>
        <?php endif; ?>
    
</body>
</html>
