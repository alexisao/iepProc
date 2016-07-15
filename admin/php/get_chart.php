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
$id = $_POST['i'];

$day = split(" ",$semestre_ini);

$sem_i = $day[0];
$sem_f = $semestre_fin;
switch ($id) {
	case 1:
		$a = $fun->get_total_students_x_h($sala, $mes,"08:00:00","09:59:59");
		$b = $fun->get_total_students_x_h($sala, $mes,"10:00:00","11:59:59");
		$c = $fun->get_total_students_x_h($sala, $mes,"13:00:00","14:59:59");
		$d = $fun->get_total_students_x_h($sala, $mes,"15:00:00","16:59:59");
		$e = $fun->get_total_students_x_h($sala, $mes,"17:00:00","18:59:59");
		$f = $fun->get_total_students_x_h($sala, $mes,"19:00:00","20:59:59");
		$arr_cant=array($a,$b,$c,$d,$e,$f);

		$response->rows=$arr_cant;
		break;

	case 2:
		$a = $fun->get_total_students_x_d($sala, $mes,"Lunes");
		$b = $fun->get_total_students_x_d($sala, $mes,"Martes");
		$c = $fun->get_total_students_x_d($sala, $mes,"Miercoles");
		$d = $fun->get_total_students_x_d($sala, $mes,"Jueves");
		$e = $fun->get_total_students_x_d($sala, $mes,"Viernes");
		$arr_cant=array($a,$b,$c,$d,$e);

		$response->rows=$arr_cant;
		break;
}

echo json_encode($response);
?>