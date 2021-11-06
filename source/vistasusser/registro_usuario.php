<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--ICONO PAGE -->
    <link rel="icon" href="../resources/img/icons/logo_ico.ico">
    <title>Welcome: Filepack</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- JQUERY -->
    <script src="../scripts/jquery/jquery-3.6.0.min.js"></script>
    <!-- FONTS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Red+Rose&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap">

    <!--STYLE SHEETS -->
    <link rel="stylesheet" href="../css/ussers/styles.css">
    <link rel="stylesheet" href="../css/ussers/btn.css">
    <link rel="stylesheet" href="../css/ussers/registro_usser.css">

    <!--FONTAWESOME -->
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">

    

    <!-- ESTILO DE LOGIN -->
    <style>
        
        body{
            background: #57638f;
            background: linear-gradient(to right, #57638f,#98bd9c);
        }

        .bg{
            background-image: url(../resources/img/img/fondo_login.png)!important;
            background-position: center center;
            width:50%;
        }

        a {
            color:#57638f;
        }

        a:hover{
            color:#98bd9c;
        }

    </style>

</head>
<body>


    <div class="container w-75 bg-light mt-5 shadow-lg rounded-3" style="border: 2px solid #57638f">
        <div class="row align-items-stretch">
            <div class="col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6" >

            </div>
            <div class="col bg-white p-3 rounded-end">
                <div class="text-end text-center">
                    <img src="../resources/img/icons/logo_web_png.png" width="150" alt="">

                </div>

                <h3 class="fw-bold text-center py-4" style="font-family: 'Red Rose'; color:#98bd9c">¿Nueva cuenta?</h3>



                <!-- FORMULARIO -->
                <form action="../php/guardar_usuario_u.php" method= "POST" id="form" class="form">
                    <!-- GRUPO NICKNAME -->
                    <div class="formulario__grupo" id="grupo__name">
                        <label for="name" class="form-label">Nombre de Usuario:</label>
                        <div class="mb-4 formulario__grupo-input">
                            <input type="text" class="form-control formulario__input" name="name" id="name" required>
                        </div>
    
                        <p class="formulario__input-error">El nombre solo puede contener letras</p>

                    </div>

                    <!-- GRUPO EMAIL -->
                    <div class="formulario__grupo" id="grupo__email">
                        <label for="email" class="form-label">Correo Electrónico:</label>
                        <div class="mb-4 formulario__grupo-input">
                            <input type="email" class="form-control formulario__input" name="email" id="email">
                        </div>
    
                        <p class="formulario__input-error">Ingresa un correo válido-</p>

                    </div>

                    <!-- GRUPO CLAVE -->
                    <div class="formulario__grupo" id="grupo__password">
                        <label for="clave" class="form-label" style="margin-right: 5px;">Contraseña:</label><i class="fa fa-eye" id="show"></i>

                            <div class="mb-4 formulario__grupo-input" >
                                <input type="password" class="form-control formulario__input" name="password_usser" id="password_usser">
                            </div>

                        <p class="formulario__input-error">La clave debe tener de 4 a 12 digitos.</p>
                        
                    </div>

                    <div class="formulario__mensaje" id="formulario__mensaje">
                        <p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el formulario correctamente. </p>
                    </div>

                    <!-- BOTON DE SUBMIT -->
                    <div class="d-grid formulario__grupo formulario__grupo-btn-enviar">
                        <button type="submit"  id="submitButton"  class="btn-outline-primary formulario__btn">¡Registrarme!</button> 
                        
                        <p class="formulario__mensaje-exito" id="formulario__mensaje-exito">Formulario enviado exitosamente!</p>
                    </div>
                   
                    
                </form>
                

            <div class="container" style="text-align: center; margin-top: 10px;">
                <h6>¿Ya tienes una cuenta? <a href="../index.html">¡Inicia sesión!</a></h6>
            </div>
            </div>
        </div>

    </div>

    <!-- script -->
    <script src="../scripts/js/mostrar_pass.js"></script>
    <script src="../scripts/js/formulario_reg_usser.js"></script>
    
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


    <br>
    <br>
    <!-- FOOTER -->
    <footer class="container text-center" style="color:azure"><a href="https://github.com/hectordelgadoneveu/PROYECTO_ING_MP" target="_blank" rel="noopener noreferrer"><b>@Packfile - 2021</b></a></footer>


    
</body>


</html>