<?php
include_once"funciones.php";
if(!empty($_POST['usuBorrar']))
{

  $idUsu=trim($_POST['usuBorrar']);
  $borrar="DELETE FROM usuarios  WHERE id = '".$idUsu."'";
  $buscar="SELECT * FROM aspirantes a WHERE a.idUsuario='".$idUsu."' ";
  $resultados=Consulta($buscar);
  $c=mysql_fetch_assoc($resultados);
  $dni=$c['dni'];
  $idDomicilio=$c['idDomicilio'];
  echo "$borrar";
  $borrar1="DELETE FROM avisoaspirante  WHERE dni='".$dni."' ";
  $borrar2="DELETE FROM domicilio  WHERE idDomicilio='".$idDomicilio."' ";
   
  Consulta($borrar1);
  Consulta($borrar2); 
  Consulta($borrar);
      
  header("Location:paginaprincipal.php");
}
?>