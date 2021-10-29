//llamada de variables
const form = document.getElementById("form")
const button = document.getElementById('submitButton')


const nombre= document.getElementById('name');
const email= document.getElementById('email');
const level= document.getElementById('level');
const admon_pass= document.getElementById('password');
const usser_pass= document.getElementById('password_usser');


//seccion de expresiones regulares para validar:
const expresiones = {
	usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
	nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
	password: /^.{4,12}$/, // 4 a 12 digitos.
	correo: /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/

}

//OBJETO
const formIsValid = {
    name: false,
    email: false,
    level: false,
    admon_pass: false,
    usser_pass: false,
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
        document.querySelector('#grupo__name .formulario__input-error').classList.remove('formulario__input-error-activo');
    }else{
        formIsValid.name =false;
        document.querySelector('#grupo__name .formulario__input-error').classList.add('formulario__input-error-activo');
    }
})

//validación correo
email.addEventListener('change', (e) =>{
    //console.log(e.target)

    if(expresiones.correo.test(email.value)){
        formIsValid.email =true;
        document.querySelector('#grupo__emailusser .formulario__input-error').classList.remove('formulario__input-error-activo');
    }else{
        formIsValid.email =false;
        document.querySelector('#grupo__emailusser .formulario__input-error').classList.add('formulario__input-error-activo');
    }
})

//validación check
level.addEventListener('change', (e) =>{
    //console.log(e.target)

    if(e.target.checked == true){
        formIsValid.level = true;
        document.querySelector('#grupo__level .formulario__input-error').classList.remove('formulario__input-error-activo');
    }else{
        formIsValid.level=false;
        document.querySelector('#grupo__level .formulario__input-error').classList.add('formulario__input-error-activo');
    }
})

//validación de clave de administrador
admon_pass.addEventListener('change', (e) =>{
    //console.log(e.target)

    if(expresiones.password.test(admon_pass.value)){
        formIsValid.admon_pass = true;
        document.querySelector('#grupo__claveadm .formulario__input-error').classList.remove('formulario__input-error-activo');
    }else{
        formIsValid.admon_pass=false;
        document.querySelector('#grupo__claveadm .formulario__input-error').classList.add('formulario__input-error-activo');
    }
})

usser_pass.addEventListener('change', (e) =>{
    //console.log(e.target)

    if(expresiones.password.test(usser_pass.value)){
        formIsValid.usser_pass = true;
        document.querySelector('#grupo__claveusser .formulario__input-error').classList.remove('formulario__input-error-activo');
    }else{
        formIsValid.usser_pass=false;
        document.querySelector('#grupo__claveusser .formulario__input-error').classList.add('formulario__input-error-activo');
    }
})

//validación de formulario
const validateForm = () =>{
    //const formValues = Object.values(formIsValid);
    const formValues = Object.values(formIsValid)

    const valid = formValues.findIndex(value => value == false)
    if(valid== -1){
        document.getElementById('formulario__mensaje-exito').classList.add('formulario__mensaje-exito-activo');
        setTimeout(() =>{
            document.getElementById('formulario__mensaje-exito').classList.remove('formulario__mensaje-exito-activo');
        }, 5000);

        //OPCION DE MODAL:
        alert('Formulario enviado')
        //ENVIO DE FORMULARIO
        form.submit()
    }else{
        alert('Formulario incorrecto')
    } 
}