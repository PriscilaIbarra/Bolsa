<?php
include"PanelSuperior.php";
include_once"funciones.php";
session_start();
$idUs=$_SESSION['usuario']['id'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Perfil Aspirante</title>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
    <link type="text/css" rel="stylesheet" href="css/bootstrap-datepicker.css"/>
</head>
<body>
<?php

 $buscarAspirante="SELECT a.idUsuario as us FROM aspirantes a
                     WHERE a.idUsuario='".$idUs."'";
                   
$aspirante=Consulta($buscarAspirante); 
$a=mysql_fetch_array($aspirante);
if(!empty($a))
{
  $buas="SELECT  ase.nombre as nombre,
                      ase.apellido as apellido,
                      ase.fechaNacimiento as fecha,
                      ase.dni as dni,
                      ca.idCalle as idCalle,
                      ca.nombre as calle,
                      ci.idCiudad as idCiudad,
                      ci.nombre as ciudad,
                      se.idSexo as idSexo,
                      se.descripcion as sexo,
                      do.nro as nro,
                      ase.fotoPerfil as fotope,
                      ase.pdf as apdf
                        FROM aspirantes ase 
                        INNER JOIN sexo se ON ase.idSexo=se.idSexo
                        INNER JOIN domicilio do ON ase.idDomicilio=do.idDomicilio
                        INNER JOIN calles ca ON do.idCalle=ca.idCalle
                        INNER JOIN ciudades ci ON do.idCiudad=ci.idCiudad  
                        WHERE ase.idUsuario='".$idUs."'";
     
           $as=Consulta($buas);
           $ar=mysql_fetch_array($as);
           
}
else{$ar= array('nombre' => "",'apellido' =>"" ,'fecha' =>"" ,'dni' =>"" ,'idCalle' =>"" ,'calle' =>"" , 'idCiudad'=>"",'ciudad'=>"",'idSexo'=>"",'sexo'=>"",'nro'=>"",'fotope'=>"");}
?>
<form action=" " method="POST"  enctype="multipart/form-data">
</br>
<div style="background-color:#eee" class="panel panel-primary" >
<div  class="btn-primary" style="text-align:center;font-size:20px">Datos Personales</div>
<div id="datos">
</br>
<center>
<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img  aling='left' src="<?php echo $ar['fotope']; ?>"  class="img-circle" width="150" height="150"></div>
</center>
</br>
<center>
<strong>Nombre:</strong><input type="text" value="<?php echo $ar['nombre'];?>" name="nombre" class="btn panel-primary">
</br>
</br>
<strong>Apellido:</strong><input type="text" value="<?php echo $ar['apellido'];?>" name="apellido" class="btn panel-primary">
</br></br>
<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha de Nacimiento :</strong></br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input id="fecha" type="text" value="<?php echo $ar['fecha'];?>" name="fecha" class="btn panel-primary"></br></br>
<strong>&nbsp;DNI:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong><input type="text"  name="dni" value="<?php echo $ar['dni'];?>" class="btn panel-primary">
</br></br>

<strong>Sexo:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
<select name="sexo"  class="btn panel-primary">
<?php
$sel='';
echo "<option ".$sel." value='".$ar['idSexo']."'>".$ar['sexo']."</option>";
 ?>
<?php
while($ce=mysql_fetch_array($sexos))
{
$sel='';
echo "<option ".$sel." value='".$ce['idSexo']."'>".$ce['descripcion']."</option>";
}
?>
</select>
</br>
</br>

<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Domicilio:
</br>
Ciudad:&nbsp;&nbsp;
<select name="ciudad"  class="btn panel-primary">
<?php
$sel='';
echo "<option ".$sel." value='".$ar['idCiudad']."'>".$ar['ciudad']."</option>";
 ?>
 <?php
while($c=mysql_fetch_array($ciudades))
{ 
  $sel='';
  echo "<option ".$sel." value='".$c['idCiudad']."'>".$c['nombre']."</option>";
}
?>
</select>
</br></br>
Calle:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<select name="calle"  class="btn panel-primary">
<?php
$sel='';
echo "<option ".$sel." value='".$ar['idCalle']."'>".$ar['calle']."</option>";
 ?>
<?php
while($d=mysql_fetch_array($calles))
{
 $sel='';
 echo "<option ".$sel." value='".$d['idCalle']."'>".$d['nombre']."</option>";
}
?>
</select>
</br></br>
Nro:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input  value="<?php echo $ar['nro'];?>" type="text" name="nrocalle"  class="btn panel-primary">
</label>
</center>
</br>
</br>
</br>
<center>
 <div>
   </br></br></br>
   
   </div>
   </div>

   </div>
   </div>
    <center><a style="text-decoration:none; " href="ModificarPerfilAspirante.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button"class="btn btn-success"  
    style="width:200px" value="Modificar"></a></center>
</form>
</body>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</html>