<?php
include"PanelSuperior.php";
include_once"funciones.php";
session_start();
$idUs=$_SESSION['usuario']['id'];

$buscar2="SELECT  avi.idfav as idfav,a.idAviso as idAviso,
                  a.asunto as asunto, a.descripcion as descripcion,
                  ci.nombre as nomCiudad,
                  ae.fechaPublicacion as fechapu, es.descripcion as estado,
                  usu.email as email,emp.razonSocial as nombre,
                  avi.calificacion as calificacion,
                  avi.comentarios as comentarios
                 FROM avisosfavoritos avi
                 INNER JOIN avisos a ON avi.idAvisoFav=a.idAviso
                 INNER JOIN usuarios us ON  avi.idUsuario=us.id
                 INNER JOIN avisosempresas ae ON  avi.idAvisoFav=ae.idAviso
                 INNER JOIN estados es ON es.idEstado= ae.estado
                 INNER JOIN domicilio do ON a.idDomicilio=do.idDomicilio
                 INNER JOIN ciudades ci ON do.idCiudad=ci.idCiudad
                 INNER JOIN empresas emp ON ae.cuitEmpresa=emp.cuit
                 INNER JOIN usuarios usu ON emp.idUsuario=usu.id
                 WHERE us.id='".$idUs."' ";

 @$Seleccionados=Consulta($buscar2);         
         

$buscar="SELECT   av.idAviso as idAviso,
                  av.asunto as asunto, av.descripcion as descripcion,
                  ci.nombre as nomCiudad,
                  em.fechaPublicacion as fechapu, es.descripcion as estado,
                  us.email as email,emp.razonSocial as nombre
                  FROM avisos av 
                  INNER JOIN avisosempresas em ON  av.idAviso=em.idAviso
                  INNER JOIN estados es ON em.estado=es.idEstado
                  INNER JOIN domicilio do ON av.idDomicilio= do.idDomicilio
                  INNER JOIN ciudades ci ON  do.idCiudad=ci.idCiudad
                  INNER JOIN empresas emp on em.cuitEmpresa=emp.cuit
                  INNER JOIN usuarios us ON emp.idUsuario=us.id";

 $avisos=Consulta($buscar);
 
 if(!empty($_POST) AND !empty($_POST['aviso']) AND !empty($_POST['calificacion']) AND
 !empty($_POST['comentario']))
 {  $idAviso=trim($_POST['aviso']);
 	$comentario=trim($_POST['comentario']);
 	$calificacion=trim($_POST['calificacion']);
 	$sql_insetar="INSERT INTO  avisosfavoritos (idUsuario,idAvisoFav,
 	                                        calificacion,comentarios)
 	                  VALUES ('".$idUs."','".$idAviso."','".$calificacion."','".$comentario."')";
    Consulta($sql_insetar); 
    header("Location:AvisosFavoritos.php");	                  
 }	
                 

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="UTF-8">
	<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
</head>
<body style="background-color: #eee">
 
 <form action="" method="POST" >
  
    <center><h1>Avisos favoritos:</h1></center>
    </br>
    <center>
    <div style="width:900px"><center>
    <div class="form-group" width=400>
      <label >Avisos:</label>
      <select name="aviso" class="form-control">
      <?php
      echo "<option>"."Seleccionar"."</option>";
      while($s=mysql_fetch_array($avisos))
      { $sel='';
        echo "<option ".$sel." value='".$s['idAviso']."'>"."<table>".
        "<tr>"."<td>"."ASUNTO: ".$s['asunto'].","."</td>"."<td>"."  EMPRESA:".$s['nombre'].","."</td>"."<td>"."   Fecha de Publicacion: ".$s['fechapu']." ".","."</td>"."<td>"." ESTADO: ".$s['estado']." , "."</td>"."<td>"." "."  CIUDAD:".$s['nomCiudad'].","."</td>"."<td>"."  CONTACTO:".$s['email']."</td>"."</tr>".
        "</table>"."</option>";
       }
      ?>
        
      </select>
    </div>
   
    <div  style="width:400px"  class="form-group">
      <label>Calificar</label>
      <select name="calificacion" style="font-size:17px" class="form-control">
        <option value="">Seleccionar </option>
        <option class="alert alert-danger">Me interesa </option> 
        <option class="alert alert-warning">Bueno </option>
        <option class="alert alert-info">Muy Bueno</option>  
        <option class="alert alert-success">Excelente</option>        
      </select>
    </div>
     
  <div class="panel panel-default">
  <div class="panel-heading">Agregar Comentarios:</div>
  <div class="list-group-item list-group-item-info">
   <div>
    <div>
    <TEXTAREA name="comentario" style="width:400px;height:100px"> </TEXTAREA>
    </div>
   </div>
</div>
</div>
</div>
    </br> 
   <button type="submit" class="btn btn-success">Agregar a Favoritos</button>
</center>
</form>
</br>
</br>
<div>
<center><h2>Agregados Recientemene: </h2></center>
<center>
<form action="modificarOborrarAvisos.php" method="GET">
<div class="form-group" style="width: 900px">
      <label ></label>
      <select name="avisoSeleccionado" class="form-control">
      <?php
      echo "<option>"."Seleccionar"."</option>";
      while($av=mysql_fetch_array($Seleccionados))
      { $sel='';
        echo "<option ".$sel." value='".$av['idfav']."'>"."<table>".
        "<tr>"."<td>"."ASUNTO: ".$av['asunto'].","."</td>"."<td>"."  EMPRESA:".$av['nombre'].","."</td>"."<td>"."   Fecha de Publicacion: ".$av['fechapu']." ".","."</td>"."<td>"." ESTADO: ".$av['estado']." , "."</td>"."<td>"." "."  CIUDAD:".$av['nomCiudad'].","."</td>"."<td>"."  CONTACTO:".$av['email']."</td>"."</tr>".
        "</table>"."</option>";
       }
      ?>
      </select>
      </br></br>
      <button type="submit" style="width:140px" value="1" class="btn btn-warning" name="boton1">Modificar</button> 
      <button type="submit" name="boton1" style="width:140px" value="2"class="btn btn-danger">Eliminar</button>
</div>       
</form>
</center>
</body>
</html>