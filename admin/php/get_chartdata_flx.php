<?php 
session_start();

require("../php/funciones.php");
include("template_reporte_salas.php");

$fun = new funciones();
if(!$fun->isAjax()){header ("Location: ../pages/index.html");}

$con = new con();
$con->connect();

/*Creación de cajas para las gráficas*/
$response = new StdClass;
$cajas = array();
$boxes = crearCajas();

/*datos que se cargarán en las gráficas*/
/*Datos del semestre*/
$s_inicio="04-02-2015";
$s_fin="06-31-2015";
$tinicio=" 00:00:00";
$tfinal=" 23:59:59";
$sala = $_POST["sala"];

/*definimos arreglos resultante*/
$f1 = array('1' => 0,'2' => 0,'3' => 0,'4' => 0,'5' => 0);
$f2 = array('1' => 0,'2' => 0,'3' => 0,'4' => 0,'5' => 0);
$f3 = array('1' => 0,'2' => 0,'3' => 0,'4' => 0,'5' => 0);
$f4 = array('1' => 0,'2' => 0,'3' => 0,'4' => 0,'5' => 0);
$f5 = array('1' => 0,'2' => 0,'3' => 0,'4' => 0,'5' => 0);
$f6 = array('1' => 0,'2' => 0,'3' => 0,'4' => 0,'5' => 0);

/*Traemos el primer día hábil (l,m,mx,j,v) del semestre*/
$dia=date('N', strtotime($s_inicio));
$str_dia=date('D', strtotime($s_inicio));
if(($dia==6) || ($dia==7)){}
else{
	$i=0;
	$ini_semestre=date('Y-m-d', strtotime($s_inicio));
	$fin_semestre=date('Y-m-d', strtotime($s_fin));
	/*verificar que no se pase de la fecha de final de semestre*/
	/*ejecutar consulta*/
	/*franja*/
	/*tomar el nro de valores*/
	while ($ini_semestre<$fin_semestre) {
		echo "<br>i: ".$i;
		$ini_semestre = strtotime("$ini_semestre +1 day");
		$i++;
	}
	/*creamos y ejecutamos consulta con conteo*/
	/*construimos fecha*/
	$qry_date=date('Y-m-d', strtotime($s_inicio));
	$qry = "SELECT * FROM tbl_flujo_estudiantes WHERE fe_sala=".$sala." AND fe_log_fecha BETWEEN '".$qry_date.$tinicio."' AND '".$s_fin.$tfinal."';";
	$r1=mysql_query($qry,$con->connect());
	$c1=mysql_num_rows($r1);
}


$response->cajas = $boxes;
$response->cantidad = 6;

echo json_encode($response);

?>