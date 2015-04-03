<?php 
session_start();

require("../php/funciones.php");

$fx = new funciones();
if(!$fx->isAjax()){header ("Location: ../pages/index.html");}

$con = new con();
$con->connect();

$response = new StdClass;

$usuario = $_POST['us'];
$pass = $_POST['ps'];
$pass = sha1(md5($pass));


/*Actualizamos la contraseña del usuario*/
$row_verif = mysql_query("UPDATE tbl_users SET us_clave='".$pass."' WHERE us_id=".$usuario.";");
if(!$row_verif){
	$res=false;
	$mes="Error al cambiar contraseña.";
}else{
	$res=true;
	$mes="Cambio registrado con éxito.";
}
$response->res = $res;
$response->mes = $mes;
echo json_encode($response);

$con->disconnect();
?>