<?php 
session_start();

require("../php/funciones.php");

$fun = new funciones();
if(!$fun->isAjax()){header ("Location: ../pages/index.html");}

$con = new con();
$con->connect();

$response = new StdClass;
//echo "<br> ->Cambio: ".$cambio;
//echo "<br> ->Lunes: ".$lunes."<br>";

/* Definimos el semestre */
$s_ini="2015-01-02 00:00:00";
$s_fin="2015-07-01 23:59:59";

/*Cuenta para la todas las solicitudes sin completar*/
$q1="SELECT * FROM tbl_reservas WHERE re_tipo_sol=1 AND re_log_fecha BETWEEN '".$s_ini."' AND '".$s_fin."';";
$r1=mysql_query($q1,$con->connect());
$c1=mysql_num_rows($r1);

/*Cuenta para la todas las solicitudes completadas*/
$q2="SELECT * FROM tbl_reservas WHERE re_tipo_sol=2 AND re_log_fecha BETWEEN '".$s_ini."' AND '".$s_fin."';";
$r2=mysql_query($q2,$con->connect());
$c2=mysql_num_rows($r2);

$datos[]=array("label"=>"Sala de Computo","value" =>$c1);
$datos[]=array("label"=>"Salon de Clases","value" =>$c2);

$response->data=$datos;
$response->total=$c1+$c2;

echo json_encode($response);

?>