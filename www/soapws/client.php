<?php

$params = array('location' => 'http://weatherpi/soapws/server.php',
                    'uri' => 'http://weatherpi/soapws/weather',
                    'trace' => 1);

$client = new SoapClient(NULL, $params);

//echo "Hallo! Mein Name ist ".$client->getMessage()."!\n";
echo "Die Temperatur beträgt ".$client->getTemperature()." grad celsius. \n";
echo "Die Luftfäuchitgkeit beträgt ".$client->getHumidity()."%\n";
echo "Die Windstärke ist ".$client->getWindSpeed()." km/h und die Windrichtung ist ".$client->getWindDirection()."\n";

?>
