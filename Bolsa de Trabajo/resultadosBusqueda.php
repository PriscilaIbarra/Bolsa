<?php
include"PanelSuperior.php";
include_once"funciones.php";


$idProvincia=$_POST['idProvincia'];
$idCiudad=$_POST['idCiudad'];
$idRubro=$_POST['idRubro'];
$idTipoTrabajo=$_POST['idTipoTrabajo'];
$idEstudio=$_POST['idEstudio'];
$expe=trim($_POST['expe']);
$idIdioma=$_POST['idIdioma'];
$edad=trim($_POST['edad']);
$idSexo=$_POST['idSexo'];



$busqueda="SELECT  emp.razonSocial as nombre,
                   emp.tel as tel, 
                   us.email as email,
                   ci.nombre as ciudad,
                   ca.nombre as calle,
                   do.nro as nro, 
                   av.asunto as asunto,
                   av.descripcion as avdescripcion,
                   ru.descripcion as rudescripcion,
                   se.descripcion as sexo,
                   re.experienciaLaboral as experiencia,
                   re.edad as edad,
                   ni.descripcion as estudio,
                   tt.descripcion as tipoTrabajo,
                   id.descripcion as idioma
                   FROM provincias pro
                   INNER JOIN ciudades  ci ON pro.idProvincia=ci.idProvincia
                   INNER JOIN domicilio do ON ci.idCiudad=do.idCiudad
                   INNER JOIN calles ca ON ca.idCalle=do.idCalle
                   INNER JOIN avisos av ON av.idDomicilio=do.idDomicilio
                   INNER JOIN rubros ru ON ru.idRubro=av.idRubro
                   INNER JOIN requisitos re ON av.idRequisitos=re.idRequisitos
                   INNER JOIN sexo se ON re.idSexo= se.idSexo
             INNER JOIN niveldeestudios ni ON re.idNivelDeEstudio=ni.idNivelDeEstudio
             INNER JOIN tiposdetrabajos tt ON re.idTipoTrabajo=tt.idTipoTrabajo 
             INNER JOIN idiomas id ON re.idIdioma=id.idIdioma 
             INNER JOIN avisosempresas ave ON av.idAviso=ave.idAviso
             INNER JOIN empresas emp ON ave.cuitEmpresa=emp.cuit
             INNER JOIN usuarios us ON emp.idUsuario= us.id

             WHERE pro.idProvincia='".$idProvincia."' 
                   AND ci.idCiudad='".$idCiudad."'  
                   AND ru.idRubro='".$idRubro."'
                   AND tt.idTipoTrabajo='".$idTipoTrabajo."' 
                   AND ni.idNivelDeEstudio='".$idEstudio."'
                   AND id.idIdioma='".$idIdioma."'
                   AND se.idSexo='".$idSexo."'
                   AND re.experienciaLaboral >='".$expe."' 
                   AND re.edad >='".$edad."'  ";     
              
$result=Consulta($busqueda);

?>


<!DOCTYPE html>
<html>
<head>
	<title>Resultados de la Busqueda</title>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
    <script type="text/javascript" src="js/jquery.js"></script>	
    <script type="text/javascript" src="js/jquery.tabletoCSV.js"></script>	
    <script type="text/javascript" src="js/tableExport.js"></script>
    <script type="text/javascript" src="js/jquery.base64.js"></script>
    <script type="text/javascript" src="js/jspdf/libs/sprintf.js"></script>
    <script type="text/javascript" src="js/jspdf/jspdf.js"></script>
    <script type="text/javascript" src="js/jspdf/libs/base64.js"></script>

    <script>
        $(function(){
            $("#CSV").click(function(){
                $("#tabla").tableToCSV();
            });
        });
    </script>

<script type="text/javascript">
    	$(document).ready(function(e){
    		$("#XLS").click(function(e){
    			$("#tabla").tableExport({
    				type:'excel',
    				escape:'false'
    			});
    		});
    	});
    </script> 

   <script type="text/javascript">
    	$(document).ready(function(e){
    		$("#XML").click(function(e){
    			$("#tabla").tableExport({
    				type:'xml',
    				escape:'false'
    			});
    		});
    	});
    </script>
    <script type="text/javascript">
    	$(document).ready(function(e){
    		$("#JSON").click(function(e){
    			$("#tabla").tableExport({
    				type:'json',
    				escape:'false'
    			});
    		});
    	});
    </script>
    
</head>
<body>
<div>
        <?php
        echo"<table id="."tabla"." class="."table table-striped".">"; 	
        echo"<thead>";
    echo "<tr style="."background-color:#5cb85c ; color:white;font-size:12px".">";
        echo"<th>Empresa:</th>";
        echo"<th>Telefono:</th>";
        echo"<th>Email:</th>";
        echo"<th>Asunto:</th>";
        echo"<th>Descripción</th>";
        echo"<th>Rubro:</th>";
        echo"<th>Estudios</th>";
        echo"<th>Dedicación</th>"; 
        echo"<th>Sexo:<th>";
        echo"<th>Edad:</th>";
        echo"<th></th>";
        echo"<th>Experiencia Laboral:<th>";
        echo"<th>Idioma</th>";
        echo"</tr >";
        echo "</thead>";
        echo "<tbody>";
        while ($c=mysql_fetch_array($result))
        {  
          echo "<tr style="."font-size:12px"."class="."table table-striped".">";
          echo "<td>".utf8_encode($c['nombre'])."</td>";  
          echo "<td>".utf8_encode($c['tel'])."</td>";  
          echo "<td>".utf8_encode($c['email'])."</td>";
          echo "<td>".utf8_encode($c['asunto'])."</td>";  
          echo "<td>".utf8_encode($c['avdescripcion'])."</td>";  
          echo "<td>".utf8_encode($c['rudescripcion'])."</td>";    
          echo "<td>".utf8_encode($c['estudio'])."</td>";  
          echo "<td>".utf8_encode($c['tipoTrabajo'])."</td>";
          echo "<td>".utf8_encode($c['sexo'])."</td>"; 
          echo"<td></td>";
          echo "<td>".utf8_encode($c['edad'])."</td>";
          echo"<td></td>";
          echo "<td>".utf8_encode($c['experiencia'])."</td>";
          echo"<td></td>";
          echo "<td>".utf8_encode($c['idioma'])."</td>";  
          echo "</tr>";
        }
         echo "</tbody>";  
         echo "</table>"; 
        
       ?>       
   </div>
  </br></br></br></br></br></br></br></br></br></br></br></br>
<center>
   <div>
   	<button id="CSV" class="btn btn-primary" data-export="export">Exportar a CSV</button>
   	<button id="XLS" class="btn btn-primary" data-export="export">Exportar a XLS
   	</button>
   <button id="XML" class="btn btn-primary" data-export="export">Exportar a XML
   </button>
   <button id="JSON" class="btn btn-primary" data-export="export">Exportar a JSON
   </button>
   </div>
 </center>  
   
</body>
</html>