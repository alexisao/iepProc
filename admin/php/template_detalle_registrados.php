<?php
$htmlStr='
<div class="panel panel-default">
    <div class="panel-heading">
        Nombre Estudiante: <span class="label label-warning">'.$name.'</span> &nbsp;&nbsp;&nbsp; Recha Registro: <span class="label label-warning">'.$created.'</span>&nbsp;&nbsp;&nbsp;Total Actividades: <span class="label label-warning">'.$total.'</span>
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Ingreso</th>
                        <th>Sala - PC</th>
                        <th>Salida</th>
                        <th>Atendido Por</th>
                    </tr>
                </thead>
                <tbody>
                '.$tbody.'
                </tbody>
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.panel-body -->
</div>
';
?>