<?php
include"PanelSuperior.php";
$ch=curl_init(); 

// set url 
curl_setopt($ch, CURLOPT_URL,"http://www.cotizacion-dolar.com.ar/cotizacion_hoy.php"); 

//return the transfer as a string 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

// $output contains the output string 
$output = curl_exec($ch); 
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="UTF-8">
</head>
<body>
<?php
echo utf8_encode($output);
?>
</body>
</html>
<?php

curl_close($ch); 


// close curl resource to free up system resources 
     

?>