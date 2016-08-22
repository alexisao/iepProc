<?php
session_start();

require("../php/funciones.php");

$fun = new funciones();
if(!$fun->isAjax()){header ("Location: ../pages/index.html");}

/*recibimos variables*/
$d = $_POST['dia'];
$t = $_POST['turno'];
$e = $_POST['espacio'];
$u = $_POST['usuario'];

$con = new con();
$con->connect();

$response = new StdClass;
$debug = false;

/*consultamos registros*/
$selectSQL ="SELECT * FROM tbl_turnos WHERE tu_us_id=".$u." AND tu_dia=".$d." AND tu_turno =".$t." AND tu_espacio = ".$e.";";
$debug .= "Consulta SQL: ".$selectSQL;
$row_cons = mysql_query($selectSQL);
$row_cant = mysql_num_rows($row_cons);
$debug .= "Cantidad de registros consultados: ".$row_cant;
if($row_cant>0){
	#Significa que tenemos registro existente y procedemos a modificar
}else{
	#significa que no existe registro previo y que tenemos que crearlo
	$sql_create = "INSERT INTO tbl_turnos (tu_us_id, tu_dia, tu_turno, tu_espacio) VALUES (".$u.",".$d.",".$t.",".$e.")";
	$resp=mysql_query($sql_create);
	if($resp){
		$res=true;
		$mes="Guardado Satisfactoriamente.";
	}else{
		$res=false;
		$mes="Error al guardar, revisar campos y si el problema persiste favor comunicarse con el administrador del sistema.";
	}
}




$response->res = $res;
$response->mes = $mes;
$response->debug = $debug;
echo json_encode($response);

$con->disconnect();
?>
