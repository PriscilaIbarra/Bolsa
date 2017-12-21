<?php
include"PanelSuperiorEmpresa.php";
include"funciones.php";
session_start();
$idUs=$_SESSION['usuario']['id'];
$buscar2="SELECT * FROM rubros";
$rubros=Consulta($buscar2);
$buscar5="SELECT * FROM niveldeestudios";
$estudios=Consulta($buscar5);
$buscar4="SELECT * FROM tiposdetrabajos";
$tipos=Consulta($buscar4);
$buscar7="SELECT * FROM sexo";
$sexo=Consulta($buscar7);
$buscar6="SELECT * FROM idiomas";
$idiomas=Consulta($buscar6);


if(!empty($_POST['idRubro']) AND !empty($_POST['asunto']) AND !empty($_POST['descripcion']) AND !empty($_POST['edad']) AND !empty($_POST['idEstudio']) AND
	!empty($_POST['idTipoTrabajo'])  AND
	 !empty($_POST['idSexo']) AND !empty($_POST['idIdioma']))
{      
	  
      $idRubro=utf8_encode(trim($_POST['idRubro']));  
      $asunto=utf8_encode(trim($_POST['asunto']));
      $descripcion=utf8_encode(trim($_POST['descripcion']));
      $edad=utf8_encode(trim($_POST['edad']));
      $idNivelDeEstudio=utf8_encode(($_POST['idEstudio']));
      $idTipoTrabajo=utf8_encode(trim($_POST['idTipoTrabajo']));
      $experiencia=utf8_encode(trim($_POST['experiencia']));
      $idSexo=utf8_encode((trim($_POST['idSexo'])));
      $idIdioma=utf8_encode(trim($_POST['idIdioma']));

      $buscarDomicilioEmpresa="SELECT emp.idDomicilio as idDomicilio
                                       FROM empresas emp
                                       WHERE emp.idUsuario='".$idUs."'";
      $rta=Consulta($buscarDomicilioEmpresa);
      $dom=mysql_fetch_array($rta);
      $d=$dom['idDomicilio'];
      if(!empty($dom))
      {  
      	$insertar_requisitos="INSERT INTO requisitos (idRequisitos,idSexo,edad,idNivelDeEstudio,idTipoTrabajo,experienciaLaboral,idIdioma)
      	     VALUES ('','".$idSexo."','".$edad."','".$idNivelDeEstudio."','".$idTipoTrabajo."','".$experiencia."','".$idIdioma."')";

      	Consulta($insertar_requisitos);
      	
      	$buscar_idRequisito="SELECT re.idRequisitos as idRequisitos 
      	                    FROM requisitos re  WHERE re.idSexo='".$idSexo."'
      	                    AND re.edad='".$edad."' 
      	                    AND re.idNivelDeEstudio='".$idNivelDeEstudio."' 
      	                    AND re.idTipoTrabajo='".$idTipoTrabajo."'
      	                    AND re.experienciaLaboral='".$experiencia."'
      	                    AND re.idIdioma='".$idIdioma."' ";
      	      
      	 $rta2=Consulta($buscar_idRequisito);
      	 $re=mysql_fetch_array($rta2);
      	 if(!empty($re))
      	 {  
      	 	$insertar_aviso="INSERT INTO avisos (idAviso,idRubro,asunto,descripcion,idRequisitos,idDomicilio)
      	 	VALUES('','".$idRubro."','".$asunto."','".$descripcion."','".$re['idRequisitos']."','".$dom['idDomicilio']."')";
      	 	Consulta($insertar_aviso);
      	 	
      	 	$buscarAviso="SELECT av.idAviso as idAviso 
      	 	              FROM avisos av
      	 	        WHERE av.idRubro='".$idRubro."' 
      	 	        AND av.asunto='".$asunto."'
      	 	        AND av.idRequisitos='".$re['idRequisitos']."'
      	 	        AND av.idDomicilio='".$dom['idDomicilio']."'";
      	 	          
      	 	 $rta3=Consulta($buscarAviso);
      	 	 $av=mysql_fetch_array($rta3);
      	 	 if(!empty($av))
      	 	    {  
      	 	    	$buscarcuit="SELECT emp.cuit  FROM empresas emp
      	 	    	              WHERE emp.idUsuario='".$idUs."'";
      	 	    	    	 	    	              
      	 	    	$rta3=Consulta($buscarcuit);
      	 	    	$cu=mysql_fetch_array($rta3);
      	 	    	if(!empty($cu))
      	 	    	  {   
      	 	    	  	  $estado=1;
      	 	    	       $fecha=date('d/m/Y');
                         $insertarAvisoEmpresa="INSERT INTO avisosempresas (idAviso,cuitEmpresa,fechaPublicacion,estado)
                            VALUES('".$av['idAviso']."','".$cu['cuit']."','".$fecha."','".$estado."')";
                            Consulta($insertarAvisoEmpresa);
                            
      	 	    	  }          
      	 	    }          
      	 }           
      }                                 

}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Publicar Avisos</title>
	<meta charset="UTF-8">
	<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
</head>
<body style="background-color:#eee" >
<center><h1 style="color:#337ab7;">Aviso:</h1></center>
<form action="" method="POST">
<center>
<div style="width:750px;text-align:left;color:#337ab7;">
	<div class="form-group">
		<label class="control-label">Rubro:</label>
		<select id="rubro" class="form-control" name="idRubro">
		<?php
          echo "<option".'>'.""."</option>";
          while($ru=mysql_fetch_array($rubros))
         {
         	$sel='';
           echo "<option ".$sel." value='".$ru['idRubro']."'>".utf8_encode($ru['descripcion'])."</option>";
         }      
		?>
		</select>
	</div>
	<div class="form-group">
    <label>Asunto:</label>
    <input type="text" name="asunto" class="form-control">
  </div>
  <div>
  <label>Descripción:</label>
  <textarea name="descripcion" class="form-control"></textarea>
  </div>

  <center><h3>Requisitos:</h3></center>
  <div>
	<div class="form-group">
    <label>Edad:</label>
    <input type="text" name="edad" class="form-control">
  </div> 
 <div class="form-group">
		<label class="control-label">Nivel de Estudio:</label>
		<select id="nivelEstudio" class="form-control" name="idEstudio">
		 <?php
		  echo "<option".'>'.""."</option>";
		     while($ni=mysql_fetch_array($estudios))
             { $sel='';
               echo "<option ".$sel." value='".$ni['idNivelDeEstudio']."'>".utf8_encode($ni['descripcion'])."</option>";
             }
			?>
	    </select>
	</div>			
   <div class="form-group">
		<label class="control-label">Tipo de trabajo:</label>
		<select id="tipoTrabajo" class="form-control" name="idTipoTrabajo">
			<?php
			 echo "<option".'>'.""."</option>";
			 while($tip=mysql_fetch_array($tipos))
             { $sel='';
               echo "<option ".$sel." value='".$tip['idTipoTrabajo']."'>".utf8_encode($tip['descripcion'])."</option>";
             }
			?>
		</select>
	</div>
<div class="form-group">
    <label>Experiencia Laboral:</label>
   <input type="text" name="experiencia" class="form-control" placeholder="0..1,2,..años">
  </div>
<div class="form-group">
		<label class="control-label">Sexo:</label>
		<select id="sexo" class="form-control" name="idSexo">
		  <?php
		    echo "<option".'>'.""."</option>";
		   while ($se=mysql_fetch_array($sexo))
          {
          	$sel='';
               echo "<option ".$sel." value='".$se['idSexo']."'>".utf8_encode($se['descripcion'])."</option>";
          }
		  ?>
		</select>
	</div>		
   <div class="form-group">
		<label class="control-label">Idioma requerido:</label>
		<select id="idiomas" class="form-control" name="idIdioma">
		  <?php
		  echo "<option".'>'.""."</option>";
		  while ($idi=mysql_fetch_array($idiomas))
          {
          	$sel='';
               echo "<option ".$sel." value='".$idi['idIdioma']."'>".utf8_encode($idi['descripcion'])."</option>";
          }
		  ?>
		</select>
	</div>	
	<center><div>
	<input type="submit" value="Publicar" style="width:150px" class="btn btn-success" ></input>
    </div>
    </center>
</div>
</center>
</form>
</br>
<center><h3>Lista de Avisos:</h3></center>
<div>
<form action="EditarAvisosEmpresas.php" method="POST">
<div class="form-group">
		<select  class="form-control" name="listaAvisos">
		  <?php
		  $buscarAv="SELECT av.asunto as asunto,
		                  av.idAviso as idAviso,
		                 av.descripcion as desAviso,
                        es.descripcion as estado,
                         ave.fechaPublicacion as fecha
		                 FROM empresas emp
		                 INNER JOIN avisosempresas ave ON emp.cuit=ave.cuitEmpresa
		                 INNER JOIN avisos av ON ave.idAviso=av.idAviso
		                 INNER JOIN estados es ON ave.estado=es.idEstado
		               WHERE emp.idUsuario='".$idUs."'";
		   @$rta6=Consulta($buscarAv);            
		  while ($avi=mysql_fetch_array($rta6))
          { 
          	$sel='';
        echo "<option ".$sel." value='".$avi['idAviso']."'>".utf8_encode($avi['asunto']).'|'." ".utf8_encode($avi['desAviso'])."| ".utf8_encode($avi['fecha'])."| Estado:".utf8_encode($avi['estado'])."</option>";
          }
		  ?>
		</select>
</div>
</br></br>
<center><button type="submit" style="width:150px" name="boton1" value="1" class="btn btn-warning">Modificar</button>
<button type="submit" name="boton1" style="width:150px" value="2" class="btn btn-danger">Eliminar</button></center>
</form>
</div>
</body>
</html>