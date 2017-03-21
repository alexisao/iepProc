<?php
session_start(); 

require("../php/funciones.php");

$fun = new funciones();
if(!$fun->isAjax()){header ("Location: ../pages/index.html");}

$con = new con();
$con->connect();

//Registro salida
$fun->make_history($_SESSION["ses_id"], false);

session_unset(); //borro todas las variables de session 
session_destroy();//destruyo la sesion 

$response = new StdClass;
$response->res = true;
$response->mes = "../pages/login.html";
echo json_encode($response);
?> 