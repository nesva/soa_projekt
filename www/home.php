
<?php
include('auth.php');
$meldung = '';

if(($_SESSION['userid']) == '') {
  $meldung = 'not logged in - oh no...' . $_SESSION['userid'];
 die('Bitte zuerst <a href="index.php">einloggen</a>');
} else {
  $meldung = 'logged in - yeah!';
}


//Abfrage der Nutzer ID vom Login
$userid = $_SESSION['userid'];

?>

<?php
echo "."
?>

<!DOCTYPE html>
<html>
<title>Smart Vinyard - SSOA-Project</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
<style>
body, html {height: 100%}
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
    <a href="#" class="w3-bar-item w3-button">HOME</a>
    <!--<a href="#menu" class="w3-bar-item w3-button">MENU</a>-->
    <a href="#about" class="w3-bar-item w3-button">ABOUT</a>
    <a href="#rest" class="w3-bar-item w3-button">REST</a>
    <a href="#soap" class="w3-bar-item w3-button">SOAP</a>
    <!--<a href="#googleMap" class="w3-bar-item w3-button">CONTACT</a>-->
    <?php
      echo '<span class="w3-bar-item">'. $meldung . '</span>';
    ?>
    <a href="logout.php" class="w3-bar-item w3-button w3-display-topright">Logout</a>

  </div>
</div>


<!-- Header with image -->
<header class="bgimg w3-display-container" id="home">
  <div class="w3-display-bottommiddle w3-padding">
    <span class="w3-tag w3-xlarge">Get weather information via REST or SOAP</span>
  </div>
  <div class="w3-display-middle w3-center">
    <span class="w3-text-white w3-hide-small" style="font-size:100px">SMART VINYARD</span>
    <p>
      <a href="#rest" class="w3-button w3-xxlarge w3-black">REST-WEATHER</a>
    </p>
    <p>
      <a href="#soap" class="w3-button w3-xxlarge w3-black">SOAP-WEATHER</a>
    </p>
  </div>
</header>

<!-- About Container -->
<div class="w3-container w3-padding-64 w3-black w3-xlarge" id="about">
  <div class="w3-content">
    <h1 class="w3-center w3-jumbo" style="margin-bottom:64px">About</h1>
    <p>The purpose of this project is to provide weather information. The idea is that the wine-maker
      can easily look after his vinyard - with one click. The weather info should not only be actual but
      also as correct (regarding geografical position) as possible. Therefore sensors are used.
    </p>
    <p>
      <strong>The Vinemaker?</strong> Mr. Leo Hillinger
      <img src="pics/logo.png" style="width:300px" class="w3-right" alt="Logo">
    </p>

    <img src="pics/vinyard.jpg" style="width:100%" class="w3-margin-top w3-margin-bottom" alt="Vinyard">
    <p>
      This SSOA-Project was founded by M. Borrelli, V. Coric, C. Gnauer and J. Wolfgeher.
    </p>

  </div>
</div>


<!-- REST container -->
<div class="w3-container w3-grey w3-padding-64 w3-xlarge" id="rest">
  <div class="w3-content">
    <h1 class="w3-center w3-jumbo" style="margin-bottom:64px">REST</h1>

    <p>Here are the weather infos of the vinyard transfered via REST.</p>

    <!-- weather info picture -->
    <div style="float: right;">
      <img src="pics/weathericons/sunny.png" alt="sun" width="150px" />
    </div>

    <div class="w3-center w3-xxlarge">

      <div>
      </div>
      <table>
<?php

          if(isset($_POST["submit"])){
            function call($method, $url) {
              $ch = curl_init();
              curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
              curl_setopt($ch, CURLOPT_URL, $url);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
              return curl_exec($ch);
            }
            $response = call('GET', 'http://localhost/restws/REST_api.php/weather/1');
            $vars = json_decode($response, true);

        echo"<tr>";
          echo"<td><b>"."Temp. "."</b></td>";
          echo"<td>".$vars['temp']." &deg;C"."</td>";
        echo"</tr>";
        echo"<tr>";
          echo"<td><b>"."Wind"."</b></td><td>". $vars['wind'] ." km/h"."</td>";
            echo"<td>&nbsp;". $vars['winddir'] ."</td>";
        echo"</tr>";
        echo"<tr>";
          echo"<td><b>"."Humidity"."</b></td><td>". $vars['humidity'] ." %"."</td>";
        echo"</tr>";
      }
?>
      </table>
    </div>

    <form action="" method="post">

      <button type="submit" name="submit" >submit</button>

   </form>

  </div>
</div>

<!-- SOAP container -->
<div class="w3-container w3-light-grey w3-padding-64 w3-xlarge" id="soap">
  <div class="w3-content">
    <h1 class="w3-center w3-jumbo" style="margin-bottom:64px">SOAP</h1>

    <p>Here are the weather infos of the vinyard transfered via SOAP.</p>

    <!-- weather info picture -->
    <div style="float: right;">
      <img src="pics/weathericons/sunny.png" alt="sun" width="150px" />
    </div>

    <?php

    $params = array('location' => 'http://weatherpi/soapws/server.php',
                        'uri' => 'http://weatherpi/soapws/weather',
                        'trace' => 1);

    $client = new SoapClient(NULL, $params);

    echo "<div class=w3-center w3-xxlarge>";
      echo "<table>";
        echo "<tr>";
          echo "<td><b>"."Temperatur  "."</b></td><td>".$client->getTemperature()." &deg;C"."</td>";
        echo "</tr>";
        echo "<tr>";
          echo "<td><b>"."Wind  "."</b></td><td>".$client->getWindSpeed()." km/h"."</td><td>"."aus ".$client->getWindDirection()."</td>";
        echo "</tr>";
        echo "<tr>";
          echo "<td><b>"."Humidity  "."</b></td><td>".$client->getHumidity()." %"."</td>";
        echo "</tr>";

      echo "</table>";
    echo "</div>";

  echo "</div>";
echo "</div>";
?>

<!-- Footer
<footer class="w3-center w3-black w3-padding-48 ">
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green">w3.css</a></p>
  <p>
    Weather-Icons
    <a href='https://www.freepik.com/free-vector/colorful-weather-icons-pack_755311.htm'>designed by Freepik</a>
  </p>
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
