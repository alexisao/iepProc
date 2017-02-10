<?php
include_once('session.php');
require("../php/funciones.php");

$fun = new funciones();
if(!$fun->isAjax()){header ("Location: ../pages/index.html");}

$con = new con();
$con->connect();

$response = new StdClass;

$res = null;
$mes = null;
$value = null;

#obtenemos el día de la semana de la fecha actual
$day = date('N');

#traemos el Id del usuario
$user = $_SESSION["ses_id"];

#traemos el turno en el que el monitor está logueado

$hora = date("H:i:s");
if ($hora>="08:00:00" && $hora<="12:00:00") { $turno = 0;} #Prox a parametrizar
if ($hora>="13:30:00" && $hora<="17:30:00") { $turno = 1;}
if ($hora>="17:30:00" && $hora<="21:00:00") { $turno = 2;}

#buscamos sala del usuario en ese día
$qry_turno = "SELECT tu_espacio FROM tbl_turnos WHERE tu_us_id=".$user." AND tu_dia=".($day-1)." AND tu_turno=".$turno.";";
$res_turno = mysql_query($qry_turno,$con->connect());
$row_turno = mysql_fetch_assoc($res_turno);

if($row_turno!=false){
	$value = $row_turno["tu_espacio"];
	$res=true;
	$mes="ok";
}else{
	$value = null;
	$res=false;
	$mes="Usted no tiene turnos programados en este momento";
}

#var_dump($row_turno);
#echo "<br>consulta: ".$qry_turno."<br>";

$response->res = $res;
$response->mes = $mes;
$response->val = $value;

echo json_encode($response);
?>