<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../resources/img/icons/logo_ico.ico">
    <title>Mis Archivos</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- FONTS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Red+Rose&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap">

    <!--STYLE SHEETS -->
    <link rel="stylesheet" href="../css/ussers/styles.css">
    <link rel="stylesheet" href="../css/ussers/btn.css">

    <!-- JQUERY / AJAX -->
    <script src="../scripts/jquery/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <!-- DATA TABLES -->
    <link rel="stylesheet" href="../librerias/datatable/dataTables.bootstrap5.min.css">

    <!-- VUE JS -->
    <!-- versión de producción, optimizada para tamaño y velocidad -->
    <script src="https://cdn.jsdelivr.net/npm/vue"></script>

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
    <!-- PARTE SUPERIOR DE PAGE (LOGO) -->
    <header>
        <div class="logo_banner" style="background-color: #ffffff;">
            
            <img src="../resources/img/icons/LOGO_LARGE.png" style="width: 200px;margin-left: 23px; margin-top: auto;"><a href="../php/logout.php"><img class="float-end" src="../resources/img/icons/logout.png" style="width: 50px;margin-top: 10px;margin-right: 10px;"></a>
        </div>
    </header>
    
    <!-- BARRA DE NAVEGACIÓN -->
    <div>
        <nav class="navbar navbar-light navbar-expand-md" style="background: #57638F;">
            <div class="container-fluid"><a class="navbar-brand" href="#"></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link active usser_nick m-lg-1 usser_nick p-lg-0.1" href="home.php" style="font-family: 'Red Rose', serif;background: #98bd9d;border-radius: 7px;color: rgb(255,255,255);text-align: center;">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link usser_nick m-lg-1 usser_nick p-lg-0.1" href="misarchivos.php" style="font-family: 'Red Rose', serif;background: #ffffff;border-radius: 7px;color: #98bd9d;text-align: center;">Mis archivos</a></li>
                        <li class="nav-item"><a class="nav-link usser_nick m-lg-1 usser_nick p-lg-0.1" href="subir_Archivo.php" style="font-family: 'Red Rose', serif;background: #98bd9d;border-radius: 7px;color: rgb(255,255,255);text-align: center;">Subir archivos</a></li>
                        <li class="nav-item"><a class="nav-link usser_nick m-lg-1 usser_nick p-lg-0.1" href="ayuda.php" style="font-family: 'Red Rose', serif;background: #98bd9d;border-radius: 7px;color: rgb(255,255,255);text-align: center;">Ayuda</a></li>
                             
                    </ul>
                </div>
            </div>
        </nav>
    </div>

    <!-- FILTROS -->
    <div class="cuadro_filtros">
        <div class="row">

            <div class="col-md-3 cuadro_filtros_2">
                <h4 style="font-family: 'Red Rose', serif;">BUSCADOR</h4>

                <!--BUSCADOR -->
                <div class="container" style="background-color: rgb(255, 255, 255); display:flex; justify-content: left;">
                    <form action="#" id="form" name="form">
                        <input type="text" placeholder="Busqueda..." name="nombre" id="nombre" class="input_filtro" style="background-color:rgb(201, 201, 201); border-radius: 5px; border-color: #98bd9d;">
                        <button type="submit" name="btnsubmitt" class="btn-filtro">Enviar</button>

                        <hr>

                        <!-- FILTROS -->
                        
                        <div style="text-align: left;">
                            <h6 style="font-family: 'Red Rose', serif;">FILTROS</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="busqueda" id="busqueda" value="titulo" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                  Titulo
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="busqueda" id="busqueda" value="contenido">
                                <label class="form-check-label" for="exampleRadios2">
                                  Contenido
                                </label>
                              </div>
                        </div>

                        <hr>

                        <!-- FILTROS -->
                        <div style="text-align: left;">
                            <h6 style="font-family: 'Red Rose', serif;">FORMATO</h6>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="pdf" name="checks[]">
                                        <label class="form-check-label" for="flexCheckDefault">
                                          PDF
                                        </label>
                                      </div>
                                </div>

                                <div class="col-sm">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="txt" name="checks[]" >
                                        <label class="form-check-label" for="flexCheckDefault">
                                          Txt
                                        </label>
                                      </div>
                                </div>
                            </div>


                            <!-- SEGUNDA FILA DE TIPOS -->
                            <div class="row">
                                <div class="col-sm">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="word" name="checks[]" >
                                        <label class="form-check-label" for="flexCheckDefault">
                                          Word
                                        </label>
                                      </div>
                                </div>

                                <div class="col-sm">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="all" name="checks[]" >
                                        <label class="form-check-label" for="flexCheckDefault">
                                          Todos
                                        </label>
                                      </div>
                                </div>
                            </div>

                            <!-- LISTA DE CHECKBOX SELECCIONADOS -->
                            <div style="color:#57638F">Ids seleccionados en matriz: <span id="arr" style="color:#66e6b5"></span></div>
                            <div style="color:#57638F">Ids seleccionados: <span id="str" style="color:#66e6b5"></span></div>
                            <hr>
                            

                            <h6 style="font-family: 'Red Rose', serif;">NIVEL</h6>
                            <div class="multi_select_box">
                                <select class="multi_select" id="nivel_select">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>

                        
                              
                        </div>
                        


                    </form>
                    
                    
                </div>


            </div>

<!-- TABLAAAAAAAAAAAA   -->

            <!-- TABLA DE ARCHIVOS -->
            <div class="col-md-9">
                <!-- SEGUNO CONTAINER-->
                <div class="container" style="border: 1px solid #d0d0d0;; border-radius: 5px; background-color:#57638F; color:#ffffff; ">

                    <h2 style="margin-top:10px;">Lista de Archivos</h2>
                    <div class="container" style="margin-bottom: 10px;">
                        <table class="table table-hover bg-white" id="tablaGestorDataTable" style="border-radius: 5px;">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Fecha</th>
                                    <th>Tipo</th>
                                    <th>Tamaño</th>
                                    <th>Descargar</th>
                                    <th>Previsualizar</th>
                                    <th>Analizar</th>
                                </tr>
                            </thead>
                            <tr>
                                    <td>archivoX.doc</td>
                                    <td>18/09/2021</td>
                                    <td>PDF</td>
                                    <td>3.5 MB</td>
                                    <td><button class="btn_descarga" type="button"><img src="../resources/img/icons/download.png" width="30px" height="32px" alt=""></button></td>
                                    <td><a href="../vistasAcciones/previsualizacion.php"><button class="btn_prev" type="button"><img src="../resources/img/icons/previsualizar_eye.png" width="30px" height="32px" alt=""></button></a></td>
                                    <td><a href="../vistasAcciones/analisis.php"><button class="btn_analizar" type="button"><img src="../resources/img/icons/graficas.png" width="30px" height="32px" alt=""></button></a></td>
                                </tr>
                        </table>
                    </div>

                    
                    
                </div>

            </div>

            <!-- FIN TABLA -->

            
        </div>


        </div>
    </div>

    <!-- funciones datatable -->
    <script type="text/javascript">
        $(document).ready(function(){
            $('#tablaGestorDataTable').DataTable();

        });

    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    

    <!-- DATA TABLES -->
    <script src="../librerias/datatable/jquery.dataTables.min.js"></script>
    <script src="../librerias/datatable/dataTables.bootstrap5.min.js"></script>
    

    <!-- JQUERY -->
    <script src="../scripts/js/filtros_usuario.js"></script>
    <!-- FOOTER -->
    <footer class="container" style="text-align: center; color:#57638F">
        <br>
        <h4>Packfile - 2021</h4>
    </footer>

</body>

</html>