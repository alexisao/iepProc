<?php 
session_start();

require("../php/funciones.php");
require("../semestre.php");

$fun = new funciones();
if(!$fun->isAjax()){header ("Location: ../pages/index.html");}

$con = new con();
$con->connect();

$response = new StdClass;

$sem_i = $semestre_ini;
$sem_f = $semestre_fin;

//separamos mes inicial y mes final
list($año_i, $mes_i, $dia_i) = split('[/.-]', $sem_i);
list($año_f, $mes_f, $dia_f) = split('[/.-]', $sem_f);
//traemos lista de meses del semestre
$datetime1 = new DateTime($sem_i);
$datetime2 = new DateTime($sem_f);
$interval = $datetime1->diff($datetime2);
$meses = ( $interval->y * 12 ) + $interval->m;

$mx=(int)$mes_i;
$html='Seleccione un mes:<br><select id="mes" name="cbx_mes" class="form-control input-sm">';
$arr_meses = array(
	1 => "Enero",
	2 => "Febrero",
	3 => "Marzo",
	4 => "Abril",
	5 => "Mayo",
	6 => "Junio",
	7 => "Julio",
	8 => "Agosto",
	9 => "Septiembre",
	10 => "Octubre",
	11 => "Noviembre",
	12 => "Diciembre"
	 );
for ($i=0; $i <= $meses; $i++) { 
	# cargamos el mes según sin que pase del mes 12 al 13
	if ($mx>12) {$mx=1;}
	$html.='<option value="'.$mx.'">'.$arr_meses[$mx].'</option>';
	$mx++;

}
$html .= '</select>';

$script = '';

$response->res=$html;
$response->msg=true;
echo json_encode($response);

?>