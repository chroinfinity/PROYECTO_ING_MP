<?php

    //conexion a la BDD e inicio de sesión.
    include '../php/connection.php';

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


        $sql = "SELECT fk_usuarios_idUsuario FROM archivos WHERE idArchivos = $idArchivo";
        $resultado = mysqli_query($link, $sql);
        $info = mysqli_fetch_assoc($resultado);
        $idUsuarioArchivo = $info['fk_usuarios_idUsuario'];
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
                    <a href="../vistasadmin/archiveroadmin.php"><button class="btn-outline-primary formulario__btn"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</button> </a>
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

                    <?php } 

                    //  TXT
                     elseif ($tipoArchivo == "txt") { 
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
                    

                    // IMAGENES
                    elseif($tipoArchivo == "jpg" || $tipoArchivo == "jpeg" || $tipoArchivo == "png") { ?>
                    <div class="container">
                        <img src="<?php echo $rutaArhivo; ?>" alt="<?php echo $nombreArchivo; ?>" class="img-thumbnail">
                    </div>
                
                    <?php }

                    // WORD (.docx)
                    elseif($tipoArchivo == "docx"){ 

                        //FUNCION PARA CONTAR PALABRAS REPETIDAS:
                        function docx2text($filename) {
                            return readZippedXML($filename, "word/document.xml");
                        }
                        
                        function readZippedXML($archiveFile, $dataFile) {
                            // Create new ZIP archive
                            $zip = new ZipArchive;
                        
                            // Open received archive file
                            if (true === $zip -> open($archiveFile)) {
                                // If done, search for the data file in the archive
                                if (($index = $zip -> locateName($dataFile)) !== false) {
                                    // If found, read it to the string
                                    $data = $zip -> getFromIndex($index);
                                    // Close archive file
                                    $zip -> close();
                                    // Load XML from a string
                                    // Skip errors and warnings
                                    
                                    $xml = new DOMDocument();
                                    

                                    $xml -> loadXML($data);

                                    $xmldata = $xml->saveXML();
                                    
                                    $xmldata = str_replace("</w:p>", "\n", $xmldata);
                                    $xmldata = str_replace("<w:tab/>", "+", $xmldata);
                                    

                                    // Return data without XML formatting tags
                                    return strip_tags($xmldata);
                                }
                                $zip -> close();
                            }
                        
                            // In case of failure return empty string
                            return "";
                        }
                        
                        
                        $contenido_word = docx2text($rutaArhivo); // Save this contents into a string
                        $contenido_word = str_ireplace("\n","<br>",$contenido_word);
                        $contenido_word = str_ireplace("+","&nbsp &nbsp &nbsp &nbsp",$contenido_word);
                        echo '<div class="container"; style="padding-left:4%;"> <div class="container overflow-auto"; style=" padding-left: 46.3177px; padding-right: 46.3177px; padding-top: 32.3177px; padding-bottom: 46.3177px; text-align: justify; outline: 2px solid black; height: 517.64px; width: 400px; font-family:Arial; font-size:7.5px;">'.$contenido_word.'</div></div>'; 
                    }

                    // ARCHIVOS MP3
                    elseif($tipoArchivo == "mp3"){ 
                        ?>
                        
                        <audio controls="controls"><source src=<?php echo $rutaArhivo; ?> type="audio/mp3"></audio> 
                        
                        <?php 
                        
                    }
                    
                    //otro tipo de archivos no compatibles
                    else { ?>
                    <div class="container" style="color:white; background-color:#57638F; ">

                        <?php if($tipoArchivo == "doc" || $tipoArchivo =="docx"){ ?>
                            <i class="fas fa-file-word fa-4x" style="margin-top:20px; margin-bottom:10px;"></i>
                            

                        <?php }elseif($tipoArchivo == "ppt" || $tipoArchivo =="pptx"){ ?>
                            <i class="fas fa-file-powerpoint fa-4x" style="margin-top:20px; margin-bottom:10px;"></i>
                        <?php } ?>
                     
                     <h4> Archivo no compatible para visualizar</h4>
                     <br>
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