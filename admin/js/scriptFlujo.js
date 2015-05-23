/*
*	function get_flujoData
*	@return: carga los contenidos de cada sala via AJAX
*/
function get_flujoData(){
	$.ajax({            
	    url: "../php/get_chartdata_flx.php?method=fetchdata",         
	    dataType: "json",                       
	    success: function(data){      
	    		var data = data;
	    		$("#s1").html(data.cajas[0]);
	        } 
	});
}
/*
*	function get_chardata_solicitudes
*	@return: array de conteos de solicitudes de servicio técnico y comunicaciones
*/
function get_chardata_solicitudes(opt){
	switch(opt){
		case 1:
			$.ajax({            
		    url: "../php/get_chartdata_sol.php?method=fetchdata",         
		    dataType: "json",                       
		    success: function(data){      
		    		var month_data = data;
				    Morris.Bar({
				        element: 'morris-area-chart-solicitudes',
				        data: month_data,
				        xkey: 'period',
				        ykeys: ['sop'],
				        labels: ['Soporte'],
				        pointSize: 2,
				        hideHover: 'auto',
				        resize: true
				    });
		        } 
		    });
		break;
		case 2:
			$.ajax({            
		    url: "../php/get_chartdata_sol_dia.php?method=fetchdata",         
		    dataType: "json",                       
		    success: function(data){      
		    		var month_data = data;
				    Morris.Area({
				        element: 'morris-area-chart-solicitudes-diarias',
				        data: month_data,
				        xkey: 'period',
				        ykeys: ['com', 'sop'],
				        labels: ['Comunicaciones', 'Soporte'],
				        pointSize: 2,
				        hideHover: 'auto',
				        resize: true
				    });
		        } 
		    });
		break;
	}
}