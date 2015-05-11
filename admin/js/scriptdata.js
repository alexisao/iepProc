/*
*	Funciones que construyen la página
*/

/* 
*	Función build_menu 
*	@return: email del usuario activo en la sesión
*/
function build_menu(a){
	a=parseInt(a);
	switch(a){
		case 1:
			$('#index').removeClass('hide');
			$('#sol').removeClass('hide');
			$('#res').removeClass('hide');
			$('#flu').removeClass('hide');
			$('#reportes').removeClass('hide');
			$('#users-tab').removeClass('hide');
		break;
		case 2:
			$('#index').removeClass('hide');
			$('#sol').removeClass('hide');
			$('#res').removeClass('hide');
			$('#flu').removeClass('hide');
			$('#reportes').removeClass('hide');
		break;
		case 3:
			$('#index').removeClass('hide');
			$('#sol').removeClass('hide');
			$('#res-box').addClass('hide');
			$('#flu-box').addClass('hide');
			$('#obs-box').addClass('hide');
			$('#btn_details').addClass('hide');
		break;
		case 4:
			$('#index').removeClass('hide');
			$('#flu').removeClass('hide');
			$('#sol-box').addClass('hide');
			$('#res-box').addClass('hide');
			$('#btn_details').addClass('hide');
		break;
	}
}

/*
*	Funcition validarEmail(email)
*	@return: bool
*/
function validarEmail(correo) {
	if(correo.search("@correounivalle.edu.co") == -1){
		$("#email").css('background',"#FFD9DD");
		return false;
	}else{
		return true;
	}
}

/* 
*	Función get_user 
*	@return: email del usuario activo en la sesión
*/
function get_user(a){
	$.ajax({			
	url: "../php/session.php",			
	dataType: "json",			
	type: "POST",			
	data: {opt:"get_user"},			
	success: function(data){		
	if(data.res==true){					
		$(a).text(data.mes);
		build_menu(data.uid);
	}
	else{
		$(location).attr('href',data.mes); 
	}
	}});
}
/* 
*	Función get_aLotData 
*	@return: 
*/
function get_aLotData(id_sol,id_res,id_flu,id_obs){
	$.ajax({			
	url: "../php/get_alotdata.php",			
	dataType: "json",			
	type: "POST",			
	data: {},			
	success: function(data){		
	if(data.res==true){					
		$(id_sol).html(data.sol);
		$(id_res).html(data.reo);
		$(id_flu).html(data.flu);
		$(id_obs).html(data.obs);
	}
	else{
		growl("danger","Hay un problema con la carga de los datos");
	}
	}});
}
/* 
*	Función get_solicitudes
*	@return: arreglo para datatable con las solicitudes
*/
function get_solicitudes(oTable){
	$.ajax({			
	url: "../php/get_solicitudes.php?method=fetchdata",			
	dataType: "json",						
	success: function(data){		
		oTable.fnClearTable();
		for(var i = 0; i < data.length; i++) {
			oTable.fnAddData([
			data[i][0],
			data[i][1],
			data[i][2],
			data[i][3],
			data[i][4],
			data[i][5],
			data[i][6]
			]);
		} 
	}});
}
/* 
*	Función get_usuarios
*	@return: arreglo para datatable con las solicitudes
*/
function get_usuarios(oTable){
	$.ajax({			
	url: "../php/get_usuarios.php?method=fetchdata",			
	dataType: "json",						
	success: function(data){		
		oTable.fnClearTable();
		for(var i = 0; i < data.length; i++) {
			oTable.fnAddData([
			data[i][0],
			data[i][1],
			data[i][2],
			data[i][5]
			]);
		} 
	}});
}
/* 
*	Función get_observaciones
*	@return: arreglo para datatable con las observaciones
*/
function get_observaciones(oTable){
	$.ajax({			
	url: "../php/get_observaciones.php?method=fetchdata",			
	dataType: "json",						
	success: function(data){		
		oTable.fnClearTable();
		for(var i = 0; i < data.length; i++) {
			oTable.fnAddData([
			data[i][0],
			data[i][1],
			data[i][2],
			data[i][3],
			data[i][4],
			data[i][5]
			]);
		} 
	}});
}
/* 
*	Función get_reservas
*	@return: arreglo para datatable con las solicitudes
*/
function get_reservas(oTable){
	$.ajax({			
	url: "../php/get_reservas.php?method=fetchdata",			
	dataType: "json",						
	success: function(data){		
		oTable.fnClearTable();
		for(var i = 0; i < data.length; i++) {
			oTable.fnAddData([
			data[i][0],
			data[i][1],
			data[i][2],
			data[i][3],
			data[i][4],
			data[i][5],
			data[i][6]
			]);
		} 
	}});
}
/* 
*	Función get_registrados
*	@return: arreglo para datatable con los estudiantes registrados
*/
function get_registrados(oTable){
	$.ajax({			
	url: "../php/get_registrados.php?method=fetchdata",			
	dataType: "json",						
	success: function(data){		
		oTable.fnClearTable();
		for(var i = 0; i < data.length; i++) {
			oTable.fnAddData([
			data[i][0],
			data[i][1],
			data[i][2]
			]);
		} 
	}});
}
/* 
*	Función get_flujo
*	@return: arreglo para datatable con los estudiantes registrados
*/
function get_flujo(oTable,room){
	$.ajax({			
	url: "../php/get_flujo.php?method=fetchdata",		
	dataType: "json",			
	type: "POST",			
	data: {sala:room},	
	success: function(data){		
		oTable.fnClearTable();
		for(var i = 0; i < data.length; i++) {
			oTable.fnAddData([
			data[i][0],
			data[i][1],
			data[i][2],
			data[i][3]
			]);
		} 
	}});
}

/* 
*	Función registrar_estudiante 
*	@return: respuesta de la inserción del estudiante en la bd
*/
function registrar_estudiante(){
	$.ajax({			
	url: "../php/registrar_estudiante.php",			
	dataType: "json",			
	type: "POST",			
	data: {
			codigo:$("#codigo").val(),
			plan:$("#plan").val(),
			nombre:$("#nombre").val()
		},			
	success: function(data){		
	if(data.res==true){		
		growl("success",data.mes)
		$("#codigo").val('');
		$("#plan").val('');
		$("#nombre").val('');
		location.reload();
	}
	else{
		growl("danger",data.mes)
	}
	}});
	//location.reload();
}
/* 
*	Función registrar_llegada 
*	@return: respuesta de la inserción del estudiante en la bd
*/
function registrar_llegada(room){
	$.ajax({			
	url: "../php/registrar_llegada.php",			
	dataType: "json",			
	type: "POST",			
	data: {
			codigo:$("#codigo-s"+room).val(),
			pc:$("#pc-s"+room).val(),
			sala:room
		},			
	success: function(data){		
	if(data.res==true){		
		growl("success",data.mes)
		$("#codigo-s"+room).val('');
		$("#pc-s"+room).val('');
	}
	else{
		growl("danger",data.mes)
	}
	}});
	//location.reload();
}
/* 
*	Función registrar_observacion 
*	@return: respuesta de la inserción del estudiante en la bd
*/
function registrar_observacion(){
	$.ajax({			
	url: "../php/registrar_observacion.php",			
	dataType: "json",			
	type: "POST",			
	data: {
			observacion:$("#obs").val(),
			pc:$("#pc").val(),
			sala:$("#room").val()
		},			
	success: function(data){		
	if(data.res==true){		
		growl("success",data.mes)
		$("#pc").val('');
		$("#obs").val('');
	}
	else{
		growl("danger",data.mes)
	}
	}});
	//location.reload();
}
/* 
*	Función registrar_usuario 
*	@return: respuesta de la inserción del estudiante en la bd
*/
function registrar_usuario(){
	correo = $("#email").val();
	if(validarEmail(correo)){
		if($("#key").val()==$("#rkey").val()){
			$.ajax({			
			url: "../php/registrar_usuario.php",			
			dataType: "json",			
			type: "POST",			
			data: {
					rol:$("#rol").val(),
					id:$("#id").val(),
					rclave:$("#rkey").val(),
					clave:$("#key").val(),
					correo:$("#email").val()
				},			
			success: function(data){		
			if(data.res==true){		
				growl("success",data.mes)
			}
			else{
				growl("danger",data.mes)
			}
			}});
		}
		else{
			growl("danger","Contraseñas no coinciden");
		}		
	}else{growl("danger","El correo no es institucional");}
}
/* 
*	Función registrar_salida
*	@return: registro de la salida del estudiante
*/
function registrar_salida(cod,npc){
	bootbox.confirm("¿Está seguro que el estudiante con codigo "+npc+" es el que va a salir de la sala?", function(result) {
	  if(result){
	  	$.ajax({			
		url: "../php/registrar_salida.php",			
		dataType: "json",			
		type: "POST",			
		data: {id:cod, codigo:npc },			
		success: function(data){		
		if(data.res==true){		
			growl("success",data.mes);
			$("#codigo-s"+room).val('');
			$("#pc-s"+room).val('');
		}
		else{
			growl("danger",data.mes)
		}
		}});
		//location.reload();
	  }
	});	
}
/* 
*	Función registrar_atendido
*	@return: registro de la salida del estudiante
*/
function registrar_atendido(cod){
	bootbox.confirm("¿Está seguro?", function(result) {
	  if(result){
	  	$.ajax({			
		url: "../php/registrar_atendido.php",			
		dataType: "json",			
		type: "POST",			
		data: {id:cod },			
		success: function(data){		
		if(data.res==true){		
			growl("success",data.mes)
		}
		else{
			growl("danger",data.mes)
		}
		}});
	  }
	});	
}
/* 
*	Función borrar_registro
*	@return: eliminar registro de la bd
*/
function borrar_registro(cod,npc){
	bootbox.confirm("¿Está seguro que desea borrar la entrada del estudiante con codigo "+npc+"?", function(result) {
	  if(result){
	  	$.ajax({			
		url: "../php/borrar_entrada.php",			
		dataType: "json",			
		type: "POST",			
		data: {id:cod, codigo:npc },			
		success: function(data){		
		if(data.res==true){		
			RefreshTable("datatables-sala1", "../php/get_flujo.php");
			growl("success",data.mes);
			$("#codigo-s"+room).val('');
			$("#pc-s"+room).val('');
		}
		else{
			growl("danger",data.mes)
		}
		}});
	  }
	});	
}
/* 
*	Función borrar_observacion
*	@return: eliminar registro de la bd
*/
function borrar_observacion(cod){
	bootbox.confirm("¿Está seguro que desea borrar esta observación?", function(result) {
	  if(result){
	  	$.ajax({			
		url: "../php/borrar_observacion.php",			
		dataType: "json",			
		type: "POST",			
		data: {id:cod},			
		success: function(data){		
		if(data.res==true){		
			growl("success",data.mes)
			$("#codigo-s"+room).val('');
			$("#pc-s"+room).val('');
		}
		else{
			growl("danger",data.mes)
		}
		}});
	  }
	});	
}
/* 
*	Función cambiar_clave 
*	@return: id del usuario en el input hidden del modal
*/
function cambiar_clave(a){
	$("#id_usuario").val(a);
	$("#pass").val("");
	$("#r_pass").val("");
	$(".bg-info").fadeOut();
	$(".bg-danger").fadeOut();
}
/* 
*	Función cambiar_clave 
*	@return: id del usuario en el input hidden del modal
*/
function send_nuevaClave(){
	$("#send_nuevaClave").addClass("disabled");
	var id_us = $("#id_usuario").val();
	var pass = $("#pass").val();
	var rpass = $("#r_pass").val();
	if (pass.length>=5){
		if(pass==rpass){
		$.ajax({		
			url: "../php/change_pass.php",			
			dataType: "json",			
			type: "POST",			
			data: {	us:id_us, ps:pass },			
			success: function(data){		
			if(data.res==true){					
				//alert(data.mes);
				$(".bg-danger").fadeOut();
				$(".bg-info").html("<i class='fa fa-check'></i> Contraseña cambiada con éxito");
				$(".bg-info").fadeIn();
				setTimeout(function (){location.reload();},3000);
			}
		}});
	}else{
		$(".bg-danger").html("<i class='fa fa-warning'></i> Contraseñas no coinciden");
		$(".bg-danger").fadeIn();
		$(".bg-info").fadeOut();
		$("#send_nuevaClave").removeClass("disabled");
	}}else{
		$(".bg-danger").html("<i class='fa fa-warning'></i> La contraseña debe tener al menos 6 caractéres.");
		$(".bg-danger").fadeIn();
		$(".bg-info").fadeOut();
		$("#send_nuevaClave").removeClass("disabled");
	}

}
/* 
*	Función send_recuperar 
*	@return: confirmación de cambio de confirmacióntraseña
*/
function send_recuperar(){
	$("#send_recuperar").addClass("disabled");
	var r_email = $("#r_email").val();
	if(validarEmail(r_email)){
		$.ajax({		
			url: "../php/recovery_pass.php",			
			dataType: "json",			
			type: "POST",			
			data: {remail:r_email},			
			success: function(data){		
			if(data.res==true){					
				//alert(data.mes);
				$(".bg-info").html("<i class='fa fa-check'></i> En unos minutos podrá encontrar un mensaje en su correo <br>("+r_email+")<br>  un enlace que lo llevará al formulario de restauración de contraseña.");
				$(".bg-info").fadeIn();
				$(".bg-danger").fadeOut();
			}
		}});
	}else{
		$(".bg-danger").html("<i class='fa fa-warning'></i> Correo Inválido: Debe ser @correounivalle.edu.co");
		$(".bg-danger").fadeIn();
		$(".bg-info").fadeOut();
		$("#send_recuperar").removeClass("disabled");
	}
}

/* 
*	Action logout 
*	@return: destroy session
*/
function logout(){
	$.ajax({			
	url: "../php/logout.php",			
	dataType: "json",			
	type: "POST",			
	data: {},			
	success: function(data){		
	if(data.res==true){					
		$(location).attr('href',data.mes); 
	}
	}});
}
function recargar(){
	location.reload();
}
/*
*	RefreshTable function 
* 	return RefreshTable
*/
function RefreshTable(tableId, urlData)
    {
    	alert("hi");
      //Retrieve the new data with $.getJSON. You could use it ajax too
      $.getJSON(urlData, null, function( json )
      {
        table = $("#"+tableId).dataTable();
        oSettings = table.fnSettings();

        table.fnClearTable(this);

        for (var i=0; i<json.aaData.length; i++)
        {
          table.oApi._fnAddData(oSettings, json.aaData[i]);
        }

        oSettings.aiDisplay = oSettings.aiDisplayMaster.slice();
        table.fnDraw();
      });
    }

/*
*	Growl function 
* 	return growl alert
*/
function growl(tipo,mes,reload){
	//alert(" tipo: "+tipo+" mes: "+mes+" reload: "+reload);
	switch(tipo){
		/* Alert simple */
		case "info":
			ico = "<i class='fa fa-info-circle'></i>"
			title = " <strong> Mensaje: </strong><br>"
			t=tipo
		break;
		/* Alert exito */
		case "success":
			ico = "<i class='fa fa-check-circle'></i>"
			title = " <strong> Esto es bueno: </strong><br>"
			t=tipo
		break;
		/* Alert aviso */
		case "warning":
			ico = "<i class='fa fa-warning'></i>"
			title = " <strong> Cuidado: </strong><br>"
			t=tipo
		break;
		/* Alert aviso */
		case "danger":
			ico = "<i class='fa fa-times-circle'></i>"
			title = " <strong> Algo no va bien: </strong><br>"
			t=tipo
		break;
	}
	$.growl(ico+title+mes, {
		type: t,
		animate: {enter: 'animated flipInY',exit: 'animated flipOutX'}
	});
	if(!reload){
		//setTimeout ("recargar()", 3500); 
	}
}
/*
*	function get_chardata_solicitudes
*	@return: array de conteos de solicitudes de servicio técnico y comunicaciones
*/
function get_chardata_solicitudes(){

	$.ajax({            
    url: "../php/get_chartdata_sol.php?method=fetchdata",         
    dataType: "json",                       
    success: function(data){      
    		var month_data = data;
		    Morris.Line({
		        element: 'morris-area-chart-solicitudes',
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
}
/*
*	function get_chardata_d_sol
*	@return: array de conteos de solicitudes de servicio técnico y comunicaciones [Donut chart]
*/
function get_chardata_d_sol(){
	
	$.ajax({            
    url: "../php/get_chartdata_donut.php?method=fetchdata",         
    dataType: "json",                       
    success: function(data){      
    		var sala_data = data;
		    Morris.Donut({
		        element: 'morris-donut-chart-solicitudes',
		        data: sala_data,
		        resize: true
		    });
        } 
    });
}
/*
*	function get_chardata
*	@return: array de ingresos a la sala en la semana
*/
function get_chardata(){

	$.ajax({            
    url: "../php/get_chartdata.php?method=fetchdata",         
    dataType: "json",                       
    success: function(data){      
    		var month_data = data;
		    Morris.Line({
		        element: 'morris-area-chart',
		        data: month_data,
		        xkey: 'period',
		        ykeys: ['sala1', 'sala2', 'sala3'],
		        labels: ['sala1', 'sala2', 'sala3'],
		        pointSize: 2,
		        hideHover: 'auto',
		        resize: true
		    });
        } 
    });
}
function get_chardata_d(){
	$.ajax({            
    url: "../php/get_chartdata_donut.php?method=fetchdata",         
    dataType: "json",                       
    success: function(data){      
    		var sala_data = data;
		    Morris.Donut({
		        element: 'morris-donut-chart',
		        data: sala_data,
		        resize: true
		    });
        } 
    });
}


$(document).on("click", "#llegada_sala1", function(event){
	registrar_llegada(1);
});
$(document).on("click", "#llegada_sala2", function(event){
	registrar_llegada(2);
});
$(document).on("click", "#llegada_sala3", function(event){
	registrar_llegada(3);
});
$(document).on("click", "#registrar-observacion", function(event){
	registrar_observacion();
});
$(document).on("click", "#registrar-usuario", function(event){
	registrar_usuario();
});
$(document).on("click", "#registrar-estudiante", function(event){
	registrar_estudiante();
});
$(document).on("click", "#send_recuperar", function(event){
	send_recuperar();
});
$(document).on("click", "#send_nuevaClave", function(event){
	send_nuevaClave();
});
$(document).on("click", "#btn-logout", function(event){
	logout();
});