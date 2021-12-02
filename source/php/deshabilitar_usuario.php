<?php
   //RECIBIMIENTO DE DATOS DE REGISTRO DE USUARIO

    //Se hace la conexión con la BDD:
    include 'connection.php';
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


        
           
                $sql = "UPDATE usuarios set habilitarUsuario= 0 WHERE idUsuario= $id_usuario_c";
                $rta = mysqli_query($link, $sql);

                var_dump($sql);
                var_dump($rta);

                if($rta){
                    echo "<script>alert('Usuario: $nombre_usuario_c deshabilitado!'); window.location='../vistasadmin/lista_de_usuarios_admin.php'</script>";

                }else{
                    echo "<script>alert('Usuario: $nombre_usuario_c no fue posible de deshabilitar. Intente más tarde'); window.location='../vistasadmin/lista_de_usuarios_admin.php'</script>";
                }
            
        
               
            
        
    


        //Variables de prueba (var_dumbs): Las var dumbs ayudan a visualizar las variables que se estan recibiendo.
        /* echo($nivel);
        echo($estado);
        var_dump($nombre);
        var_dump($correo);
        var_dump($clave);
        var_dump($nivel);
        var_dump($estado); */


?>