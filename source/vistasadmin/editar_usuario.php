<?php

    //RECIBIMIENTO DE DATOS DE REGISTRO DE USUARIO

    //Se hace la conexión con la BDD:
    include '../php/connection.php';
    //Validacion de sesión de usuario, si en dado caso no existe, redirecciona a index.php:
    if (!isset($_SESSION['id'])) {
        header("Location: ../index.php");
    }

    //Se reciben los datos mandados a través del formulario:
        $id_usuario_c = $_GET['id'];
        $nombre_usuario_c = $_GET['nom'];
        $correo_usuario_c = $_GET['correo'];
        //se usa validacion con isset, en caso de realizarse el registro y no se percibe un nivel, se asigna automaticamente 1:
        /*Si se recibe el dato del nivel, se le asigna el valor a la variable, de caso contrario, se le asigna automaticamente
        un 1, de primer nivel */
        $nivel_usuario_c = $_GET['nivel'];
        //Si se recibe una instrucción de estado, estará activo/inactivo, de caso contrario se asigna un inactivo (0) por default:
        $estado_usuario_c = $_GET['estado'];
    
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../resources/img/icons/logo_ico.ico">
    <title>Usuarios</title>

    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- FONTS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Red+Rose&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap">
    
    <!--STYLE SHEETS -->
    <link rel="stylesheet" href="../css/admin/styles.css">
    <link rel="stylesheet" href="../css/admin/btn.css">
    <link rel="stylesheet" href="../css/admin/registro.css">

    

</head>




<header>
    <div class="" style="background-color: #ffffff;">
        <img src="../resources/img/icons/LOGO_LARGE.png" style="width: 200px;margin-left: 23px; margin-top: auto;"><a href="../php/logout.php"><img class="float-end" src="../resources/img/icons/logout.png" style="width: 50px;margin-top: 10px;margin-right: 10px;"></a>
    </div>
    <div>
</header>

<body>
    
    
    <div>
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
    </div>

    <div class="container" >

        <div class="container" style="background-color: #ffffff; border-radius: 5px; margin-top: 20px;">
            <div class="row">
                
                <div class="container">
                    <a href="lista_de_usuarios_admin.php"><button class="btn-outline-danger" style="border-radius: 5px; margin-top: 5px;"><</button></a>
                    <H1 style="text-align: center;">EDITAR USUARIO</H1>
                    <div class="col-sm">
                        
                        <i style="font-size: small; color:#57638F"><b>NOTA:</b> Todos los campos marcados con (*) son obligatorios.</i><br>
                        <!-- FORMULARIO -->
                        
                        <form action="../php/editar_usser.php" method="post" id="form" class="form">
                            
                            <!-- GRUPO DE NOMBRE DE USUARIO -->
                            
                            <label for="name" class="form-label">* Nombre de Usuario:</label>
                            <input type="text" name="id" id="id" style="visibility:hidden" value="<?php echo $id_usuario_c?>">  <!-- ID -->
    
                            <div class="formulario__grupo" id="grupo__name">
                                <div class="mb-4">
                                    <input type="text" class="form-control formulario__input" name="name" id="name" placeholder="Nombre de usuario" value="<?php echo $nombre_usuario_c?>">
                                </div>
                                <p class="formulario__input-error">*El nombre solo debe contener letras y espacios. </p>
                            </div>
    
                            <!-- GRUPO DE CORREO  -->
                            <label for="email" class="form-label">* Correo:</label>
                            <div class="formulario__grupo" id="grupo__emailusser">
                                <div class="mb-4">
                                    <input type="email" class="form-control formulario__input" name="email" id="email" placeholder="Correo de usuario" value="<?php echo $correo_usuario_c?>" disabled >
                                </div>
                                <p class="formulario__input-error">Ingresa un correo válido-</p>
                            </div>
                            
    
                            <!-- GRUPO NIVELES -->
    
                            <div class="formulario__grupo" id="grupo__level">
                                <label for="level" class="form-label">* Nivel:</label>
                                <div class="mb-4">
                                    
                                    <div id="level">
                                        <input class="form-check-input" type="radio" name="level"  value="1" <?php if($nivel_usuario_c==1){ ?>checked<?php } ?>>
                                        <label class="form-check-label" for="niveluno">
                                          Nivel 1
                                        </label>
    
                                        <input class="form-check-input" type="radio" name="level"  value="2" <?php if($nivel_usuario_c==2){ ?>checked<?php } ?>>
                                        <label class="form-check-label" for="niveldos">
                                          Nivel 2
                                        </label>
                
    
                                        <input class="form-check-input" type="radio" name="level"  value="3" <?php if($nivel_usuario_c==3){ ?>checked<?php } ?>>
                                        <label class="form-check-label" for="niveltres">
                                          Nivel 3
                                        </label>
    
                
                                      
                                        <input class="form-check-input" type="radio" name="level"  value="4" <?php if($nivel_usuario_c==4){ ?>checked<?php } ?>>
                                        <label class="form-check-label" for="niveladm">
                                          Administrador
                                        </label>
                                    </div>
                                </div>
    
                                <p class="formulario__input-error">Selecciona un nivel</p>

                                <!-- GRUPO ESTADO-->
    
                            <div class="formulario__grupo" id="grupo__level">
                                <label for="level" class="form-label">* Nivel:</label>
                                <div class="mb-4">
                                    
                                    <div id="level">
                                        <input class="form-check-input" type="radio" name="estado"  value="1" <?php if($estado_usuario_c==1){ ?>checked<?php } ?>>
                                        <label class="form-check-label" for="niveluno">
                                          Habilitado
                                        </label>
    
                                        <input class="form-check-input" type="radio" name="estado"  value="0" <?php if($estado_usuario_c==0){ ?>checked<?php } ?>>
                                        <label class="form-check-label" for="niveldos">
                                          Deshabilitado
                                        </label>
                
    
                                    </div>
                                </div>
    
                                <p class="formulario__input-error">Selecciona un nivel</p>
    
                            </div>
                            
                        
    
                            <!-- CLAVE DE CONFIRMACIÓN -->
                            <label for="email" class="form-label">* Clave-Administrador:</label>
                            <div class="formulario__grupo" id="grupo__claveadm">
                                <div class="mb-4">
                                    <input type="password" class="form-control formulario__input" id="password" name="password" placeholder="Inserte la clave administrativa">
                                </div>
    
                                <p class="formulario__input-error">La contraseña debe se de 4 a 12 digitos</p>
                            </div>
    
                            
        
        
                            <button type="submit">ACTUALIZAR</button>
                            
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
 

    <!-- script -->
    <!-- <script src="../scripts/js/formulario_editar_usuario.js"></script> -->
    <!-- FOOTER -->
    <footer class="container" style="text-align: center; color:#57638F">
        <br>
        <h4>Packfile - 2021</h4>
    </footer>

</body>

</html>