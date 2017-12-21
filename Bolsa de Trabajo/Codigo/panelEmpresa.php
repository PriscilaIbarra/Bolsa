<!DOCTYPE html>
<html>
<head>
	<title>Perfil Empresa</title>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
</head>
<body>
<?php
include_once"PanelSuperiorEmpresa.php";
include_once"funciones.php";
session_start();
$idU=$_SESSION['usuario']['id'];
$buscar1="SELECT * FROM ciudades";
$ciudades=Consulta($buscar1);
$buscar2="SELECT *FROM calles";
$calles=Consulta($buscar2);
 $buscar="SELECT emp.idUsuario FROM empresas emp WHERE emp.idUsuario='".$idU."'";
 $rta=Consulta($buscar);
 $emp=mysql_fetch_array($rta);
 
  if(!empty($emp))
 {
       $buas="SELECT  emp.razonSocial as razonSocial,
                      emp.tel as tel,
                      emp.descripcion as descripcion,
                      emp.cuit as cuit,
                      ca.nombre as calle,
                      ca.idCalle as idCalle,
                      ci.nombre as ciudad,
                      ci.idCiudad as idCiudad,
                      do.nro as nro,
                      emp.fotoPerfil as fotope
                      FROM empresas emp  
                        INNER JOIN domicilio do ON emp.idDomicilio=do.idDomicilio
                        INNER JOIN calles ca ON do.idCalle=ca.idCalle
                        INNER JOIN ciudades ci ON do.idCiudad=ci.idCiudad  
                        WHERE emp.idUsuario='".$idU."'";
              

           @$em=Consulta($buas);
           @$empe=mysql_fetch_array($em);
           
 }
 else{ $empe= array('razonSocial' =>"",'tel'=>"",'descripcion'=>"",'cuit'=>"",'calle'=>"",'idCalle'=>"",'ciudad'=>"",'idCiudad'=>"",'nro'=>"",'fotope'=>"");
       }
?>
<form action="modificarDatosEmpresa.php" method="POST" enctype="multipart/form-data">
</br>
<div class="panel panel-primary" style="background-color:#eee">
<div  class="btn-primary" style="text-align:center;font-size:20px">Datos empresariales</div>
<div id="datos">
</br>
<center>
<div><img  aling='left' src="<?php echo $empe['fotope'];?>" 
 class="img-circle" width="150" height="150"></div>
</center>
<center>
<div>
    <label>Foto de Perfil:</label>
     <input type="file" name="foto" accept="image/*">
  </div>
</center>
<center>
</br>
<div style="width:500px;text-align:left;">
<div>
	<label>Razón Social:</label>
	<input type="text" value="<?php echo $empe['razonSocial'];?>" name="razon" class="form-control"></input>
</div>
<div>
	<label>CUIT:</label>
	<input type="text" name="cuit" value="<?php echo $empe['cuit'];?>" class="form-control"></input>
</div>
<div>
	<label>TEL:</label>
	<input type="text" name="tel" value="<?php echo $empe['tel'];?>" class="form-control"></input>
</div>
</br>
<label>Dirección:</label>
  <div class="form-group">
      <label>Ciudad:</label>
      <select  name="ciudad"class="form-control">
        <?php
         $sel='';
          echo "<option ".$sel." value='".$empe['idCiudad']."'>".$empe['ciudad']."</option>"; 
         ?>
         <?php 
        while($c=mysql_fetch_array($ciudades))
        {  
         	$sel='';
         	echo "<option ".$sel." value='".$c['idCiudad']."'>".$c['nombre']."</option>";
        }
        ?>
        </select>
 </div>
 <div class="form-group">
      <label>Calle:</label>
      <select  name="calle"class="form-control">
       <?php
         $sel='';
          echo "<option ".$sel." value='".$empe['idCalle']."'>".$empe['calle']."</option>"; 
         ?>
      <?php
        while($ca=mysql_fetch_array($calles))
        {  
         	$sel='';
         	echo "<option ".$sel." value='".$ca['idCalle']."'>".$ca['nombre']."</option>";
        }
        ?>
      </select>
 </div>
 <div>
	<label>Nro:</label>
	<input type="text" value="<?php echo $empe['nro'];?>" name="nro" class="form-control"></input>
</div>
</br>
<div>
<label>Descripción:</label>
</br>
<textarea name="descripcion"  class="form-control"><?php echo $empe['descripcion'];?></textarea>
</div>
</br>
<div>
	<center><button type="submit"  style="width:100px"  class="btn btn-primary">Guardar</button></center>
</div>
</br></br>
</div>
</center>
</form>
</body>
</html>

