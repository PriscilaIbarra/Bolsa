<?php
include_once"funciones.php";
include_once"funciones_validar.php";
@$email = trim($_POST['email']);
echo valida2(@$email);
?>