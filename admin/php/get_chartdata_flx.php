<?php 
session_start();

require("../php/funciones.php");
include("template_reporte_salas.php");

$fun = new funciones();
if(!$fun->isAjax()){header ("Location: ../pages/index.html");}

$con = new con();
$con->connect();

$response = new StdClass;
$cajas = array();

$response->$cajas = crearCajas();

echo json_encode($response);

?>