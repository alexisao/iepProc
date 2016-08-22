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
$qry_us = 'SELECT * FROM tbl_turnos WHERE tu_us_id='.$usu.';';
$row_us = mysql_query($qry_us);
$cnt_us = mysql_num_rows($row_us);
if ($cnt_us>0) {
	#hay horarios en la tabla
  for ($i=0; $i < sizeof($dias); $i++) {
		# code...
		$html .= '
		<div class="col-lg-12">
		<div class="col-lg-3 text-right">'.$dias[$i].'</div>';
		for ($j=0; $j < $turnos; $j++) {
			# code...
      $html .= "<script type='text/javascript'>
              $('#ct_".$i."_".$j."').on('change', function() {
                  set_turn(".($i).",".($j).",$(this).val(),".$usu.");
              });</script>";
      $sql_turno = "SELECT * FROM tbl_turnos WHERE tu_us_id=".$usu." AND tu_dia=".$i." AND tu_turno=".$j.";";
      $turno_res = mysql_query($sql_turno);
      $cant_turnos = mysql_num_rows($turno_res);
      $turnos = mysql_fetch_assoc($turno_res);

        $s0="";
        $s1="";
        $s2="";
        $s3="";
        $s4="";
        if($cant_turnos>0){
          switch ($turnos['tu_espacio']) {
            case 0:
              $s0='selected';
              break;
            case 1:
              $s1='selected';
              break;
            case 2:
              $s2='selected';
              break;
            case 3:
              $s3='selected';
              break;
            case 4:
              $s4='selected';
              break;
          }
        }
        $html .= '	<div class="col-lg-3">
  					        <select class="form-control" id="ct_'.$i.'_'.$j.'">
  					            <option '.$s0.' value="0">Sin turno</option>
                        <option '.$s4.' value="4">Soporte</option>
  					            <option '.$s1.' value="1">Sala1</option>
  					            <option '.$s2.' value="2">Sala2</option>';
  			$html .= ($j==2) ? " " : '<option '.$s3.' value="3">Sala3</option>'; #restringimos sala 3 al turno de la noche

			$html .= '  </select>
					    </div>';
		}
		$html .= '</div>';
	}

}else{
	#sin horarios
	for ($i=0; $i < sizeof($dias); $i++) {
		# code...
		$html .= '
		<div class="col-lg-12">
		<div class="col-lg-3 text-right">'.$dias[$i].'</div>';
		for ($j=0; $j < $turnos; $j++) {
			# code...
      $html .= "<script type='text/javascript'>
              $('#ct_".$i."_".$j."').on('change', function() {
                  set_turn(".($i).",".($j).",$(this).val(),".$usu.");
              });</script>";
			$html .= '	<div class="col-lg-3">
					        <select class="form-control" id="ct_'.$i.'_'.$j.'">
					            <option value="0">Sin turno</option>
					            <option value="4">Soporte</option>
					            <option value="1">Sala1</option>
					            <option value="2">Sala2</option>';
			$html .= ($j==2) ? " " : '<option value="3">Sala3</option>'; #restringimos sala 3 al turno de la noche
			$html .= '  </select>
					    </div>';
		}
		$html .= '</div>';
	}
}
$arrayData->res=true;
$arrayData->mes="Carga satisfactoria";
$arrayData->bdy=$html;
echo json_encode($arrayData);

$con->disconnect();
?>
