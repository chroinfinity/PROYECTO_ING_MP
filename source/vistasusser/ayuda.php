<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../resources/img/icons/logo_ico.ico">
    <title>Ayuda</title>

      <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- FONTS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Red+Rose&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap">

    <!--STYLE SHEETS -->
    <link rel="stylesheet" href="../css/ussers/styles.css">
    <link rel="stylesheet" href="../css/ussers/btn.css">
    <link rel="stylesheet" href="../css/ussers/ayuda.css">

    <!--FONTAWESOME -->
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">

</head>

<!-- CODIGO PHP-->
<?php

    //conexion a la BDD e inicio de sesión.
    include '../php/connection.php';

    /* var_dump($_SESSION['id']);
    var_dump($_SESSION['nivelUsuario']); */


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


<body>
    <header>
        <div class="logo_banner" style="background-color: #ffffff;">
            
            <img src="../resources/img/icons/LOGO_LARGE.png" style="width: 200px;margin-left: 23px; margin-top: auto;"><a href="../php/logout.php"><img class="float-end" src="../resources/img/icons/logout.png" style="width: 50px;margin-top: 10px;margin-right: 10px;"></a>
        </div>
    </header>
    
    <div>
        <nav class="navbar navbar-light navbar-expand-md" style="background: #57638F;">
            <div class="container-fluid"><a class="navbar-brand" href="#"></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link active usser_nick m-lg-1 usser_nick p-lg-0.1" href="home.php" style="font-family: 'Red Rose', serif;background: #98bd9d;border-radius: 7px;color: rgb(255,255,255);text-align: center;">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link usser_nick m-lg-1 usser_nick p-lg-0.1" href="misarchivos.php" style="font-family: 'Red Rose', serif;background: #98bd9d;border-radius: 7px;color: rgb(255,255,255);text-align: center;">Mis archivos</a></li>
                        <li class="nav-item"><a class="nav-link usser_nick m-lg-1 usser_nick p-lg-0.1" href="subir_Archivo.php" style="font-family: 'Red Rose', serif;background: #98bd9d;border-radius: 7px;color: rgb(255,255,255);text-align: center;">Subir archivos</a></li>
                        <li class="nav-item"><a class="nav-link usser_nick m-lg-1 usser_nick p-lg-0.1" href="ayuda.php" style="font-family: 'Red Rose', serif;background: #ffffff;border-radius: 7px;color: #98bd9d;text-align: center;">Ayuda</a></li>
                             
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <div class="cuadro_informativo_ayuda">
        <div class="row">
            <div class="col-md-6 cuadro_1_ayuda">
                <h1>¿Necesitas Ayuda?</h1>
                <h4>¡Contactanos!</h4>
            </div>
            <div class="col-md-6">
                <!-- login form -->
                <form action="#" id="form" class="form">
                    <div class="mb-4">
                        <i style="font-size: small; color:#57638F"><b>NOTA:</b> Todos los campos marcados con (*) son obligatorios.</i><br>
                        
                        <!-- FORMULARIO: NOMBRE-->
                        <div class="formulario__grupo" id="grupo__name">
                            <label for="name" class="form-label">* Nombre:</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Introduce tu nombre">

                        <p class="formulario__input-error">Introduce un nombre válido [Solo letras y espacios]</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <!-- FORMULARIO: CORREO-->
                        
                        <div class="formulario__grupo" id="grupo__email">
                        <label for="email" class="form-label">* Correo:</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Introduce tu correo...">

                        <p class="formulario__input-error">El correo no es válido.</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <!-- FORMULARIO: ASUNTO-->
                        
                        <div class="formulario__grupo" id="grupo__asunto">
                        <label for="text" class="form-label">* Asunto:</label>
                        <input type="text" class="form-control" name="asunto" id="asunto" placeholder="Motivo del correo...">

                        <p class="formulario__input-error">El asunto solo puede contener letras y numeros.</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <!-- FORMULARIO: DECRIPCION-->
                        <div class="formulario__grupo" id="grupo__descripcion">
                          <label for="Mensaje">* Descripción</label>
                          <textarea class="form-control" name="mensaje_correo" id="mensaje_correo" rows="3" placeholder="Escribe tu mensaje..."></textarea>
                        
                          <p class="formulario__input-error">Escribe la descripción de tu problema</p>
                        </div>

                        
                    </div>

                    <!-- MENSAJE DE ERROR -->
                    <div class="formulario__mensaje" id="formulario__mensaje">
                        <p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
                    </div>

                    <!-- FORMULARIO: BOTON DE ENVIAR-->
                    <div class="d-grid formulario__grupo formulario__grupo-btn-enviar">
                        <button  type="submit" id="submitButton" name="submit">Enviar</button>
                        <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Gracias por contactarnos, nos pondremos en contacto contigo cuando antes.</p>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
    <!-- SCRIPT VALIDACIONES -->
    <script src="../scripts/js/formulario_ayuda.js"></script>
    <!-- FOOTER -->
    <footer class="container" style="text-align: center; color:#57638F">
        <br>
        <h4>Packfile - 2021</h4>
    </footer>

</body>

</html>