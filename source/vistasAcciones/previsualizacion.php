
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

    //obtención de información de archivos a previsualizar:
    if(isset($_GET['idArchivo'])){
        $idArchivo = $_GET['idArchivo'];
        $rutaArhivo = $_GET['ruta'];
        $tipoArchivo = $_GET['tipo'];
    }

?>

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
    <link rel="stylesheet" href="../css/ussers/btn.css">
    <link rel="stylesheet" href="../css/acciones/previsualizacion.css">

    <!--FONTAWESOME -->
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">

    <!-- CHART JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../scripts/js/prev_doc.js"></script>

</head>

<!-- CODIGO PHP-->


<body>
    
    <div class="" style="background-color: #ffffff;">
        <img src="../resources/img/icons/LOGO_LARGE.png" style="width: 200px;margin-left: 23px; margin-top: auto;"><a href="index.html"><img class="float-end" src="../resources/img/icons/logout.png" style="width: 50px;margin-top: 10px;margin-right: 10px;"></a>
    </div>
    <div>

        <!-- NAV BAR -->
        <nav class="navbar navbar-light navbar-expand-md" style="background: #57638F;">
            <div class="container-fluid"><a class="navbar-brand" href="#"></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link active usser_nick m-lg-1 usser_nick p-lg-0.1" href="../vistasusser/home.php" style="font-family: 'Red Rose', serif;background: #98bd9d;border-radius: 7px;color: rgb(255,255,255);text-align: center;">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link usser_nick m-lg-1 usser_nick p-lg-0.1" href="../vistasusser/misarchivos.php" style="font-family: 'Red Rose', serif;background: #98bd9d;border-radius: 7px;color: rgb(255,255,255);text-align: center;">Mis archivos</a></li>
                        <li class="nav-item"><a class="nav-link usser_nick m-lg-1 usser_nick p-lg-0.1" href="../vistasusser/subirArchivos.php" style="font-family: 'Red Rose', serif;background: #ffffff;border-radius: 7px;color: #98bd9d;text-align: center;">Subir archivos</a></li>
                        <li class="nav-item"><a class="nav-link usser_nick m-lg-1 usser_nick p-lg-0.1" href="../vistasusser/ayuda.php" style="font-family: 'Red Rose', serif;background: #98bd9d;border-radius: 7px;color: rgb(255,255,255);text-align: center;">Ayuda</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <!-- CANVAS DE GRÁFICAS-->

    <div class="container">
        <div class="row">
            <div class="col-md">
                <div class="container" style="background-color: #ffffff; border-radius: 5px; margin-top: 20px;">
                    <br>
                    <h3>Informacion de Archivo</h3>

                    <?php 

                        $sql = "SELECT nombreArchivo, sizeArchivo from archivos WHERE idArchivos = $idArchivo";
                        $resultado = mysqli_query($link,$sql);
                        $info = mysqli_fetch_assoc($resultado);

                        $nombreArchivo = $info['nombreArchivo'];
                        $tamArchivo = $info['sizeArchivo'];
                    
                    
                    ?>
                    <p>
                        <b>Nombre del archivo:</b> <?php echo $nombreArchivo?> <br>
                        <b>Tipo:</b> <?php echo $tipoArchivo ?> <br>
                        <b>Tamaño: </b><?php echo round($tamArchivo/1000000,4).'MB'; ?> <br><br>

                    </p>
                    <a href="../vistasusser/misarchivos.php"><button class="btn-outline-primary formulario__btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</button> </a>
                    <br>
                    <br>
                </div>
            </div>

            <div class="col-md">
                <div class="container" style="text-align: center; background-color: #ffffff; border-radius: 5px; margin-top: 20px;">
                    <h1> Previsualización</h1>

                    <!-- PDF -->
                    <?php  if($tipoArchivo == "pdf") { ?>
                    <div class="container">
                        <!-- https://www.kyocode.com/2019/08/visualizar-pdfs-html/ -->
                    <iframe src="<?php echo $rutaArhivo; ?>"class="responsive-iframe" style="width:500px; height:600px;min-width:200px; min-height:300px;border-radius: 5px;" frameborder="0" ></iframe>
                    </div>

                    <?php } ?>

                    <!--- TXT -->
                    <?php  if($tipoArchivo == "txt") { 
                        $archivotxt = fopen($rutaArhivo, "r") or die ("Error al leer archivo"); //apertura de archivo solo lectura

                    ?>
                        
                    <div class="container" style="text-align:justify; background-color:antiquewhite; border-radius: 5px;">
                    <br>

                        <?php
                        while(!feof($archivotxt)){

                            $linea= fgets($archivotxt);
                            $saltodelinea = nl2br($linea);
                            
                    ?>
                        <h6><?php echo $saltodelinea; ?></h6>
                        
                    <?php
                
                        }
                    ?> <br></div>
                    <?php 

                        fclose($archivotxt); //cierre de archivo
                    }
                    ?>

                    <!-- IMAGENES -->
                    <?php  if($tipoArchivo == "jpg" || $tipoArchivo == "jpeg" || $tipoArchivo == "png") { ?>
                    <div class="container">
                        <img src="<?php echo $rutaArhivo; ?>" alt="<?php echo $nombreArchivo; ?>" class="img-thumbnail">
                    </div>

                    <?php } ?>


                    
                    
                
                <br>
                </div>
            </div>
        </div>

   </div>
    

        
      
    
</body>

    <!-- DO NOT TOUCH:  Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
    



<footer class="container" style="text-align: center; color:#57638F">
    <br>
    <h4>Packfile - 2021</h4>
</footer>

</html>