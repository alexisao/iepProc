<?php 
session_start();

require("funciones.php");

$fun = new funciones();
if(!$fun->isAjax()){header ("Location: ../pages/index.html");}

$con = new con();
$con->connect();

$response = new StdClass;

/*Consulta a la Bd*/
$selectSQL ="SELECT * FROM tbl_estudiantes";

$row_cons = mysql_query($selectSQL);

while ($fila = mysql_fetch_array($row_cons)) { 
	$codplan=$fila[2]."-".$fila[3];
	$arrayData[]=array(
				$fila[1],
				$codplan,
				$fila[5]);
}
//echo $arrayData[1][1]
echo json_encode($arrayData);

$con->disconnect();	
?>