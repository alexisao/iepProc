<?php 
session_start();

require("../php/funciones.php");

$fun = new funciones();
if(!$fun->isAjax()){header ("Location: ../pages/index.html");}

//Verificamos si la peticion viene por get o por post
//modificacion requerida para refrescar tablas
if(isset($_GET['sala'])){
	$sala=$_GET["sala"];
}else{
	$sala = $_POST['sala'];	
}

$con = new con();
$con->connect();

$response = new StdClass;

/*Consulta a la Bd*/
$selectSQL ="SELECT FE.fe_pc,ES.es_nombre, ES.es_codigo, ES.es_plan, FE.fe_id FROM tbl_flujo_estudiantes FE
				Inner Join tbl_estudiantes ES
				WHERE FE.fe_es_codigo = ES.es_codigo AND
				FE.fe_sala = ".$sala." AND
				FE.fe_estado = 1;";

$row_cons = mysql_query($selectSQL);

while ($fila = mysql_fetch_array($row_cons)) { 
	$codplan=$fila[2]."-".$fila[3];
	$arrayData[]=array(
				'<button type="button" class="btn btn-primary"><i class="fa fa-desktop"></i>&nbsp;&nbsp;&nbsp;'.$fila[0].'</button>',
				$fila[1],
				$fila[2]."-".$fila[3],
				'
				<button type="button" onclick="registrar_salida('.$fila[4].','.$fila[2].');" title="Registrar Salida" class="btn btn-success btn-circle"><i class="fa fa-paper-plane-o"></i></button>
				<button type="button" onclick="borrar_registro('.$fila[4].','.$fila[2].','.$sala.');" title="Borrar Registro" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></button>

				'
				);
}
//print_r($arrayData);
echo json_encode($arrayData);

$con->disconnect();
?>