var correo = document.getElementById('email');
var clave = document.getElementById('clave');
var error = document.getElementById('error');
error.style.color = 'white';

function iniciar_sesion_val() {
    console.log("Iniciando sesión...");

    var mensajesError = ["Por favor: <br>"];

    if(correo.value == null |correo.value == ""){
        mensajesError.push("- Ingresa tu correo <br>");
    }

    if(clave.value == null || clave.value == ""){
        mensajesError.push("- Ingresa tu clave <br>");
    }

    error.innerHTML = mensajesError.join( ' ' );
    return false;
}