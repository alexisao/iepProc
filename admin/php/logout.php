<?php
session_start();
session_unset(); //borro todas las variables de session 
session_destroy();//destruyo la sesion 

$response = new StdClass;
$response->res = true;
$response->mes = "../pages/login.html";
echo json_encode($response);
?> 