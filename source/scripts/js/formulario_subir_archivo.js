//_-------------------
$(document).ready(function(){

    $('#submitButton').on("click", function(evt){
        //alert("si agarra")
        evt.preventDefault();
        cargarArchivoCSV();
    });
});

const form = document.getElementById("form")
//rescate de variables:
//const nombre_archivo= document.getElementById('nameFile');

//seccion de expresiones regulares para validar:
const expresiones = {
	nombre: /^[a-zA-Z0-9\-\_\s]{1,40}$/, // Letras y espacios, guiones bajos y guiones medios.
}

//campos validos (estos se ponen por defecto en default, para realizar las validaciones):
//campos validos o no (valor booleano)
//OBJETO:
const formIsValid = {
    nombreArchivo: false
}


function cargarArchivoCSV()
{
    var archivo     = $('input[name="file"]').val();
    var nombre_archivo = $('input[name="nameFile"').val();

    var returnError = false;


    if(archivo=="" || nombre_archivo ==""){
        swal({
            title: "Woopsy!",
            text: "Por favor completa los campos",
            icon: "warning",
            dangerMode: true,
        });
        
        returnError= true;
        $('#file').focus();
    }else{
        if(!expresiones.nombre.test(nombre_archivo)){
            swal("Cuidado con el nombre", "Por favor escribe bien el nombre, los siguientes caracteres son válidos: \n\n - Letras\n -Numeros \n -Guion bajo y guión medio", "warning");
            
            returnError= true;
            $('#nameFile').focus();
        }else{
            form.submit();
        }
    }
}