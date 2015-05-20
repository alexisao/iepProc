<?php 
session_start();

require("funciones.php");

$fun = new funciones();
if(!$fun->isAjax()){header ("Location: ../pages/index.html");}

/*recibimos variables*/
$id = $_POST['id'];
$estado = $_POST['estado'];
$tipo = $_POST['tipo'];
//$hora_salida=date('H:i:s');


$con = new con();
$con->connect();

$response = new StdClass;

/*Consulta de estudiante inexistente*/
$row_verif = mysql_query("UPDATE tbl_servicios SET se_estado='".$estado."' WHERE se_id=".$id.";");
if(!$row_verif){
	$res=false;
	$mes="Error al registrar el cambio de estado, favor intentarlo de nuevo o comunicarse con el administrador del sistema.";
}else{
	$res=true;
	$mes="Cambio registrado con éxito.";
}

$response->res = $res;
$response->mes = $mes;
echo json_encode($response);

$con->disconnect();
?>