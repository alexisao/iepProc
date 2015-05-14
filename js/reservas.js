/*
* Funcion que valida campos
* @return bool
*/
function validarCampos(){
var $inputs = $('#contact-form :input'); // Obtenemos los inputs de nuestro formulario
var formvalido = true; // Para saber si el form esta vacio 
 
$inputs.each(function() {  // Recorremos los inputs del formulario (uno a uno)
	if(!isEmpty($(this).val())){ // Verificamos que el input este vacio 
		$(this).css('background',"#FFD9DD"); // Agregamos un fondo  si este esta vacio
		formvalido = false;
	}else{
		$(this).css('background',''); // quitamos el fondo rojo si este esta lleno
	}
});
var email = $("#email").val();


return formvalido; // retornamos segun corresponda
}

/*
* Funcion para validar Email
*/
function validarEmail( email ) {
	if(email.search("@") != -1){
		$("#email").css('background',"#FFD9DD");
		alert('[ERROR]: Escribir correo hasta antes del @.');
		return false;
	}else{
		return true;
	}
}

/*
* Funcion para validar tipoSol
*/
function validarTipoSol(ts){
	if(ts==0){
		$("#tipoSol").css('background',"#FFD9DD");
		alert("[ERROR]: Debe seleccionar un tipo de solicitud primero");
		return false;
	}else{
		return true;
	}
}
/*
* Funcion que muestra los salones segun sea el edificio
* @return data
*/
function verificarCombo(id){
	switch(id){
		case "#tipoSol":
			if ($(id).val()==1) {$("#c_e").hide()} else{$("#c_e").show()};
		break;
		case "#r_edif":
			if ($(id).val()==388) {$("#1011").hide()} else{$("#1011").show()};
		break;
	}
}

/*
* Funcion que valida que un campo sea completado
* @return bool
*/
function isEmpty(val){
if(jQuery.trim(val).length == 0)
    return false;
return true;
}
/*
* Datepicker
*/
$('.input-group.date.fReserva').datepicker({
	format: 'yyyy-mm-dd',
    clearBtn: true,
    language: "es",
    calendarWeeks: true,
    todayHighlight: true,
    autoclose: true
});

/* TIME PICKER */
$('.input-group.date.desde').datetimepicker({
    pickDate: false,
    autoclose: true
});
$('.input-group.date.hasta').datetimepicker({
    pickDate: false,
    autoclose: true
});

$(document).ready(function(){
	$("#tipoSol").on("change", function(){
		verificarCombo("#tipoSol")
	})
	$("#r_edif").on("change", function(){
		verificarCombo("#r_edif")
	})
})

$(document).on("click", ".js-enviar", function(event){
	$('.js-enviar').attr('disabled',true);
	if(validarCampos() && validarEmail($("#email").val()) && validarTipoSol($("#tipoSol").val())){
		$.ajax({  
				url: "mods/reservas.php",  
				type: "POST",  
				dataType: "json",  
				data: {  
					tipoSol: $("#tipoSol").val(),
					nombre: $("#nombre").val(),
					cargo: $("#cargo").val(),
					tid: $("#tid").val(),
					id: $("#id").val(),
					edificio: $("#edificio").val(),
					oficina: $("#oficina").val(),
					tel: $("#tel").val(),
					ext: $("#ext").val(),
					email: $("#email").val(),
					fReserva: $("#fReserva").val(),
					r_edif: $("#r_edif").val(),
					r_salon: $("#r_salon").val(),
					desde: $("#desde").val(),
					hasta: $("#hasta").val()
					},  
					success: function(response) {  
						if(response.res==false)  
						{  
							alert(response.msg);  
							$('.js-enviar').attr('disabled',false);
						}  
						else{  
							alert(response.msg);
							$('.js-enviar').attr('disabled',false);
						}   
					},  
			}); 
	}
	else{
		alert("[ERROR]: Campos son obligatorios.");
		$('.js-enviar').attr('disabled',false);
	}	
});