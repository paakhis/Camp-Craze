<?php
session_start();
session_unset(); 
session_destroy(); 


header("Location: /camping-website/camping-website/responsive-login-signin-signup-main/login.php");
exit();
?>
