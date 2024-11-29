<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!--=============== FAVICON ===============-->
   <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

   <!--=============== REMIXICONS ===============-->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.4.0/remixicon.css" crossorigin="">

   <!--=============== CSS ===============-->
   <link rel="stylesheet" href="assets/css/styles.css">

   <title>Responsive camping website - Bedimcode</title>
</head>
<body>
   <!--==================== HEADER ====================-->
   <nav class="nav">
      <a href=""><img src="assets/img/favicon.png"/></a>
      <a href="index.php">Home</a>
      <a href="explorePage/explore.php">Pricing</a>
     
      <a href="contact.php">Contact</a>
      <a href="responsive-login-signin-signup-main/login.php">Login</a>
      <a href="explorePage/host.php">Host</a>
   </nav>
   
   <div class="image-container">
      <img class="'img-4" src="assets/img/img-4.svg">
      <img class="img-3" src="assets/img/img-3.svg"/> <!-- Lowest z-index -->
      <img class="img-2" src="assets/img/img-2.svg"/> <!-- Middle z-index -->
      <img class="img-1 tentImg" src="assets/img/img-1.svg"/> <!-- Highest z-index -->
   </div>

   <div class="text-container">
      <div class="text0">A LIFETIME EXPERIENCE</div>
      <div class="text">Camping Events</div>
      <div class="text">To Remember</div>
      <a href="explorePage/explore.php"><button>Explore Locations</button></a>

   </div>

   <img class = "bird1" src="assets/img/bird-1.svg"/>
   <img class = "bird2" src="assets/img/bird-2.svg"/>
   
   <!--=============== GSAP ===============-->
   <script src=""></script>

   <!--=============== MAIN JS ===============-->
   <script src="assets/js/main.js"></script>
</body>
</html>
