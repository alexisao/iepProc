<?php 
session_start();

require("funciones.php");

$fun = new funciones();
if(!$fun->isAjax()){header ("Location: ../pages/index.html");}

/*recibimos variables*/
$codigo = $_POST['codigo'];
$id = $_POST['id'];
$hora_salida=date('H:i:s');


$con = new con();
$con->connect();

$response = new StdClass;

/*Consulta de estudiante inexistente*/
$row_verif = mysql_query("UPDATE tbl_flujo_estudiantes SET fe_hora_salida='".$hora_salida."', fe_estado=2 WHERE fe_id=".$id.";");
if(!$row_verif){
	$res=false;
	$mes="Error al registrar la salida del estudiante, favor intentarlo de nuevo o comunicarse con el administrador del sistema.";
}else{
	$res=true;
	$mes="Cambio registrado con éxito.";
}

$response->res = $res;
$response->mes = $mes;
echo json_encode($response);

$con->disconnect();
?>