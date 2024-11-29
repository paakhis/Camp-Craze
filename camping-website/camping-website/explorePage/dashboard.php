<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campsite Submission Form</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body style = "background-color:#c4d9ee;">
    <div class="container">
        <h1>Submit Your Campsite</h1>
        <form id="campsiteForm" action="dashboard.php" method="POST">
            <div class="form-group">
                <label for="hostName">Host Name:</label>
                <input type="text" id="hostName" name="hostName" required>
            </div>
            <div class="form-group">
                <label for="campName">Camp Name:</label>
                <input type="text" id="campName" name="campName" required>
            </div>
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea id="address" name="address" required></textarea>
            </div>
            <div class="form-group">
                <label for="activity">Activity:</label>
                <select id="activity" name="activity" required>
                    <option value="">Select Activity</option>
                    <option value="River Rafting">River Rafting</option>
                    <option value="Waterfall">Waterfall</option>
                    <option value="Paragliding">Paragliding</option>
                    <option value="Trekking">Trekking</option>
                </select>
            </div>
            <div class="form-group">
                <label for="campStyle">Camp Style:</label>
                <select id="campStyle" name="campStyle" required>
                    <option value="">Select Camp Style</option>
                    <option value="Swiss Tent">Swiss Tent</option>
                    <option value="Geodesic Tent">Geodesic Tent</option>
                    <option value="A-Frame Cabin">A-Frame Cabin</option>
                    <option value="Tree House">Tree House</option>
                </select>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" min="0" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="imageLink">Image Link:</label>
                <input type="url" id="imageLink" name="imageLink" required>
            </div>
            <button type="submit">Submit Campsite</button>
        </form>
    </div>
</body>
</html>




<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "camping_website";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $campName = $conn->real_escape_string($_POST['campName']);
    $location = $conn->real_escape_string($_POST['location']);
    $address = $conn->real_escape_string($_POST['address']);
    $activity = $conn->real_escape_string($_POST['activity']);
    $campStyle = $conn->real_escape_string($_POST['campStyle']);
    $price = $conn->real_escape_string($_POST['price']);
    $description = $conn->real_escape_string($_POST['description']);
    $imageLink = $conn->real_escape_string($_POST['imageLink']);

    // Insert data into the database
    $sql = "INSERT INTO campsite (Name, Location, Address, Activity, Style, Price, Description, ImageLink) 
            VALUES ('$campName', '$location', '$address', '$activity', '$campStyle', '$price', '$description', '$imageLink')";

    if ($conn->query($sql) === TRUE) {
        echo "New campsite submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>



