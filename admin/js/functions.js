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

return formvalido; // retornamos segun corresponda
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
*  Función Login
*/
function login(){
$.ajax({			
	url: "../php/login.php",			
	dataType: "json",			
	type: "POST",			
	data: { 
		user: $('#email').val(),
		pass: $('#password').val()
	},			
	success: function(data){		
	if(data.res==true){					
		url = "../pages/index.html";  					
		$(location).attr('href',url); 				
	}else				
	{	
		alert(data.mes);				
	}
}});
}

/*
*	LOAD
*/
$(document).on("click", "#js-enviar", function(event){
	if(validarCampos()){
		login();

	}
	else{
		alert("[ERROR]: Campos son obligatorios.");

	}	
});