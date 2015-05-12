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

/*Construimos el arreglo de días*/
$dias=array();
for ($i=5; $i >= 1; $i--) { 
	$dias[$i]=date('Y-m-d',strtotime($lunes.'+'.$cambio--.' day'));
}
$viernes=date('Y-m-d',strtotime($lunes.'+5 day'));
$tinicio=" 00:00:00";
$tfinal=" 23:59:59";

/*Construimos arreglo de datos*/
for ($i=1; $i <=5 ; $i++) { 
	/*Cuenta para las solicitudes de Soporte se_tipo_sol=1*/
	$q1="SELECT * FROM tbl_servicios WHERE se_tipo_sol=1 AND se_log_fecha BETWEEN '".$dias[$i].$tinicio."' AND '".$dias[$i].$tfinal."';";
	$r1=mysql_query($q1,$con->connect());
	$c1=mysql_num_rows($r1);
	/*Cuenta para las solicitudes de Comunicaciones se_tipo_sol=2*/
	$q2="SELECT * FROM tbl_servicios WHERE se_tipo_sol=2 AND se_log_fecha BETWEEN '".$dias[$i].$tinicio."' AND '".$dias[$i].$tfinal."';";
	$r2=mysql_query($q2,$con->connect());
	$c2=mysql_num_rows($r2);
	$datos[]=array(
		"period"=>$dias[$i],
		"com" =>$c1,
		"sop" =>$c2,
	);
	//$response->data=$datos[$i];
}
echo json_encode($datos);

?>