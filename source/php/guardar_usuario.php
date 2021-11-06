<?php
    //RECIBIMIENTO DE DATOS DE REGISTRO DE USUARIO

    //Se hace la conexión con la BDD:
    require 'connection.php';

    //Se reciben los datos mandados a través del formulario:
        $nombre = $_POST['name'];
        $correo = $_POST['email'];
        //se usa validacion con isset, en caso de realizarse el registro y no se percibe un nivel, se asigna automaticamente 1:
        /*Si se recibe el dato del nivel, se le asigna el valor a la variable, de caso contrario, se le asigna automaticamente
        un 1, de primer nivel */
        $nivel = isset($_POST['exampleRadios']) ? $_POST['exampleRadios'] : 1;
        $clave = $_POST['password_usser'];
        $clave_admin = isset($_POST['password']) ? $_POST['password'] : 1; //password admin, test -> "1111"
        //Si se recbe una instrucción de estado, estará activo/inactivo, de caso contrario se asigna un inactivo (0) por default:
        $estado = isset($_POST['estado']) ? $_POST['estado'] : 0;
        //test de variable de sesion
        $sesion = 'admin';


        //Variables de prueba (var_dumbs): Las var dumbs ayudan a visualizar las variables que se estan recibiendo.
        echo($nivel);
        echo($estado);
        var_dump($nombre);
        var_dump($correo);
        var_dump($clave);
        var_dump($nivel);
        var_dump($clave_admin);
        var_dump($estado);


        //Encriptacion de contraseña: (HASH)
        //$clave_fuerte = password_hash($clave,PASSWORD_DEFAULT); 

    /*espacio libre  validaciones del lado de servidor: ejemplo_ Usuarios duplicados (correos).

        [...] 
        
    */
    //VALIDACIÓN DE USUARIO NO EXISTENTE:
    $query_correo = mysqli_query($link, "SELECT * FROM usuarios WHERE correoUsuario = '$correo'");
    $nr = mysqli_num_rows($query_correo); //# de filas
    //var_dump($nr);
    $buscar_correo = mysqli_fetch_array($query_correo); #arreglo de consulta
    var_dump($buscar_correo);

    //si la sesión es de admnistrador:
    if($sesion == 'admin'){
        //Se valida la clave de administrador:
        if($clave_admin == '1111'){
            //validación de existencia de correo ocupado:
            if(($nr >= 1) && ($correo == $buscar_correo['correoUsuario'])){
                echo "<script>alert('No ha sido posible registrar a usuario: $nombre por favor elija otro correo'); window.location='../vistasadmin/registro.php'</script>";
            }else{
                //El correo no ha sido registrado con anterioridad, asi que puede registrarse:
                //Generación de query para inserción de datos:
                $sql = "INSERT INTO usuarios (nombreUsuario,correoUsuario,passwordUsuario,nivelUsuario,habilitarUsuario) VALUES ('$nombre','$correo','$clave','$nivel','$estado')";

                //Ejecución de query:
                $resultado = $link->query($sql); //verifiación de ejecucion de query
                //mysqli_close($conexion);

                //Redireccionamiento:
                if($resultado){
                    echo "<script>alert('Usuario registrado: $nombre'); window.location='../vistasadmin/lista_de_usuarios_admin.html'</script>";
                }else{
                    echo"Error: ".$sql."<br>".mysqli_error($link);
                }

            }
        }else{
            //contraseña de admin incorrecta
            echo "<script>alert('Contraseña de administrador incorrecta, operacion rechazada'); window.location='../vistasadmin/lista_de_usuarios_admin.html'</script>";
        }
    }


?>

