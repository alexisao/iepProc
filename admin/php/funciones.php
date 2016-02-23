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
	function get_cant_students_x_h($fecha,$franja){
		$selectSQL ="SELECT count(`fe_id`) AS conteo FROM `tbl_flujo_estudiantes` WHERE `fe_sala`=1 AND `fe_hora_entrada` BETWEEN '2015-06-01 00:00:00' AND '2016-02-29 23:59:59'";
	}	

}
?>