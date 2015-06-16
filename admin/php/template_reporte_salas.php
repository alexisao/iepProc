<?php
function buildBox($head,$id){
	$panel='
	<!-- /.col-lg-4 -->
	<div class="col-lg-4">
	    <!-- /.panel -->
	    <div class="panel panel-default">
	        <div class="panel-heading" id="btn_details" >
	            <i class="fa fa-bar-chart-o fa-fw"></i> '.$head.'
	        </div>
	        <div class="panel-body">
	            <div id="'.$id.'"></div>
	            
	        </div>
	        <!-- /.panel-body -->
	    </div>
	    <!-- /.panel -->
	    
	</div>
	<!-- /.col-lg-4 -->
';
return $panel;
}

function crearCajas(){
	$p ="";
	$arrayFranjas = array(
		'f1' => "08:00:00#09:59:59", 
		'f2' => "10:00:00#11:59:59", 
		'f3' => "13:00:00#14:59:59", 
		'f4' => "15:00:00#16:59:59", 
		'f5' => "17:00:00#18:59:59", 
		'f6' => "19:00:00#20:59:59", 
		);
	$i=0;
	foreach ($arrayFranjas as $v) {
		$h="Franja de ".$v;
		$id="morris-chart-".$i;
		$p.=buildBox($h, $id);
	    $i++;
	}
	return $p;
}
?>
