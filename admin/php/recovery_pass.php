<?php 
session_start();

require("../php/funciones.php");

$fx = new funciones();
if(!$fx->isAjax()){header ("Location: ../pages/index.html");}

$con = new con();
$con->connect();

$response = new StdClass;

$mail = $_POST['remail'];

/* $pass_encriptada1 = md5 ($pass); //Encriptacion nivel 1
$pass_encriptada2 = crc32($pass_encriptada1); //Encriptacion nivel 1
$pass_encriptada3 = sha1("xtemp".$pass_encriptada2); //Encriptacion nivel 3
$pass_encriptada4 = crypt($pass_encriptada3, "xtemp"); //Encriptacion nivel 2 */

/*Consulta a la Bd*/
$selectSQL ="SELECT * FROM `tbl_users` WHERE `us_email` = '$mail'";

$row_cons = mysql_query($selectSQL);
$existe = mysql_fetch_assoc($row_cons);
/*Termina Consulta*/

/*Existe*/
if($existe){
	$res = true;
	$mes = "existe";
	/* Construimos Cuerpo del email */
		$para = $mail;
		$titulo = "Solicitud de Cambio de Contraseña - Plataforma IEP";
		$mensaje = "<a href='#'>Cambiar contraseña</a>";
	/* Fin */
	/* Realizamos envío de correo con link para cambiar password 
		if($fx->enviar_email($para, $titulo, $mensaje))
		{	
			//mail($fw_para, $fw_titulo, $fw_mensaje, $fw_cabeceras);
			$response->res = "true";
			$response->msg = 'Enviado Satisfactoriamente.';
		}else{
			$response->msg = 'Hubo problemas al enviar su solicitud, favor intentar m&aacute;s tarde.';
			$response->res = "false";
		}*/
}else{
	$res = false;
	$mes = "No existe ningun usuario asociado a este correo.";
}

$response->res = $res;
$response->mes = $mes;
echo json_encode($response);

$con->disconnect();
?>