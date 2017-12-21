<?php
include_once"funciones.php";
session_start();
$idU=$_SESSION['usuario']['id'];
$buscar="SELECT emp.idUsuario FROM empresas emp WHERE emp.idUsuario='".$idU."'";
 $rta=Consulta($buscar);
 $emp=mysql_fetch_array($rta);
 
  if(empty($emp))
 {
      if( !empty($_POST['razon']) AND !empty($_POST['cuit']) AND !empty($_POST['tel']) AND !empty($_POST['descripcion']) AND !empty($_POST['ciudad']) AND !empty($_POST['calle']) AND !empty($_POST['nro']) AND !empty($_FILES))
      {
        $razon=trim($_POST['razon']);
        $cuit=trim($_POST['cuit']);
        $tel=trim($_POST['tel']);
        $descripcion=trim($_POST['descripcion']);
        $ciudad=trim($_POST['ciudad']);
        $calle=trim($_POST['calle']);
        $nro=trim($_POST['nro']);
     
      $nombrefoto = "fotos/".date('Y-m-dHis')."_".rand(123,123123);
      if(preg_match("/png/i", $_FILES['foto']['type']) > 0){
        $ext = ".png";
      }
      if(preg_match("/jpg/i", $_FILES['foto']['type']) > 0){
        $ext = ".jpg";
      }
      if(preg_match("/jpeg/i", $_FILES['foto']['type']) > 0){
        $ext = ".jpeg";
      }
      
      if(preg_match("/gif/i", $_FILES['foto']['type']) > 0){
        $ext = ".gif";
      }
      //guardar la imagen a la carpeta foto
      move_uploaded_file($_FILES['foto']['tmp_name'], $nombrefoto.$ext);

        $sql_insertar="INSERT INTO domicilio (idDomicilio,idCalle,nro,idCiudad)
                      VALUES('','".$calle."','".$nro."','".$ciudad."')
                      ";
    Consulta($sql_insertar);
    $bus="SELECT do.idDomicilio FROM domicilio do WHERE do.idCalle='".$calle."' AND do.idCiudad='".$ciudad."' AND do.nro='".$nro."'";
     $Do=mysql_fetch_array(Consulta($bus));    
     $idDo=$Do['idDomicilio']; 
     if(!empty($Do))
     {
       $perfil_empresa="INSERT INTO empresas(idUsuario,razonSocial,cuit,descripcion,idDomicilio,tel,fotoPerfil)
                           VALUES ('".$idU."','".$razon."','".$cuit."',
                           '".$descripcion."','".$idDo."','".$tel."',
                            '".$nombrefoto.$ext."')";
    
       Consulta($perfil_empresa);
       header("Location:panelEmpresa.php");
     }

     }
   }

     else
     {
        if( !empty($_POST['razon']) AND !empty($_POST['cuit']) AND !empty($_POST['tel']) AND !empty($_POST['descripcion']) AND !empty($_POST['ciudad']) AND !empty($_POST['calle']) AND !empty($_POST['nro']) AND !empty($_FILES))
      {
        $razon=trim($_POST['razon']);
        $cuit=trim($_POST['cuit']);
        $tel=trim($_POST['tel']);
        $descripcion=trim($_POST['descripcion']);
        $ciudad=trim($_POST['ciudad']);
        $calle=trim($_POST['calle']);
        $nro=trim($_POST['nro']);
      
        $ext = ".jpeg";
      $nombrefoto = "fotos/".date('Y-m-dHis')."_".rand(123,123123);
      if(preg_match("/png/i", $_FILES['foto']['type']) > 0){
        $ext = ".png";
      }
      if(preg_match("/jpg/i", $_FILES['foto']['type']) > 0){
        $ext = ".jpg";
      }
      if(preg_match("/jpeg/i", $_FILES['foto']['type']) > 0){
        $ext = ".jpeg";
      }
      
      if(preg_match("/gif/i", $_FILES['foto']['type']) > 0){
        $ext = ".gif";
      }
      //guardar la imagen a la carpeta foto
      move_uploaded_file($_FILES['foto']['tmp_name'], $nombrefoto.$ext);
    
      $bus="SELECT do.idDomicilio FROM domicilio do INNER JOIN empresas emp ON do.idDomicilio=emp.idDomicilio WHERE emp.idUsuario='".$idU."'";
     $Do=mysql_fetch_array(Consulta($bus)); 
    
     $idDo=$Do['idDomicilio'];
        if(!empty($Do))
      {  

         $sql_actualizar="UPDATE  domicilio do SET 
                                          do.idCalle='".$calle."',
                                          do.nro='".$nro."',
                                          do.idCiudad='".$ciudad."'
                                          WHERE do.idDomicilio='".$idDo."'";
         
         Consulta($sql_actualizar);
      
         $act_empresa="UPDATE empresas emp SET emp.razonSocial='".$razon."',
                                           emp.cuit='".$cuit."',
                                           emp.descripcion='".$descripcion."',
                                           emp.tel='".$tel."',
                                           emp.fotoPerfil='".$nombrefoto.$ext."'
                                           WHERE emp.idUsuario='".$idU."'";
       
        Consulta($act_empresa);
        header("Location:panelEmpresa.php");                               
      }

       }
     }
?>