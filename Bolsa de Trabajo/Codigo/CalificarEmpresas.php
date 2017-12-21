<?php
include_once"funciones.php";
include"PanelSuperior.php";
session_start();
$idUs=$_SESSION['usuario']['id'];
$buscarD="SELECT * FROM usuarios us WHERE us.id='".$idUs."'";
@$usuario=Consulta($buscarD);
@$usuar=mysql_fetch_array($usuario);
$buscar="SELECT * FROM empresas";
@$empresas=Consulta($buscar);

$nomUsuario=$usuar['nomUsuario'];
if(!empty($_POST['nomEmpresa']) AND !empty($_POST['remuneracion']) AND !empty($_POST['experiencia']))
{    
	$nomEmpresa=trim($_POST['nomEmpresa']);
	$remuneracion=trim($_POST['remuneracion']);
	$experiencia=trim($_POST['experiencia']);
	if(isset($_POST['checkbox1']))
	{ $remuter="Si";}else{$remuter="No";}

    if(isset($_POST['checkbox2']))
	{ $capacita="Si";}else{$capacita="No";}

    if(isset($_POST['checkbox3']))
	{ $estabilidad="Si";}else{$estabilidad="No";}

    $archivo = fopen("calificarempresas.txt",'a+');
    $cadena=$nomUsuario.','.$nomEmpresa.','.$remuneracion.','.$remuter.','.$capacita.','.$estabilidad.','.$experiencia.';';
    fputs($archivo,$cadena);
    fclose($archivo);
     
    $lista=fopen("listaCalificaciones.txt",'a+') ;
    $fecha= date("d.m.y"); 
     $cadena1="Fecha: ".$fecha.'|'."Usuario:  ".$nomUsuario.' | '." Empresa: ".$nomEmpresa.'|'." REMUNERACION: ".$remuneracion.' | '." PAGA A TERMINO: ".$remuter.' | '." CAPACITA: ".$capacita.' | '." BRINDA ESTABILIDAD LABORAL:".$estabilidad.' | '." COMENTARIOS: ".$experiencia.';';
    fputs($lista,$cadena1);
    fclose($lista);    

    header("Location:CalificarEmpresas.php");
    
}
?>




<!DOCTYPE html>
<html>
<head>
	<title>Calificar Empresas</title>
     <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap.min.css"> 
</head>
<body style="background-color:#eee">
</br></br>
<center>
<form style="width:400px;text-align: left" action="" method="POST">
	<h1 style="color:#33CC33">Calificar Empresa</h1>
<div class="form-group">
      <label style="color:#f0ad4e">Empresa</label>
      <select style="color: #337ab7" name="nomEmpresa" class="form-control">
        <option value="">Seleccionar</option>
         <?php
         while ($e=mysql_fetch_array($empresas))
         {
          $sel='';
         	echo "<option ".$sel." value='".$e['razonSocial']."'>".$e['razonSocial']."</option>";          
         }
         ?>
      </select>
    </div>
 <div class="form-group">
      <label style="color:#f0ad4e">Remuneración Ofrecida</label>
      <select style="color: #337ab7" name="remuneracion" class="form-control">
        <option><strong>Seleccionar</strong></option>
        <option><strong>Baja</strong></option>
        <option><strong>Alta</strong></option>
        <option><strong>Conforme a lo Pautado</strong></option>
      </select>
    </div>   

    <div>
    <label style="color:#f0ad4e">Abona remuneración a término? <input type="checkbox" name="checkbox1">  </label>
   </div>
   </br></br>
   <div>
    <label style="color:#f0ad4e">Capacita a sus empleados? <input type="checkbox" name="checkbox2">  </label>
   </div>
   </br></br>
   <div>
    <label style="color:#f0ad4e">Brinda estabilidad laboral ? <input type="checkbox" name="checkbox3">  </label>
   </div>
   </br>
   <div><label style="color:#f0ad4e">Comentar Experiencia:
    <textarea class="form-control" rows="3" name="experiencia" style="color:#f0ad4e;width:400px "></textarea></label>
   </div>
   <div>
   	<button type="submit" name="boton" class="btn btn-success">Agregar Calificación</button>
   </div>
</form>
</center>


<div><center>
<form style="width:1200px">
    </br>
<center><h1 style="color:#337ab7;">Lista de Calificaciones:</h1></center>
	<?php 
     $archivoCompleto = file_get_contents('listaCalificaciones.txt');
        @fclose('listaCalificaciones.txt');
        @$arrayca=explode(';', $archivoCompleto);
         $cantidad=count($arrayca);
         $cont=0;
         echo "<select  class="."form-control".">";
         while($cont<$cantidad)
         { 
            echo "<option style="."color:red".">$arrayca[$cont]</option>";
            $cont++;        
         }
         echo "</select>";
    ?>
	
</form>
</center>
</div>
</body>
</html>