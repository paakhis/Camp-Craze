<?php
session_start(); // Start session to manage user login state

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "camping_website";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Error message initialization
$error_message = "";
$success_message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password']; // Plain text password

    // Sanitize inputs
    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);

    // Check if user already exists
    $sql = "SELECT * FROM `users` WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $error_message = "User already exists with this email.";
    } else {
        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user into database
        $sql = "INSERT INTO `users` (`email`, `password`) VALUES ('$email', '$hashed_password')";
        if ($conn->query($sql) === TRUE) {
            // Automatically log in the user after signup
            $user_id = $conn->insert_id; // Get the newly created user ID
            $_SESSION['user_id'] = $user_id;
            $_SESSION['email'] = $email;

            // Redirect to home page
            header("Location: home.php");
            exit();
        } else {
            $error_message = "Error signing up: " . $conn->error;
        }
    }
}
$conn->close();
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <div class="container">
        <div class="signup-section">
            <form action="signup.php" method="POST">
                <h2>Signup</h2>

                <!-- Display error or success messages -->
                <?php if (!empty($error_message)): ?>
                    <p style="color: red;"><?php echo $error_message; ?></p>
                <?php endif; ?>
                <?php if (!empty($success_message)): ?>
                    <p style="color: green;"><?php echo $success_message; ?></p>
                <?php endif; ?>

                <label for="email"><b>Email Address</b></label>
                <input type="email" id="email" name="email" required>

                <label for="password"><b>Password</b></label>
                <input type="password" id="password" name="password" required>

                <button type="submit"><b>Signup</b></button>
            </form>
        </div>
    </div>
</body>
</html>
