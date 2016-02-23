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

$day = split(" ",$semestre_ini);

$sem_i = $day[0];
$sem_f = $semestre_fin;
$arr_dias_semana=array("Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo");

					
$html='<table class="table table-hover">';
$html.='
	<thead>
		<th></th>
		<th></th>
		<th>8:00 - 9:59</th>
		<th>10:00 - 11:59</th>
		<th>13:00 - 14:59</th>
		<th>15:00 - 16:59</th>
		<th>17:00 - 18:59</th>
		<th>19:00 - 20:59</th>
	</thead>
';
//MES
for($i=$sem_i;$i<=$sem_f;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
	$html.='<tr>';
	$dia_semana = $arr_dias_semana[(date('N', strtotime($i)) - 1)];
	$mes_fecha = date('n', strtotime($i));
	if ($mes_fecha==$mes) {
		$html.='<td>'.$i.'</td>';
		$html.='<td>'.$dia_semana.'</td>';
		$html.='<td></td>';
		$html.='<td></td>';
		$html.='<td></td>';
		$html.='<td></td>';
		$html.='<td></td>';
		$html.='<td></td>';
	}
	$html.='</tr>';

}
$html.='</table>';

$response->table=$html;
echo json_encode($response);
?>