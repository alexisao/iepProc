<?php 
session_start();

require("../php/funciones.php");

$fun = new funciones();
if(!$fun->isAjax()){header ("Location: ../pages/index.html");}

$con = new con();
$con->connect();

$response = new StdClass;

$usu = $_POST['user'];
$pass = $_POST['pass'];
$pass = sha1(md5($pass));

/*Consulta a la Bd*/
$selectSQL ="SELECT * FROM `tbl_users` WHERE `us_email` = '$usu' AND `us_clave` = '$pass'";

$row_cons = mysql_query($selectSQL);
$existe = mysql_fetch_assoc($row_cons);
/*Termina Consulta*/

/*Existe*/
//$existe = 1;
$url="";
if($existe){
	$res = true;
	$mes = "Welcome";
	$usuario = explode("@", $existe["us_email"]);
	
	$_SESSION["ses_id"] = $existe['us_id'];
	$_SESSION["ses_email"] = $existe['us_email'];
	$_SESSION["ses_user"] = $usuario[0];
	$_SESSION["ses_tipo"] = $existe['us_tipo'];

	#guardamos registro de acceso
	$fun->make_history($existe['us_id']);

	switch ($existe["us_tipo"]) {
		case "6":
			$url = "../pages/flujocendopu.html";
			break;
		
		default:
			$url = "../pages/index.html";
			break;
	}
	
//$menu = 1;
}else{
	$res = false;
	$mes = "Usuario y/o contraseña incorrectos";
}

$response->res = $res;
$response->mes = $mes;
$response->url = $url;
echo json_encode($response);

$con->disconnect();
?>