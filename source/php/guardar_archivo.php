<?php

    //RECIBIMIENTO DE DATOS DE REGISTRO DE USUARIO

    //Se hace la conexión con la BDD:
    require 'connection.php';

    //Validacion de sesión de usuario, si en dado caso no existe, redirecciona a index.php:
    if (!isset($_SESSION['id'])) {
        header("Location: ../index.php");
    }

    //Se almcenan las variables de sesion:
        $id_usuario = $_SESSION['id'];
        $nombre_usuario = $_SESSION['nombreUsuario'];
        $nivel_usuario = $_SESSION['nivelUsuario'] ;
        //Si se recibe una instrucción de estado, estará activo/inactivo, de caso contrario se asigna un inactivo (0) por default:
        $estado_usuario = $_SESSION['habilitarUsuario'];

    //Validacion de sesión de usuario, si en dado caso no existe, redirecciona a index.php:
    if ($_FILES["file"]["error"]>0) {
        echo "<script>alert('El archivo presenta un error, por facor cargue otro...'); window.location='../vistasusser/subir_Archivo.php'</script>";
    }


    $nombre_original_archivo= $_FILES["file"]["name"];
    $nombre_nuevo_archivo = $_POST["nameFile"] . "." . strtolower(pathinfo($nombre_original_archivo,PATHINFO_EXTENSION));
    $permitidos = array("image/gif", "image/png","image/jpg","image/jpeg","audio/*","audio/mpeg","audio/ogg","video/mp4","application/octet-stream", "text/plain", "text/x-php", "application/pdf", "application/x-httpd-php","application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.ms-excel","application/x-httpd-php-source");
    $limite_kb= 10000; //10 MB

    $dir= "../files/".$id_usuario ."/";  //directorio a donde se almacenan archivos
    $ruta = $dir. $nombre_nuevo_archivo ; // ../files/nombre_archivo.jpg
    $ruta_tmp= $_FILES["file"]["tmp_name"]; // c//:home/usser/img/archivo.png


    var_dump($nombre_nuevo_archivo);
    var_dump($nombre_original_archivo);
    var_dump($_FILES["file"]["type"]);
    var_dump($dir);
    var_dump($id_usuario);
    var_dump($ruta_tmp); 
    var_dump($ruta); 
    var_dump($_FILES);
    var_dump(!in_array($_FILES["file"]["type"], $permitidos));

    //var_dump($_FILES);
    if((in_array($_FILES["file"]["type"], $permitidos))) {
        echo("validacion q pasada");
        if(($_FILES["file"]["size"] <= $limite_kb*1024)){

            //$_FILES["file"]["name"]= $nombre_archivo;
            //$nombre_nuevo_archivo = $_FILES["file"]["name"];

            $tipo_archivo = strtolower(pathinfo($nombre_original_archivo,PATHINFO_EXTENSION));
            $tam_archivo = $_FILES["file"]["size"];
            var_dump($nombre_nuevo_archivo);
            var_dump($tipo_archivo);
            var_dump($tam_archivo);
            var_dump($id_usuario);
            var_dump($ruta); 

            //se crea ruta en caso de no existir:
            if(!file_exists($dir)){
                mkdir($dir, 0777); //0777 para poder darle todos los permisos a la carpeta. 
            }

            if(!file_exists($ruta)){
                //subida de archivo:
                $subida= move_uploaded_file($ruta_tmp,$ruta); // <--- subida de archivo
                //registro de información en BDD:
                $sql= "INSERT INTO archivos 
                        (nombreArchivo,tipoArchivo,sizeArchivo,fk_usuarios_idUsuario,ruta) 
                        VALUES 
                        ('$nombre_nuevo_archivo','$tipo_archivo','$tam_archivo','$id_usuario','$ruta')";
                
                
                //Ejecución de query:
                $resultado = $link->query($sql); //verifiación de ejecucion de query
                var_dump($sql);

                //Redireccionamiento:
                if($resultado){
                    echo "<script>alert('El archivo se ha registrado en la BDD correctamente'); window.location='../vistasusser/subir_Archivo.php'</script>";
                }else{
                    echo"Error: ".$sql."<br>".mysqli_error($link);
                }
            }else{
                echo "<script>alert('Elija otro nombre para el archivo'); window.location='../vistasusser/subir_Archivo.php'</script>";
            }

            
            


        }else{
            echo "<script>alert('El archivo es demasiado pesado (+10MB)'); window.location='../vistasusser/subir_Archivo.php'</script>"; 
        }
    }else{
        echo "<script>alert('El archivo no es permitido, elija otro por favor'); ";
    }




?>