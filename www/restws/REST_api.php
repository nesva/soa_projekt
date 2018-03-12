<?php

header("Content-Type:application/json");

// HTTP Methode, Pfad und Request einlesen
$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
$input = json_decode(file_get_contents('php://input'),true);

// Tabelle und id aus dem Request auslesen
$table = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
$key = array_shift($request)+0;

$link = mysqli_connect('localhost', 'logger', 'reggol', 'weatherstation');
mysqli_set_charset($link,'utf8');

// SQL Statement anhand der HTTP Methode erstellen
switch ($method) {
  case 'GET':
    $sql = "SELECT temp, humidity, wind, winddir FROM `$table`".($key?" WHERE id=$key":'');break;
  /*case 'PUT':
    $sql = "update `$table` set $set where id=$key"; break;
  case 'POST':
    $sql = "insert into `$table` set $set"; break;
  case 'DELETE':
    $sql = "delete `$table` where id=$key"; break;*/
}
// SQL statement ausführen
$result = mysqli_query($link,$sql);

// wenn SQL statement fehlschlägt
if (!$result) {
  http_response_code(404);
  die(mysqli_error());
}

// Ausgabe der Ergebnisse
if ($method == 'GET') {
  if (!$key) echo '[';
  for ($i=0;$i<mysqli_num_rows($result);$i++) {
    echo ($i>0?',':'').json_encode(mysqli_fetch_object($result));
  }
  if (!$key) echo ']';
} elseif ($method == 'POST') {
  echo mysqli_insert_id($link);
} else {
  echo mysqli_affected_rows($link);
}

mysqli_close($link);

?>
