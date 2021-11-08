<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../resources/img/icons/logo_ico.ico">
    <title>Inicio</title>
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- FONTS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Red+Rose&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap">
    
    <!--STYLE SHEETS -->
    <link rel="stylesheet" href="../css/ussers/styles.css">
    <link rel="stylesheet" href="../css/ussers/btn.css">

    <!-- CHART JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    

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
            if($_SESSION['nivelUsuario'] <= 3){
                header("Location: ../vistasusser/home.php");
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
    
    <!-- CABECERA PROYECTO (LOGOUT)-->
    <div class="" style="background-color: #ffffff;">
        <img src="../resources/img/icons/LOGO_LARGE.png" style="width: 200px;margin-left: 23px; margin-top: auto;"><a href="../php/logout.php"><img class="float-end" src="../resources/img/icons/logout.png" style="width: 50px;margin-top: 10px;margin-right: 10px;"></a>
    </div>
    <div>

        <!-- NAV BAR -->
        <nav class="navbar navbar-light navbar-expand-md" style="background: #57638F;">
            <div class="container-fluid"><a class="navbar-brand" href="#"></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link active usser_nick m-lg-1 usser_nick p-lg-0.1" href="../vistasadmin/home_admin.php" style="font-family: 'Red Rose', serif;background: #98bd9d;border-radius: 7px;color: rgb(255,255,255);text-align: center;">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link usser_nick m-lg-1 usser_nick p-lg-0.1" href="../vistasadmin/archiveroadmin.php" style="font-family: 'Red Rose', serif;background: #ffffff;border-radius: 7px;color: #98bd9d;text-align: center;">Archivos</a></li>
                        <li class="nav-item"><a class="nav-link usser_nick m-lg-1 usser_nick p-lg-0.1" href="../vistasadmin/lista_de_usuarios_admin.php" style="font-family: 'Red Rose', serif;background: #98bd9d;border-radius: 7px;color: rgb(255,255,255);text-align: center;">Lista de usuarios</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>


    <!-- CANVAS DE GRÁFICAS-->

    <div class="container">
        <div class="row">
            <div class="col-md">
                <div class="container" style="box-shadow: 5px 5px 5px rgba(33,37,41,0.39);background-color: #ffffff; border-radius: 5px; margin-top: 20px; max-width: 600px; max-height: 800px;">
                    <canvas id="miGrafica" width="100px" height="100px"></canvas>
                </div>
            </div>
    
            <div class="col-md">
                <div class="container border-light" style="box-shadow: 5px 5px 5px rgba(33,37,41,0.39);text-align: center; background-color: #57638F;border-style: solid;border-color:#ffffff; border-radius: 5px; margin-top: 20px; color: white;">
                    <br>
                    <h3>Estadisticas</h3><br>
                        Numero de Palabras: <h6 id="num_palabras">6</h6> <br>
                        Numero de Parrafos: <h6 id="num_parrafos">4</h6> <br>
                        Numero de caracteres: <h6 id="num_caracteres">345</h6> <br>
                </div>

                <!-- BOTON DE REGRESO A ARCHIVERO -->
                <div  style="margin-top: 20px;">
                    <a href="../vistasadmin/archiveroadmin.php"><button  class="btn-outline-primary analisis_btn_back">Regresar</button></a>
                </div>
                <br>
                
                
            </div>
        </div>

    </div>
    

        
      
    
</body>

    <script>

        //variables prueba:
        num_palabras= 13;
        num_coincidencias = 14;
        num_parrafos = 20;
        num_caracteres = 12;

        var label_palabras = document.getElementById('num_palabras');
        //var label_coincidencias = document.getElementById('num_palabras');
        var label_parrafos = document.getElementById('num_parrafos');
        var label_caracteres = document.getElementById('num_caracteres');

        //agregado de información
        label_palabras.innerHTML= num_palabras;
        label_parrafos.innerHTML= num_parrafos;
        label_caracteres.innerHTML= num_caracteres;
        //obtencion de canvas
        let miCanvas=document.getElementById("miGrafica").getContext("2d");

        //variable de libreri char: https://www.chartjs.org/docs/latest/samples/other-charts/radar-skip-points.html

        var chart = new Chart(miCanvas,{
            type: "bar",
            data: {
                
                labels:["# de palabras","# de parrafos","# de Coincidencias","# de caracteres"],
                datasets: [
                    {
                        
                        backgroundColor: [
                            '#DA380D',
                            '#2ADA0D',
                            '#0DDACC',
                            '#0D12DA',
                            '#E181EE',
                        ],
                        data:[num_palabras,num_coincidencias,num_parrafos,num_caracteres]
                    }
                ]
            },

            options: {
                responsive: true,
                plugins: {
                title: {
                    display: true,
                    text: 'Analisis de documento'
                }
                }
            },
        })
    
    
    </script>

    <!-- DO NOT TOUCH:  Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <!-- LIBRERIA CHART JS (CDN) -->
    



<footer class="container" style="text-align: center; color:#57638F">
    <br>
    <h4>Packfile - 2021</h4>
</footer>

</html>