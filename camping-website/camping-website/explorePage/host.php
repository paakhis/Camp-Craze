
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


if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    
    if (empty($email) || empty($password)) {
        echo "<p style='color:red;'>Please fill in all fields.</p>";
    } else {
       
        $sql = "SELECT * FROM host WHERE email = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $_SESSION['host'] = $email; 
            header("Location: dashboard.php"); 
            exit;
        } else {
            echo "<p style='color:red;'>Incorrect email or password.</p>";
        }
    }
}


$conn->close();
?>



<html>
    <head>
        <link rel="stylesheet" href="host.css"> 
    </head>
    <body>
        <div class="heading">
            <p>WHERE HOST <br>MEETS CAMPERS!!</p>
        </div>
        <div class="main">
          <div class="para">
            <h1>Welcome to CampCraze</h1>
  <h2>Your Gateway to Seamless Campsite Hosting</h2>
  
  <p>At CampCraze, we help you manage your campsites with ease. Join our community of hosts and enjoy:</p>
  
  <ul>
    <li>Easy campsite registration</li>
    <li>Real-time booking management</li>
    <li>Comprehensive reviews and ratings</li>
    <li>Secure payment handling</li>
  </ul>
  
  <h3>Why Host with Us?</h3>
  <p>We provide all the tools you need to turn your land into a thriving campsite business. From seamless site setup to real-time guest interaction, CampCraze is your trusted partner in campsite hosting.</p>

  <h3>Get Started Today</h3>
  <p>Sign up to start managing your campsites. It's quick and easy, and we'll guide you every step of the way!</p>
          </div>
          <div class="side">
            <form name="myform" onsubmit="return(validate());" action="host.php" method="post">
                <label for="email">Email</label><br>
                <input type="text" name="email"><br>
                <label for="password">Password</label><br>
                <input type="text" name="password">
                <button type="submit" class="signup-button" name="submit">Sign In</button>
            </form>
          </div>
        </div>
        <script src=".js"></script>
    </body>
</html>
