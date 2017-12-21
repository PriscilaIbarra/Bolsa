<?php
include"PanelSuperior.php";
include_once"funciones.php";
session_start();
$buscar="SELECT * FROM provincias ";
$provincias=Consulta($buscar);
$buscar1="SELECT * FROM ciudades";
$ciudades=Consulta($buscar1);
$buscar2="SELECT * FROM rubros";
$rubros=Consulta($buscar2);
$buscar3="SELECT * FROM avisos";
$avisos=Consulta($buscar3);
$buscar4="SELECT * FROM tiposdetrabajos";
$tipos=Consulta($buscar4);
$buscar5="SELECT * FROM niveldeestudios";
$estudios=Consulta($buscar5);
$buscar6="SELECT * FROM idiomas";
$idiomas=Consulta($buscar6);
$buscar7="SELECT * FROM sexo";
$sexo=Consulta($buscar7);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Busqueda Avanzada</title>
    <meta charset="UTF-8"> 
    <link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
    <link type="text/css" rel="stylesheet" href="css/bootstrap-datepicker.css"/>
</head>
<body style="background-color: #eee">
<div class="container" style="background-color: #eee">
<form action="resultadosBusqueda.php" method="POST">
</br>
<h1 class="text-center">Buscador Avanzado</h1>
<div class="form-group">
		<label class="control-label">Provincia:</label>
		<select id="provincia" class="form-control" name="idProvincia">
		<?php
            echo "<option>"."Seleccionar"."</option>"; 
            while($pro=mysql_fetch_array($provincias))
           { 
            $sel='';
            echo "<option ".$sel." value='".$pro['idProvincia']."'>".$pro['nombre']."</option>";
            }
		?>
	   </select>
	</div>
<div class="form-group">
		<label class="control-label">Ciudad:</label>
		<select id="ciudad" class="form-control" name="idCiudad">
		<?php
         echo "<option>"."Seleccionar"."</option>";
         while($ci=mysql_fetch_array($ciudades))
         {
         	$sel='';
         	echo "<option ".$sel." value='".$ci['idCiudad']."'>".$ci['nombre']."</option>";
         }      
		?>
		</select>
	</div>	
<div class="form-group">
		<label class="control-label">Rubro:</label>
		<select id="rubro" class="form-control" name="idRubro">
		<?php
         echo "<option>"."Seleccionar"."</option>";
         while($ru=mysql_fetch_array($rubros))
         {
         	$sel='';
           echo "<option ".$sel." value='".$ru['idRubro']."'>".utf8_encode($ru['descripcion'])."</option>";
         }      
		?>
		</select>
	</div>

<div class="form-group">
		<label class="control-label">Tipo de trabajo:</label>
		<select id="tipoTrabajo" class="form-control" name="idTipoTrabajo">
			<?php
			echo"<option>"."Seleccionar"."</option>";
             while($tip=mysql_fetch_array($tipos))
             { $sel='';
               echo "<option ".$sel." value='".$tip['idTipoTrabajo']."'>".utf8_encode($tip['descripcion'])."</option>";
             }
			?>
		</select>
	</div>
<div class="form-group">
		<label class="control-label">Nivel de Estudio:</label>
		<select id="nivelEstudio" class="form-control" name="idEstudio">
			<?php
             echo"<option>"."Seleccionar"."</option>";
             while($ni=mysql_fetch_array($estudios))
             { $sel='';
               echo "<option ".$sel." value='".$ni['idNivelDeEstudio']."'>".utf8_encode($ni['descripcion'])."</option>";
             }
			?>
	    </select>
	</div>			

<div class="form-group">
		<label class="control-label">Experiencia Laboral:</label>
		<input id="experienciaLaboral" class="form-control"type="text"  placeholder="1,2,3...(años)  o 0 Sin experiencia" name="expe">
</div>		
<div class="form-group">
		<label class="control-label">Idiomas requeridos:</label>
		<select id="idiomas" class="form-control" name="idIdioma">
		  <?php
		  echo"<option>"."Seleccionar"."</option>";
          while ($idi=mysql_fetch_array($idiomas))
          {
          	$sel='';
               echo "<option ".$sel." value='".$idi['idIdioma']."'>".utf8_encode($idi['descripcion'])."</option>";
          }
		  ?>
		</select>
	</div>	
<div class="form-group">
		<label class="control-label">Edad:</label>
		<input id="edad" class="form-control" name="edad">
</div>	
<div class="form-group">
		<label class="control-label">Sexo:</label>
		<select id="sexo" class="form-control" name="idSexo">
		  <?php
		  echo"<option>"."Seleccionar"."</option>";
          while ($se=mysql_fetch_array($sexo))
          {
          	$sel='';
               echo "<option ".$sel." value='".$se['idSexo']."'>".utf8_encode($se['descripcion'])."</option>";
          }
		  ?>
		</select>
	</div>			
<center>
<input type="submit" value="Buscar" style="width:130px" class="btn btn-primary">
</center>
</form>
</div>
</body>
</html>