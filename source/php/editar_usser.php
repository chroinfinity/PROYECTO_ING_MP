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
        $nombre_usuario_c = $_GET['name'];
        $correo_usuario_c = $_GET['email'];
        //se usa validacion con isset, en caso de realizarse el registro y no se percibe un nivel, se asigna automaticamente 1:
        /*Si se recibe el dato del nivel, se le asigna el valor a la variable, de caso contrario, se le asigna automaticamente
        un 1, de primer nivel */
        $nivel_usuario_c = $_GET['level'];
        //Si se recibe una instrucción de estado, estará activo/inactivo, de caso contrario se asigna un inactivo (0) por default:
        $estado_usuario_c = $_GET['estado'];

        //clave administrador:
        $clave_admin_confirmacion = $_GET['password'];


        //validacion de clave administrativa:
        
                $sql = "UPDATE INTO usuarios(nombreUsuario, nivelUsuario, habilitarUsuario) VALUES ($nombre_usuario_c,$nivel_usuario_c,$estado_usuario_c)";
                $rta = mysqli_query($link, $sql);

                if(!$rta){
                    echo "<script>alert('Se ha actualizado al usuario: $nombre_usuario_c ')";

                    echo '<script language = javascript> 
                                window.location.href = "../vistasadmin/lista_de_usuarios_admin.php";
                        </script>';

                }else{
                    echo "<script>alert('No ha sido posible actualizar al usuario: $nombre_usuario_c ')";
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