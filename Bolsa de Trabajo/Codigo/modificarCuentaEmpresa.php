<?php
include_once"PanelSuperiorEmpresa.php";
include_once"funciones.php";
session_start();

$idUs=$_SESSION['usuario']['id'];
$cons="SELECT * FROM usuarios us WHERE us.id ='".$idUs."'";
$resultado=Consulta($cons);
$c=mysql_fetch_array($resultado);
$nombreAnterior=$c['nomUsuario'];
$emailAnterior=$c['email'];
$passAnterior=$c['password'];

if((!empty($_POST['nombreUsuario'])) AND (!empty($_POST['email'])) AND 
	(!empty($_POST['pass'])) )
{   if(strcmp($passAnterior,$_POST['pass'])==0) 
   {
   	$nusuario=trim($_POST['nombreUsuario']);
    $email=trim($_POST['email']);
    $actualizar= "UPDATE usuarios us SET us.nomUsuario='".$nusuario."',
                                         us.email='".$email."',
                                         us.password='".$passAnterior."'
                                         WHERE us.id='".$idUs."'
                                         ";
    $resActualizar=Consulta($actualizar);
   }
   else{
   	$nusuario=trim($_POST['nombreUsuario']);
    $email=trim($_POST['email']);
    $pass=md5(sha1(trim($_POST['pass'])));

    $actualizar= "UPDATE usuarios us SET us.nomUsuario='".$nusuario."',
                                         us.email='".$email."',
                                         us.password='".$pass."'
                                         WHERE us.id='".$idUs."'
                                         ";
    $resActualizar=Consulta($actualizar);}
    header("Location:modificarCuentaEmpresa.php");
}                                    

?>

<!DOCTYPE html>
<html>
<head>
	<title>Modificar Cuenta</title>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
    <link type="text/css" rel="stylesheet" href="css/bootstrap-datepicker.css"/>
</head>
<body style="background-color: #eee">
<div class="container" style="background-color: #eee">
<form  name="formulario" action=" " method="POST" >
</br>
<h1 class="text-center">Modificar Datos de la Cuenta</h1>
<div class="form-group">
   <label class="control-label">Nombre de Usuario:</label>
   <input type="text" id="usuario" name="nombreUsuario"
    class="form-control" width=300
    value="<?php echo $c['nomUsuario']; ?>">
   </div>
<div class="form-group">
		<label class="control-label">Email:</label>
		<input type="text" name="email" class="form-control" id="email" width=300 
		 value="<?php echo $c['email']; ?>">
</div>

<div class="form-group">
		<label class="control-label">Contraseña:</label>
		<input type="password" name="pass" class="form-control" width=300 value="<?php echo $c['password']; ?>">
</div>

<center>
</br></br>
  <div class="form-group"><label class="control-label">Modificar</label> 
      <input type="checkbox" onclick="document.formulario.enviar.disabled=!document.formulario.enviar.disabled" value="acepto">
      </br></br>
      <input type="submit" name="enviar" id="Guardar" value="Guardar Cambios" disabled  class="btn btn-primary" width=300 > 
    </div>
</center>
</form>
<script type="text/javascript">
$( document ).ready(function() {

  
    $( "#usuario" ).keyup(function() {
      
      valorUsuario = $(this).val();
    
      if(valorUsuario.length >=1){
         $.ajax({
                type: "POST",
                url: "valida5.php",
                data:  {
                       'usuario' : valorUsuario
                       },
                dataType: "text",
                success: function(msg){
                                      if (msg == "encontrado"){
                      $( "#usuario" ).css("color","red");
                      $( "#Guardar" ).prop( "disabled", true );
                    }else{
                      $( "#usuario" ).css("color","green");
                         }
                   }
            });
      }
      
   });
});

</script>


<script type="text/javascript">
$( document ).ready(function() {

  
    $( "#email" ).keyup(function() {
      
      valorEmail = $(this).val();
    
      if(valorEmail.length >=1){
         $.ajax({
                type: "POST",
                url : "valida4.php",
                data:  {
                       'email' : valorEmail
                       },
                dataType: "text",
                success: function(msg){
                                      if (msg == "encontrado"){
                      $( "#email" ).css("color","red");
                      $( "#Guardar" ).prop( "disabled", true );
                    }else{
                      $( "#email" ).css("color","green");
                         }
                                       }
            });
                              }
      
   });
});
</script>
</body>
</html>