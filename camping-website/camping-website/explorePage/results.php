<?php

$conn = new mysqli("localhost", "root", "", "camping_website");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$filter_column = isset($_GET['filter_column']) ? $_GET['filter_column'] : '';
$filter_value = isset($_GET['filter_value']) ? $_GET['filter_value'] : '';
$campsites = [];


if (!empty($filter_column) && !empty($filter_value)) {
    $stmt = $conn->prepare("SELECT * FROM campsite WHERE $filter_column = ?");
    $stmt->bind_param("s", $filter_value);
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $campsites[] = $row;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campsites</title>
    <style>
        body{
            background-color : #c4d9ee;
        }
    .wrapper {
    display: flex;
    justify-content: space-evenly;
    flex-direction: column;
    align-items: space-evenly; 
    border: 1px solid #ccc;
    border-radius: 10px;
    padding: 15px;
    background-color: #fff;
    width: 300px; 
    margin: 20px; 
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    height: auto; 
}

.image {
    width: 100%;
    height: 150px; 
    background-size: cover;
    background-position: center;
    border-radius: 10px;
    margin-bottom: 15px; 
    overflow: hidden; 
}

.details {
    display: flex;
    flex-direction : column;
    align-items: center;
    justify-content : center;
    text-align: centre; 
    margin: 5px 0; 

}

.details h1 {
    font-size: 1.2rem; 
    margin: 5px 0;
    color: #333;
}

.details h2 {
    font-size: 1rem; 
    margin: 5px 0;
    color: #666;
}

p {
    color: #555;
    margin: 5px 0;
}

.name{
    text-align : center;
}

.price {
    font-size: 1.2rem;
    color: #007BFF;
    margin-top: 5px; 
    text-align : center;
}

#campsites-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: flex-start; 
}

.heading{
    text-align:center;
}
</style>
<body>
    <h1 class="heading">Campsites for "<?php echo htmlspecialchars($filter_value); ?>"</h1>
    <div id="campsites-container">
        <?php if (!empty($campsites)): ?>
            <?php foreach ($campsites as $campsite): ?>
                <a href="form.php?sno=<?php echo $campsite['SNO']; ?>" style="text-decoration: none; color: inherit;">
                <div class="wrapper">
                    <h1 class="name"><?php echo htmlspecialchars($campsite['Name']); ?></h1>
                    
                    <!-- Corrected image section -->
                    <div class="image i1">
                        <?php if (!empty($campsite['ImageLink'])): ?>
                            <!-- Use the correct URL for the image -->
                            <img src="<?php echo htmlspecialchars($campsite['ImageLink']); ?>" alt="<?php echo htmlspecialchars($campsite['Name']); ?>" style="width: 100%; height: auto;">
                        <?php endif; ?>
                    </div>

                    <div class="details">
                        <h1><em><?php echo htmlspecialchars($campsite['Location']); ?></em></h1>
                        <h2><?php echo htmlspecialchars($campsite['Style']); ?></h2>
                        <p><?php echo htmlspecialchars($campsite['Activity']); ?></p>
                    </div>
                    <h1 class="price">₹<?php echo htmlspecialchars($campsite['Price']); ?> per night</h1>
                </div>
                        </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No campsites found for this subcategory.</p>
        <?php endif; ?>
    </div>
</body>



</html>
