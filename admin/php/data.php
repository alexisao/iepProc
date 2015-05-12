<?php
session_start();
error_reporting(2|4);
//echo "nombre".$_SESSION["us_nombre"];
//miramos que hay en las variables de sesion
if(isset($_SESSION["ses_id"]))
	{
		$s_id=$_SESSION["ses_id"];
		$s_email=$_SESSION["ses_email"];
	}
	else{
		header ("Location: index.php");
	}
?>
