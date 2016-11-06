<?php 
session_start();

require("funciones.php");

$fun = new funciones();
if(!$fun->isAjax()){header ("Location: ../pages/index.html");}

$con = new con();
$con->connect();

$data = $_POST["dt"];

$response = new StdClass;

/*Consulta a la Bd*/
$selectSQL ="SELECT * FROM tbl_estudiantes WHERE es_nombre like '%".$data."%' OR es_codigo like '%".$data."%' AND es_estado < 99 ";
#echo $selectSQL;

$row_cons = mysql_query($selectSQL);

while ($fila = mysql_fetch_array($row_cons)) { 
	$codplan=$fila[2]."-".$fila[3];
	$btn='<button type="button" onclick="get_detalle('.$fila[2].',3);" class="btn btn-success" data-toggle="modal" data-target="#modal_detalleRegistrados-lg" data-whatever="@mdo"><i class="fa fa-edit"></i>  Ver Estudiante</button>';
	if ($_SESSION['ses_tipo']==1) {
		$btn_2='<button type="button" onclick="borrar_estudiante('.$fila[0].','.$fila[2].',this);" title="Borrar registro" class="btn btn-danger"><i class="fa fa-trash"></i> Borrar Registro</button>';
	}else{
		$btn_2='';
	}
	$arrayData[]=array(
				$codplan,
				$fila[1],
				$btn." ".$btn_2);
}
//echo $arrayData[1][1]
echo json_encode($arrayData);

$con->disconnect();	
?>