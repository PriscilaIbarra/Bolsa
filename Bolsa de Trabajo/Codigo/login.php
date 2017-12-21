<?php
include_once "funciones.php";

if(!empty($_POST['us']) AND !empty($_POST['pass']))
{
  $usuario=trim($_POST['us']);
  $pass=md5(sha1(trim($_POST['pass'])));
  if(filter_var($usuario,FILTER_VALIDATE_EMAIL) OR (strlen($usuario)<=30))
  { $buscar="SELECT id FROM usuarios us WHERE (us.email='".$usuario."' AND us.password='".$pass."') OR (us.nomUsuario='".$usuario."' AND us.password='".$pass."') LIMIT 1";
     
    $resultado=consultaSql($buscar);
    if(!empty($resultado['id']))
    {
       session_start();
       $_SESSION['usuario_valido']=TRUE;
       $_SESSION['usuario']=$resultado;
       header("Location:privado.php");
    }
    else{           /*?> y<?php se usan para embeber codigo html*/ 
          ?>   <body style="background-color: #1da1f2;"><div class="alert">
                <span class="closebtn" onclick="this.parentElement.style.display='none';"><a href="login.php">×</a></span>
                <strong><center>Usuario o Contraseña  incorrectos!</strong>
                </div>
                </body> 
           <?php             
         
         }
    }
  
}


?>


<!DOCTYPE html>
<html>
<head>
<title>Empleo.com/Ingresar</title>
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
<label id="titulo">Ingresar</label>
</br></br>
<input type ="text" name="us" placeholder="Correo o usuario" class="btn" >
</br></br>
<input type ="password" name="pass" placeholder="Contraseña" class="btn">
</br></br>
<input type="submit" value="Iniciar Sesión" class="btn btn-success">
</br></br>
<a href="registrarse.php" style="color:white">&nbsp;Registrarse &nbsp;</a>
<a href="recuperarContrase.php" style="color: white">¿Olvidaste tu contraseña?</a>
</form>


</body>
</html>