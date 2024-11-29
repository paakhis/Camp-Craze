<?php
session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "camping_website";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$error_message = $success_message = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        
        $email = $conn->real_escape_string($_POST['email']);
        $password = $conn->real_escape_string($_POST['password']);

        if (empty($email) || empty($password)) {
            $error_message = "Please enter both email and password.";
        } else {
            $stmt = $conn->prepare("SELECT * FROM User WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                if ($password === $user['pass']) {
                   
                    $_SESSION['email'] = $user['email'];

                    
                    header("Location: /camping-website/camping-website/explorePage/explore.php"); // Use the correct path
                    exit();
                } else {
                    $error_message = "Incorrect password.";
                }
            } else {
                $error_message = "No account found with this email.";
            }
            $stmt->close();
        }
    } elseif (isset($_POST['signup'])) {
        // Signup logic
        $email = $conn->real_escape_string($_POST['email']);
        $password = $conn->real_escape_string($_POST['password']);

        if (empty($email) || empty($password)) {
            $error_message = "All fields are required.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message = "Invalid email format.";
        } else {
            // Check if the email already exists
            $stmt = $conn->prepare("SELECT * FROM User WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $error_message = "Email already registered.";
            } else {
                // Insert the new user into the database
                $stmt = $conn->prepare("INSERT INTO User (email, pass) VALUES (?, ?)");
                $stmt->bind_param("ss", $email, $password);
                if ($stmt->execute()) {
                    $success_message = "Signup successful!";
                } else {
                    $error_message = "Error: " . $conn->error;
                }
                $stmt->close();
            }
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>
    <title>Responsive Login Form</title>
</head>
<body>
    <div class="login">
        <div class="login__content">
            <div class="login__img">
                <img src="assets/img/img-login.svg" alt="Login">
            </div>

            <div class="login__forms">
              
                <form action="login.php" method="POST" class="login__registre" id="login-in">
                    <h1 class="login__title">Sign In</h1>

              
                    <?php if (!empty($error_message)): ?>
                        <p style="color: red; font-weight: bold;"><?php echo $error_message; ?></p>
                    <?php endif; ?>
                    <?php if (!empty($success_message)): ?>
                        <p style="color: green; font-weight: bold;"><?php echo $success_message; ?></p>
                    <?php endif; ?>

                    <div class="login__box">
                        <i class='bx bx-user login__icon'></i>
                        <input type="email" name="email" placeholder="Email" class="login__input" required>
                    </div>

                    <div class="login__box">
                        <i class='bx bx-lock-alt login__icon'></i>
                        <input type="password" name="password" placeholder="Password" class="login__input" required>
                    </div>

                    <input type="submit" name="login" value="Sign In" class="login__button">

                    <div>
                        <span class="login__account">Don't have an Account?</span>
                        <span class="login__signin" id="sign-up">Sign Up</span>
                    </div>
                </form>

               
                <form action="login.php" method="POST" class="login__create none" id="login-up">
                    <h1 class="login__title">Create Account</h1>

                    <div class="login__box">
                        <i class='bx bx-at login__icon'></i>
                        <input type="email" name="email" placeholder="Email" class="login__input" required>
                    </div>

                    <div class="login__box">
                        <i class='bx bx-lock-alt login__icon'></i>
                        <input type="password" name="password" placeholder="Password" class="login__input" required>
                    </div>

                    <input type="submit" name="signup" value="Sign Up" class="login__button">

                    <div>
                        <span class="login__account">Already have an Account?</span>
                        <span class="login__signup" id="sign-in">Sign In</span>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="assets/js/main.js"></script>
</body>
</html>
