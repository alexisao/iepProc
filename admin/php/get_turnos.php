<?php 
session_start();

require("../php/funciones.php");

$fun = new funciones();
if(!$fun->isAjax()){header ("Location: ../pages/index.html");}

$con = new con();
$con->connect();

$response = new StdClass;

#traemos usuario
$usu = $_POST['id'];

#arreglo de turnos
$turnos = 3;

#arreglo de días de la semana
$dias = array('Lunes','Martes','Miercoles','Jueves','Viernes');

$html = '
<div class="col-lg-12">
    <div class="col-lg-3"></div>';
    for ($a=1; $a <= $turnos; $a++) { 
    	# code...
    	$html .= '<div class="col-lg-3">Turno '.$a.'</div>';
    }
    
$html .= '
</div>
';


#Revisamos si hay horarios existentes para este usuario
$qry_us = 'SELECT tu_id FROM tbl_turnos WHERE tu_us_id='.$usu.';';
$row_us = mysql_query($qry_us);
$cnt_us = mysql_num_rows($row_us);

if ($cnt_us>0) {
	#hay horarios en la tabla

}else{
	#sin horarios
	for ($i=0; $i < sizeof($dias); $i++) { 
		# code...
		$html .= '	
		<div class="col-lg-12">
		<div class="col-lg-3 text-right">'.$dias[$i].'</div>';
		for ($j=0; $j < $turnos; $j++) { 
			# code...
			$html .= '	<div class="col-lg-3">
					        <select class="form-control" id="ct_'.$i.'_'.$j.'">
					            <option value="0">Sin turno</option>
					            <option value="1">Sala1</option>
					            <option value="2">Sala2</option>';
			$html .= ($j==2) ? " " : '<option value="3">Sala3</option>'; #restringimos sala 3 al turno de la noche
			$html .= '      </select>
					    </div>';
		}
		$html .= '</div>';
	}
}










/*Consulta a la Bd*/
/*$selectSQL ="SELECT * FROM tbl_users WHERE us_estado<>99; ";

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

	$btn_rol = '<button type="button" title="'.$tipo.'" class="btn btn-'.$color.' btn-circle"><i class="fa fa-user"></i></button>';

	$arrayData[]=array(
				$fila[1],
				$btn_rol." ".$nombre[0],
				$tipo,
				$estado,
				$fila[5],
				$btn_turnos.'
				<button type="button" onclick="cambiar_clave('.$fila[0].');" title="Cambiar Clave" class="btn btn-default btn-circle" data-toggle="modal" data-target="#modal_cambiarClave" data-whatever="@mdo"><i class="fa fa-edit"></i></button>
				<button type="button" onclick="borrar_usuario('.$fila[0].',this);" title="Borrar usuario" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></button>
				'
				);
}*/
$arrayData->res=true;
$arrayData->mes="Carga satisfactoria";
$arrayData->bdy=$html;
echo json_encode($arrayData);

$con->disconnect();
?>