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
$icon = array('fa fa-sun-o', 'fa fa-clock-o', 'fa fa-moon-o');

$html = '
<div class="col-lg-12">
    <div class="col-lg-3"></div>';
    for ($a=1; $a <= $turnos; $a++) {
    	# code...
    	$html .= '<div class="col-lg-3 text-center"><i class="'.$icon[$a-1].'"></i><br>Turno '.$a.'</div>';
    }

$html .= '
</div>
';

for ($i=0; $i < sizeof($dias); $i++) {
	# code...
	$html .= '
	<div class="col-lg-12">
	<div class="col-lg-3 text-right">'.$dias[$i].'</div>';
	for ($j=0; $j < $turnos; $j++) {
		# code...
    $sql_turno = "SELECT * FROM tbl_turnos WHERE tu_us_id=".$usu." AND tu_dia=".$i." AND tu_turno=".$j.";";
    $turno_res = mysql_query($sql_turno);
    $cant_turnos = mysql_num_rows($turno_res);
    $turns = mysql_fetch_assoc($turno_res);

      $html .= "<script type='text/javascript'>
      $('#ct_".$i."_".$j."').on('change', function() {
        set_turn(".($i).",".($j).",$(this).val(),".$usu.");
      });";
      if ($cant_turnos > 0) {
        # code...
        $html .= "$('#ct_".$i."_".$j."').val(".$turns["tu_espacio"].");";
      }

      $html .= "</script>";
      $html .= '	<div class="col-lg-3">
					        <select class="form-control" id="ct_'.$i.'_'.$j.'">
					            <option  value="0">Sin turno</option>
                      <option  value="4">Soporte</option>
					            <option  value="1">Sala1</option>
					            <option  value="2">Sala2</option>
  		                <option  value="3">Sala3</option>';
		$html .= '  </select>
				    </div>';
	}
	$html .= '</div>';
}

$arrayData->res=true;
$arrayData->mes="Carga satisfactoria";
$arrayData->bdy=$html;
echo json_encode($arrayData);

$con->disconnect();
?>
