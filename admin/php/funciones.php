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

	function get_total_students_x_d($sala, $mes, $dia){
		include("../semestre.php");
		$con = new con();
		$con->connect();

		#recorremos semestre
		$arr_dias_semana=array("Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo");

		#acum
		$acum = 0;

		$day = split(" ",$semestre_ini);
		$sem_i = $day[0];
		$sem_f = $semestre_fin;
		$i=0;
		for($i=$sem_i;$i<=$sem_f;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
			$dia_semana = $arr_dias_semana[(date('N', strtotime($i)) - 1)];
			$mes_fecha = date('n', strtotime($i));
			if ($mes_fecha==$mes) {
				if($dia_semana===$dia){
					$query="SELECT COUNT(fe_id) AS conteo FROM tbl_flujo_estudiantes WHERE fe_sala=".$sala." AND fe_log_fecha BETWEEN '".$i." 00:00:00' AND '".$i." 23:59:59'";
					//echo $query."<br>";
					$rq = mysql_query($query);
					$fq = mysql_fetch_array($rq);
					//echo "<br> -> fecha[".$i."] >> acum=".$acum." // result=".$fq[0];
					$acum += $fq[0];
				}
			}
		}
		//echo "<br>Total acum: ".$acum;
		return $acum;
	}

	function get_total_students_x_dh($sala, $mes, $dia, $h_ini, $h_fin){
		include("../semestre.php");
		$con = new con();
		$con->connect();

		#recorremos semestre
		$arr_dias_semana=array("Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo");

		#acum
		$acum = 0;

		$day = split(" ",$semestre_ini);
		$sem_i = $day[0];
		$sem_f = $semestre_fin;
		$i=0;
		for($i=$sem_i;$i<=$sem_f;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
			$dia_semana = $arr_dias_semana[(date('N', strtotime($i)) - 1)];
			$mes_fecha = date('n', strtotime($i));
			if ($mes_fecha==$mes) {
				if($dia_semana===$dia){
					$query="SELECT COUNT(fe_id) AS conteo FROM tbl_flujo_estudiantes WHERE fe_sala=".$sala." AND fe_log_fecha BETWEEN '".$i." ".$h_ini."' AND '".$i." ".$h_fin."';";
					//echo $query."<br>";
					$rq = mysql_query($query);
					$fq = mysql_fetch_array($rq);
					//echo "<br> -> fecha[".$i."] >> acum=".$acum." // result=".$fq[0];
					$acum += $fq[0];
				}
			}
		}
		//echo "<br>Total acum: ".$acum;
		return $acum;
	}

	function check_turno($d,$t,$e){
		$query="SELECT COUNT(tu_id) FROM tbl_turnos WHERE tu_espacio=".$e." AND tu_dia=".$d." AND tu_turno =".$t.";;";
		$rq = mysql_query($query);
		$re = mysql_fetch_array($rq);
		if($re[0]>0){
			return false;
		}else{
			return true;
		}
	}

	function make_history($us_id, $login=true){
		/*Obtenemos IP*/
		$ip = $_SERVER['REMOTE_ADDR'];

		if ($login) {
			/*insercción - Login*/
			try{
				$selectSQL ="INSERT INTO tbl_historial_accesos (ha_us_id, ha_ip)
							 	VALUES (".$us_id.", '".$ip."');";

				$row_cons = mysql_query($selectSQL);

				if($row_cons){
					$res=true;
					$mes="Guardado Satisfactoriamente.";
				}else{
					$res=false;
					$mes="Error al guardar, revisar campos y si el problema persiste favor comunicarse con el administrador del sistema.";
				}
			}
			catch(Exception $e){
				echo "Excepción capturada: ".$e->getMessage();
			}

		}else{
			/*actualización - Logout*/
			try{
				$selectSQL ="SELECT * FROM tbl_historial_accesos WHERE ha_us_id=".$us_id." ORDER BY ha_timestamp_in DESC LIMIT 1;";
				$res_ses = mysql_query($selectSQL);
				while ($row_ses = mysql_fetch_assoc($res_ses)) {
					# code...
					$updateSQL = 'UPDATE tbl_historial_accesos SET ha_timestamp_out=now() WHERE ha_id='.$row_ses['ha_id'].';';
					$res_insert = mysql_query($updateSQL);
				}
				if($res_insert){
					$res=true;
					$mes="Guardado Satisfactoriamente.";
				}else{
					$res=false;
					$mes="Error al guardar, revisar campos y si el problema persiste favor comunicarse con el administrador del sistema.";
				}

			}
			catch(Exception $e){
				echo "Excepción capturada: ".$e->getMessage();
			}
		}		
	}
}
?>
