<?php 
session_start();

require("../php/funciones.php");
require("../semestre.php");

$fun = new funciones();
if(!$fun->isAjax()){header ("Location: ../pages/index.html");}

$con = new con();
$con->connect();

$response = new StdClass;

#traemos listado de programas
$array_plan = array(
3410 => "Profesional en Ciencias del Deporte",
3454 => "Licenciatura en Matemática Física - Presencial",
3456 => "Licenciatura en Biología Química - Presencial",
3458 => "Licenciatura en Educación Física y Salud",
3462 => "Licenciatura en Educación Primaria",
3464 => "Programa Académico en Recreación",
3465 => "Profesional en Estudios Políticos y Resolución de conflictos",
3466 => "Programa Académico en Recreación - Nocturno",
3467 => "Licenciatura en Educación Básica Enf en Ciencias Naturales y Educación Ambiental - Presencial",
3468 => "Licenciatura en Educación Básica Enf en Ciencias Naturales y Educación Ambiental – Semi-presencial",
3469 => "Licenciatura en Educación Básica Enf en Educación Matemática - Presencial",
3470 => "Licenciatura en Educación Básica Enf en Educación Matemática – Semi-presencial",
3484 => "Licenciatura en Educación Física y Deporte - Presencial",
3485 => "Licenciatura en Educación Física y Deporte – Semi-presencial",
3486 => "Licenciatura en Educación Popular- Semi-presencial nocturno",
3487 => "Licenciatura en Matemática Física - Presencial",
3488 => "Licenciatura en Matemática Física - Semi-presencial  </option>",
7405 => "Maestría en Educación - Énfasis en Educación Popular y Desarrollo Comunitario</option>",
7406 => "Maestría en Educación - Énfasis en Enseñanza de las Ciencias</option>",
7412 => "Maestría en Educación - Énfasis en Educación Matemática</option>",
7414 => "Maestría en Educación - Énfasis en Enseñanza de las Ciencias Naturales</option>",
7415 => "Maestría en Educación - Énfasis en Pedagogia del Entrenamiento Deportivo</option>",
7419 => "Maestría en Educación - Énfasis en Género, Educación Popular y Desarrollo</option>",
9405 => "Doctorado Interinstitucional en Educación</option>",
9999 => "Otro Plan");

$arr_key = array(
0 => "3410",
1 => "3454",
2 => "3456",
3 => "3458",
4 => "3462",
5 => "3464",
6 => "3465",
7 => "3466",
8 => "3467",
9 => "3468",
10 => "3469",
11 => "3470",
12 => "3484",
13 => "3485",
14 => "3486",
15 => "3487",
16 => "3488",
17 => "7405",
18 => "7406",
19 => "7412",
20 => "7414",
21 => "7415",
22 => "7419",
23 => "9405",
24 => "9999"
	);


#consultamos estudiantes por cada uno de los programas
#Construimos html
$html = '<div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr>
                        <th>Programa</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>';
for ($i=0; $i < sizeof($array_plan); $i++) { 
	# code...
	$html .= '<tr class="odd gradeX"  title="'.$array_plan[$arr_key[$i]].'">';
	$sql_est = "SELECT * FROM tbl_estudiantes WHERE es_plan=".$arr_key[$i].";";
	$sql_res = mysql_query($sql_est);
	$sql_can = mysql_num_rows($sql_res);
	$html .= "<td><i class='fa fa-angle-right'></i>   ".$arr_key[$i]." </td><td class='text-center'> ".$sql_can."</td>";
}
$html .= '</tbody></table></div>';
#resultado
	$res = $html;

$response->res=$res;
echo json_encode($response);

?>