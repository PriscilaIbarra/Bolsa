<?php
include_once"funciones.php";
session_start();//incluir el session_start en todas las paginas q se usen en la parte privada.
$idUsuario=$_SESSION['usuario']['id'];
$buscartipoUsuario="SELECT us.tipoUsuario FROM usuarios us 
                           WHERE us.id='".$idUsuario."'";
$resultado=consultaSql($buscartipoUsuario);

if(count($resultado))
{  
  if($resultado['tipoUsuario']=="1")
  {
    header("Location:panelEmpresa.php");
  }
  else{
         header("Location:panelAspirante.php");
      }
}
   
?>
