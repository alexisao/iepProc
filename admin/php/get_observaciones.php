<?php 
session_start();

require("../php/funciones.php");

$fun = new funciones();
if(!$fun->isAjax()){header ("Location: ../pages/index.html");}

$con = new con();
$con->connect();

$response = new StdClass;

/*Consulta a la Bd*/
$selectSQL ="SELECT * FROM tbl_observaciones OB 
			 INNER JOIN tbl_users US
			 WHERE 
			 OB.ob_us_id = US.us_id AND
			 OB.ob_estado = 1;";

$row_cons = mysql_query($selectSQL);

while ($fila = mysql_fetch_array($row_cons)) { 
	/* Definimos que botones mostramos segun el tipo de usuario */
	$btn_1='<button type="button" onclick="registrar_atendido('.$fila[0].',this);" title="Marcar como <<Atendido>>" class="btn btn-success btn-circle"><i class="fa fa-check"></i></button>';
	$btn_2='<button type="button" onclick="borrar_observacion('.$fila[0].',this);" title="Borrar observación" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></button>';
	switch($_SESSION["ses_tipo"]) {
		case 1:
			$opciones=$btn_1.$btn_2;
		break;
		case 4:
			$opciones=$btn_2;
		break;
	}
	$nombre = explode("@", $fila[11]);
	$arrayData[]=array(
				$fila[4],
				'<button type="button" class="btn btn-primary"><i class="fa fa-home"></i>&nbsp;S'.$fila[2].'</button>',
				'<button type="button" class="btn btn-primary"><i class="fa fa-desktop"></i>&nbsp;'.$fila[3].'</button>',
				$nombre[0],
				$fila[5],
				$opciones
				);
}
//echo $arrayData[1][1]
echo json_encode($arrayData);

$con->disconnect();
?>