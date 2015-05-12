<?php 
session_start();

require("funciones.php");

$fun = new funciones();
if(!$fun->isAjax()){header ("Location: ../pages/index.html");}

$con = new con();
$con->connect();

$response = new StdClass;

/*Consulta a la Bd*/
$selectSQL1 ="SELECT * FROM tbl_servicios";
$selectSQL2 ="SELECT * FROM tbl_reservas";
$selectSQL3 ="SELECT * FROM tbl_flujo_estudiantes";
$selectSQL4 ="SELECT * FROM tbl_observaciones";

$row_sol = mysql_query($selectSQL1);
$row_res = mysql_query($selectSQL2);
$row_flu = mysql_query($selectSQL3);
$row_obs = mysql_query($selectSQL4);

$cant_sol = mysql_num_rows($row_sol);
$cant_res = mysql_num_rows($row_res);
$cant_flu = mysql_num_rows($row_flu);
$cant_obs = mysql_num_rows($row_obs);

$response->res = true;
$response->sol = $cant_sol;
$response->reo = $cant_res;
$response->flu = $cant_flu;
$response->obs = $cant_obs;

echo json_encode($response);

$con->disconnect();	
?>