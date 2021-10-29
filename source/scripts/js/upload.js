//Selecconando los elementos requeridos
const dropArea = document.querySelector(".drag-area"),
dragText = dropArea.querySelector("header"),
button = dropArea.querySelector("button"),
input = dropArea.querySelector("input");
let file; //Variable global
button.onclick = ()=>{
  input.click();
}

input.addEventListener("change", function(){
  //Si el usuario selecciona varios archivos, solo se seleccionará el primero
  file = this.files[0];
  dropArea.classList.add("active");
  showFile();
});

//Esto para cuando se arrastra un archivo
dropArea.addEventListener("dragover", (event)=>{
  event.preventDefault();
  dropArea.classList.add("active");
  dragText.textContent = "Suelte para subir el archivo";
});

//If user leave dragged File from DropArea
dropArea.addEventListener("dragleave", ()=>{
  dropArea.classList.remove("active");
  dragText.textContent = "Arrastre y suelte su archivo";
});

//Cuando el usuario suelta el archivo en el área
dropArea.addEventListener("drop", (event)=>{
  event.preventDefault(); //Previene del comportamiento default
  //Si el usuario selecciona varios archivos, solo se seleccionará el primero
  file = event.dataTransfer.files[0];
  showFile(); 
});

function showFile(){
  let fileType = file.type; //Identifica el tipo de archivo
  let validExtensions = ["image/jpeg", "image/jpg", "image/png", "application/pdf", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.ms-excel", "text/plain"]; //Si quieren añadir la extensión de algún tipo de archivo, usenlo en su formato MIME
  if(validExtensions.includes(fileType)){ //Si el usuari selecciona un archivo válido 
    let fileReader = new FileReader(); //Crea un nuevo objeto del tipo FileReader
    fileReader.onload = ()=>{
      let fileURL = fileReader.result;
    }
    fileReader.readAsDataURL(file);
  }else{
    alert("Archivo no válido");
    dropArea.classList.remove("active");
    dragText.textContent = "Arrastre y suelte para subir el archivo";
  }
}