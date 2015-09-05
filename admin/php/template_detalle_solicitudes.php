<?php
$htmlStr='
<p>
	<div><strong>Fecha de Solicitud: </strong><span>'.$fecha.'</span></div>
	<div><strong>Tipo de Solicitud: </strong><span>'.$tp.'</span></div>
	<div><strong>Descripci&oacute;n: </strong><br><span>'.$desc.'</span></div>
	<hr>
	<button type="button" '.$arrayHide["leido"].' onclick="cambiar_estado('.$id.',2,1);" title="Leído" id="leido" class="btn btn-warning"><i class="fa fa-check"></i> Leído </button>
	<button type="button" '.$arrayHide["proceso"].' onclick="cambiar_estado('.$id.',3,1);" title="En Proceso" id="enproceso" class="btn btn-info "><i class="fa fa-check"></i> En proceso</button>
	<button type="button" '.$arrayHide["atendido"].' onclick="cambiar_estado('.$id.',4,1);" title="Atendido" id="atendido" class="btn btn-primary "><i class="fa fa-check"></i> Atendido</button>
	<button type="button" '.$arrayHide["completado"].' onclick="cambiar_estado('.$id.',5,1);" title="Completado" id="completado" class="btn btn-success "><i class="fa fa-check"></i> Completado</button>
	'.$msgCompleted.'
</p>
';
?>