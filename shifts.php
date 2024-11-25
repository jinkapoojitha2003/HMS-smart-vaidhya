<?php
// Database connection
$servername = "localhost:3306";
$username = "root";
$password = "Poojitha";
$dbname = "hospital_management"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $doctor = $_POST['doctor'];
    $shift_type = $_POST['shift_type'];
    $shift_date = $_POST['shift_date'];
    $shift_start_time = $_POST['shift_start_time'];
    $shift_end_time = $_POST['shift_end_time'];
    $department = $_POST['department'];
    $break_time = $_POST['break_time'];
    $shift_status = $_POST['shift_status'];
    $notes = $_POST['notes'];

    // Validate time: Ensure end time is greater than start time
    if ($shift_end_time <= $shift_start_time) {
        echo "<script>alert('End time must be later than start time.'); window.history.back();</script>";
        exit();
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO shift_management (doctor_id, shift_type, shift_date, shift_start_time, shift_end_time, department, break_time, shift_status, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssssss", $doctor, $shift_type, $shift_date, $shift_start_time, $shift_end_time, $department, $break_time, $shift_status, $notes);

    // Execute query
    if ($stmt->execute()) {
        // Redirect to the home page (index.php or index.html)
        header("Location: index.html");  // Change 'index.php' to your home page file
        exit(); // Always use exit after header() to stop further script execution
    } else {
        // If there's an error, show an alert and stay on the same page
        echo "<script>alert('Error saving shift. Please try again.'); window.history.back();</script>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
