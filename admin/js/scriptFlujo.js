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

/*
*	CONJUNTO DE FUNCIONES ENCARGADAS DE GENERAR LOS DATOS PARA LOS REPORTES DE FLUJO MENSUAL
*/

/*
*	function get_planilla(sala,mes,contenedor)
*	@return: Planilla general de flujo mensual
*/
function get_planilla(s,m,c){
	$.ajax({            
		    url: "../php/get_planilla.php?method=fetchdata",         
		    dataType: "json",			
			type: "POST",  
		    data: {
		    	s:s, 
		    	m:m
		    },                     
		    success: function(r){      
		    	$("#"+c).html(r.table);
		        } 
		    });
}
/*
*	function go_to
*   objetivo: carga contenidos a pedido
*	@return: contenido solicitado
*/
function go_to(cont,req,sala){
	var mes = $("#mes").val();
	switch(req){
		case "planilla":
			get_planilla(sala,mes,cont);
		break;
	}
}
/*
*	function cbx_mes
*   objetivo: carga combo con los meses del semestre
*	@return: combo con meses
*/
function cbx_mes(){
	$.ajax({            
		    url: "../php/get_cbx_meses_semestre.php?method=fetchdata",         
		    dataType: "json",			
			type: "POST",                     
		    success: function(resp){      
		    	$("#combo_mes").html(resp.res);
		        } 
		    });
}