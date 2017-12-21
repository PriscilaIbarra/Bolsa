<?php
include"PanelSuperior.php";
include_once"funciones.php";
session_start();
$idUs=$_SESSION['usuario']['id'];
$buscar="SELECT * FROM ciudades";
$ciudades=Consulta($buscar);
$buscar2="SELECT * FROM calles";
$calles=Consulta($buscar2);
$buscar3="SELECT * FROM sexo";
$sexos=Consulta($buscar3);

$buscarAspirante="SELECT a.idUsuario as us FROM aspirantes a
                     WHERE a.idUsuario='".$idUs."'";
                   
$aspirante=Consulta($buscarAspirante); 
$a=mysql_fetch_array($aspirante);


if(empty($a))             
{   
      if(!empty($_POST['ciudad']) AND !empty($_POST['calle']) AND !empty($_POST['nrocalle']) AND !empty($_POST['fecha']) AND !empty($_POST['sexo']) AND !empty($_POST['dni']) AND !empty($_POST['apellido']) 
        AND  !empty($_POST['nombre']) AND !empty($_FILES))
    {
     $nombre=trim($_POST['nombre']);
     $apellido=trim($_POST['apellido']);
     $calle=trim($_POST['calle']);
     $nro=trim($_POST['nrocalle']);
     $ciudad=trim($_POST['ciudad']);
     $fecha=trim($_POST['fecha']);
     $dni=trim($_POST['dni']);
     $idSexo=trim($_POST['sexo']);

      
      $nombrefoto = "fotos/".date('Y-m-dHis')."_".rand(123,123123);
      if(preg_match("/png/i", $_FILES['foto']['type']) > 0){
        $ext = ".png";
      }
      if(preg_match("/jpg/i", $_FILES['foto']['type']) > 0){
        $ext = ".jpg";
      }
      if(preg_match("/jpeg/i", $_FILES['foto']['type']) > 0){
        $ext = ".jpeg";
      }
      
      if(preg_match("/gif/i", $_FILES['foto']['type']) > 0){
        $ext = ".gif";
      }
      //guardar la imagen a la carpeta foto
      move_uploaded_file($_FILES['foto']['tmp_name'], $nombrefoto.$ext);
      
      
      //archivo
      
      $nombrearchivo = "pdf/".date('Y-m-dHis')."_".rand(123,123123);
      if(preg_match("/pdf/i", $_FILES['archivo']['type']) > 0){
        $ext2 = ".pdf";
      }
      //guardar la imagen a la carpeta foto
      move_uploaded_file($_FILES['archivo']['tmp_name'], $nombrearchivo.$ext2);
      
     
     $sql_insertar="INSERT INTO domicilio(idDomicilio,idCalle,nro,idCiudad)
                           VALUES ('','".$calle."','".$nro."','".$ciudad."')";
 
     Consulta($sql_insertar);

     $bus="SELECT do.idDomicilio FROM domicilio do WHERE do.idCalle='".$calle."' AND do.idCiudad='".$ciudad."' AND do.nro='".$nro."'";
     $Do=mysql_fetch_array(Consulta($bus));    
     $idDo=$Do['idDomicilio'];
     
     if(!empty($Do))
     {$perfil_aspirante="INSERT INTO aspirantes(idUsuario,nombre,apellido,fechaNacimiento,dni,idSexo,idDomicilio,fotoPerfil,pdf)
                           VALUES ('".$idUs."','".$nombre."','".$apellido."','".$fecha."','".$dni."','".$idSexo."','".$idDo."',
                            '".$nombrefoto.$ext."','".$nombrearchivo.$ext2."')";
            
      Consulta($perfil_aspirante);} 
          
     }
  }
  else { 
          
    if(!empty($_POST['ciudad']) AND !empty($_POST['calle']) AND !empty($_POST['nrocalle']) AND !empty($_POST['fecha']) AND !empty($_POST['sexo']) AND !empty($_POST['dni']) AND !empty($_POST['apellido']) AND  !empty($_POST['nombre']) AND !empty($_FILES))
     { 


     $nombre=trim($_POST['nombre']);
     $apellido=trim($_POST['apellido']);
     $calle=trim($_POST['calle']);
     $nro=trim($_POST['nrocalle']);
     $ciudad=trim($_POST['ciudad']);
     $fecha=trim($_POST['fecha']);
     $dni=trim($_POST['dni']);
     $idSexo=trim($_POST['sexo']);

      
      $nombrefoto = "fotos/".date('Y-m-dHis')."_".rand(123,123123);
      if(preg_match("/png/i", $_FILES['foto']['type']) > 0){
        $ext = ".png";
      }
      if(preg_match("/jpg/i", $_FILES['foto']['type']) > 0){
        $ext = ".jpg";
      }
      if(preg_match("/jpeg/i", $_FILES['foto']['type']) > 0){
        $ext = ".jpeg";
      }
      
      if(preg_match("/gif/i", $_FILES['foto']['type']) > 0){
        $ext = ".gif";
      }
      
      move_uploaded_file($_FILES['foto']['tmp_name'], $nombrefoto.$ext);
      
      
      
      
      $nombrearchivo = "pdf/".date('Y-m-dHis')."_".rand(123,123123);
      if(preg_match("/pdf/i", $_FILES['archivo']['type']) > 0){
        $ext2 = ".pdf";
      }
      
      move_uploaded_file($_FILES['archivo']['tmp_name'], $nombrearchivo.$ext2);

     $bus="SELECT asp.idDomicilio as idDomicilio FROM aspirantes asp 
                 INNER JOIN domicilio do ON asp.idDomicilio=do.idDomicilio
                 WHERE asp.idUsuario='".$idUs."'";
     
    
     $Do=mysql_fetch_array(Consulta($bus));   
     

     if(!empty($Do))
     {$idDo=$Do['idDomicilio'];

     $sql_actualizar="UPDATE  domicilio do SET 
                                          do.idCalle='".$calle."',
                                          do.nro='".$nro."',
                                          do.idCiudad='".$ciudad."'
                                          WHERE do.idDomicilio='".$idDo."'";
    
     Consulta($sql_actualizar);
     
    
       $perfil_aspirante="UPDATE aspirantes ap SET
                                             ap.nombre='".$nombre."',
                                             ap.apellido='".$apellido."',
                                             ap.fechaNacimiento='".$fecha."',
                                             ap.dni='".$dni."',
                                             ap.idSexo='".$idSexo."',
                                             ap.fotoPerfil='".$nombrefoto.$ext."',
                                             ap.pdf='".$nombrearchivo.$ext2."' ";
                           
         Consulta($perfil_aspirante);
         header("Location:panelAspirante.php"); 
        }            
  }   
}

         
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
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
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
     
           @$as=Consulta($buas);
           @$ar=mysql_fetch_array($as); 

      
}
else{$ar= array('nombre' => "",'apellido' =>"" ,'fecha' =>"" ,'dni' =>"" ,'idCalle' =>"" ,'calle' =>"" , 'idCiudad'=>"",'ciudad'=>"",'idSexo'=>"",'sexo'=>"",'nro'=>"",'fotope'=>"",'apdf'=>"");}
?>
<form action=" " method="POST"  enctype="multipart/form-data">
</br>
<div style="background-color:#eee" class="panel panel-primary" >
<div class="btn-primary" style="text-align:center;font-size:20px">Datos Personales</div>
<div>
</br>
<center>
<div> <img align="center" src="<?php echo $ar['fotope']; ?>"  class="img-circle" width="150" height="150">
</div>
<div>
    <label>Foto de Perfil:</label>
    <input type="file" name="foto" accept="image/*">
  </div>
</div>
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
    <label>Cargar Curriculum Vitae</label>
    <input type="file" name="archivo" accept="pdf/*">
  </div>
  <div>
   </br></br></br>
   
   </div>
   </div>

   </div>
   </div>
    <center><button type="submit" name="enviar" class="btn btn-primary" style="width:100px">Actualizar</button></center>
</center>
</form>
</body>
<script src="js/bootstrap-datepicker.min.js"></script>
<script src="js/locales/bootstrap-datepicker.es.js"></script>
<script type="text/javascript">
	$("#fecha").datepicker({format:'dd/mm/yyyy',language:'es'});
</script>
</html>