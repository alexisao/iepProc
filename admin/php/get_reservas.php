<?php 
session_start();

require("../php/funciones.php");

$fun = new funciones();
if(!$fun->isAjax()){header ("Location: ../pages/index.html");}

$con = new con();
$con->connect();

$response = new StdClass;

/*Consulta a la Bd*/
$selectSQL ="SELECT * FROM tbl_reservas";

$row_cons = mysql_query($selectSQL);

while ($fila = mysql_fetch_array($row_cons)) { 
	if($fila[1]==1){$img='<i class="fa fa-settings fa-fw"></i>'; $title="Salón de Informática";}
	if($fila[1]==2){$img='<i class="fa fa-settings fa-fw"></i>'; $title="Salón de Clases";}
	$tipo_solicitud=$title;
	$telext=$fila[8]."-".$fila[9];
	$info_reserva="Se solicita el salón ".$fila[13].", ubicado en el edificio ".$fila[12]." para la fecha ".$fila[11]." desde las ".$fila[14]." hasta las ".$fila[15].".";
	$arrayData[]=array(
				$tipo_solicitud,
				$fila[16],
				$fila[2],
				$fila[3],
				$telext,
				$fila[10],
				$info_reserva);
}
//echo $arrayData[1][1]
echo json_encode($arrayData);

$con->disconnect();
?>