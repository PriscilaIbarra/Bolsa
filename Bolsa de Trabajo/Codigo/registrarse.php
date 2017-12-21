<?php
include_once"funciones.php";
if(!empty($_GET) AND !empty($_GET['usuario']) AND !empty($_GET['pass']) AND !empty($_GET['email']) AND !empty($_GET['tipoUsuario']) AND !empty($_GET['passc']))
{ 
           $pass1=trim($_GET['pass']);
           $pass=md5(sha1($pass1));  
           $pass2=trim($_GET['passc']);
           $passcon=md5(sha1($pass2));       
           $nomUsuario=trim($_GET['usuario']);
           $email=trim($_GET['email']);  
           $tipoUsu=trim($_GET['tipoUsuario']);
           $sql_insertar="INSERT INTO usuarios (id,nomUsuario,email,password,tipoUsuario)
                           VALUES ('','".$nomUsuario."','".$email."','".$pass."','".$tipoUsu."')";
           Consulta($sql_insertar);


$asunto="GRACIAS POR REGISTRARSE EN EMPLEOS.COM";
  $cuerpo="
        <html>
        <head>
          <title>Registro</title>
          
        </head>
        <body>
          <h1>Bienvenido!!!<h1>
          <p>Datos de registro:</p>
          <p>Usuario: ".$nomUsuario."</p>
          <p>mail: ".$email." </p>
                                        <p>ingresa: http://empleos.esy.es/ </p>
        </body>
        </html>
        ";
        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  if (mail($email, $asunto, $cuerpo, $cabeceras) ){
    ?><div id="navbar" class="navbar-collapse collapse" style="background-color:#0080FF">
        <div class="alert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';"><a href="login.php">X</a></span>
                <strong><center>Email de Bienvenida Enviado!</strong>
                </div>
                
        </div>
   <?php
    
  }else{
         ?><div id="navbar" class="navbar-collapse collapse" style="background-color: #0080FF">
        <div class="alert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';"><a href="paginaprincipal.php">X</a></span>
                <strong><center>Ha ocurrido un erro intentelo más tarde!!</strong>
                </div>
                
        </div>
           <?php 
        }
           
      
}


?>

<!DOCTYPE html> 
<html lang="en">
<head>  <title>Empleos.com/registrarse</title> 
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" href="registrarse.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
            
</head>
<body style="background-color:#1da1f2">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script> 

<center>
<h1 style="color: white"><strong>Registrarse</strong></h1>
<form id="f1"  action="" method="GET" >
</br>
Usuario: <br/>
<input type="text" name="usuario" id="usuario" class="form-control" required >
<br/>
Email: <br/>
    <input type="text" name="email" id="email" class="form-control" required>
<br/>
Contraseña:<br/>
<input type="password" name="pass" id="pass" class="form-control" required >
<br/>
Confirmar Contraseña:<br/>
<input type="password" name="passc" id="pacon"class="form-control" required>
<br/>
Tipo de usuario:
<select name="tipoUsuario" size="1" required>
        <option value="1"><strong>Empresa  </strong></option>
        <option value="2"><strong>Aspirante</strong></option>
</select>
<br/><br/>
<center>
<input type="submit" class="btn btn-success" style="font-size:19px"value="Registrar">  
</br>
</br>
</form>
</center>



<script type="text/javascript">
$( document ).ready(function() {

  
    $( "#usuario" ).keyup(function() {
      
      valorUsuario = $(this).val();
    
      if(valorUsuario.length >=1){
         $.ajax({
                type: "GET",
                url: "valida.php",
                data:  {
                       'usuario' : valorUsuario
                       },
                dataType: "text",
                success: function(msg){
                                      if (msg == "encontrado"){
                      $( "#usuario" ).css("color","red");
                      $( "#Registrar" ).prop( "disabled", true );
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
                type: "GET",
                url : "valida2.php",
                data:  {
                       'email' : valorEmail
                       },
                dataType: "text",
                success: function(msg){
                                      if (msg == "encontrado"){
                      $( "#email" ).css("color","red");
                      $( "#Registrar" ).prop( "disabled", true );
                    }else{
                      $( "#email" ).css("color","green");
                         }
                                       }
            });
                              }
      
   });
});
</script>

<script type="text/javascript">

$( document ).ready(function() {

  
    $( "#pacon" ).keyup(function() {
      
      valorPassc = $(this).val();
      valor1 =  $("#pass").val();
    
      if(valorPassc.length >=1){
         $.ajax({
                type: "GET",
                url : "valida3.php",
                data:  {
                       'pacon' : valorPassc,
                       'pass':valor1 
                       },
                dataType: "text",
                success: function(msg){
                                      if (msg == "correcto"){
                                      $( "#pacon" ).css("color","green");
                                      }else{
                                           $( "#pacon" ).css("color","red");
                                           $( "#Registrar" ).prop( "disabled", true );
                                          }
                                      }
            });
                              }
      
   });
});
</script>



</body>
</html>