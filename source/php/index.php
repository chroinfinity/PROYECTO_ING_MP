<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--ICONO PAGE -->
    <link rel="icon" href="img/logo_ico.ico">
    <title>Welcome: Filepack</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- FONTS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Red+Rose&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap">

    <!--STYLE SHEETS -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/btn.css">

    <!-- ESTILO DE LOGIN -->
    <style>
        body{
            background: #57638f;
            background: linear-gradient(to right, #57638f,#98bd9c);
        }

        .bg{
            background-image: url(img/fondo_login.png)!important;
            background-position: center center;
            width:50%;
        }

        a {
            color:#57638f;
        }

        a:hover{
            color:#ffffff;
        }

    </style>

</head>

<body>



    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>



    <div class="container w-75 bg-light mt-5 shadow-lg rounded-3" style="border: 2px solid #57638f">
        <div class="row align-items-stretch">
            <div class="col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6" >

            </div>
            <div class="col bg-white p-3 rounded-end">
                <div class="text-end text-center">
                    <img src="img/logo_web_png.png" width="150" alt="">

                </div>

                <h3 class="fw-bold text-center py-4" style="font-family: 'Red Rose'; color:#98bd9c">Bienvenido</h3>

                <!-- login form -->
                <div id="error" class="container" style="background-color: rgb(224, 129, 129); border-radius: 5px;">
                    <!-- AQUI VA EL MENSAJE DE ERRORES -->
                </div>
                <form method="post" action="login.php">
                    <div class="mb-4">
                        <label for="email" class="form-label">Correo Electrónico:</label>
                        <input type="email" class="form-control" name="email" id="email">
                    </div>

                    <div class="mb-4">
                        <label for="clave" class="form-label">Contraseña:</label>
                        <input type="password" class="form-control" name="password" id="clave">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn-outline-primary" name="login">Iniciar Sesión</button>
                    </div>
                    <a href="home.html" style="text-align: center;">Inicio prueba</a>
                    
                </form>
                
                

                
            </div>
        </div>

    </div>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <br>
    <br>
    <!-- FOOTER -->
    <footer class="container text-center" style="color:azure"><a href="https://github.com/hectordelgadoneveu/PROYECTO_ING_MP" target="_blank" rel="noopener noreferrer"><b>@Packfile - 2021</b></a></footer>

</body>

<script src="scripts/js/validaciones.js"></script>
</html>