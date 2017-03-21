<?php
session_start();
error_reporting(2|4);

//echo "nombre".$_SESSION["us_nombre"];
//miramos que hay en las variables de sesion
function get_user(){
$response = new StdClass;
if(isset($_SESSION["ses_id"]))
	{
		$s_id=$_SESSION["ses_id"];
		$s_email=$_SESSION["ses_user"];
		$s_tipo=$_SESSION["ses_tipo"];
		$res = true;
		$mes = $s_email;
	}
	else{
		$res = false;
		$mes = "../pages/login.html";
	}

	$response->res = $res;
	$response->mes = $mes;
	$response->uid = $s_tipo;
	echo json_encode($response);
}


/* Validación de la opción y ejecución de las peticiones*/
$opt=$_POST['opt'];

switch ($opt) {
	case "get_user":
		get_user();
		break;
	
	default:
		# code...
		break;
}
?>
