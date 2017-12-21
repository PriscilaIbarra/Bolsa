<?php
include_once"funciones.php";
include_once"funciones_validar.php";
@$usuario = trim($_POST['usuario']);
echo valida1(@$usuario);
?>