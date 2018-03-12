<?php

$params = array('location' => 'http://weatherpi/soapws/server.php',
                    'uri' => 'http://weatherpi/soapws/weather',
                    'trace' => 1);

$client = new SoapClient(NULL, $params);

echo "Die Temperatur beträgt: ".$client->getTemperature()." \n";
echo "Die Luftfäuchitgkeit beträgt: ".$client->getHumidity()." \n";
echo "Die Windstärke ist: ".$client->getWind()." km/h\n";
echo "Mein Name ist: ".$client->getMessage()." \n";


?>
