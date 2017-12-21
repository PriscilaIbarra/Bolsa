<?php
function consultaSql($consulta)
{
$conexion=mysql_connect("localhost","root","");
if($conexion==false)
{
	die('No pudo conectarse: '.mysql_error());
}
       mysql_select_db("tp",$conexion);
       $resultado=mysql_query($consulta);
       if($resultado==false)
        {
        	$resultado=0;
        }
      else{
         $resultado=mysql_fetch_assoc($resultado);}//mysql_fetch_assoc convierte el resultado de la consulta a array
         mysql_close($conexion);//todas las funciones del mysql no se pueden invocar fuera de la conexion,una vez cerrada la conexion no puedo usar fuera de este archivo mysql_num_rows, mysql_...
         return $resultado;    
} 

function Consulta($sql)
{
 
$link=mysql_connect("localhost","root","");
mysql_select_db("tp",$link);
$resultado=mysql_query($sql);
return $resultado;
}        
?>
