<?php
include"PanelSuperior.php";
include_once"funciones.php";
session_start();

if (!empty($_GET) AND !empty($_GET['avisoSeleccionado']) AND 
	!empty($_GET['boton1']))
{    $idAvSelec=trim($_GET['avisoSeleccionado']);
     $buscar3="SELECT  avi.idfav as idfav,a.idAviso as idAviso,
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
                 WHERE avi.idfav='".$idAvSelec."'";

   @$rta=Consulta($buscar3);
   $s=mysql_fetch_array($rta);
	$valorBoton=trim($_GET['boton1']);
    if($valorBoton=="1")
	{    ?>
         <html>
         <head>
        	<title>Modificar</title>
        	<meta charset="UTF-8">
         </head>
         <body style="background-color: #eee">
         <form action="modificarA.php" method="POST" >
     <center><h1>Avisos favoritos:</h1></center>
    </br>
    <center>
    <div style="width:900px"><center>
    <div class="form-group" width=400>
      <label >Avisos:</label>
      <select name="aviso" class="form-control">
      <?php
        $sel='';
        echo "<option ".$sel." value='".$s['idfav']."'>"."<table>".
        "<tr>"."<td>"."ASUNTO: ".$s['asunto'].","."</td>"."<td>"."  EMPRESA:".$s['nombre'].","."</td>"."<td>"."   Fecha de Publicacion: ".$s['fechapu']." ".","."</td>"."<td>"." ESTADO: ".$s['estado']." , "."</td>"."<td>"." "."  CIUDAD:".$s['nomCiudad'].","."</td>"."<td>"."  CONTACTO:".$s['email']."</td>"."</tr>".
        "</table>"."</option>";
      ?>
      </select>
    </div>
   
    <div  style="width:400px"  class="form-group">
      <label>Calificar</label>
      <select name="calificacion" style="font-size:17px" class="form-control">
        <option> <?php echo $s['calificacion'];?></option>
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
    <TEXTAREA name="comentario" style="width:400px;height:100px"><?php echo $s['comentarios'];?>  </TEXTAREA>
    </div>
   </div>
   </div>
   </div>
   <center><button type="submit" style="width:140px"  class="btn btn-info">Guardar</button></center>
   </form>
     </body>
     </html>
          <?php
       }
    else
    { include_once"funciones.php";
      $idAvSelec=trim($_GET['avisoSeleccionado']);
      $borrar="DELETE FROM avisosfavoritos  WHERE idfav='". $idAvSelec."'";
      $rta=Consulta($borrar);
      if($rta==true)
      { ?>    <html>
            <head>
            <meta charset="UTF-8">
              </head>
            <body style="background-color:#eee">
            <center>
            </br></br></br></br></br></br></br></br></br></br></br></br></br></br>
            <div style="background-color:#d9534f;width:650px;position:center">
             <div class="alert" style="color:white;font-size:30px">
                <strong>AVISO ELIMINADO CON EXITO&nbsp;&nbsp;&nbsp;
                </strong>
                <span class="closebtn" onclick="this.parentElement.style.display='none';"><a href="AvisosFavoritos.php"style="font-size:50px;color:white;text-decoration:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ×</a></span>
                </div>
               </div> 
              </center> 
              </body>
      </html>
        <?php 
       }
    }
  }
  
  

?>