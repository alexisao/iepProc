<?php 
session_start();

require("../php/funciones.php");

$fun = new funciones();
if(!$fun->isAjax()){header ("Location: ../pages/index.html");}

$con = new con();
$con->connect();

$response = new StdClass;

/*Consulta a la Bd*/
/* filtramos según sea el tipo de usuario */
switch ($_SESSION["ses_tipo"]) {
	//Superadmin
	case 1:
		$selectSQL ="SELECT * FROM tbl_servicios";
		break;
	//Soporte
	case 2:
		$selectSQL ="SELECT * FROM tbl_servicios WHERE se_tipo_sol=1";
		break;
	//Comunicaciones
	case 3:
		$selectSQL ="SELECT * FROM tbl_servicios WHERE se_tipo_sol=2";
		break;
	//Monitor
	case 4:
		$selectSQL ="SELECT * FROM tbl_servicios WHERE se_tipo_sol=0";
		break;
}

$row_cons = mysql_query($selectSQL);

while ($fila = mysql_fetch_array($row_cons)) { 
	if($fila[1]==1){$img='<i class="fa fa-settings fa-fw"></i>'; $title="Soporte Técnico";}
	if($fila[1]==2){$img='<i class="fa fa-settings fa-fw"></i>'; $title="Comunicaciones";}
	$tipo_solicitud=$title;
	$telext=$fila[8]."-".$fila[9];
	$arrayData[]=array(
				$tipo_solicitud,
				$fila[12],
				$fila[2],
				$fila[3],
				$telext,
				$fila[10],
				$fila[11]);
}
//echo $arrayData[1][1]
echo json_encode($arrayData);

$con->disconnect();
?>