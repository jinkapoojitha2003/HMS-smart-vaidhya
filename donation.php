<?php
// Database connection parameters
$servername = "localhost"; // Or the server where your database is hosted
$username = "root"; // Your MySQL username
$password = "Poojitha"; // Your MySQL password
$dbname = "hospital_management"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$name = $_POST['name'];
$age = $_POST['age'];
$bloodType = $_POST['bloodType'];
$contact = $_POST['contact'];
$message = $_POST['message'];

// SQL query to insert the data into the blood_donors table
$sql = "INSERT INTO blood_donors (name, age, blood_type, contact, message)
        VALUES ('$name', '$age', '$bloodType', '$contact', '$message')";

// Execute the query
if ($conn->query($sql) === TRUE) {
    // Redirect to the home page after successful insertion
    header("Location: index.html"); // Change 'index.php' to your actual home page
    exit(); // Make sure the script stops here to avoid further execution
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>
