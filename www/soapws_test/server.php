<?php
// SOAP Server Klasse
class server
{
  private $con;

  // Konstruktor für die Datenbankverbindung.
  public function __construct()
  {
    $this->con = (is_null($this->con)) ? self::connect() : $this->con;
  }

  //Verbindung zur Datenbank
  static function connect()
  {
    $con = mysqli_connect('localhost', 'logger', 'reggol', 'weatherstation_test');
    return $con;
  }

  //getTemperature() Funktion um die Temperatur aus der Datenbank auszulesen
  public function getTemperature()
  {
    $sql = "SELECT * FROM weather";
    $qry = mysqli_query($this->con, $sql);
    $res = mysqli_fetch_array($qry);
    return $res['temp'];
  }

  //getHumidity() Funktion um die Luftfäuchtigkeit aus der Datenbank auszulesen
  public function getHumidity()
  {
    $sql = "SELECT * FROM weather";
    $qry = mysqli_query($this->con, $sql);
    $res = mysqli_fetch_array($qry);
    return $res['humidity'];
  }

  //getWindSpeed() Funktion um die Windstärke aus der Datenbank auszulesen
  public function getWindSpeed()
  {
    $sql = "SELECT * FROM weather";
    $qry = mysqli_query($this->con, $sql);
    $res = mysqli_fetch_array($qry);
    return $res['wind'];
  }

  //getWindDirection() Funktion um die Windrichtung aus der Datenbank auszulesen
  public function getWindDirection()
  {
    $sql = "SELECT * FROM weather";
    $qry = mysqli_query($this->con, $sql);
    $res = mysqli_fetch_array($qry);
    return $res['winddir'];
  }

}

$params = array('uri' => 'http://weatherpi/soapws_test/weather');

//SoapServer Objekt mit der URI. NULL wird verwendet weil noch keine WSDL verfügbar ist
$server = new SoapServer(NULL, $params);

//Server Klasse wird gesetzt
$server->setClass('server');

//Der Handler wird gestartet
$server->handle();

?>
