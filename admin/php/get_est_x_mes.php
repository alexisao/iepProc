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

#año
$year_i = date('Y', strtotime($ini_semestre));
$year_f = date('Y', strtotime($fin_semestre));


while($fin_semestre > $ini_semestre){
    //echo "<br> inicio: ".$ini_semestre." - Fin: ".$fin_semestre."<br>";
    //$temp_date = strtotime('+1 day',strtotime($ini_semestre));
    //$ini_semestre = date("Y-m-d", $temp_date);

    /*descartamos sabados y domingos*/
    $int_mes=date('n', strtotime($ini_semestre));
    $str_mes=$arr_str_meses[($int_mes-1)];
    $msg .= $br."mes: ".$str_mes;
  
    	//echo "<br> -> fecha actual: ".$ini_semestre." (".$int_dia.")";
    	//echo "<br>realizamos consulta:";
        #construimos fin de mes
        $t_yer = date('Y', strtotime($ini_semestre));
        $t_mes = date('m', strtotime($ini_semestre));
        $t_dia = 31;
        $fin_mes = $t_yer."-".$t_mes."-".$t_dia;
        $qry_date_i=date('Y-m-d', strtotime($ini_semestre));
    	$qry_date_f=date('Y-m-d', strtotime($fin_mes));
    	//echo "<br>fecha consulta: ".$qry_date;
    	/*Franjas*/
	
		/* Lanzamos query por franja */
		$qry = "SELECT COUNT(*) AS Total FROM tbl_flujo_estudiantes WHERE fe_sala=".$sala." AND fe_log_fecha BETWEEN '".$qry_date_i.$ti."' AND '".$qry_date_f.$tf."';";
        $msg .= $br."qry: ".$qry;
		$result = mysql_query($qry,$con->connect());
		$val=mysql_fetch_assoc($result);

		$datos[]=array(
			"mes"=>$str_mes,
			"est" =>$val["Total"],
		);

$temp_date = strtotime('+1 month',strtotime($ini_semestre));
$ini_semestre = date("Y-m-d", $temp_date);
}
$response->mss = $msg;
$response->dta = $datos;
echo json_encode($response);

?>