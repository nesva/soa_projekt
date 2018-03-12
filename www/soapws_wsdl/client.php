<?php

//$params = array('location' => 'http://weatherpi/soapws_test/server.php',
//                    'uri' => 'http://weatherpi/soapws_test/weather',
//                    'trace' => 1);

$client = new SoapClient('http://weatherpi/soapws_wsdl/server.php?wsdl', array('soap_version' => SOAP_1_2, 'trace' => 1, 'cache_wsdl' => 0));

//echo "Hallo! Mein Name ist ".$client->getMessage()."!\n";
echo "Die Temperatur beträgt ".$client->getTemperature()." grad celsius. \n";
echo "Die Luftfäuchitgkeit beträgt ".$client->getHumidity()."%\n";
echo "Die Windstärke ist ".$client->getWindSpeed()." km/h und die Windrichtung ist ".$client->getWindDirection()."\n";

?>
