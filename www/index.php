<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=weatherstation', 'logger', 'reggol');

if(isset($_GET['login'])) {
  $email = $_POST['email'];
  $passwort = $_POST['password'];

  // Überprüfung der E-Mail-Adresse
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errorMessage = "E-Mail is not valid";

  } else {

    // Benutzerdaten mit passender E-Mail-Adresse aus Tabelle User holen
    $statement = $pdo->prepare("SELECT * FROM User WHERE email = :email");
    $result = $statement->execute(array('email' => $email));
    $user = $statement->fetch();

    //Überprüfung des Passworts
    if ($user !== false && password_verify($passwort, $user['password'])) {
      $_SESSION['userid'] = $user['id'];
      // Weiterleitung zur Startseite
      header('Location: http://www.weatherpi.at/home.php');
    } else {
      $errorMessage = "Password not valid";
    }
  }
}
?>

<!DOCTYPE html>
<html>
<title>Smart Vinyard - SSOA-Project</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
<style>
body, html {height: 100%; background-color: black;}
body,h1,h2,h3,h4,h5,h6 {font-family: "Calibri", sans-serif}
.menu {display: none}
.bgimg {
    background-repeat: no-repeat;
    background-size: cover;
    background-image: url("pics/vinyard_2.jpg");
    background-position: center;
    min-height: 70%;
}
</style>
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top w3-hide-small">
  <div class="w3-bar w3-xlarge w3-black w3-opacity" id="myNavbar">
    <a href="#login" class="w3-bar-item w3-button">LOGIN</a>

  </div>
</div>

<!-- Header with image -->
<header class="bgimg w3-display-container w3-greyscale" id="login">
  <div class="w3-display-bottommiddle w3-padding">
    <span class="w3-tag w3-xlarge">Get weather information via REST or SOAP</span>
  </div>
  <div class="w3-display-middle w3-center">
    <span class="w3-text-white w3-hide-small" style="font-size:100px">SMART VINYARD</span>

    <form action="?login=1" method="post">
      <p>
        <input type="text" name="email" value="" placeholder="name" />
      </p>
      <p>
        <input type="password" name="password" value="" placeholder="password" />
      </p>
      <?php
        if(isset($errorMessage)){
          echo '<span class="w3-white" style="padding: 0 3px;">' . $errorMessage . '</span>';
        }
      ?>
      <p>
        <input type="submit" name="login" value="Login" class="w3-button w3-xlarge w3-black" />
        <!--<a href="login.php?test" class="w3-button w3-xlarge w3-black">Login</a>-->
      </p>

    </form>
  </div>
</header>

<!-- Footer
<footer class="w3-center w3-black w3-padding-48 ">
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green">w3.css</a></p>
</footer>
-->
<!-- Add Google Maps -->
<script>

// Tabbed Menu
function openMenu(evt, menuName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("menu");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
     tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
  }
  document.getElementById(menuName).style.display = "block";
  evt.currentTarget.firstElementChild.className += " w3-red";
}
document.getElementById("myLink").click();
</script>

</body>
</html>
