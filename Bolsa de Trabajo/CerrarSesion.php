<?php

include_once"funciones.php";
session_start();
$idUs=$_SESSION['usuario']['id'];
if(session_destroy()==true)
{
 header("Location:index.php");
}
else{ echo "No pudo destruirse la session";}
?>