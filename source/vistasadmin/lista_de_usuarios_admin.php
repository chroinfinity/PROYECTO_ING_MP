<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Lista de usuarios</title>
    <link rel="icon" href="../resources/img/icons/logo_ico.ico">

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- FONTS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Red+Rose&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap">
    
    <!--STYLE SHEETS -->
    <link rel="stylesheet" href="../css/admin/styles.css">
    <link rel="stylesheet" href="../css/admin/btn.css">
   
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

<header>
    <div class="logo_banner" style="background-color: white;">
        <img src="../resources/img/icons/LOGO_LARGE.png" style="width: 200px;margin-left: 23px; margin-top: auto;"><a href="../php/logout.php"><img class="float-end" src="../resources/img/icons/logout.png" style="width: 50px;margin-top: 10px;margin-right: 10px;"></a>
        <button
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav"
                    class="navbar-toggler"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="Toggle navigation">

                    

        </button>
    </div>

    <nav class="navbar navbar-light navbar-expand-md" style="background: #57638F;">
        <div class="container-fluid"><a class="navbar-brand" href="#"></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active usser_nick m-lg-1 usser_nick p-lg-0.1" href="home_admin.php" style="font-family: 'Red Rose', serif;background: #98bd9d;border-radius: 7px;color: rgb(255,255,255);text-align: center;">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link usser_nick m-lg-1 usser_nick p-lg-0.1" href="archiveroadmin.php" style="font-family: 'Red Rose', serif;background: #98bd9d;border-radius: 7px;color: rgb(255,255,255);text-align: center;">Archivos</a></li>
                    <li class="nav-item"><a class="nav-link usser_nick m-lg-1 usser_nick p-lg-0.1" href="lista_de_usuarios_admin.php" style="font-family: 'Red Rose', serif;background: #ffffff;border-radius: 7px;color: #98bd9d;text-align: center;">Lista de usuarios</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<body>
    <div>
        


        <!-- TABLA DE USUARIOS -->
        <div style="padding-bottom: 1%;">
            <h1 class="text-uppercase text-center text-sm-center text-md-center text-lg-center text-xl-center text-xxl-center" style="color: #1f2438;font-size: 34px;text-align: center;font-family: Roboto, sans-serif;font-weight: bold;padding-top: 10px;padding-bottom: 10px;">LISTA DE USUARIOS</h1>
            <div class="text-center text-sm-center text-md-center text-lg-center text-xl-center text-xxl-center" style="text-align: center;margin-left: auto;margin-right: auto;height: 420.8px;">
                <div class="shadow d-xxl-flex text-center text-sm-center text-md-center text-lg-center text-xl-center text-xxl-center" style="background: #747474;padding-top: 2px;padding-bottom: 15px;width: 625.4px;margin-left: auto;border-radius: 10px;height: 100%;margin-right: auto;">
                    <div class="table-responsive text-start" style="width: 600.4px;font-family: Roboto, sans-serif;margin-left: auto;margin-right: auto;">
                        
                        <!-- TABLA DE USUARIOS-->
                        <table>
                            <thead>
                                <tr>
                                    <th style="border-radius: 10px;border-width: 3px;border-color: #747474;">NOMBRE</th>
                                    <th style="border-radius: 10px;border-width: 3px;border-color: #747474;">CORREO</th>
                                    <th style="border-radius: 10px;border-width: 3px;border-color: #747474;">NIVEL</th>
                                    <th style="border-radius: 10px;border-width: 3px;border-color: #747474;" colspan="2">ACCIONES</th>
                                    
                                </tr>
                            </thead>

                            <tbody>
                                <!--PHP -->
                                <?php 

                                    
                                    //Se realiza query: Toma todos los registros habilitados, excepto el del usuario administraor en cuestión, y los acomoda en orden ascendente:
                                    $sql = "SELECT * FROM usuarios WHERE habilitarUsuario = 1 AND idUsuario != $id_usuario ORDER BY idUsuario ASC";
                                    $rta = mysqli_query($link, $sql);

                                    $usuarios = mysqli_query($link, $sql);

                                    $existencia_usuarios = mysqli_fetch_row($rta);
                                    //despliegue de tabla:
                                    if($existencia_usuarios == null){
                                        ?> 
                                        <tr style="border-color: #747474;border-radius: 68px;">
                                        <td style="background: #ffffff;border-radius: 10px;width: 230px;border-width: 3px; " colspan="5"><i class="fas fa-exclamation-triangle"></i>  Sin usuarios activos por mostrar</td>
                                        </tr>

                                    <?php
                                    }else{
                                    while ($mostrar = mysqli_fetch_row($usuarios)){

                                ?>

                                <tr style="border-color: #747474;border-radius: 68px;">
                                    <td style="background: #ffffff;border-radius: 10px;width: 230px;border-width: 3px; padding-left: 1%;"><?php echo $mostrar['1'];?></td>
                                    <td style="border-radius: 10px;background: #ffffff;width: 200px;border-width: 3px; padding-left: 1%;"><?php echo $mostrar['2'];?></td>
                                    <td style="border-radius: 10px;background: #ffffff;width: 10%;text-align: center;border-width: 3px;"><?php echo $mostrar['4'];?></td>
                                    <td style="border-radius: 10px;background: #ffffff;width: 10%;height: 42px;border-width: 3px;">
                                        <a href="editar_usuario.php?id=<?php echo $mostrar['0']?>&nom=<?php echo $mostrar['1']?> &correo=<?php echo $mostrar['2']?>&nivel=<?php echo $mostrar['4']?>&estado=<?php echo $mostrar['5']?>">
                                                <button class="btn btn-primary" type="button" style="background: url('../resources/img/icons/edit.png');background-size: cover;width: 30px;height: 28px;margin-left: 25%;margin-top: -6px;border-color: rgb(255,255,255);"></button>
                                        </a>
                                    </td>
                                    <td style="border-radius: 10px;background: #ffffff;width: 10%;height: 42px;border-width: 3px;">
                                        <a href="../php/deshabilitar_usuario.php?id=<?php echo $mostrar['0']?>&nom=<?php echo $mostrar['1']?> &correo=<?php echo $mostrar['2']?>&nivel=<?php echo $mostrar['4']?>&estado=<?php echo $mostrar['5']?>">
                                            <button class="btn btn-primary" type="button" style="margin-left: 25%;background: url('../resources/img/icons/cross-flat.png') no-repeat;background-size: contain;width: 30px;height: 28px;margin-top: -8%;border-color: rgb(255,255,255);padding-left: 12px;"></button>
                                        </a>
                                    </td>
                                </tr>
                                

                                <?php 
                                    }
                                }
                                ?>

                        </table>

                                <!--Solicitudes de usuarios -->

                                <table>
                                <thead>
                                    <tr>
                                        <h5 style="padding-top:2%">SOLICITUDES DE REGISTRO</h5>
                                        <th style="border-radius: 10px;border-width: 3px;border-color: #747474;">NOMBRE</th>
                                        <th style="border-radius: 10px;border-width: 3px;border-color: #747474;">CORREO</th>
                                        <th style="border-radius: 10px;border-width: 3px;border-color: #747474;">NIVEL</th>
                                        <th style="border-radius: 10px;border-width: 3px;border-color: #747474;" colspan="2">ACCIONES</th>
                                        
                                    </tr>
                                </thead>

                                <?php 

                                                                    
                                //Se realiza query: Toma todos los registros habilitados, excepto el del usuario administraor en cuestión, y los acomoda en orden ascendente:
                                $sql = "SELECT * FROM usuarios WHERE habilitarUsuario = 0 AND idUsuario != $id_usuario ORDER BY idUsuario ASC";
                                $rta = mysqli_query($link, $sql);

                                $usuarios = mysqli_query($link, $sql);

                                $existencia_usuarios = mysqli_fetch_row($rta);
                                //despliegue de tabla:
                                if($existencia_usuarios == null){
                                    ?> 
                                    <tr style="border-color: #747474;border-radius: 68px;">
                                    <td style="color:#98bd9d; background: #ffffff;border-radius: 10px;width: 125%;height: 50px; border-width: 3px; padding-left: 1%" colspan="5"><i class="fa fa-check" aria-hidden="true"></i> Sin usuarios inactivos por mostrar</td>
                                    </tr>

                                <?php
                                }else{
                                while ($mostrar = mysqli_fetch_row($usuarios)){

                                ?>

                                <tr style="border-color: #747474;border-radius: 68px;">
                                <td style="background: #ffffff;border-radius: 10px;width: 230px;border-width: 3px; padding-left: 1%;"><?php echo $mostrar['1'];?></td>
                                <td style="border-radius: 10px;background: #ffffff;width: 200px;border-width: 3px; padding-left: 1%;"><?php echo $mostrar['2'];?></td>
                                <td style="border-radius: 10px;background: #ffffff;width: 10%;text-align: center;border-width: 3px;"><?php echo $mostrar['4'];?></td>
                                <td style="border-radius: 10px;background: #ffffff;width: 10%;height: 42px;border-width: 3px;">
                                    <a href="editar_usuario.php?id=<?php echo $mostrar['0']?>&nom=<?php echo $mostrar['1']?> &correo=<?php echo $mostrar['2']?>&nivel=<?php echo $mostrar['4']?>&estado=<?php echo $mostrar['5']?>">
                                            <button class="btn btn-primary" type="button" style="background: url('../resources/img/icons/edit.png');background-size: cover;width: 30px;height: 28px;margin-left: 25%;margin-top: -6px;border-color: rgb(255,255,255);"></button>
                                    </a>
                                </td>
                                <td style="border-radius: 10px;background: #ffffff;width: 10%;height: 42px;border-width: 3px;">
                                    <a href="../php/habilitar_usuario.php?id=<?php echo $mostrar['0']?>&nom=<?php echo $mostrar['1']?> &correo=<?php echo $mostrar['2']?>&nivel=<?php echo $mostrar['4']?>&estado=<?php echo $mostrar['5']?>">
                                        <button class="btn btn-primary" type="button" style="margin-left: 25%;background: url('../resources/img/icons/palomita.png') no-repeat;background-size: contain;width: 30px;height: 28px;margin-top: -8%;border-color: rgb(255,255,255);padding-left: 12px;"></button>
                                    </a>
                                </td>
                                </tr>


                                <?php 
                                }
                                }
                                ?>



                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
            <a href="registro.php"><div class="text-center text-sm-center text-md-center text-lg-center text-xl-center text-xxl-center" style="text-align: center;border-color: rgb(255,255,255);margin-left: auto;margin-right: auto;"><button class="btn btn-primary shadow d-xxl-flex justify-content-xxl-center align-items-xxl-end" type="button" style="margin-left: auto;margin-top: 1%;background: #98bd9d;color: rgb(255,255,255);border-width: 0px;text-align: center;margin-right: auto;border-radius: 7px;">AGREGAR USUARIO</button></div></a>
        </div>
    </div>


    <!-- DO NOT TOUCH:  Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
</body>

</html>