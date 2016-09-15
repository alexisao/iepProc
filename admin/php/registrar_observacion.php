<?php 
session_start();

require("../php/funciones.php");

$fun = new funciones();
if(!$fun->isAjax()){header ("Location: ../pages/index.html");}

/*recibimos variables*/
$sala = $_POST['sala'];
$pc = $_POST['pc'];
$obs = $_POST['observacion'];
$usuario = $_SESSION["ses_id"];


$con = new con();
$con->connect();

$response = new StdClass;

/*insercción*/
$selectSQL ="INSERT INTO tbl_observaciones (ob_us_id, ob_sala, ob_pc, ob_observacion, ob_estado, ob_id_del)
			 VALUES (".$usuario.",".$sala.",".$pc.",'".$obs."',1, 0);";

$row_cons = mysql_query($selectSQL);

if($row_cons){
	$res=true;
	$mes="Guardado Satisfactoriamente.";
}else{
	$res=false;
	$mes="Error al guardar, revisar campos y si el problema persiste favor comunicarse con el administrador del sistema.";
}


$response->res = $res;
$response->mes = $mes;
echo json_encode($response);

$con->disconnect();
?>