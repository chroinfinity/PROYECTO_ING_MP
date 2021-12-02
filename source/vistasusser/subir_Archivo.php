<?php

    //conexion a la BDD e inicio de sesión.
    include '../php/connection.php';

    //se realiza validación en caso de que ya exista una sesión, manejo de accesos.
    if (isset($_SESSION['id'])) {
        if(isset($_SESSION['nivelUsuario'] )){
            if($_SESSION['nivelUsuario'] == 4){
                header("Location: ../vistasadmin/home_admin.php");
            }
        }
    }else{
        header("Location: ../index.php");
    }

    //Captura de variables de sesion (USUARIO-ADMIN)
    $id_usuario = $_SESSION['id'];
    $nombre_usuario = $_SESSION['nombreUsuario'];
    $nivel = $_SESSION['nivelUsuario'];
    $habilitado = $_SESSION['habilitarUsuario'];
    $correo_usuario = $_SESSION['correoUsuario'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="icon" href="../resources/img/icons/logo_ico.ico">
    <title>Subir archivos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Red+Rose&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">

     <!--STYLE SHEETS -->
     
     <link rel="stylesheet" href="../css/ussers/btn.css">
    <link rel="stylesheet" href="../css/ussers/subir_archivo.css">
    <link rel="stylesheet" href="../css/ussers/login.css">

    <!-- JQUERY / AJAX -->
    <script src="../scripts/jquery/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    
    
</head>

<!-- PARTE SUPERIOR DE PAGE (LOGO) -->
<header>
    <div class="logo_banner" style="background-color: #ffffff;">
        
        <img src="../resources/img/icons/LOGO_LARGE.png" style="width: 200px;margin-left: 23px; margin-top: auto;"><a href="../php/logout.php"><img class="float-end" src="../resources/img/icons/logout.png" style="width: 50px;margin-top: 10px;margin-right: 10px;"></a>
    </div>
</header>

<body>
    <div>
        <nav class="navbar navbar-light navbar-expand-md" style="background: #57638F;">
            <div class="container-fluid"><a class="navbar-brand" href="#"></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link active usser_nick m-lg-1 usser_nick p-lg-0.1" href="home.php" style="font-family: 'Red Rose', serif;background: #98bd9d;border-radius: 7px;color: rgb(255,255,255);text-align: center;">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link usser_nick m-lg-1 usser_nick p-lg-0.1" href="misarchivos.php" style="font-family: 'Red Rose', serif;background: #98bd9d;border-radius: 7px;color: #ffffff;text-align: center;border-right-color: 0,;">Mis archivos</a></li>
                        <li class="nav-item"><a class="nav-link usser_nick m-lg-1 usser_nick p-lg-0.1" href="subir_Archivo.php" style="font-family: 'Red Rose', serif;background: #ffffff;border-radius: 7px;color: #98bd9d;text-align: center;">Subir archivos</a></li>
                        <li class="nav-item"><a class="nav-link usser_nick m-lg-1 usser_nick p-lg-0.1" href="ayuda.php" style="font-family: 'Red Rose', serif;background: #98bd9d;border-radius: 7px;color: rgb(255,255,255);text-align: center;">Ayuda</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>



    <div class="container" >

        <div class="container" style="background-color: #ffffff; border-radius: 5px; margin-top: 20px;">
            <div class="row">
                
                <div class="container">
                    
                    <H1 style="text-align: center;">SUBIR ARCHIVO</H1>
                    <div class="col-sm">
                        
                        <i style="font-size: small; color:#57638F"><b>NOTA:</b> Todos los campos marcados con (*) son obligatorios.</i><br>
                       
                        
                        <!-- FORMULARIO SUBIR ARCHIVO -->
                        
                        <form action="../php/guardar_archivo.php" method= "POST" id="form" class="form" enctype="multipart/form-data" autocomplete="off">
                            
                            
                            <!-- GRUPO DE NOMBRE DE USUARIO -->
                            <label for="nameFile" class="form-label">* Nombre de Archivo:</label>
    
                            <div class="formulario__grupo" id="grupo__nameFile">
                                <div class="mb-4">
                                    <input type="text" class="form-control formulario__input" name="nameFile" id="nameFile" placeholder="Nombre de Archivo">
                                </div>
                                <p class="formulario__input-error">*El nombre solo debe contener letras y espacios. </p>
                            </div>
    
                            <!-- GRUPO DE ARCHIVO -->
                            <label for="file" class="form-label">* Archivo:</label>
    
                            <div class="formulario__file" id="grupo__file">
                                <div class="mb-4">
                                    <input type="file" class="form-control formulario__input" name="file" id="file" >
                                </div>
                                <p class="formulario__input-error">* Por favor sube un archivo </p>
                            </div>

                            <div class="container row">
                                <div class="col-6">
                                    <!-- BOTON DE RESET -->
                                    <div class="d-grid formulario__grupo formulario__grupo-btn-enviar">
                                        <!-- <button type="submit" onclick="return validarRegistro();"  class="btn-outline-primary formulario__btn">Registrar</button> -->
                                        <button  type="reset" id="resetButton" style="background-color:#98bd9d; border-radius: 10px; color:white;">Limpiar</button>
                                        <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario limpio!</p>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <!-- BOTON DE SUBMIT -->
                                    <div class="d-grid formulario__grupo formulario__grupo-btn-enviar">
                                        <!-- <button type="submit" onclick="return validarRegistro();"  class="btn-outline-primary formulario__btn">Registrar</button> -->
                                        <button  type="submit" id="submitButton" style="background-color:#98bd9d; border-radius: 10px; color:white;">Subir</button>
                                        <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Archivo subido correctamente</p>
                                    </div>
                                </div>


                            </div>
                            
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>

    
    

    <!-- <script src="../scripts/js/upload.js"></script> -->
    <script src="../scripts/js/formulario_subir_archivo.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
</body>


<footer class="container" style="text-align: center; color:#57638F">
    <br>
    <h4>Packfile - 2021</h4>
</footer>
</html>