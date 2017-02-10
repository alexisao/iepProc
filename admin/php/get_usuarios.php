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

$btn_turnos = '';

while ($fila = mysql_fetch_array($row_cons)) { 
	$nombre = explode("@", $fila[3]);
	switch ($fila[4]) {
		case 1:
			$tipo="SuperAdmin";
			$color = "primary";
			break;
		case 2:
			$tipo="Soporte";
			$color = "success";
			break;
		case 3:
			$tipo="Comunicaciones";
			$color = "warning";
			break;
		case 4:
			$tipo="Monitor";
			$color = "success";
			$onClick="turnos(".$fila[0].",'".$nombre[0]."');";
			$btn_turnos = '<button type="button" onclick="'.$onClick.'" title="Turnos" class="btn btn-default btn-circle" data-toggle="modal" data-target="#modal_turnos" data-whatever="@mdo"><i class="fa fa-calendar"></i></button>';
			break;
		case 5:
			$tipo="Secretaria";
			$color = "warning";
			break;
		case 6:
			$tipo="Cendopu";
			$color = "warning";
			$onClick="";
			$btn_turnos = '';
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

	$btn_rol = '<button type="button" onclick="ver_accesos('.$fila[0].');" title="Ver registro de '.$tipo.'" class="btn btn-'.$color.' btn-circle" data-toggle="modal" data-target="#modal_verRegistro" ><i class="fa fa-clock-o"></i></button>';

	$arrayData[]=array(
				$fila[1],
				$btn_rol." ".$nombre[0],
				$tipo,
				$estado,
				$fila[5],
				$btn_turnos.'
				<button type="button" onclick="cambiar_clave('.$fila[0].');" title="Cambiar Clave" class="btn btn-default btn-circle" data-toggle="modal" data-target="#modal_cambiarClave"><i class="fa fa-edit"></i></button>
				<button type="button" onclick="borrar_usuario('.$fila[0].',this);" title="Borrar usuario" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></button>
				'
				);
}
echo json_encode($arrayData);

$con->disconnect();
?>