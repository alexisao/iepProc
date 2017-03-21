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
			$('#cendopu-tab').addClass('hide');
		break;
		case 2:
			$('#index').removeClass('hide');
			$('#sol').removeClass('hide');
			$('#res').removeClass('hide');
			$('#flu').addClass('hide');
			$('#reportes').removeClass('hide');
			$('#cendopu-tab').addClass('hide');
		break;
		case 3:
			$('#index').removeClass('hide');
			$('#sol').removeClass('hide');
			$('#res-box').addClass('hide');
			$('#flu-box').addClass('hide');
			$('#obs-box').addClass('hide');
			$('#btn_details').addClass('hide');
			$('#cendopu-tab').addClass('hide');
		break;
		case 4:
			$('#index').removeClass('hide');
			$('#flu').removeClass('hide');
			$('#sol-box').addClass('hide');
			$('#res-box').addClass('hide');
			$('#btn_details').addClass('hide');
			$('#cendopu-tab').addClass('hide');
		break;
		case 5:
			$('#index').removeClass('hide');
			$('#res').removeClass('hide');
			$('#sol-box').addClass('hide');
			$('#res-box').addClass('hide');
			$('#flu-box').addClass('hide');
			$('#obs-box').addClass('hide');
			$('#btn_details').addClass('hide');
			$('#cendopu-tab').addClass('hide');
		break;
		case 6:
			$('#index').addClass('hide');
			$('#res').addClass('hide');
			$('#sol-box').addClass('hide');
			$('#res-box').addClass('hide');
			$('#flu-box').addClass('hide');
			$('#obs-box').addClass('hide');
			$('#btn_details').addClass('hide');
			$('#li_flujo').addClass('hide');
			$('#cendopu-tab').removeClass('hide');
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
			//data[i][2],
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
*	Función get_estudiante
*	@return: JSON con información de usuarios relacionados con la busqueda ingresada.
*/
function get_estudiante(str, obj){
	$.ajax({
	url: "../php/get_registrados.php?method=fetchdata",
	dataType: "json",
	type:'POST',
	data:{dt:str},
	success: function(data){
		build_resp(data, obj);
	}});
}

function build_resp(dt, obj)
{
	obj.fnClearTable();
		for(var i = 0; i < dt.length; i++) {
			obj.fnAddData([
			dt[i][0],
			dt[i][1],
			dt[i][2]
			]);
		}
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
		var oTable = $('#datatables-registrados').dataTable({
            responsive: true,
            language: {
                "url": "http://cdn.datatables.net/plug-ins/a5734b29083/i18n/Spanish.json"
            }
        });
        get_registrados(oTable);
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
		location.reload();
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
		var oTable = $('#datatables-observaciones').dataTable({
            responsive: true,
            language: {
                "url": "http://cdn.datatables.net/plug-ins/a5734b29083/i18n/Spanish.json"
            }
        });
        get_observaciones(oTable);
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
				growl("success",data.mes);
				$('#form-nuevoest').trigger("reset");
				var oTable = $('#datatables-observaciones').dataTable({responsive: true});
        		get_usuarios(oTable);
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
function registrar_salida(cod,npc,obj){
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
			$("#"+obj.id).closest('tr').fadeOut();
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
function registrar_atendido(cod,obj){
	bootbox.confirm("¿Está seguro?", function(result) {
	  if(result){
	  	$.ajax({
		url: "../php/registrar_atendido.php",
		dataType: "json",
		type: "POST",
		data: {id:cod },
		success: function(data){
		if(data.res==true){
			growl("success",data.mes);
			$("#"+obj.id).closest('tr').fadeOut();
		}
		else{
			growl("danger",data.mes)
		}
		}});
	  }
	});
}
/*
*	Función borrar_estudiante
*	@return: eliminar registro de la bd
*/
function borrar_estudiante(cod,npc,obj){
	bootbox.confirm("¿Está seguro que desea borrar al estudiante con codigo "+npc+"?", function(result) {
	  if(result){
	  	$.ajax({
		url: "../php/borrar_estudiante.php",
		dataType: "json",
		type: "POST",
		data: {id:cod },
		success: function(data){
		if(data.res==true){
			growl("success",data.mes);
			$("#"+obj.id).closest('tr').fadeOut()
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
function borrar_registro(cod,npc,obj){
	bootbox.confirm("¿Está seguro que desea borrar la entrada del estudiante con codigo "+npc+"?", function(result) {
	  if(result){
	  	$.ajax({
		url: "../php/borrar_entrada.php",
		dataType: "json",
		type: "POST",
		data: {id:cod, codigo:npc },
		success: function(data){
		if(data.res==true){
			growl("success",data.mes);
			$("#"+obj.id).closest('tr').fadeOut()
		}
		else{
			growl("danger",data.mes)
		}
		}});
	  }
	});
}
/*
*	Función borrar_usuario
*	@return: eliminar registro de la bd
*/
function borrar_usuario(cod,obj){
	bootbox.confirm("¿Está seguro que desea borrar este usuario?", function(result) {
	  if(result){
	  	$.ajax({
		url: "../php/borrar_usuario.php",
		dataType: "json",
		type: "POST",
		data: {codigo:cod },
		success: function(data){
		if(data.res==true){
			growl("success",data.mes);
			$("#"+obj.id).closest('tr').fadeOut()
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
function borrar_observacion(cod,obj){
	bootbox.confirm("¿Está seguro que desea borrar esta observación?", function(result) {
	  if(result){
	  	$.ajax({
		url: "../php/borrar_observacion.php",
		dataType: "json",
		type: "POST",
		data: {id:cod},
		success: function(data){
		if(data.res==true){
			growl("success",data.mes);
			$("#"+obj.id).closest('tr').fadeOut();
		}
		else{
			growl("danger",data.mes)
		}
		}});
	  }
	});
}

/*
*	Función turnos
*	@return: grid de turnos para modificar por usuario
*/
function turnos(a, n){
	$("#id_us").val(a);
	$("#nombre_monitor").text(n);
	$.ajax({
		url: "../php/get_turnos.php",
		dataType: "json",
		type: "POST",
		data: {id:a},
		success: function(data){
		if(data.res==true){
			growl("success",data.mes);
			$("#turnos_body").empty();
			$("#turnos_body").html(data.bdy);
		}
		else{
			growl("danger",data.mes)
		}
	}});
	$(".bg-info").fadeOut();
	$(".bg-danger").fadeOut();
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
function refresh(fn){
	var time = 2000;
	setInterval( function () {
	    fn
	}, time);
}
/*
*	RefreshTable function
* 	return RefreshTable
*/
function RefreshTable(tableId, urlData)
    {
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
*	function get_chardata_observaciones
*	@return: array de conteos de observaciones
*/
function get_chardata_observaciones(opt){
	switch(opt){
		case 1:
			$.ajax({
		    url: "../php/get_chartdata_obs.php?method=fetchdata",
		    dataType: "json",
		    success: function(data){
		    		var month_data = data;
				    Morris.Bar({
				        element: 'morris-area-chart-observaciones',
				        data: month_data,
				        xkey: 'period',
				        ykeys: ['com','sop'],
				        labels: ['Observaciones pendientes','Observaciones completadas'],
				        pointSize: 2,
				        hideHover: 'auto',
				        resize: true
				    });
		        }
		    });
		break;
		case 2:
			$.ajax({
		    url: "../php/get_chartdata_obs_dia.php?method=fetchdata",
		    dataType: "json",
		    success: function(data){
		    		var month_data = data;
				    Morris.Line({
				        element: 'morris-area-chart-observaciones-diarias',
				        data: month_data,
				        xkey: 'period',
				        ykeys: ['obsol', 'obcom'],
				        labels: ['Obs. completadas', 'Obs. pendientes'],
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
*	function get_chardata_solicitudes
*	@return: array de conteos de solicitudes de servicio técnico y comunicaciones
*/
function get_chardata_reservas(opt){
	switch(opt){
		case 1:
			$.ajax({
		    url: "../php/get_chartdata_res.php?method=fetchdata",
		    dataType: "json",
		    success: function(data){
		    		var month_data = data;
				    Morris.Bar({
				        element: 'morris-area-chart-reservas',
				        data: month_data,
				        xkey: 'period',
				        ykeys: ['computo','clases'],
				        labels: ['Salon de Cómputo','Salon de Clases'],
				        pointSize: 2,
				        hideHover: 'auto',
				        resize: true
				    });
		        }
		    });
		break;
		case 2:
			$.ajax({
		    url: "../php/get_chartdata_res_dia.php?method=fetchdata",
		    dataType: "json",
		    success: function(data){
		    		var month_data = data;
				    Morris.Line({
				        element: 'morris-area-chart-reservas-diarias',
				        data: month_data,
				        xkey: 'period',
				        ykeys: ['computo','clases'],
				        labels: ['Sala de Cómputo','Salon de Clases'],
				        pointSize: 2,
				        hideHover: 'auto',
				        resize: true
				    });
		        }
		    });
		break;
		case 3:
			$.ajax({
		    url: "../php/get_chartdata_res_dia_cendopu.php?method=fetchdata",
		    dataType: "json",
		    success: function(data){
		    		var month_data = data.dt;
				    Morris.Line({
				        element: 'morris-area-chart-reservas-diarias',
				        data: month_data,
				        xkey: 'period',
				        ykeys: ['computo'],
				        labels: ['Sala de Cómputo'],
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
*	function get_chardata_exp
*	@return: html de conteos de estudiantes por programa [HTML]
*/
function get_chardata_exp(id){
	switch(id){
		case "estxprog":
			$.ajax({
		    url: "../php/get_est_x_prog.php",
		    dataType: "json",
		    success: function(d){
		    		var html = d.res;
		    		$("#"+id).append(html);
		        }
		    });
		break;
		case "morris-bar-chart-est-mes":
			$.ajax({
		    url: "../php/get_est_x_mes.php?method=fetchdata",
		    dataType: "json",
		    success: function(data){
				    Morris.Bar({
				        element: id,
				        data: data.dta,
				        xkey: 'mes',
				        ykeys: ['est'],
				        labels: ['Estudiantes'],
				        pointSize: 2,
				        hideHover: 'auto',
				        resize: true
				    });
		        }
		    });
		break;
		case "morris-bar-chart-hpico":
			$.ajax({
		    url: "../php/get_hora_pico.php?method=fetchdata",
		    dataType: "json",
		    success: function(data){
				    Morris.Bar({
				        element: id,
				        data: data.dta,
				        xkey: 'hrs',
				        ykeys: ['cnt'],
				        labels: ['Cantidad Estudiantes'],
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
*	function get_chardata_d_res
*	@return: array de conteos de reservas [Donut chart]
*/
function get_chardata_d_res(){

	$.ajax({
    url: "../php/get_chartdata_donut_res.php?method=fetchdata",
    dataType: "json",
    success: function(r){
    		var sol_data = r.data;
    		$("#btn_details").append("Total de reservas: "+r.total);
		    Morris.Donut({
		        element: 'morris-donut-chart-solicitudes',
		        data: sol_data,
		        resize: true
		    });
        }
    });
}
/*
*	function get_chardata_d_obs
*	@return: array de conteos de observaciones [Donut chart]
*/
function get_chardata_d_obs(){

	$.ajax({
    url: "../php/get_chartdata_donut_obs.php?method=fetchdata",
    dataType: "json",
    success: function(r){
    		var sol_data = r.data;
    		$("#btn_details").append("Total de observaciones: "+r.total);
		    Morris.Donut({
		        element: 'morris-donut-chart-observaciones',
		        data: sol_data,
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
    url: "../php/get_chartdata_donut_sol.php?method=fetchdata",
    dataType: "json",
    success: function(r){
    		var sol_data = r.data;
    		$("#btn_details").append("Total de solicitudes: "+r.total);
		    Morris.Donut({
		        element: 'morris-donut-chart-solicitudes',
		        data: sol_data,
		        resize: true
		    });
        }
    });
}

/*
*	function get_flujoFranjas();
*	@return: array de reporte de franjas por sala
*/
function get_flujoFranjas(sala){
	$("#s1").empty();
	$("#s2").empty();
	$("#s3").empty();
	$("#s1_mes").empty();
	$("#s2_mes").empty();
	$("#s3_mes").empty();
	$.ajax({
    url: "../php/get_chartdata_flx.php?method=fetchdata",
    dataType: "json",
    type: "POST",
	data: {s:sala},
    success: function(data){
    		$("#s"+sala).empty();
    		$("#s"+sala).html(data.cajas);
    			/*carga de datos en los gráficos*/
			for (var i = 0; i < data.cantidad; i++) {
    			//console.log('['+JSON.stringify(data.franjas["f"+(i+1)])+']');
    			Morris.Bar({
			        element: 's'+sala+'-morris-chart-'+i,
			        data: JSON.parse('['+JSON.stringify(data.franjas["f"+(i+1)])+']'),
			          xkey: 'turno',
					  ykeys: ['1', '2', '3', '4', '5'],
					  labels: ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes'],
					  resize:true
			    });
			};
        }
    });
    get_flx_mes(sala);
}
/*
*	function get_flx_mes
*	@return: array de ingresos a la sala filtrados por mes
*/
function get_flx_mes(s){
	var months = ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"];
	$.ajax({
    url: "../php/get_chartdata_fxm.php?method=fetchdata",
    dataType: "json",
    type: "POST",
    data: {sala:s},
    success: function(data){
    		var month_data = data;
		    Morris.Area({
		        element: 's'+s+'_mes',
		        data: month_data,
		        xkey: 'Mes',
			    ykeys: ['Conteo'],
			    labels: ['Conteo'],
			    xLabelFormat: function (x) { return months[x.getMonth()]; },
		        pointSize: 2,
		        hideHover: 'auto',
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
/*
*	function set_turn
*	@return: respuesta al guardado de turnos
*/
function set_turn(d, t, e, u){
	console.log("Guardando => dia:"+d+" turno:"+t+" Espacio: "+e+" Usuario:"+u+".");
	$.ajax({
		url: "../php/set_turn.php",
		dataType: "json",
		type: "POST",
		data: {dia: d, turno: t, espacio:e, usuario:u},
		success: function(data){
		if(data.res==true){
			growl("success",data.mes);
			console.log(data.debug);
		}else{
			growl("danger",data.mes);
			console.log(data.debug);
		}
	}});
}
/*
*	function mostrarDetalle
*	@return: Panel con información detallada del registro a consultar
*/
function mostrarDetalle(id,tipo){
	get_detalle(id,tipo);
	$(".panel-info").slideDown();
	$("#md-"+id).hide();
	$("#od-"+id).show();
}
function ocultarDetalle(id){
	$(".panel-info").slideUp();
	$("#od-"+id).hide();
	$("#md-"+id).show();
}
/*
*	Función get_detalle
*	@return: información detallada del registro a consultar
*/
function ver_accesos(id){
	get_detalle(id,4)
}
/*
*	Función get_detalle
*	@return: información detallada del registro a consultar
*/
function get_detalle(id,tipo){
	$.ajax({
	url: "../php/get_detalle.php",
	dataType: "json",
	type: "POST",
	data: {id:id,tipo:tipo},
	success: function(data){
	if(data.res==true){
		switch(tipo){
			case 3:
				$(".modal-body").html(data.mes);
			break;
			
			case 4:
				$("#table-body").html(data.mes);
			break;

			default:
				$("#detalle-sol").html(data.mes);
			break;
		}
	}
	else{
		growl("danger",data.mes);
	}
	}});
}

/*
*	Función cambiar_estado
*	@return: bool
*/
function cambiar_estado(id,estado,tipo){
	$.ajax({
	url: "../php/cambiar_estado.php",
	dataType: "json",
	type: "POST",
	data: {id:id,tipo:tipo,estado:estado},
	success: function(data){
	if(data.res==true){
		growl("info",data.mes);
		ocultarDetalle(id);
		//recargar();
	}
	else{
		growl("danger",data.mes);
	}
	}});
}

/*
*	Función get_all_turnos: trae todos los turnos de los monitores discriminados por salas y soporte
*	@return: HTMLContent
*/
function get_all_turnos(c, e){
	$.ajax({
		url: "../php/get_all_turnos.php",
		dataType: "json",
		type: "POST",
		data: {e:e},
		success: function(data){
		if(data.res==true){
			$("#"+c).empty();
			$("#"+c).html(data.bdy);
		}
		else{
			growl("danger",data.mes);
		}
	}});
}
/*
*	Función get_sala_activa: trae la sala que se debe visualizar
*	@return: int
*/
function get_sala_activa(){
	var ret;
	$.ajax({
		url: "../php/get_sala_activa.php",
		dataType: "json",
		type: "POST",
		success: function(data){
			if(data.res==true){
				load_sala_activa(data.val);
			}
			else{
				growl("danger",data.mes);
			}
		}
	});
}



$(document).on("click", "#ps1", function(event){
	get_flujoFranjas(1);
});
$(document).on("click", "#ps2", function(event){
	get_flujoFranjas(2);
});
$(document).on("click", "#ps3", function(event){
	get_flujoFranjas(3);
});
$(document).on("click", "#llegada_sala1", function(event){
	registrar_llegada(1);
});
$(document).on("click", "#llegada_sala2", function(event){
	registrar_llegada(2);
});
$(document).on("click", "#llegada_sala3", function(event){
	registrar_llegada(3);
});
$(document).on("click", "#llegada_sala4", function(event){
	registrar_llegada(4);
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
