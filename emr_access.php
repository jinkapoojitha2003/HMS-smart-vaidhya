<?php
// Database connection
$servername = "localhost:3306";
$username = "root";
$password = "Poojitha";
$dbname = "hospital_management";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$emrData = "";
$errorMsg = "";
$searchMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['patient_id'])) {
        // Accessing EMR by Patient ID
        $patientID = $_POST['patient_id'];
        $stmt = $conn->prepare("SELECT id, name, age, gender, phone, email, medical_history, allergies, medications, height, weight, blood_pressure, visit_date, doctor_name FROM patients WHERE id = ?");
        $stmt->bind_param("s", $patientID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            $emrData = "<div class='emr-record'><h2>Patient EMR Record</h2>" .
                "<p><strong>Patient ID:</strong> {$data['id']}</p>" .
                "<p><strong>Name:</strong> {$data['name']}</p>" .
                "<p><strong>Age:</strong> {$data['age']}</p>" .
                "<p><strong>Gender:</strong> {$data['gender']}</p>" .
                "<p><strong>Phone:</strong> {$data['phone']}</p>" .
                "<p><strong>Email:</strong> {$data['email']}</p>" .
                "<p><strong>Medical History:</strong> {$data['medical_history']}</p>" .
                "<p><strong>Allergies:</strong> {$data['allergies']}</p>" .
                "<p><strong>Medications:</strong> {$data['medications']}</p>" .
                "<p><strong>Height:</strong> {$data['height']}</p>" .
                "<p><strong>Weight:</strong> {$data['weight']}</p>" .
                "<p><strong>Blood Pressure:</strong> {$data['blood_pressure']}</p>" .
                "<p><strong>Last Visit Date:</strong> {$data['visit_date']}</p>" .
                "<p><strong>Doctor's Name:</strong> {$data['doctor_name']}</p></div>";
        } else {
            $errorMsg = "No record found with this Patient ID.";
        }
        $stmt->close();
    } elseif (!empty($_POST['name']) && !empty($_POST['phone'])) {
        // Finding Patient ID by Name and Phone
        $stmt = $conn->prepare("SELECT id FROM patients WHERE name = ? AND phone = ?");
        $stmt->bind_param("ss", $_POST['name'], $_POST['phone']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $searchMsg = "Your Patient ID is: " . htmlspecialchars($result->fetch_assoc()['id']);
        } else {
            $errorMsg = "No record found with this information. Please check the details.";
        }
        $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access EMR</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            max-width: 400px;
            text-align: center;
        }
        .emr-record {
            margin-top: 20px;
            background-color: #f1f1f1;
            padding: 20px;
            border-radius: 5px;
            width: 100%;
            max-width: 500px;
        }
        .error { color: red; font-weight: bold; }
        .success { color: green; font-weight: bold; }
        form { margin-bottom: 20px; }
        label {
            display: block;
            text-align: left;
            margin: 10px 0 5px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button:hover { background-color: #218838; }
    </style>
</head>
<body>
    <h1>Electronic Medical Records (EMR) Access</h1>
    
    <div class="form-container">
        <?php if ($errorMsg): ?><p class="error"><?php echo $errorMsg; ?></p><?php endif; ?>
        <?php if ($searchMsg): ?><p class="success"><?php echo $searchMsg; ?></p><?php endif; ?>
        
        <form method="POST" action="">
            <label for="patient_id">Enter Patient ID:</label>
            <input type="text" id="patient_id" name="patient_id" required>
            <button type="submit">Access EMR</button>
        </form>

        <h2>OR</h2>

        <form method="POST" action="">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" required>
            <button type="submit">Find Patient ID</button>
        </form>
    </div>
    
    <?php if ($emrData): echo $emrData; endif; ?>
</body>
</html>
