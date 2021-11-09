<?php

    //VARIABLES DE SESION

    session_start();

    $enviar= $_POST['submit'];
    //rescate de variables:
    $nombre = $_POST['name'];
    $asunto = $_POST['asunto'];
    $email = $_POST['email'];
    $mensaje = $_POST['mensaje_correo'];


    //metodo de envio de correo
    if(isset($_POST['submit'])){
        if(!empty($_POST['name']) && !empty($_POST['asunto']) && !empty($_POST['email']) && !empty($_POST('mensaje_correo'))){
            //rescate de variables:
            $nombre = $_POST['name'];
            $asunto = $_POST['asunto'];
            $email = $_POST['email'];
            $mensaje = $_POST['mensaje_correo'];

            //construccion de correo:
            $header = "From: noreply@example.com" . "\r\n";
            $header.= "Reply-To: noreply@exmaple.com" . "\r\n";
            $header.= "Enviado desde PACKFILE- Ussers" . "\r\n";
            $header.= "X-Mailer: PHP/" . phpversion();

            $mensajecompleto = $mensaje . "\n Datos de Usuario: \n Nombre de usuario: ". $_SESSION['nombreUsuario'] . "\nEmail: " . $_SESSION['correoUsuario'];
            $asuntofinal = "PACK-FILE: " . $asunto;
            $mail = @mail($email,$asuntofinal,$mensajecompleto,$header);

            if($mail){
                echo "<script>alert('Gracias por enviarnos mensaje, un administrador se pondrá pronto en contacto contigo')</script>";
                echo "<script> setTimeout(\"location.href='../vistasusser/ayuda.php'\",100)</script>";
            }
        }
    }

?>