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
$s_inicio="2015-02-02";
$s_fin="2015-06-30";
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

/* verificamos si estamos dentro del semestre */
$ini_semestre=date("Y-m-d",strtotime($s_inicio));
$fin_semestre=date("Y-m-d",strtotime($s_fin));
while($fin_semestre > $ini_semestre){
    //echo "<br> inicio: ".$ini_semestre." - Fin: ".$fin_semestre."<br>";
    //$temp_date = strtotime('+1 day',strtotime($ini_semestre));
    //$ini_semestre = date("Y-m-d", $temp_date);

    /*descartamos sabados y domingos*/
    $int_dia=date('N', strtotime($ini_semestre));
    if(($int_dia==6) || ($int_dia==7)){}
    else{
    	echo "<br> -> fecha actual: ".$ini_semestre." (".$int_dia.")";
    	echo "<br>realizamos consulta:";
    	$qry_date=date('Y-m-d', strtotime($ini_semestre));
    	echo "<br>fecha consulta: ".$qry_date;
    	/*Franjas*/
    	for ($i=1; $i <= 6; $i++) { 
    		switch ($i) {
    			case 1:
    				$ti="08:00:00";
    				$tf="09:59:59";
    				$franja_temp = array();
    				$franja_temp = $f1;
    				break;
    			case 2:
    				$ti="10:00:00";
    				$tf="11:59:59";
    				$franja_temp = array();
    				$franja_temp = $f2;
    				break;
    			case 3:
    				$ti="13:00:00";
    				$tf="14:59:59";
    				$franja_temp = array();
    				$franja_temp = $f3;
    				break;
    			case 4:
    				$ti="15:00:00";
    				$tf="16:59:59";
    				$franja_temp = array();
    				$franja_temp = $f4;
    				break;
    			case 5:
    				$ti="17:00:00";
    				$tf="18:59:59";
    				$franja_temp = array();
    				$franja_temp = $f5;
    				break;
    			case 6:
    				$ti="19:00:00";
    				$tf="20:59:59";
    				$franja_temp = array();
    				$franja_temp = $f6;
    				break;
    			
    			default:
    				$msg="Error en la consulta, comunicarse con soporte tecnico";
    				break;
    		}
    		/* Lanzamos query por franja */
			$qry = "SELECT COUNT(*) AS Total FROM tbl_flujo_estudiantes WHERE fe_sala=".$sala." AND fe_log_fecha BETWEEN '".$qry_date." ".$ti."' AND '".$qry_date." ".$tf."';";
			$result = mysql_query($qry,$con->connect());
			$val=mysql_fetch_assoc($result);

			/* Agrupamos resultado segun dia de la semana en la franja del bucle*/
			switch ($int_dia) {
				case 1:
					/*traemos valor que tiene ese dia en la franja*/
					echo"<br> Franja ".$i." en el dia ".$int_dia.":";
					$new_val=$franja_temp[1]+$val["Total"];
					echo $franja_temp[1]."// nuevo valor: ".$new_val;
					break;
				case 2:
					/*traemos valor que tiene ese dia en la franja*/
					echo"<br> Franja ".$i." en el dia ".$int_dia.":";
					$new_val=$franja_temp[2]+$val["Total"];
					echo $franja_temp[2]."// nuevo valor: ".$new_val;
					break;
				case 3:
					/*traemos valor que tiene ese dia en la franja*/
					echo"<br> Franja ".$i." en el dia ".$int_dia.":";
					$new_val=$franja_temp[3]+$val["Total"];
					echo $franja_temp[3]."// nuevo valor: ".$new_val;
					break;
				case 4:
					/*traemos valor que tiene ese dia en la franja*/
					echo"<br> Franja ".$i." en el dia ".$int_dia.":";
					$new_val=$franja_temp[4]+$val["Total"];
					echo $franja_temp[4]."// nuevo valor: ".$new_val;
					break;
				case 5:
					/*traemos valor que tiene ese dia en la franja*/
					echo"<br> Franja ".$i." en el dia ".$int_dia.":";
					$new_val=$franja_temp[5]+$val["Total"];
					echo $franja_temp[5]."// nuevo valor: ".$new_val;
					break;
				
				default:
					$msg="Error en la consulta, comunicarse con soporte tecnico(2)";
					break;
			}

			/*Cargamos resultado en el arreglo de la franja a la que corresponde el resultado*/
			switch ($i) {
				case 1:
					$f1[$int_dia]=$new_val;
					break;
				case 2:
					$f2[$int_dia]=$new_val;
					break;
				case 3:
					$f3[$int_dia]=$new_val;
					break;
				case 4:
					$f4[$int_dia]=$new_val;
					break;
				case 5:
					$f5[$int_dia]=$new_val;
					break;
				case 6:
					$f6[$int_dia]=$new_val;
					break;
				
				default:
					# code...
					break;
			}

			//echo "<br>consulta de la fecha ".$qry_date." en la franja (".$i."): ".$qry."  <strong>Total: ".$val["Total"]."</strong>";
    	}//fin del for
		/*
		$r1=mysql_query($qry,$con->connect());
		$c1=mysql_num_rows($r1);*/
	}
	echo"<br> ";
	var_dump($f1);
	echo"<br> ";
	var_dump($f2);
	echo"<br> ";
	var_dump($f3);
	echo"<br> ";
	var_dump($f4);
	echo"<br> ";
	var_dump($f5);
	echo"<br> ";
	var_dump($f6);
	echo"<br> ";

$temp_date = strtotime('+1 day',strtotime($ini_semestre));
$ini_semestre = date("Y-m-d", $temp_date);
}


/*Traemos el primer día hábil (l,m,mx,j,v) del semestre*/
/*$dia=date('N', strtotime($s_inicio));
$str_dia=date('D', strtotime($s_inicio));
if(($dia==6) || ($dia==7)){}
else{
	$i=0;

	$qry_date=date('Y-m-d', strtotime($s_inicio));
	$qry = "SELECT * FROM tbl_flujo_estudiantes WHERE fe_sala=".$sala." AND fe_log_fecha BETWEEN '".$qry_date.$tinicio."' AND '".$s_fin.$tfinal."';";
	$r1=mysql_query($qry,$con->connect());
	$c1=mysql_num_rows($r1);
}*/


$response->cajas = $boxes;
$response->cantidad = 6;

echo json_encode($response);

?>