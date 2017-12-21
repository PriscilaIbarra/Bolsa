<?php
function valida1($usuario)
{
  $sql_buscar="SELECT nomUsuario FROM usuarios u WHERE u.nomUsuario='".$usuario."' LIMIT 1";
  if(mysql_num_rows (Consulta($sql_buscar))>0)
  {  $rta="encontrado";
     return $rta;
  }

}

function valida2($email)
{
	$sql_buscar="SELECT email FROM usuarios u WHERE u.email='".$email."' LIMIT 1";
    if(mysql_num_rows (Consulta($sql_buscar))>0)
  {  $rta="encontrado";
     return $rta;
  } 

}

function valida3($pass,$passc)
{ 
	if(strcmp($pass,$passc)==0)
	{
		$rta="correcto";
        return $rta;
	}

}  
?>