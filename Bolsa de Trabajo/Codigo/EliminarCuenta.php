<?php
include"PanelSuperior.php";
include_once"funciones.php";
session_start();
$idUs=$_SESSION['usuario']['id'];

session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Eliminar Cuenta</title>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
    <link type="text/css" rel="stylesheet" href="css/bootstrap-datepicker.css"/>
</head>
<body style="background-color: #eee">
<div class="container" style="background-color: #eee">
<form  name="formulario" action="Baja.php" method="POST" >
</br>
<h1 class="text-center">Eliminar Cuenta:</h1>
<center>
</br></br>
  <div class="form-group">
     <h2>Está seguro que desea eliminar su cuenta? </br>
         ¡Esta acción no puede deshacerse!</h2>
         </br></br>
     
    <label class="control-label" style="font-size: 40px"> SI </label> 
      <input type="checkbox" onclick="document.formulario.enviar.disabled=!document.formulario.enviar.disabled" value="acepto">
      </br></br>
      <input name="usuBorrar" type="hidden" value="<?php echo $idUs; ?>">
      <input style="width:300" type="submit" name="enviar"  value="Eliminar"  disabled class="btn btn-primary"> 
    </div>
</center>
</form>
</div>
</body>
</html>