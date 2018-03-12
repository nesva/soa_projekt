<?php
     session_start();

     if (!isset($_SESSION['userid']) ) {
      header('Location: http://www.weatherpi.at/index.php');
      exit;
      }
?>
