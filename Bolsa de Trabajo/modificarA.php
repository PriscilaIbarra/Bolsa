 <?php
include_once"funciones.php";
if(!empty($_POST) AND !empty($_POST['aviso']) AND !empty($_POST['comentario']) AND !empty($_POST['calificacion']))
        {      $cal=trim($_POST['calificacion']);
               $com=trim($_POST['comentario']);
             $actualizar="UPDATE avisosfavoritos av SET av.calificacion='".$cal."',
                                                         av.comentarios='".$com."'";
             Consulta($actualizar);
             header("Location:AvisosFavoritos.php");                 
        }
 ?>

 