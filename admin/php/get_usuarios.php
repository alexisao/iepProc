<?php 
session_start();

require("../php/funciones.php");

$fun = new funciones();
if(!$fun->isAjax()){header ("Location: ../pages/index.html");}

$con = new con();
$con->connect();

$response = new StdClass;

/*Consulta a la Bd*/
$selectSQL ="SELECT * FROM tbl_users WHERE us_estado<>99; ";

$row_cons = mysql_query($selectSQL);

while ($fila = mysql_fetch_array($row_cons)) { 
	$nombre = explode("@", $fila[3]);
	switch ($fila[4]) {
		case 1:
			$tipo="SuperAdmin";
			break;
		case 2:
			$tipo="Soporte";
			break;
		case 3:
			$tipo="Comunicaciones";
			break;
		case 4:
			$tipo="Monitor";
			break;
		case 5:
			$tipo="Secretaria";
			break;
		default:
			# code...
			break;
	}
	switch ($fila[7]) {
		case 1:
			$estado = "Activo";
			break;
		case 2:
			$estado = "Inactivo desde: ".$fila[6];
			break;
	}
	$arrayData[]=array(
				$fila[1],
				$nombre[0],
				$tipo,
				$estado,
				$fila[5],
				'
				<button type="button" onclick="cambiar_clave('.$fila[0].');" title="Cambiar Clave" class="btn btn-success btn-circle" data-toggle="modal" data-target="#modal_cambiarClave" data-whatever="@mdo"><i class="fa fa-edit"></i></button>
				<button type="button" onclick="borrar_usuario('.$fila[0].',this);" title="Borrar usuario" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></button>
				'
				);
}
//echo $arrayData[1][1]
echo json_encode($arrayData);

$con->disconnect();
?>