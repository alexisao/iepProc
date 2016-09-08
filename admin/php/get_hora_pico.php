<?php 
session_start();

require("../php/funciones.php");
require("../semestre.php");

$fun = new funciones();
if(!$fun->isAjax()){header ("Location: ../pages/index.html");}

$con = new con();
$con->connect();

/*Creación de cajas para las gráficas*/
$response = new StdClass;

/*datos que se cargarán en las gráficas*/
/*Datos del semestre*/
$ti=" 00:00:00";
$tf=" 23:59:59";
$sala = 4;

$br = "<br>";
$mes="";


/* verificamos si estamos dentro del semestre */
$ini_semestre=date("Y-m-d",strtotime($semestre_ini));
$fin_semestre=date("Y-m-d",strtotime($semestre_fin));

for($k=8;$k<=21;$k++){

    /* Lanzamos query Agrupado por horas */
	$qry = "SELECT COUNT(*) AS Cantidad FROM tbl_flujo_estudiantes WHERE fe_sala=".$sala." AND fe_log_fecha BETWEEN '".$ini_semestre." ".$k.":00:00' AND '".$fin_semestre." ".$k.":59:59';";
	$result = mysql_query($qry,$con->connect());
	$val=mysql_fetch_assoc($result);

	$datos[]=array(
		"hrs"=>$k.":00:00 - ".$k.":59:59",
		"cnt" =>$val["Cantidad"],
	);
}
$response->mss = $msg;
$response->dta = $datos;
echo json_encode($response);

?>