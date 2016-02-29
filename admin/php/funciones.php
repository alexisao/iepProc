<?php
include_once("db.php");

class funciones{
	/* Función para Enviar Email*/
	function enviar_email($para, $titulo, $mensaje) {
		$cabeceras = 'Content-type: text/html; charset=UTF-8'. "\r\n" .
		'From: $correo' . "\r\n" .
		'Reply-To: $correo' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();
		return mail($para, $titulo, $mensaje, $cabeceras);
	}

	/*Funcion validar datos*/
	function validar($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")   
	{  
	  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;  
	  switch ($theType) {  
	   	case "text":  
	      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";  
		break;      
	    case "long":  
		case "int":  
		  $theValue = ($theValue != "") ? intval($theValue) : "NULL";  
		break;  
	    case "double":  
	      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";  
		break;  
	    case "date":  
		  $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";  
	    break;  
		case "defined":  
	      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;  
		break;  
	 }  
	 return $theValue;  
	}

	function isAjax()
	{
	    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
	    {return true;}
	    else
	    {return false;}
	}


	function get_total_students_x_h($sala, $mo ,$h_i,$h_f){
		include("../semestre.php");

		$con = new con();
		$con->connect();
		#traemos inicio y final de semestre
		$s_i = $semestre_ini;
		$s_f = $semestre_fin;
		#extraemos año_i, año_f
		$row_s_i = split('-', $s_i);
		$row_s_f = split('-', $s_f); 
		$a_s_i = $row_s_i[0];
		$a_s_f = $row_s_f[0];

		$m=$mo;
		#verificamos si los años son identicos en el intervalo
		if ($a_s_i==$a_s_f) {
			# construimos fecha
			$fecha_i = $a_s_i."-".$m."-"."01";
			$fecha_f = $a_s_f."-".$m."-"."31";
		} else {
			#construimos las 2 fechas posibles
			$fecha_pos_a = $a_s_i."-".$m."-"."01";
			$fecha_pos_b = $a_s_f."-".$m."-"."01";

			#verificamos cual está en el semestre definido
			$ini = new DateTime($s_i);
			$fin = new DateTime($s_f);
			$pos_a = new DateTime($fecha_pos_a);
			$pos_b = new DateTime($fecha_pos_b);
			if ($pos_a >= $ini && $pos_a<= $fin) {
				$fecha_i = $a_s_i."-".$m."-"."01";
				$fecha_f = $a_s_i."-".$m."-"."31";
			} else {
				$fecha_i = $a_s_f."-".$m."-"."01";
				$fecha_f = $a_s_f."-".$m."-"."31";
			}
			
		}	

		$query="SELECT COUNT(fe_id) AS conteo FROM tbl_flujo_estudiantes WHERE fe_sala=".$sala." AND fe_hora_entrada BETWEEN '".$h_i."' AND '".$h_f."' AND fe_log_fecha BETWEEN '".$fecha_i." 00:00:00' AND '".$fecha_f." 23:59:59'";
		//echo $query."<br>";
		$rq = mysql_query($query);
		$fq = mysql_fetch_array($rq);
		return $fq[0];
	}	 

	function get_cant_students_x_h($sala, $fecha,$h_i,$h_f){
		$con = new con();
		$con->connect();

		$query="SELECT COUNT(fe_id) AS conteo FROM tbl_flujo_estudiantes WHERE fe_sala=".$sala." AND fe_hora_entrada BETWEEN '".$h_i."' AND '".$h_f."' AND fe_log_fecha BETWEEN '".$fecha." 00:00:00' AND '".$fecha." 23:59:59'";
		//echo $query."<br>";
		$rq = mysql_query($query);
		$fq = mysql_fetch_array($rq);
		return $fq[0];
	}	

}
?>