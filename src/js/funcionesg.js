
async function enviarPostData(url = '', data = {} , typeResponse = 'text')  {
	console.log(data,"esto es lo que voy a enviar");
	const response = await fetch(url, {
		method: 'POST', // PUT
		body: JSON.stringify( data ), // data
		headers: {
			'Content-Type': 'application/json;charset= utf-8'
		}
	});
	if(typeResponse == 'text'){
		return response.text();
	}
	return response.json(); 
}


async function getApi(pagina)
{
	console.time("cargaPagina:");
	//inicio la barra de progreso
	//NProgress.start();
	console.log(pagina);
	const result = await $.ajax({
		type: 'GET',
		url: pagina,
		cache:false,
		dataType:"html",
		beforeSend: function()
		{
			//NProgress.set(0.4);
		},//fin del beforesend					  
		error:function(XMLHttpRequest, textStatus, errorThrown){
			console.log(arguments);
			var error;
			//alertaExito("esto es estatus"+XMLHttpRequest.status);
			if (XMLHttpRequest.status === 404) error="Pagina no existe "+XMLHttpRequest.status;
			if (XMLHttpRequest.status === 500) error="Error del Servidor "+XMLHttpRequest.status; 
			if (XMLHttpRequest.status === 401) error="Error del Servidor: "+XMLHttpRequest.status;
			//NProgress.done();
		},
		success:function(msj){
			//NProgress.done();
			return msj				  
		}
	}).done(function(){console.timeEnd("cargaPagina:");});	

	return result;			  		
}

//funcion para obtenerlos datos del formulario con JQUERY
function ObtenerDatosFormulario(id)
{
	var cadena = $('#'+id).serialize();
	//console.log(cadena);
	return cadena
}

async function aparecermodulos(pagina,donde)
{
	//NProgress.inc();	
	const result = await $.ajax({
						type: 'GET',
						url: pagina,
						async:true,
						cache:false,
						dataType:"html",
						beforeSend: function()
						{
							//NProgress.set(0.4);
						},//fin del beforesend					  
						error:function(XMLHttpRequest, textStatus, errorThrown){
							console.log(arguments);
							var error;
							//alertaExito("esto es estatus"+XMLHttpRequest.status);
							if (XMLHttpRequest.status === 404) error="Pagina no existe "+XMLHttpRequest.status;// display some page not found error 
							if (XMLHttpRequest.status === 500) error="Error del Servidor "+XMLHttpRequest.status; // display some server error 
							if (XMLHttpRequest.status === 401) error="Error del Servidor: "+XMLHttpRequest.status;
							//NProgress.done();
						},
						success:function(msj){
							//NProgress.done();
							$("#"+donde).html(msj);			  
						}
					});		

	return result;
}

function abrirModal(id){
	$("#"+id).modal('show');
	alert("hili");
}



