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
if($data!=0){
	$selectSQL ="SELECT * FROM tbl_estudiantes WHERE es_nombre like '%".$data."%' OR es_codigo like '%".$data."%' OR es_plan like '%".$data."%' AND es_estado < 99 ";
}else{
	$selectSQL ="SELECT * FROM tbl_estudiantes WHERE es_nombre like '%".$data."%' AND es_estado < 99 ORDER BY es_fecha_registro DESC LIMIT 30";
}
//echo $selectSQL;

$row_cons = mysql_query($selectSQL);

while ($fila = mysql_fetch_array($row_cons)) { 
	$codplan=$fila[2]."-".$fila[3];
	$btn='<button type="button" onclick="get_detalle('.$fila[2].',3);" title="detalles" class="btn btn-success btn-circle" data-toggle="modal" data-target="#modal_detalleRegistrados-lg" data-whatever="@mdo"><i class="fa fa-edit"></i></button>';
	if ($_SESSION['ses_tipo']==1) {
		$btn_2='<button type="button" onclick="borrar_estudiante('.$fila[0].','.$fila[2].',this);" title="Borrar registro" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></button>';
	}else{
		$btn_2='';
	}
	$arrayData[]=array(
				$codplan,
				$fila[1],
				$btn.$btn_2);
}

echo json_encode($arrayData);

$con->disconnect();	
?>