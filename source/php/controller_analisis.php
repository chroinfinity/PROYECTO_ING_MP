<?php 

    //Validacion de sesión de usuario, si en dado caso no existe, redirecciona a index.php:
    if (!isset($_SESSION['id'])) {
        header("Location: ../index.php");
    }


    //validacion de obtencion de datos
    if(isset($_GET['idArchivo'])){
        $idArchivo = $_GET['idArchivo'];
        $ruta = $_GET['ruta'];
        $nombreArchivo = $_GET['nombreArchivo'];
        $tipoArchivo = $_GET['tipo'];

        //REDIRECCION DE ARCHIVOS SEGUN TIPO DE ANALISIS:


        if($tipoArchivo == "txt"){
            echo "<script> window.location='../vistasAcciones/analisis.php?idArchivo=".$idArchivo."'</script>";
        }


    }else{

        //redireccionamiento en caso de archivo perdido:
        echo "<script>alert('Archivo perdido');</script>";

        if($_SESSION['id'] <=3){
            echo "<script> window.location='../vistasusser/misarchivos.php'</script>";
        }else{
            echo "<script> window.location='../vistasadmin/archiveroadmin.php'</script>";
        }
        
    }

?>