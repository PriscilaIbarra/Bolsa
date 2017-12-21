<?php
$soapclient = new SoapClient('http://www.webservicex.net/globalweather.asmx?WSDL');


$params = array(
      'CityName' => 'Rosario', 
      'CountryName' => 'Argentina',
      
    );
$response = $soapclient->GetWeather($params);
$a=json_encode($response);
$b=json_decode($a, true);


$c=$b['GetWeatherResult'];
$c=str_replace("", '-',$c);
$a=explode('/', $c);

$fecha=substr($a[1],9);
$tem=substr($a[7],12);
$hu=substr($a[9],30);
echo "FECHA:"."$fecha"." "."TEMPERATURA:"."$tem".""."HUMEDAD:"."$hu";
?> 

