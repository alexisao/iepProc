<?php 
session_start();

require("../php/funciones.php");

$fun = new funciones();
if(!$fun->isAjax()){header ("Location: ../pages/index.html");}

/*recibimos variables*/
$codigo = $_POST['codigo'];
$pc = $_POST['pc'];
$sala = $_POST['sala'];
$hora_entrada=date('H:i:s');
$monitor=$_SESSION["ses_id"];


$con = new con();
$con->connect();

$response = new StdClass;

/*Consulta de estudiante inexistente*/
$row_verif = mysql_query("SELECT COUNT(*) FROM tbl_estudiantes WHERE es_codigo=".$codigo.";");
$rows = mysql_fetch_array($row_verif);
if($rows[0]==0){
	$res=false;
	$mes="Este estudiante no existe en la base de datos, si es primera vez que ingresa a la sala, favor registrarlo.";
}else{
	/*Consulta a la Bd para evitar estudiantes previamente registrados en salas*/
	$row_check = mysql_query("SELECT COUNT(*) FROM tbl_flujo_estudiantes WHERE fe_es_codigo=".$codigo." AND fe_estado=1;");
	$fila = mysql_fetch_array($row_check);
	if($fila[0]>0){
		$res=false;
		$mes="Este estudiante registra un ingreso en esta o en otra sala.";
	}else{
		/*insercción*/
		$selectSQL ="INSERT INTO tbl_flujo_estudiantes (fe_es_codigo, fe_sala, fe_pc, fe_hora_entrada, fe_monitor, fe_estado)
					 	VALUES ('".$codigo."',".$sala.",".$pc.",'".$hora_entrada."',".$monitor.",1);";

		$row_cons = mysql_query($selectSQL);

		if($row_cons){
			$res=true;
			$mes="Guardado Satisfactoriamente.";
		}else{
			$res=false;
			$mes="Error al guardar, revisar campos y si el problema persiste favor comunicarse con el administrador del sistema.";
		}
	}
}

$response->res = $res;
$response->mes = $mes;
echo json_encode($response);

$con->disconnect();
?>