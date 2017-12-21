<?php
include_once"funciones.php";
session_start();
var_dump($_POST);
 if(!empty($_POST['idEstado']) AND !empty($_POST['idRubro']) AND !empty($_POST['asunto']) AND !empty($_POST['descripcion']) AND !empty($_POST['edad']) AND !empty($_POST['idEstudio']) AND !empty($_POST['idTipoTrabajo']) AND !empty($_POST['experiencia']) AND !empty($_POST['idSexo'])  AND !empty($_POST['idIdioma']) AND !empty($_POST['idAviso']))
     {
         $idEstado=utf8_encode(trim($_POST['idEstado']));
         $idRubro=utf8_encode(trim($_POST['idRubro']));
         $asunto=utf8_encode(trim($_POST['asunto']));
         $descripcion=utf8_encode(trim($_POST['descripcion']));
         $edad=utf8_encode(trim($_POST['edad']));
         $idEstudio=utf8_encode(trim($_POST['idEstudio']));
         $idTipoTrabajo=utf8_encode(trim($_POST['idTipoTrabajo']));
         $experiencia=utf8_encode(trim($_POST['experiencia']));
         $idSexo=utf8_encode(trim($_POST['idSexo']));
         $idIdioma=utf8_encode(trim($_POST['idIdioma']));
          
         $idAviso=trim($_POST['idAviso']); 
        
        $actualizar_avisosEmpresas="UPDATE avisosempresas av
                                   SET av.estado='".$idEstado."'
                                   WHERE av.idAviso='".$idAviso."'";
        Consulta($actualizar_avisosEmpresas);
        
  $buscarIdRequisito="SELECT av.idRequisitos as idRequisitos 
                     FROM avisos av 
                     WHERE av.idAviso='".$idAviso."'";                           
       $req=Consulta($buscarIdRequisito);
       $re=mysql_fetch_array($req);
       if(!empty($re))
       {    
           $r=$re['idRequisitos'];     
       	   $actualizar_requisito="UPDATE requisitos re 
       	                           SET re.idSexo='".$idSexo."',
       	                           re.edad='".$edad."',
       	                           re.idNivelDeEstudio='".$idEstudio."',
       	                           re.idTipoTrabajo='".$idTipoTrabajo."',
       	                           re.experienciaLaboral='".$experiencia."',
       	                           re.idIdioma='".$idIdioma."'
                                   WHERE re.idRequisitos='".$r."'
       	                           ";
       	   Consulta($actualizar_requisito);

       	   $actualizar_aviso="UPDATE avisos ave 
       	                            SET ave.idRubro='".$idRubro."',
                                     ave.asunto='".$asunto."',
                                     ave.descripcion='".$descripcion."'
                                     WHERE ave.idAviso='".$idAviso."' 
       	                            ";
       	    Consulta($actualizar_aviso);     
           header("Location:PublicarAvisos.php");                   
       	                           
       }
     }
?>