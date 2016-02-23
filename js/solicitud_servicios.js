function validarCampos(){
var $inputs = $('#servicios-form :input'); // Obtenemos los inputs de nuestro formulario
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
* Funcion que valida que un campo sea completado
* @return bool
*/
function isEmpty(val){
if(jQuery.trim(val).length == 0)
    return false;
return true;
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
*	función urlGet
*	Retorna arreglo de variables get
*/
function urlGET()
{
    // capturamos la url
    var loc = document.location.href;
    // si existe el interrogante
    if(loc.indexOf('?')>0)
    {
        // cogemos la parte de la url que hay despues del interrogante
        var getString = loc.split('?')[1];
        // obtenemos un array con cada clave=valor
        var GET = getString.split('&');
        var get = {};

        // recorremos todo el array de valores
        for(var i = 0, l = GET.length; i < l; i++){
            var tmp = GET[i].split('=');
            get[tmp[0]] = unescape(decodeURI(tmp[1]));
        }
        return get;
    }
}

function mostrarVariablesGet()
{
    // Cogemos los valores pasados por get
    var valores=urlGET();


    if(valores)
    {
        // hacemos un bucle para pasar por cada indice del array de valores
        // hacemos un bucle para pasar por cada indice del array de valores
        for(var index in valores)
        {
            //console.log("<br>clave: "+index+" - valor: "+valores[index]);
            //alert(valores[index]);
    		if (valores[index]==1) {
    			//Soporte
    			$('#tipoSol').val(valores[index]);
    		} else{
    			//Comunicaciones
    			$('#tipoSol').val(valores[index]);
    			$('#inventario').hide();
    		}
        }
    }else{
        // no se ha recibido ningun parametro por GET
        console.log("<br>No se ha recibido ningún parámetro");
    }
}

$(document).ready(function(){
	mostrarVariablesGet();
})
$("#js_enviar").on("click", function(event){
	alert("hi");
	$('.js-enviar').attr('disabled',true);
	if(validarEmail($("#email").val()) && validarTipoSol($("#tipoSol").val())){
		$.ajax({  
				url: "mods/solicitud_servicios.php",  
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
					inv: $("#inventario").val(),
					email: $("#email").val(),
					descripcion: $("#descripcion").val()
					},  
					success: function(response) {  
						if(response.res==false)  
						{  
							$('#servicios-form').trigger("reset");
							alert(response.msg);  
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