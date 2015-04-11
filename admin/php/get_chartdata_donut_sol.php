<?php 
session_start();

require("../php/funciones.php");

$fun = new funciones();
if(!$fun->isAjax()){header ("Location: ../pages/index.html");}

$con = new con();
$con->connect();

$response = new StdClass;

/*Consultamos día de la semana*/
$hoy=date('Y-m-d');
$dhoy=date('N');
/*traemos la fecha del lunes de esta semana*/
if($dhoy!=0){
	$cambio=$dhoy-1;
	$lunes=date('Y-m-d',strtotime($hoy.'-'.$cambio.' day'));
}else{
	$cambio=0;
	$lunes=$hoy;
}
//echo "<br> ->Cambio: ".$cambio;
//echo "<br> ->Lunes: ".$lunes."<br>";

/* Definimos el semestre */
$s_ini="2015-01-02 00:00:00";
$s_fin="2015-07-01 23:59:59";

/*Construimos el arreglo de días*/
$dias=array();
for ($i=5; $i >= 1; $i--) { 
	$dias[$i]=date('Y-m-d',strtotime($lunes.'+'.$cambio--.' day'));
}
$viernes=date('Y-m-d',strtotime($lunes.'+5 day'));
$tinicio=" 00:00:00";
$tfinal=" 23:59:59";

/*Construimos arreglo de datos*/
for ($i=1; $i <=3 ; $i++) { 

	/*Cuenta para la sala 1*/
	$q1="SELECT * FROM tbl_flujo_estudiantes WHERE fe_sala=".$i." AND fe_log_fecha BETWEEN '".$s_ini."' AND '".$s_fin."';";
	$r1=mysql_query($q1,$con->connect());
	$c1=mysql_num_rows($r1);

	$datos[]=array(
		"label"=>"Sala ".$i,
		"value" =>$c1
	);
	//$response->data=$datos[$i];
}
echo json_encode($datos);

?>