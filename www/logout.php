<?php
session_start();
session_destroy();

header('Location: http://www.weatherpi.at/index.php');

?>
