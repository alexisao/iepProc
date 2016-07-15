<?php 
session_start();

require("../php/funciones.php");

$fun = new funciones();
if(!$fun->isAjax()){header ("Location: ../pages/index.html");}

/*recibimos variables*/
$codigo = $_POST['codigo'];
$plan = $_POST['plan'];
$nombre = $_POST['nombre'];

$con = new con();
$con->connect();

$response = new StdClass;

/*Consulta de estudiante inexistente*/
$row_verif = mysql_query("SELECT COUNT(*) FROM tbl_estudiantes WHERE es_codigo=".$codigo.";");
$rows = mysql_fetch_array($row_verif);
if($rows[0]>0){
	$res=false;
	$mes="Este estudiante ya está registrado.";
}else{
	/*insercción*/
	$selectSQL ="INSERT INTO tbl_estudiantes (es_nombre, es_codigo, es_plan, es_registrado_por, es_estado)
				 	VALUES ('".$nombre."',".$codigo.",".$plan.",".$_SESSION["ses_id"].",1);";

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
