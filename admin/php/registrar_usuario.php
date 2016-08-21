<?php 
session_start();

require("../php/funciones.php");

$fun = new funciones();
if(!$fun->isAjax()){header ("Location: ../pages/index.html");}

/*recibimos variables*/
$codigo = $_POST['id'];
$tipo = $_POST['rol'];
$clave = $_POST['clave'];
$rclave = $_POST['rclave'];
$correo = $_POST['correo'];

$clave=sha1(md5($clave));

$con = new con();
$con->connect();

$response = new StdClass;

/*Consulta de estudiante inexistente*/
$row_verif = mysql_query("SELECT COUNT(*) FROM tbl_users WHERE us_usuario=".$codigo.";");
$rows = mysql_fetch_array($row_verif);
if($rows[0]!=0){
	$res=false;
	$mes="Este usuario ya está registrado.";
}else{
	/*insercción*/
	$selectSQL ="INSERT INTO tbl_users (us_usuario, us_clave, us_email, us_tipo, us_estado)
				 	VALUES (".$codigo.",'".$clave."','".$correo."',".$tipo.",1);";
	$row_cons = mysql_query($selectSQL);

	if($row_cons){
		$res=true;
		$mes="Guardado Satisfactoriamente.";
	}else{
		$res=false;
		$mes="Error al guardar, revisar campos y si el problema persiste favor comunicarse con el administrador del sistema.";
	}
}

$response->res = $res;
$response->mes = $mes;
echo json_encode($response);

$con->disconnect();
?>