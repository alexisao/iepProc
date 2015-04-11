<?php
require("../admin/php/db.php");
require("../admin/php/funciones.php");
date_default_timezone_set('America/Bogota');

$tipoSol=$_POST['tipoSol'];
$nombre=$_POST['nombre'];
$cargo=$_POST['cargo'];
$tid=$_POST['tid'];
$id=$_POST['id'];
$edificio=$_POST['edificio'];
$oficina=$_POST['oficina'];
$tel=$_POST['tel'];
$ext=$_POST['ext'];
$email=$_POST['email'];
$descripcion=$_POST['descripcion'];

$fecha= date('Y-m-d');
$hora= date("h:i:s");

$email .= "@correounivalle.edu.co";

switch ($tipoSol) {
	case 1:
		$para="uno.choco@gmail.com";
		$tipo_servicio = "Soporte T&eacute;cnico";
		break;
	case 2:
		$para="dos.choco@gmail.com";
		$tipo_servicio = "Servicio - Comunicaciones";
		break;
}

switch ($tid) {
	case 1:
		$tipo_id="CC";
		break;

	case 2:
		$tipo_id="TI";
		break;

	case 3:
		$tipo_id="TE";
		break;

	case 4:
		$tipo_id="PA";
		break;
}

$titulo = "Solicitud de ".$tipo_servicio;

$html = '
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#999;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#999;color:#444;background-color:#F7FDFA;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;border-color:#999;color:#fff;background-color:#26ADE4;}
.tg .tg-vn4c{background-color:#D2E4FC}
</style>
<table class="tg">
  <tr>
    <th class="tg-031e" colspan="4">'.$titulo.'</th>
  </tr>
  <tr>
    <td class="tg-vn4c" colspan="2"><strong>Fecha: </strong>'.$fecha.'</td>
    <td class="tg-vn4c" colspan="2"><strong>Hora: </strong>'.$hora.'</td>
  </tr>
  <tr>
    <td class="tg-031e" colspan="4"><strong>Nombre: </strong>'.$nombre.'</td>
  </tr>
  <tr>
    <td class="tg-vn4c" colspan="4"><strong>Cargo: </strong>'.$cargo.'</td>
  </tr>
  <tr>
    <td class="tg-031e" colspan="2"><strong>Tipo ID: </strong>'.$tipo_id.'</td>
    <td class="tg-031e" colspan="2"><strong>N&uacute;mero: </strong>'.$id.'</td>
  </tr>
  <tr>
    <td class="tg-vn4c"><strong>Edificio: </strong>'.$edificio.'</td>
    <td class="tg-vn4c"><strong>Oficina: </strong>'.$oficina.'</td>
    <td class="tg-vn4c"><strong>Tel&eacute;fono: </strong>'.$tel.'</td>
    <td class="tg-vn4c"><strong>Extensi&oacute;n</strong>'.$ext.'</td>
  </tr>
  <tr>
    <td class="tg-031e" colspan="4"><strong>Correo Institucional: </strong>'.$email.'</td>
  </tr>
  <tr>
    <td class="tg-vn4c" colspan="4"><strong>Descripcion de la Solicitud:<br></strong>'.$descripcion.'</td>
  </tr>
</table>
';

$mensaje = $html;

$con = new con();
$con->connect();

$fx = new funciones();
$response = new StdClass;

$sql="INSERT INTO tbl_servicios (se_tipo_sol, se_nombre, se_cargo, se_tid, se_nid, se_edificio, se_oficina, se_tel, se_ext, se_email, se_desc, se_log_fecha, se_estado) 
			  VALUES (".$tipoSol.",'".$nombre."','".$cargo."',".$tid.",".$id.",".$edificio.",".$oficina.",".$tel.",".$ext.",'".$email."','".$descripcion."',NOW(),1)";

		  
if(mysql_query($sql)){
	if(!$fx->enviar_email($para, $titulo, $mensaje))
	{	
		//mail($fw_para, $fw_titulo, $fw_mensaje, $fw_cabeceras);
		$response->res = "true";
		$response->msg = 'Enviado Satisfactoriamente.';/*
	}else{
		$response->msg = 'Hubo problemas al enviar su solicitud, favor intentar m&aacute;s tarde.';
		$response->res = "false";*/
	}
}
else{
	$response->msg = 'Hubo problemas al procesar su solicitud, revise los campos e intentelo de nuevo';
	$response->res = "false";
}

echo json_encode($response);
?>