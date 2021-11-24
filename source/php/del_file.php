<?php

    //DESHABILITADO DE ARCHIVOS

    //Se hace la conexión con la BDD:
    include 'connection.php';
    //Validacion de sesión de usuario, si en dado caso no existe, redirecciona a index.php:
    if (!isset($_SESSION['id'])) {
        header("Location: ../index.php");
    }

    //Se reciben los datos mandados a través del formulario: (DESACTIVACION)
    if(isset($_POST['del_id'])){
        $id_archivo = $_POST['del_id'];

        $sql = "UPDATE archivos set estado=0 WHERE idArchivos= $id_archivo";
        $rta = mysqli_query($link, $sql);


        if($rta){
            echo "<script>alert('El archivo ha sido deshabilitado'); window.location='../vistasusser/micarpeta.php'</script>";
        }else{
            echo "<script>alert('El archivo no ha podido ser deshabilitado, intente mas tarde'); window.location='../vistasusser/micarpeta.php'</script>";
        }
    };

    //ACTIVACION

    if(isset($_POST['act_id'])){
        $id_archivo = $_POST['act_id'];

        $sql = "UPDATE archivos set estado=1 WHERE idArchivos= $id_archivo";
        $rta = mysqli_query($link, $sql);


        if($rta){
            echo "<script>alert('El archivo ha sido habilitado'); window.location='../vistasusser/micarpeta.php'</script>";
        }else{
            echo "<script>alert('El archivo no ha podido ser habilitado, intente mas tarde'); window.location='../vistasusser/micarpeta.php'</script>";
        }
    };



?>