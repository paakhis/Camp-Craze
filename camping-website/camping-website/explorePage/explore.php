<?php
session_start();


if (!isset($_SESSION['email'])) {
  header("Location: /camping-website/camping-website/responsive-login-signin-signup-main/login.php");
  exit();
  
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="explore.css" rel="stylesheet">
    <link rel="shortcut icon" href="camping-website\assets\img\favicon.png" type="image/x-icon">

<!--=============== REMIXICONS ===============-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.4.0/remixicon.css" crossorigin="">
    <title>Document</title>
</head>

<body >
<nav class="nav">
      <a href=""><img src="favicon.png"/></a>
      <a href="/camping-website/camping-website/index.php">Home</a>
      <a href="explore.php">Pricing</a>
     
      <a href="/camping-website/camping-website/contact.php">Contact</a>
      <a href="logout.php">Logout</a>
      <a href="host.php">Host</a>
   </nav>
  <div class ="main">
    <div class="style">
        <div class="style">
            <h1>Choose By Style</h1>
            <div class ="types">
                
                

                <div class="card5">
                <a href="results.php?filter_column=Style&filter_value=Swiss%20Tent">
                 <div class="card5-content">
                  <img class="icon" src="tent.png">
                <div class="style-name">Swiss Tent</div>
               </div>
                  </a>
              </div>
               
                <div class="card5">
                <a href="results.php?filter_column=Style&filter_value=A-Frame%20Cabin">
                    <div class="card5-content">
                      <img class="icon" src="frame-house.png">
                      <div class="style-name">A-Frame Cabin</div>
                    </div>
                    </a>
                </div>
                
                <div class="card5">
                <a href="results.php?filter_column=Style&filter_value=Tree%20House">
                    <div class="card5-content">
                      <img class="icon" src="tree-house.png">
                      <div class="style-name">Tree House</div>
                    </div>
                    </a>
                </div>
               
                <div class="card5">
                <a href="results.php?filter_column=Style&filter_value=Geodosic%20Tent">
                    <div class="card5-content">
                      <img class="icon" src="dome.png">
                      <div class="style-name">Geodosic Tent</div>
                    </div>
                  </a>
                </div>

            </div>
          </div>




            <div class="style">
                <h1>Choose By Activity</h1>
            <div class="cards-list">
            <a href="results.php?filter_column=Activity&filter_value=River%20Rafting">
                <div class="card 1">
                  <div class="card_image"> <img src="1__1647933468__river_rafting_jpg" /> </div>
                  <div class="card_title title-white">
                    <p style = "color: orangered;">River Rafting</p>
                  </div>
               </div>
                </a>

                <a href="results.php?filter_column=Activity&filter_value=Waterfall">
                  <div class="card 2">
                  <div class="card_image">
                    <img src="1__1649575054__waterfall_png" />
                    </div>
                  <div class="card_title title-white">
                    <p style = "color: orangered;">Waterfall</p>
                  </div>
                </div>
                </a>
                
                <a href="results.php?filter_column=Activity&filter_value=Paragliding">
                <div class="card 3">
                  <div class="card_image">
                    <img src="1__1649580120__DSC_2658_jpg" />
                  </div>
                  <div class="card_title">
                    <p style = "color: orangered;">Paragliding</p>
                  </div>
                </div>
                </a>

                <a href="results.php?filter_column=Activity&filter_value=Trekking">
                  <div class="card 4">
                  <div class="card_image">
                    <img src="1__1656484276__DSC03065_2__1_jpg" />
                    </div>
                  <div class="card_title title-black">
                    <p style = "color: orangered;">Trekking</p>
                  </div>
                  </div>
                  </a>

            </div>
        </div>

    



</div>
 </div>
   
</body>

</html>