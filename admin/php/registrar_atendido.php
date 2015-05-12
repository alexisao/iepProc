<?php 
session_start();

require("funciones.php");

$fun = new funciones();
if(!$fun->isAjax()){header ("Location: ../pages/index.html");}

/*recibimos variables*/
$id = $_POST['id'];

$con = new con();
$con->connect();

$response = new StdClass;

/* marcamos la salida de esta observacion*/
$row_verif = mysql_query("UPDATE tbl_observaciones SET ob_estado=2 WHERE ob_id=".$id.";");
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