<?php

    //RECIBIMIENTO DE DATOS DE REGISTRO DE USUARIO

    //Se hace la conexión con la BDD:
    include 'connection.php';
    //Validacion de sesión de usuario, si en dado caso no existe, redirecciona a index.php:
    if (!isset($_SESSION['id'])) {
        header("Location: ../index.php");
    }


    //validación de sesión:
    if(isset($_SESSION['id'])){
        $nivelUsuario = $_SESSION['nivelUsuario'];
    }else{
        echo '<script language = javascript>
                    alert("No hay una sesión iniciada, por favor inicie sesión.")
            </script>';

            echo '<script language = javascript> 
            window.location.href = "../index.php";
            </script>';
    }



    //se obtiene id del archivo:
    if(isset($_GET['idArchivo'])){

        $id_archivo= $_GET['idArchivo'];

        $sql= "SELECT * from archivos WHERE idArchivos= $id_archivo";
        var_dump($sql);
        $resultado= mysqli_query($link, $sql);
        $info= $resultado->fetch_assoc();
        var_dump($info);

        if($resultado){
            /* printf(mysqli_error($link)); */
            $id_archivo=$info['idArchivos'];
            $extension= $info['tipoArchivo'];
            $ruta= $info['ruta'];
            $tipo= $info['tipoArchivo'];
            $nombre_archivo= $info['nombreArchivo'];

            printf($ruta);
            
            if($extension == "pdf"){
                if($nivelUsuario == 4){
                    //previsualizacion pdf de administrador:
                    echo '<script language = javascript> 
                        window.location.href = "../vistasAcciones/previsualizacion_admin.php?idArchivo='.$id_archivo.'&ruta='.$ruta.'&tipo='.$tipo.'";
                    </script>';
                }else{
                    //previsualización pdf de usuario normal:
                    echo '<script language = javascript> 
                        window.location.href = "../vistasAcciones/previsualizacion.php?idArchivo='.$id_archivo.'&ruta='.$ruta.'&tipo='.$tipo.'";
                    </script>';
                }
            }elseif($extension == "txt"){
                if($nivelUsuario == 4){
                    //previsualizacion txt de administrador:
                    echo '<script language = javascript> 
                        window.location.href = "../vistasAcciones/previsualizacion_admin.php?idArchivo='.$id_archivo.'&ruta='.$ruta.'&tipo='.$tipo.'";
                    </script>';
                }else{
                    //previsualización txt de usuario normal:
                    echo '<script language = javascript> 
                        window.location.href = "../vistasAcciones/previsualizacion.php?idArchivo='.$id_archivo.'&ruta='.$ruta.'&tipo='.$tipo.'";
                    </script>';
                }
            }elseif($extension == "jpg" || $extension == "png" || $extension == "jpeg"){
                if($nivelUsuario == 4){
                    //previsualizacion imagenes de administrador:
                    echo '<script language = javascript> 
                        window.location.href = "../vistasAcciones/previsualizacion_admin.php?idArchivo='.$id_archivo.'&ruta='.$ruta.'&tipo='.$tipo.'";
                    </script>';
                }else{
                    //previsualización imagenes de usuario normal:
                    echo '<script language = javascript> 
                        window.location.href = "../vistasAcciones/previsualizacion.php?idArchivo='.$id_archivo.'&ruta='.$ruta.'&tipo='.$tipo.'";
                    </script>';
                }
            }elseif($extension == "docx" || $extension == "doc" || $extension == "ppt" || $extension == "pptx" ){
                if($nivelUsuario == 4){
                    //previsualizacion word de administrador:
                    echo '<script language = javascript> 
                        window.location.href = "../vistasAcciones/previsualizacion_admin.php?idArchivo='.$id_archivo.'&ruta='.$ruta.'&tipo='.$tipo.'";
                    </script>';
                }else{
                    //previsualización word de usuario normal:
                    echo '<script language = javascript> 
                        window.location.href = "../vistasAcciones/previsualizacion.php?idArchivo='.$id_archivo.'&ruta='.$ruta.'&tipo='.$tipo.'";
                    </script>';
                }
            }elseif($extension == "mp3"){
                if($nivelUsuario == 4){
                    //previsualizacion word de administrador:
                    echo '<script language = javascript> 
                        window.location.href = "../vistasAcciones/previsualizacion_admin.php?idArchivo='.$id_archivo.'&ruta='.$ruta.'&tipo='.$tipo.'";
                    </script>';
                }else{
                    //previsualización word de usuario normal:
                    echo '<script language = javascript> 
                        window.location.href = "../vistasAcciones/previsualizacion.php?idArchivo='.$id_archivo.'&ruta='.$ruta.'&tipo='.$tipo.'";
                    </script>';
                }
            }else{
                echo '<script language = javascript>
                    alert("Este documento no puede ser previsualizado.")
                    </script>';
                //no se puede previsualizar:
                if($nivelUsuario == 4){
                    

                    //redireccion administrador:
                    echo '<script language = javascript> 
                        window.location.href = "../vistasadmin/archiveroadmin.php";
                    </script>';
                }else{
                    //redireccion usuario normal:
                    echo '<script language = javascript> 
                        window.location.href = "../vistasusser/misarchivos.php";
                    </script>';
                }
            }


        }

    }

?>