<?php
$conn = new mysqli("localhost", "root", "", "camping_website");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sno = $_GET['sno'] ?? null;
$name = $price_per_night = $campsite_name = "";


if ($sno) {
    $stmt = $conn->prepare("SELECT Name, Price FROM campsite WHERE Sno = ?");
    $stmt->bind_param("i", $sno);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $campsite = $result->fetch_assoc();
        $name = htmlspecialchars($campsite['Name']);
        $price_per_night = htmlspecialchars($campsite['Price']);
        $campsite_name = $name;
    } else {
        die("Campsite not found.");
    }
    $stmt->close();
} else {
    die("Invalid campsite selection.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $visitor_name = $_POST['visitor_name'];
    $visitor_email = $_POST['visitor_email'];
    $visitor_phone = $_POST['visitor_phone'];
    $total_adults = $_POST['total_adults'];
    $no_of_camps = $_POST['camp'];
    $checkin_date = $_POST['checkin'];
    $checkout_date = $_POST['checkout'];
    $room_preference = $_POST['room_preference'];
    $visitor_message = $_POST['visitor_message'];

    
    $checkin_timestamp = strtotime($checkin_date);
    $checkout_timestamp = strtotime($checkout_date);
    $num_days = ($checkout_timestamp - $checkin_timestamp) / (60 * 60 * 24); 
    $total_price = $no_of_camps * $price_per_night * $num_days;

    
    $stmt = $conn->prepare("INSERT INTO booking (Name, email, phone, members, `check-in`, `check-out`, comments, Total) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssisisi", $visitor_name, $visitor_email, $visitor_phone, $total_adults, $checkin_date, $checkout_date, $visitor_message, $total_price);
    
    if ($stmt->execute()) {
        echo "<p>Reservation successful! Total Price: ₹" . $total_price . "</p>";
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="form.css" rel="stylesheet">
    <title>Booking Form</title>
</head>
<body style = "background-color:#c4d9ee;">
    <h1>Booking for: <?php echo $name; ?></h1>
    <h2>Price per night: ₹<?php echo $price_per_night; ?></h2>

    <form action="form.php?sno=<?php echo $sno; ?>" method="post">
        <input type="hidden" name="price" value="<?php echo $price_per_night; ?>">
        <input type="hidden" name="campsite_name" value="<?php echo $campsite_name; ?>">

        <div class="elem-group">
            <label for="name">Your Name</label>
            <input type="text" id="name" name="visitor_name" placeholder="John Doe" pattern="[A-Z\sa-z]{3,20}" required>
        </div>
        <div class="elem-group">
            <label for="email">Your E-mail</label>
            <input type="email" id="email" name="visitor_email" placeholder="john.doe@email.com" required>
        </div>
        <div class="elem-group">
            <label for="phone">Your Phone</label>
            <input type="tel" id="phone" name="visitor_phone" placeholder="498-348-3872" pattern="(\d{3})-?\s?(\d{3})-?\s?(\d{4})" required>
        </div>
        <hr>
        <div class="elem-group inlined">
            <label for="adult">Members</label>
            <input type="number" id="adult" name="total_adults" placeholder="2" min="1" required>
        </div>
        <div class="elem-group inlined">
            <label for="camp">No. of Camps</label>
            <input type="number" id="camp" name="camp" placeholder="2" min="0" required>
        </div>
        <div class="elem-group inlined">
            <label for="checkin-date">Check-in Date</label>
            <input type="date" id="checkin-date" name="checkin" required>
        </div>
        <div class="elem-group inlined">
            <label for="checkout-date">Check-out Date</label>
            <input type="date" id="checkout-date" name="checkout" required>
        </div>
        <div class="elem-group">
            <label for="room-selection">Select Room Preference</label>
            <select id="room-selection" name="room_preference" required>
                <option value="">Choose a Room from the List</option>
                <option value="connecting">Connecting</option>
                <option value="adjoining">Adjoining</option>
                <option value="adjacent">Adjacent</option>
            </select>
        </div>
        <hr>
        <div class="elem-group">
            <label for="message">Anything Else?</label>
            <textarea id="message" name="visitor_message" placeholder="Tell us anything else that might be important." required></textarea>
        </div>

        <!-- Total Price Display -->
        <div class="elem-group">
            <label>Total Price</label>
            <p id="total-price">₹0</p>
        </div>

        <button type="submit">Book The Rooms</button>
    </form>

    <script>
        
        function calculateTotal() {
            var adults = parseInt(document.getElementById('adult').value) || 0;
            var camps = parseInt(document.getElementById('camp').value) || 0;
            var pricePerNight = <?php echo $price_per_night; ?>;

            var checkinDate = new Date(document.getElementById('checkin-date').value);
            var checkoutDate = new Date(document.getElementById('checkout-date').value);

            
            if (checkinDate && checkoutDate && checkoutDate > checkinDate) {
              
                var timeDiff = checkoutDate - checkinDate;
                var numDays = timeDiff / (1000 * 3600 * 24); 
            } else {
                var numDays = 0; 
            }

            
            var totalPrice = camps * pricePerNight * numDays;

            
            document.getElementById('total-price').innerText = "₹" + totalPrice;
        }

       
        document.getElementById('adult').addEventListener('input', calculateTotal);
        document.getElementById('camp').addEventListener('input', calculateTotal);
        document.getElementById('checkin-date').addEventListener('change', calculateTotal);
        document.getElementById('checkout-date').addEventListener('change', calculateTotal);

        
        window.onload = calculateTotal;
    </script>

    <script src="form.js"></script>
</body>
</html>
