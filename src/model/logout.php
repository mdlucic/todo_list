<?php
 #Logging out
   session_start();
   unset($_SESSION['username']);
   header("Location: ../../public/view/login.php");
   exit();
?>

