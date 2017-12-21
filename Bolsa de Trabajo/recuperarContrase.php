<?php
include_once"funciones.php";
$nuevaCont=rand(1020,4589);
if(!empty($_POST['us']))
{   $usuario=utf8_encode(trim($_POST['us']));
	$pass=utf8_encode(trim($nuevaCont));
	$newpass=md5(sha1($pass));
	$recuperaClave="UPDATE usuarios us SET us.password='".$newpass."' 
	           WHERE us.nomUsuario='".$usuario."' OR us.email='".$usuario."'";
	if(Consulta($recuperaClave))
	{
		
         $b="SELECT us.email FROM usuarios us WHERE us.nomUsuario='".$usuario."' OR us.email='".$usuario."'";

         $mai=Consulta($b);
         $mail=mysql_fetch_array($mai);
         $email=$mail['email'];
         $asunto="Recuperar Contraseña";
  $cuerpo="
        <html>
        <head>
          <title>Registro</title>
          
        </head>
        <body>
          <h1>Nuevos Datos:<h1>
          <p>Datos de registro:</p>
          <p>mail: ".$email." </p>
          <p>pass: ".$nuevaCont."</p> <p>ingresa: http://empleos.esy.es/ </p>
        </body>
        </html>
        ";
        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
         mail($email, $asunto, $cuerpo, $cabeceras);

		?><body style="background-color:#1da1f2;"><div class="alert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';"><a href="login.php">×</a></span>
                <strong><center>Se le ha enviado un mail para recuperar su password,revise su casilla por favor!</strong>
                </div>
                </body> 
           <?php       
	}           
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Recuperar Contraseña</title>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="Stylesheet" href="login.css">
<style>
.alert {
    padding: 20px;
    background-color: #f44336;
    color: white;
       }

.closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
}

.closebtn:hover {
    color: black;
}


</style>
</head>
<body>

<form id="f2" action="" method="POST">
</br>
<center>
<label id="titulo">Ingrese su nombre de Usuario o email</label>
</br></br>
<input type ="text" name="us" placeholder="Correo o usuario" class="btn" >
</br></br>
<input type="submit" value="Recuperar Contraseña" class="btn btn-success">
</br></br>
<a href="registrarse.php" style="color:white">&nbsp;Registrarse &nbsp;</a>
<a href="" style="color: white">¿Olvidaste tu contraseña?</a>
</form>


</body>
</html>