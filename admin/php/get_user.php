<?php
include_once('session.php');

$response = new StdClass;

$res = true;
$mes = $s_email;
$uid = $s_tipo;

$response->res = $res;
$response->mes = $mes;
$response->uid = $uid;
//echo json_encode($response);
?>