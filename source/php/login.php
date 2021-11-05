<?php 

    include 'connection.php';

    $email= isset($_POST["email"]) ? $_POST["email"]:null;
	$contrasena= isset($_POST["password"]) ? $_POST["password"]:null;

    $consulta = "SELECT * FROM usuarios WHERE correoUsuario='".$email."' AND passwordUsuario='".$contrasena."'"; 
    $resultado = mysqli_query($link,$consulta);
                    
    $fila = mysqli_fetch_array($resultado);

    $nivel = $fila[4];
    $habilitado = $fila[5];

    if (!$fila[0])
    {
        echo '<script language = javascript>
                    alert("Usuario o Password incorrectos, por favor verifique.")
            </script>';

        echo '<script language = javascript> 
                    window.location.href = "index.php";
            </script>';

    }
    else
    {
        $_SESSION['correoUsuario'] = $fila['correoUsuario'];
        $_SESSION['nombreUsuario'] = $fila['nombreUsuario'];
        $_SESSION['nivelUsuario'] = $fila['nivelUsuario'];
        $_SESSION['habilitarUsuario'] = $fila['habilitarUsuario'];

        if($nivel == 4 && $habilitado == 1){
            header("Location: ../vistasadmin/home_admin.html");
        }

        else if($nivel <=3 && $nivel > 0 && $habilitado == 1){
            header("Location: ../vistasusser/home.html");
        }

        else{
            echo '<script language = javascript>
                    alert("La cuenta ingresada ha sido deshabilitada indefinidamente. Intente con otra cuenta.")
            </script>';

            echo '<script language = javascript> 
                        window.location.href = "../index.php";
                </script>';
        }


        
    }
                    
                
?>