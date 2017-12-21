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

$a=explode('/', $c);


$fecha=substr($a[1],9);
$tem=substr($a[7],12);
$hu=substr($a[9],12);
echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";echo "</br>";
echo "FECHA:"."$fecha";

?> 

<!DOCTYPE html >  
<html>
<head> 
<title>Buscar empleo</title> 
<meta name="author" content="pri">
<meta name="description" content="Bolsa de trabajo">
<meta name="keywords" content="Pagina para buscar trabajo-avisos laborales">
<meta name="classification" content="oferta laboral,trabajo,empresas">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link type="text/css" rel="stylesheet" href="formatopagpri.css"/>
</head>
<body>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>


 <h1>Empleos.esy  </h1>  
<!-----------------buscador---------->
<div class="contenedor">
<form id="form" action="resultados.php" method="POST">
      <input id="b" type="text" name="buscador"  style="color:orange;font-style:italic; " 
      placeholder="                Rubro, Descripción, Ciudad"/>
      <input id="bo" type="submit" value="Buscar"/>  
</form>
</div>
<!-----------------finbuscador---------->
<br/>
 <!------------ Registrarse o ingresar-->
<div class="contenedor1">
<button id="b1" type="button"><a href="registrarse.php">Registrarse</a></button>
<button id="b2" type="button"><a href="login.php">Ingresar</a></button>
</div>
 <!------------ finRegistrarse o ingresar-->
</body>
</html>

