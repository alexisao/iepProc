<?php 
session_start();

require("../php/funciones.php");
require("../semestre.php");

$fun = new funciones();
if(!$fun->isAjax()){header ("Location: ../pages/index.html");}

$con = new con();
$con->connect();


$response = new StdClass;

/* GET */
$sala = $_POST['s'];
$mes = $_POST['m'];
$ini = $_POST['i'];
$fin = $_POST['f'];

$day = split(" ",$semestre_ini);

$sem_i = $day[0];
$sem_f = $semestre_fin;

$a = $fun->get_total_students_x_dh($sala, $mes,"Lunes",$ini,$fin);
$b = $fun->get_total_students_x_dh($sala, $mes,"Martes",$ini,$fin);
$c = $fun->get_total_students_x_dh($sala, $mes,"Miercoles",$ini,$fin);
$d = $fun->get_total_students_x_dh($sala, $mes,"Jueves",$ini,$fin);
$e = $fun->get_total_students_x_dh($sala, $mes,"Viernes",$ini,$fin);
$arr_cant=array($a,$b,$c,$d,$e);

$response->rows=$arr_cant;


echo json_encode($response);
?>