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
*	function get_chart_x(sala,mes,contenedor)
*	@return: Grafica solicitada
*/
function get_chart(s,m,c,canvas,id){
	switch(id){
		case 1:
			var url = "../php/get_chart.php?method=fetchdata";
			var labels = 'horas';
		break;
		case 2:
			var url = "../php/get_chart.php?method=fetchdata";
			var labels = 'dias';
		break;
	}
	$.ajax({            
		    url: url,         
		    dataType: "json",			
			type: "POST",  
		    data: {
		    	s:s, 
		    	m:m,
		    	i:id
		    },                     
		    success: function(r){      
		    	//$("#"+c).html(r.table);
		    	graficar(canvas,r.rows,labels);
		        } 
		    });
}
function graficar(cv,dt,tlabl){
	var ctx = $("#"+cv).get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        switch(tlabl){
        	case "dias":
        	 var labels = ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo"];
        	break;
        	case "horas":
        	 var labels = ["08:00 - 09:59", "10:00 - 11:59", "12:00 - 13:59", "14:00 - 15:59", "16:00 - 17:59", "18:00 - 19:59", "20:00 - 21:00"];
        	break;
        }
        var data = {
            labels: labels,
            datasets: [
                {
                    label: "My First dataset",
                    fillColor: "rgba(220,220,220,0.5)",
                    strokeColor: "rgba(220,220,220,0.8)",
                    highlightFill: "rgba(220,220,220,0.75)",
                    highlightStroke: "rgba(220,220,220,1)",
                    data: dt
                }
            ]
        };
        var options = {
            //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
            scaleBeginAtZero : true,

            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines : true,

            //String - Colour of the grid lines
            scaleGridLineColor : "rgba(0,0,0,.05)",

            //Number - Width of the grid lines
            scaleGridLineWidth : 1,

            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,

            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,

            //Boolean - If there is a stroke on each bar
            barShowStroke : true,

            //Number - Pixel width of the bar stroke
            barStrokeWidth : 2,

            //Number - Spacing between each of the X value sets
            barValueSpacing : 5,

            //Number - Spacing between data sets within X values
            barDatasetSpacing : 1,

            responsive: false,
		    maintainAspectRatio: true,

            //String - A legend template
            legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"

        }
        var myNewChart = new Chart(ctx).Bar(data, options);
}
/*
*	function go_to
*   objetivo: carga contenidos a pedido
*	@return: contenido solicitado
*/
function go_to(cont,req,sala,canvas){
	var mes = $("#mes").val();
	switch(req){
		case "planilla":
			get_planilla(sala,mes,cont);
		break;
		case "e_x_h":
			get_chart(sala,mes,cont,canvas,1);
		break;
		case "e_x_d":
			get_chart(sala,mes,cont,canvas,2);
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