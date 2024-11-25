<?php
// Database connection
$host = 'localhost:3306';
$dbname = 'hospital_management';
$username = 'root';
$password = 'Poojitha';

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$errorMessage = '';
$registrationSuccess = false; // Flag to check registration success

// Handle registration form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $errorMessage = "Email already exists!"; // Error message for existing email
    } else {
        // Insert new user into the database
        $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $registrationSuccess = true; // Set success flag
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffe6e9; /* Background color */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .message {
            text-align: center;
            color: red; /* Color for error message */
            margin-bottom: 10px;
        }
        .success {
            text-align: center;
            color: green; /* Color for success message */
            margin-bottom: 10px;
        }
        input[type="email"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            box-shadow: rgba(14, 30, 37, 0.12) 0px 2px 4px 0px, rgba(14, 30, 37, 0.32) 0px 2px 16px 0px;
        }
        input[type="submit"] {
            background-color: purple;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #4CAF50;
        }
        p {
            text-align: center;
        }
        a {
            color: #4CAF50;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <?php if ($registrationSuccess): ?>
            <div class="success">Registration successful! <a href="login.php">Log in here</a></div> <!-- Show success message -->
        <?php elseif ($errorMessage): ?>
            <div class="message"><?php echo $errorMessage; ?></div> <!-- Show error message -->
        <?php endif; ?>
        <form method="POST" action="">
            Email: <input type="email" name="email" required><br>
            Password: <input type="password" name="password" required><br>
            <input type="submit" value="Register" name="register">
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
