<?php
session_start();

require("../php/funciones.php");

$fun = new funciones();
if(!$fun->isAjax()){header ("Location: ../pages/index.html");}

$con = new con();
$con->connect();

$e = $_POST["e"];

$response = new StdClass;

#arreglo de días de la semana
$dias = array('Lunes','Martes','Miercoles','Jueves','Viernes');
$icon = array('fa fa-sun-o', 'fa fa-clock-o', 'fa fa-moon-o');

$html = "";

$html .= '
<div class="dataTable_wrapper">
  <table class="table table-striped table-bordered table-hover" id="dataTables-example">
      <thead>
          <tr>
              <th></th>
              <th>Lunes</th>
              <th>Martes</th>
              <th>Miercoles</th>
              <th>Jueves</th>
              <th>Viernes</th>
          </tr>
      </thead>
      <tbody>';
      for ($i=0; $i < sizeof($icon); $i++) {
        # code...
        $html .= '<tr>
                    <td>Turno '.($i+1).'<!--<br> Inicio: <br>Fin: --></td>';
        for ($j=0; $j < sizeof($dias); $j++) {
          # code...
          $sql_tur = "SELECT T.tu_us_id, U.us_usuario, U.us_email FROM tbl_turnos AS T
                      INNER JOIN tbl_users AS U ON (U.us_id = T.tu_us_id)
                      WHERE T.tu_dia=".$j." AND T.tu_turno=".$i." AND T.tu_espacio=".$e.";";
          $sql_res = mysql_query($sql_tur);
          $sql_row = mysql_fetch_assoc($sql_res);
          $sql_cnt = mysql_num_rows($sql_res);
          if ($sql_cnt>0) {
            # code...
            $nombre = explode("@", $sql_row["us_email"]);
            $html .= '<td class="success">['.$sql_row["us_usuario"].']<br>'.$nombre[0].'</td>';
          }else{
            $html .= '<td>Sin Asignar</td>';
          }
        }
        $html .= '</tr>';
      }
$html .='</tbody>
  </table>
</div>
';
/*
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
*/
$arrayData->res=true;
$arrayData->mes="Carga satisfactoria";
$arrayData->bdy=$html;
echo json_encode($arrayData);

$con->disconnect();
?>
