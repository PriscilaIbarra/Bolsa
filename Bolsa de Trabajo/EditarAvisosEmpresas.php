<?php
include_once"PanelSuperiorEmpresa.php";
include_once"funciones.php";
session_start();
$idUs=$_SESSION['usuario']['id'];
$_POST['listaAvisos'];
if(!empty($_POST['listaAvisos']))
{
	$idAviso=utf8_encode(trim($_POST['listaAvisos']));
    $boton=utf8_encode(trim($_POST['boton1']));
    if($boton==2)
    {
       $borrar1="DELETE FROM avisosempresas WHERE idAviso='".$idAviso."'";
       Consulta($borrar1);
       $buscarIdRequisito="SELECT av.idRequisitos FROM avisos av WHERE av.idAviso='".$idAviso."'";
       $rta=Consulta($buscarIdRequisito);
       $re=mysql_fetch_array($rta);
       if(!empty($re))
       {  
       	   $req=$re['idRequisitos']; 
           $borrar2="DELETE FROM avisos WHERE idAviso='".$idAviso."'";
           Consulta($borrar2);
           $borrar3="DELETE FROM requisitos WHERE idRequisitos='".$req."'";
           Consulta($borrar3);
       }
      header("Location:PublicarAvisos.php");   
    
    }
    else
   { 
   	    
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
     $buscar7="SELECT * FROM estados";
     $estados=Consulta($buscar7); 
    
    ?>
    <!DOCTYPE html>
    <html>
    <head>
	<title>Publicar Avisos</title>
	<meta charset="UTF-8">
	<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
</head>
<body >
<center><h1 style="color:#337ab7;">Aviso:</h1></center>
<form action="modificarAvisoEmpresa.php" method="POST">
<center>
<?php
$buscarDatos="SELECT es.idEstado as idEstado,
                     es.descripcion as estado,
                     ru.idRubro as idRubro,
                     ru.descripcion as rubro,
                     a.asunto as asunto,
                     a.descripcion as descripcion,
                     re.edad as edad,
                     ni.idNivelDeEstudio as idNivelDeEstudio,
                     ni.descripcion as nivelEstudio,
                     t.idTipoTrabajo as idTipoTrabajo,
                     t.descripcion as tipTrabajos,
                     re.experienciaLaboral as experiencia,
                     se.idSexo as idSexo,
                     se.descripcion as sexo,
                     i.idIdioma as idIdioma,
                     i.descripcion as idioma
                       FROM empresas emp 
                       INNER JOIN avisosempresas aemp ON emp.cuit=aemp.cuitEmpresa
                       INNER JOIN estados es ON aemp.estado=es.idEstado
                       INNER JOIN avisos a ON aemp.idAviso=a.idAviso
                       INNER JOIN rubros ru ON a.idRubro=ru.idRubro
                       INNER JOIN requisitos re ON re.idRequisitos=a.idRequisitos
                       INNER JOIN sexo se ON se.idSexo=re.idSexo
          INNER JOIN niveldeestudios ni ON ni.idNivelDeEstudio=re.idNivelDeEstudio
          INNER JOIN tiposdetrabajos  t ON t.idTipoTrabajo=re.idTipoTrabajo
          INNER JOIN idiomas i ON i.idIdioma=re.idIdioma
          WHERE emp.idUsuario='".$idUs."'";
 @$busc=Consulta($buscarDatos);
 @$busq=mysql_fetch_array($busc);

?>
<div style="width:750px;text-align:left;color:#337ab7;">
  <div class="form-group">
   <label class="control-label">Estado del Aviso:</label>
		<select  class="form-control" name="idEstado">
		<?php
         $sel='';
echo "<option ".$sel." value='".$busq['idEstado']."'>".utf8_encode($busq['estado'])."</option>";
          while($es=mysql_fetch_array($estados))
         {
         	$sel='';
           echo "<option ".$sel." value='".$es['idEstado']."'>".utf8_encode($es['descripcion'])."</option>";
         }      
		?>
		</select>
	</div>	
	<div class="form-group">
		<label class="control-label">Rubro:</label>
		<select id="rubro" class="form-control" name="idRubro">
		<?php
          $sel='';
           echo "<option ".$sel." value='".$busq['idRubro']."'>".utf8_encode($busq['rubro'])."</option>";
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
    <input type="text" name="asunto" value="<?php echo $busq['asunto'];?>"class="form-control">
  </div>
  <div>
  <label>Descripción:</label>
  <textarea name="descripcion" class="form-control"><?php echo $busq['descripcion'];?></textarea>
  </div>
  <center><h3>Requisitos:</h3></center>
  <div>
	<div class="form-group">
    <label>Edad:</label>
    <input type="text" name="edad" value="<?php echo $busq['edad'];?>" class="form-control">
  </div> 
 <div class="form-group">
		<label class="control-label">Nivel de Estudio:</label>
		<select id="nivelEstudio" class="form-control" name="idEstudio">
		 <?php
		  $sel='';
               echo "<option ".$sel." value='".$busq['idNivelDeEstudio']."'>".utf8_encode($busq['nivelEstudio'])."</option>";
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
			  $sel='';
               echo "<option ".$sel." value='".$busq['idTipoTrabajo']."'>".utf8_encode($busq['tipTrabajos'])."</option>";
			 while($tip=mysql_fetch_array($tipos))
             { $sel='';
               echo "<option ".$sel." value='".$tip['idTipoTrabajo']."'>".utf8_encode($tip['descripcion'])."</option>";
             }
			?>
		</select>
	</div>
<div class="form-group">
    <label>Experiencia Laboral:</label>
   <input type="text" name="experiencia" value="<?php echo $busq['experiencia'];?>" class="form-control" placeholder="0..1,2,..años">
  </div>
<div class="form-group">
		<label class="control-label">Sexo:</label>
		<select id="sexo" class="form-control" name="idSexo">
		  <?php
		   $sel='';
               echo "<option ".$sel." value='".$busq['idSexo']."'>".utf8_encode($busq['sexo'])."</option>"; 
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
		  $sel='';
               echo "<option ".$sel." value='".$busq['idIdioma']."'>".utf8_encode($busq['idioma'])."</option>";
		  while ($idi=mysql_fetch_array($idiomas))
          {
          	$sel='';
               echo "<option ".$sel." value='".$idi['idIdioma']."'>".utf8_encode($idi['descripcion'])."</option>";
          }
		  ?>
		</select>
	</div>	
  <input type="text" hidden name="idAviso" value="<?php echo $_POST['listaAvisos'];?>">
	<center><div>
<input type="submit" value="Actualizar" style="width:150px" class="btn btn-success" ></input>
    </div>
    </center>
</div>
</center>
</form>
</body>
</html>
    <?php
  }
}
?>