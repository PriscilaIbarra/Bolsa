<?php
include_once"funciones.php";

if(!empty($_POST['buscador']))
{
  $_POST['buscador'] .= ",";
$busqueda=explode(',',$_POST['buscador']);
@$rubro=trim($busqueda[0]);
@$descripcion=trim($busqueda[1]);
@$ciudad=trim($busqueda[2]);
$por='%';
$descripcion=$por.$descripcion.$por;
$buscar="SELECT ru.descripcion as rubro,av.asunto as asunto,av.descripcion as descripcion, se.descripcion as sexo,emp.razonSocial as nombre,emp.tel as tel,us.email as email,pro.nombre as provincia,ci.nombre as ciudad, ca.nombre as calle,do.nro as nro FROM rubros ru 
                INNER JOIN avisos av ON av.idRubro=ru.idRubro
                INNER JOIN domicilio do ON av.idDomicilio=do.idDomicilio 
                INNER JOIN ciudades ci ON do.idCiudad=ci.idCiudad 
                INNER JOIN provincias pro ON ci.idProvincia= pro.idProvincia
                INNER JOIN calles ca ON do.idCalle=ca.idCalle 
                INNER JOIN requisitos re ON re.idRequisitos=av.idRequisitos  
                INNER JOIN sexo se ON re.idSexo=se.idSexo
                INNER JOIN avisosempresas ave ON av.idAviso= ave.idAviso
                INNER JOIN empresas emp ON emp.cuit=ave.cuitEmpresa
                INNER JOIN usuarios us ON us.id=emp.idUsuario
                WHERE 
                ru.descripcion ='".$rubro."'
                AND
                (ci.nombre ='".$ciudad."' 
                OR   av.asunto like '".$descripcion."'
                OR  av.descripcion like '".$descripcion."')";
   
 $resultado=consultaSql($buscar);
 
 
 if($resultado==0)
 {
 	    ?>    <html>
 	          <head>
	          <meta charset="UTF-8">
              </head>
 	          <body>
 	          <style type="text/css">
 	           html{  background: url(imagenes/paginaprincipal/5.jpg) no-repeat      center center fixed;
                    -webkit-background-size: cover;
                    -moz-background-size: cover;
                    -o-background-size: cover;
                    background-size: cover;
                    }
 	          </style>
 	          <center>
 	          </br></br></br></br></br></br></br></br></br></br></br></br></br></br>
 	          <div style="background-color:#d9534f;width:550px;position:center">
 	           <div class="alert" style="color:white;font-size:40px">
                <strong>&nbsp;&nbsp;&nbsp;&nbsp;SIN RESULTADOS&nbsp;&nbsp;&nbsp;
                </strong>
                <span class="closebtn" onclick="this.parentElement.style.display='none';"><a href="paginaprincipal.php"style="font-size:50px;color:white;text-decoration:none;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ×</a></span>
                </div>
               </div> 
              </center> 
              </body>
 	    </html>
        <?php 
  } 
  else
  	{  ?>
       <!DOCTYPE html>
       <html>
       <head>
       	<meta charset="UTF-8">
       	<link rel="stylesheet" href="css/bootstrap.min.css"> 	
       </head>
       <body>
        <table class="table table-hover">  
       <tr class="success">  
       <th>Rubro: </th>
       <th>Asunto:</th>  
       <th>Descripción:</th>
       <th>Requisitos-Sexo: </th>
       <th>Empresa: </th>
       <th>Telefono: </th>
       <th>Email: </th>
       <th>Provincia: </th>
       <th>Ciudad: </th> 
       <th>Calle: </th>
       <th>Nro:</th>
       </tr>
       <?php 
       foreach ($resultado as $clave => $valor)
  	   {
  	   	$va=utf8_encode($valor);  
        echo "<td>$va</td>"; 
  	   }
       ?>
       </table>
       </body>
       </html
       <?php 
       	  
  	  
  	 
    }

}         

?>




 