<?php 
session_start();

require("funciones.php");

$fun = new funciones();
if(!$fun->isAjax()){header ("Location: ../pages/index.html");}

/*recibimos variables*/
$codigo = $_POST['codigo'];
$hora_salida=date('H:i:s');


$con = new con();
$con->connect();

$response = new StdClass;
$SQL="UPDATE tbl_users SET us_estado=99 WHERE us_id=".$codigo." AND us_id_del='".$_SESSION["ses_id"]."';";

/*Consulta de estudiante inexistente*/
$row_verif = mysql_query($SQL);
if(!$row_verif){
	$res=false;
	$mes="Error al eliminar el registro del usuario, favor intentarlo de nuevo o comunicarse con el administrador del sistema.";
}else{
	$res=true;
	$mes="Cambio registrado con éxito.";
}

$response->res = $res;
$response->mes = $mes;
echo json_encode($response);

$con->disconnect();
?>