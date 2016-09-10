<?php 
session_start();

require("../php/funciones.php");
require("../semestre.php");

$fun = new funciones();
if(!$fun->isAjax()){header ("Location: ../pages/index.html");}

$con = new con();
$con->connect();

$response = new StdClass;

$sala = 4;

$br = "<br>";
$mes="";
$msg="";

/* definimos variables */
$year_ini = date("Y",strtotime($semestre_ini));
$mnth_ini = date("m",strtotime($semestre_ini));
$dday_ini = date("m",strtotime($semestre_ini));

$year_fin = date("Y",strtotime($semestre_fin));
$mnth_fin = date("m",strtotime($semestre_fin));
$dday_fin = date("m",strtotime($semestre_fin));

$ini_semestre=date("Y-m-d",strtotime($semestre_ini));
$fin_semestre=date("Y-m-d",strtotime($semestre_fin));

for($h=8; $h <= 21; $h++){
    #Ciclo Hora
    /* Lanzamos query Agrupado por horas */
    $qry = "SELECT COUNT(*) AS Cantidad FROM tbl_flujo_estudiantes WHERE fe_sala=".$sala." AND fe_hora_entrada BETWEEN '".$h.":00:00' AND '".$h.":59:59';";
    $msg .= $br.$qry;
    $result = mysql_query($qry,$con->connect());
    $val=mysql_fetch_assoc($result);

    $datos[]=array(
        "hrs"=>$h,
        "cnt" =>$val["Cantidad"],
    );
}
$response->mss = $msg;
$response->dta = $datos;
echo json_encode($response);

?>