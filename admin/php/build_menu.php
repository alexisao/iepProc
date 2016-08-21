<?php
session_start();
//error_reporting(2|4);
$search = '<li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Buscar...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>';

$menu_super = $search.'
        <li>
            <a href="index.html"><i class="fa fa-dashboard fa-fw"></i> Inicio</a>
        </li>
        <li>
            <a href="solicitudes.html"><i class="fa fa-inbox fa-fw"></i> Solicitudes</a>
        </li>
        <li>
            <a href="reservas.html"><i class="fa fa-calendar fa-fw"></i> Reservas</a>
        </li>
        <li>
            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Flujo<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li><a href="fregistro.html"><i class="fa fa-users fa-fw"></i> Registro de Estudiantes</a></li>
                <li><a href="flujo.html"><i class="fa fa-retweet fa-fw"></i> Ver Flujos</a></li>
                <li><a href="observaciones.html"><i class="fa fa-comments fa-fw"></i> Observaciones</a></li>
            </ul>
            <!-- /.nav-second-level -->
        </li>
        <li>
            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Reportes<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li><a href="rsolicitudes.html"><i class="fa fa-bar-chart-o fa-fw"></i>Solicitudes</a></li>
                <li><a href="rreservas.html"><i class="fa fa-bar-chart-o fa-fw"></i>Reservas</a></li>
                <li><a href="rflujo.html"><i class="fa fa-bar-chart-o fa-fw"></i>Flujo - Salas</a></li>
                <li><a href="robservaciones.html"><i class="fa fa-bar-chart-o fa-fw"></i>Observaciones</a></li>
            </ul>
            <!-- /.nav-second-level -->
        </li>
        <li>
            <a href="usuarios.html"><i class="fa fa-user fa-fw"></i> Usuarios</a>
        </li>
';
$menu_cendopu = $search.'
		<li>
         	<a href="index.html"><i class="fa fa-dashboard fa-fw"></i> Inicio</a>
        </li>
        <li>
            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Cendopu<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li><a href="fregistro.html"><i class="fa fa-users fa-fw"></i> Registro de Estudiantes</a></li>
            </ul>
            <!-- /.nav-second-level -->
        </li>
        <li>
            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Reportes<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li><a href="rsolicitudes.html"><i class="fa fa-bar-chart-o fa-fw"></i>Solicitudes</a></li>
                <li><a href="rreservas.html"><i class="fa fa-bar-chart-o fa-fw"></i>Reservas</a></li>
                <li><a href="rflujo.html"><i class="fa fa-bar-chart-o fa-fw"></i>Flujo - Salas</a></li>
                <li><a href="robservaciones.html"><i class="fa fa-bar-chart-o fa-fw"></i>Observaciones</a></li>
            </ul>
            <!-- /.nav-second-level -->
        </li>
        <li>
            <a href="usuarios.html"><i class="fa fa-user fa-fw"></i> Usuarios</a>
        </li>
';
$menu_comunicaciones = $search.'
		<li>
         	<a href="index.html"><i class="fa fa-dashboard fa-fw"></i> Inicio</a>
        </li>
        <li>
            <a href="solicitudes.html"><i class="fa fa-inbox fa-fw"></i> Solicitudes</a>
        </li>
        <li>
            <a href="reservas.html"><i class="fa fa-calendar fa-fw"></i> Reservas</a>
        </li>
        <li>
            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Flujo en Salas<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li><a href="fregistro.html"><i class="fa fa-bar-chart-o fa-fw"></i>Registro de Estudiantes</a></li>
                <li><a href="flujo.html.html"><i class="fa fa-bar-chart-o fa-fw"></i>Ver Flujos</a></li>
                <li><a href="observaciones.html"><i class="fa fa-bar-chart-o fa-fw"></i>Observaciones</a></li>
            </ul>
            <!-- /.nav-second-level -->
        </li>
        <li>
            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Reportes<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li><a href="rsolicitudes.html"><i class="fa fa-bar-chart-o fa-fw"></i>Solicitudes</a></li>
                <li><a href="rreservas.html"><i class="fa fa-bar-chart-o fa-fw"></i>Reservas</a></li>
                <li><a href="rflujo.html"><i class="fa fa-bar-chart-o fa-fw"></i>Flujo - Salas</a></li>
                <li><a href="robservaciones.html"><i class="fa fa-bar-chart-o fa-fw"></i>Observaciones</a></li>
            </ul>
            <!-- /.nav-second-level -->
        </li>
        <li>
            <a href="usuarios.html"><i class="fa fa-user fa-fw"></i> Usuarios</a>
        </li>
';


$response = new StdClass;
if(isset($_SESSION["ses_id"]))
	{
			
		switch ($_SESSION["ses_tipo"]) {
			case 1:
				$menu=$menu_super;
				break;
			case 2:
				$menu=$menu_super;
				break;
			case 3:
				$menu=$menu_comunicaciones;
				break;
            case 3:
                $menu=$menu_monitor;
                break;
			case 6:
				$menu=$menu_cendopu;
				break;
			
			default:
				$menu="Press F5";
				break;
		}
		$res = true;	
		$mes = $menu;
	}
	else{
		$res = false;
		$mes = "../pages/login.html";
	}

	$response->res = $res;
	$response->mes = $mes;

echo json_encode($response);

?>