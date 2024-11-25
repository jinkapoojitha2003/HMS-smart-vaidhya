<?php
$servername = "localhost:3306"; // or your server IP
$username = "root"; // your database username
$password = "Poojitha"; // your database password
$dbname = "hospital_management"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from POST request
$name = $_POST['name'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$phone = $_POST['phone'];
$date = $_POST['date'];
$time = $_POST['time'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO app (name, age, gender, phone, appointment_date, appointment_time) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sissss", $name, $age, $gender, $phone, $date, $time);

// Execute the statement
if ($stmt->execute()) {
    echo "Appointment booked successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the connection
$stmt->close();
$conn->close();
?>
