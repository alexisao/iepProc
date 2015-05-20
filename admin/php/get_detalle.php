<?php 
session_start();

require("../php/funciones.php");

$fun = new funciones();
if(!$fun->isAjax()){header ("Location: ../pages/index.html");}

$id=$_POST['id'];
$tipo=$_POST['tipo'];

$con = new con();
$con->connect();

$response = new StdClass;

/*Consulta a la Bd*/
switch ($tipo) {
	case 1:
		$selectSQL ="SELECT * FROM tbl_servicios WHERE se_id=".$id.";";
		break;
	
	case 2:
		$selectSQL ="SELECT * FROM tbl_reservas WHERE re_id=".$id.";";
		break;
}


$row_cons = mysql_query($selectSQL);
$hideStr = 'class="hide"';

while ($fila = mysql_fetch_array($row_cons)) { 

	if($tipo==1){
		/* Solicitudes */
		$tp="Solicitud de Soporte técnico";
		$fecha=$fila[13];
		$desc=$fila[12];
		switch ($fila[14]) {
			case 1://mostrar solo leído
				$arrayHide = array('leido' => "",'proceso' => $hideStr, 'atendido' => $hideStr, 'completado' => $hideStr);
				$msgCompleted="";
				break;
			case 2://mostrar solo en proceso
				$arrayHide = array('leido' => $hideStr,'proceso' => "", 'atendido' => $hideStr, 'completado' => $hideStr);
				$msgCompleted="";
				break;
			case 3://mostrar solo en proceso
				$arrayHide = array('leido' => $hideStr,'proceso' => $hideStr, 'atendido' => "", 'completado' => $hideStr);
				$msgCompleted="";
				break;
			case 4://mostrar solo en proceso
				$arrayHide = array('leido' => $hideStr,'proceso' => $hideStr, 'atendido' => $hideStr, 'completado' => "");
				$msgCompleted="";
				break;
			case 5:// Mensaje de completado
				$arrayHide = array('leido' => $hideStr,'proceso' => $hideStr, 'atendido' => $hideStr, 'completado' => $hideStr);
				$msgCompleted = "Proceso completado satisfactoriamente.";
			
			default:
				# code...
				break;
		}
		$buttons="";
		include("template_detalle_solicitudes.php");
		$res = true;
		$mes = $htmlStr;
	}else{
		$res=false;
		$mes="Hubo un error al realizar la consulta, por favor comuniquese con el administrador del sistema y notifiquele el error";
	}
}

$response->res = $res;
$response->mes = $mes;
echo json_encode($response);

$con->disconnect();
?>
