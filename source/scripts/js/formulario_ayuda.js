//Obtención de variables:
const form = document.getElementById("form")
const button = document.getElementById('submitButton')

//Rescate de variables:
const nombre= document.getElementById('name');
const email= document.getElementById('email');
const asunto_var= document.getElementById('asunto');
const mensaje_correo= document.getElementById('mensaje_correo');

//expresiones regulares:
//seccion de expresiones regulares para validar:
const expresiones = {
	asunto_form: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
	nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
	password: /^.{4,12}$/, // 4 a 12 digitos.
	correo: /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/,
    mensaje: /^[\pL\s0-9\w\W.\,\¿\?\¡\!]{1,244}$/
}


//campos validos (estos se ponen por defecto en default, para realizar las validaciones):
//campos validos o no (valor booleano)
//OBJETO:
const formIsValid = {
    correo: false,
    mensaje: false,
    name: false,
    asunto: false,
}

//se evita que el formulario se envie
form.addEventListener('submit', (e) =>{
    e.preventDefault()
    validateForm()
})


//validación nombre
//change, dispara el evento cuando se ha cambiado el campo
nombre.addEventListener('change', (e) =>{
    //console.log(e.target)

    if(expresiones.nombre.test(nombre.value)){
        formIsValid.name =true;
        document.getElementById('grupo__name').classList.remove('formulario__grupo-incorrecto');
        document.getElementById('grupo__name').classList.add('formulario__grupo-correcto');
        document.querySelector('#grupo__name .formulario__input-error').classList.remove('formulario__input-error-activo');
    }else{
        formIsValid.name =false;
        document.getElementById('grupo__name').classList.remove('formulario__grupo-correcto');
        document.getElementById('grupo__name').classList.add('formulario__grupo-incorrecto');
        document.querySelector('#grupo__name .formulario__input-error').classList.add('formulario__input-error-activo');
    }
})

//validación correo
email.addEventListener('change', (e) =>{
    //console.log(e.target)

    if(expresiones.correo.test(email.value)){
        formIsValid.correo =true;
        document.getElementById('grupo__email').classList.remove('formulario__grupo-incorrecto');
        document.getElementById('grupo__email').classList.add('formulario__grupo-correcto');
        document.querySelector('#grupo__email .formulario__input-error').classList.remove('formulario__input-error-activo');
    }else{
        formIsValid.correo =false;
        document.getElementById('grupo__email').classList.remove('formulario__grupo-correcto');
        document.getElementById('grupo__email').classList.add('formulario__grupo-incorrecto');
        document.querySelector('#grupo__email .formulario__input-error').classList.add('formulario__input-error-activo');
    }
})

//validación descripción
mensaje_correo.addEventListener('change', (e) =>{
    //console.log(e.target)

    if(expresiones.mensaje.test(mensaje_correo.value)){
        formIsValid.mensaje =true;
        document.getElementById('grupo__descripcion').classList.remove('formulario__grupo-incorrecto');
        document.getElementById('grupo__descripcion').classList.add('formulario__grupo-correcto');
        document.querySelector('#grupo__descripcion .formulario__input-error').classList.remove('formulario__input-error-activo');
    }else{
        formIsValid.mensaje =false;
        document.getElementById('grupo__descripcion').classList.remove('formulario__grupo-correcto');
        document.getElementById('grupo__descripcion').classList.add('formulario__grupo-incorrecto');
        document.querySelector('#grupo__descripcion .formulario__input-error').classList.add('formulario__input-error-activo');
    }
})

//validación asunto
asunto_var.addEventListener('change', (e) =>{
    //console.log(e.target)

    if(expresiones.asunto_form.test(asunto_var.value)){
        formIsValid.asunto =true;
        document.getElementById('grupo__asunto').classList.remove('formulario__grupo-incorrecto');
        document.getElementById('grupo__asunto').classList.add('formulario__grupo-correcto');
        document.querySelector('#grupo__asunto .formulario__input-error').classList.remove('formulario__input-error-activo');
    }else{
        formIsValid.asunto =false;
        document.getElementById('grupo__asunto').classList.remove('formulario__grupo-correcto');
        document.getElementById('grupo__asunto').classList.add('formulario__grupo-incorrecto');
        document.querySelector('#grupo_asunto .formulario__input-error').classList.add('formulario__input-error-activo');
    }
})

//validación de formulario
const validateForm = () =>{
    //const formValues = Object.values(formIsValid);
    const formValues = Object.values(formIsValid)

    const valid = formValues.findIndex(value => value == false)
    if(valid== -1){
        document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo');

        /*setTimeout(() =>{
            document.getElementById('formulario__mensaje-exito').classList.remove('formulario__mensaje-exito-activo');
        }, 10000); */

        //OPCION DE MODAL:
        alert('Formulario enviado')
        //ENVIO DE FORMULARIO
        form.submit()
        
    }else{
        alert('Formulario incorrecto')
        //si no todos los campos son verdadero:
        document.getElementById('formulario__mensaje').classList.add('formulario__mensaje-activo');
    } 
}