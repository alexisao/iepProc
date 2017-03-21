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
	case 3:
		$selectSQL ="Select F.*, E.es_nombre, E.es_codigo, E.es_fecha_registro, U.us_id, U.us_email
					FROM tbl_flujo_estudiantes AS F
					INNER JOIN tbl_estudiantes AS E ON F.fe_es_codigo=E.es_codigo
					INNER JOIN tbl_users AS U ON F.fe_monitor=U.us_id
					WHERE F.fe_es_codigo = ".$id." AND
					F.fe_Estado<10";
		break;
	case 4:
		$selectSQL = "SELECT * FROM tbl_historial_accesos WHERE ha_us_id=".$id." ORDER BY ha_id DESC;";
		break;

}

$row_cons = mysql_query($selectSQL);
$hideStr = 'class="hide"';
$i=1;
$tbody="";
$htmlStr="";

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
	}elseif ($tipo==3) {
		$name=$fila[10];
		$created=$fila[12];
		$total=$i;
		if($fila[5]===NULL){$salida='<span class="label label-success">En Sala</span>';}else{$salida=$fila[5];}
		$tbody.='<tr>
                    <td>'.$i++.'</td>
                    <td>'.$fila[6].'</td>
                    <td>'.$fila[2].' - '.$fila[3].'</td>
                    <td>'.$salida.'</td>
                    <td>'.$fila[14].'</td>
               	   </tr>';			
	}elseif ($tipo==4) {
		if($fila[3]===NULL){$salida='<span class="label label-success">Conectado</span>';}else{$salida=$fila[3];}
		$htmlStr.='<tr>
                    <td>'.$i++.'</td>
                    <td>'.$fila[2].'</td>
                    <td>'.$salida.'</td>
                    <td>'.$fila[4].'</td>
               	   </tr>';
	}else{
		$res=false;
		$mes="Hubo un error al realizar la consulta, por favor comuniquese con el administrador del sistema y notifiquele el error";
	}
}

if($tipo==3){
	include("template_detalle_registrados.php");
	$res = true;
	$mes = $htmlStr;
}
if($tipo==4){
	$res = true;
	$mes = $htmlStr;
}


$response->res = $res;
$response->mes = $mes;
echo json_encode($response);

$con->disconnect();
?>
