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

					
$html='<table class="table table-hover" id="planilla">';
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
		<th>Total</th>
	</thead>
';
//MES
$i=0;
for($i=$sem_i;$i<=$sem_f;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
	$html.='<tr>';
	$dia_semana = $arr_dias_semana[(date('N', strtotime($i)) - 1)];
	$mes_fecha = date('n', strtotime($i));
	if ($mes_fecha==$mes) {
		if($dia_semana==='Sabado' || $dia_semana === 'Domingo'){}else{
			$a = $fun->get_cant_students_x_h($sala, $i,"08:00:00","09:59:59");
			$b = $fun->get_cant_students_x_h($sala, $i,"10:00:00","11:59:59");
			$c = $fun->get_cant_students_x_h($sala, $i,"13:00:00","14:59:59");
			$d = $fun->get_cant_students_x_h($sala, $i,"15:00:00","16:59:59");
			$e = $fun->get_cant_students_x_h($sala, $i,"17:00:00","18:59:59");
			$f = $fun->get_cant_students_x_h($sala, $i,"19:00:00","20:59:59");
			$t_dia=($a+$b+$c+$d+$e+$f);
			$html.='<td>'.$i.'</td>';
			$html.='<td>'.$dia_semana.'</td>';
			$html.='<td>'.$a.'</td>';
			$html.='<td>'.$b.'</td>';
			$html.='<td>'.$c.'</td>';
			$html.='<td>'.$d.'</td>';
			$html.='<td>'.$e.'</td>';
			$html.='<td>'.$f.'</td>';
			$html.='<td><strong>'.$t_dia.'</strong></td>';
		}
	}
	$html.='</tr>';
}

	/*$a = $fun->get_total_students_x_h($sala, $i,"08:00:00","09:59:59");
	$b = $fun->get_total_students_x_h($sala, $i,"10:00:00","11:59:59");
	$c = $fun->get_total_students_x_h($sala, $i,"13:00:00","14:59:59");
	$d = $fun->get_total_students_x_h($sala, $i,"15:00:00","16:59:59");
	$e = $fun->get_total_students_x_h($sala, $i,"17:00:00","18:59:59");
	$f = $fun->get_total_students_x_h($sala, $i,"19:00:00","20:59:59");
	$t_col=($a+$b+$c+$d+$e+$f);
	$html.='<td></td>';
	$html.='<td>Total</td>';
	$html.='<td>'.$a.'</td>';
	$html.='<td>'.$b.'</td>';
	$html.='<td>'.$c.'</td>';
	$html.='<td>'.$d.'</td>';
	$html.='<td>'.$e.'</td>';
	$html.='<td>'.$f.'</td>';
	$html.='<td>'.$t_col.'</td>';*/
/*
$html.='<tr>';
$html.='<td>'.$mes.'</td>';
$html.='<td>'.$dia_semana.'</td>';
$html.='<td>'.$fun->get_total_students_x_h($sala, $mes,"08:00:00","09:59:59").'</td>';
$html.='<td>'.$fun->get_total_students_x_h($sala, $mes,"10:00:00","11:59:59").'</td>';
$html.='<td>'.$fun->get_total_students_x_h($sala, $mes,"13:00:00","14:59:59").'</td>';
$html.='<td>'.$fun->get_total_students_x_h($sala, $mes,"15:00:00","16:59:59").'</td>';
$html.='<td>'.$fun->get_total_students_x_h($sala, $mes,"17:00:00","18:59:59").'</td>';
$html.='<td>'.$fun->get_total_students_x_h($sala, $mes,"19:00:00","20:59:59").'</td>';
$html.='</tr>';
*/
$html.='
	<tfoot>
		<th></th>
		<th></th>
		<th>8:00 - 9:59</th>
		<th>10:00 - 11:59</th>
		<th>13:00 - 14:59</th>
		<th>15:00 - 16:59</th>
		<th>17:00 - 18:59</th>
		<th>19:00 - 20:59</th>
	</tfoot>
';
$html.='</table>';

$response->table=$html;
echo json_encode($response);
?>