<?php
include_once"funciones.php";
include_once"funciones_validar.php";
@$pass = trim($_GET['pass']);//en el get van los nombre de los id no los name ,tiene q ir lo mismo q paso en ajax
@$passc=trim($_GET['pacon']);
echo valida3($pass,$passc);
?>