//llamada de variables
const form = document.getElementById("form")
const button = document.getElementById('submit')


const nombre= document.getElementById('name');
const email= document.getElementById('email');
const level= document.getElementById('level');
const admon_pass= document.getElementById('password');


//seccion de expresiones regulares para validar:
const expresiones = {
	usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
	nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
	password: /^.{4,12}$/, // 4 a 12 digitos.
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/

}

//OBJETO
const formIsValid = {
    name: false,
    email: false,
    level: false,
    admon_pass: false,
}

//se evita que el formulario se envie
form.addEventListener('submit', (e) =>{
    e.preventDefault()
})

//validación nombre
//change, dispara el evento cuando se ha cambiado el campo
nombre.addEventListener('change', (e) =>{
    //console.log(e.target)

    if(expresiones.nombre.test(nombre.value)){
        formIsValid.name =true;
    }else{
        formIsValid.name =false;
    }
})

//validación correo
email.addEventListener('change', (e) =>{
    //console.log(e.target)

    if(expresiones.correo.test(email.value)){
        formIsValid.email =true;
    }else{
        formIsValid.email =false;
    }
})

//validación correo
level.addEventListener('change', (e) =>{
    //console.log(e.target)

    if(e.target.checked == true){
        formIsValid.level = true;
    }else{
        formIsValid.level=false;
    }
})

