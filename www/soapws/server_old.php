<?php

class server
{
  private $con;

  public function __construct()
  {
    $this->con = (is_null($this->con)) ? self::connect() : $this->con;
  }

  static function connect()
  {
    $con = mysqli_connect('localhost', 'logger', 'reggol', 'weatherstation');
    return $con;
  }

  public function getTemperature()
  {
    $sql = "SELECT * FROM weather";
    $qry = mysqli_query($this->con, $sql);
    $res = mysqli_fetch_array($qry);
    return $res['temp'];
  }

  public function getHumidity()
  {
    $sql = "SELECT * FROM weather";
    $qry = mysqli_query($this->con, $sql);
    $res = mysqli_fetch_array($qry);
    return $res['humidity'];
  }

  public function getWind()
  {
    $sql = "SELECT * FROM weather";
    $qry = mysqli_query($this->con, $sql);
    $res = mysqli_fetch_array($qry);
    return $res['wind'];
  }

  public function getMessage()
  {
    return 'Vanes Coric';
  }

}

$params = array('uri' => 'http://weatherpi/soapws/weather');
$server = new SoapServer(NULL, $params);
$server->setClass('server');
$server->handle();

?>
