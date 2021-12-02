<?php

    //Se llama la sesión:
    session_start();

    //Se destruye la sesión:
    echo '<script language = javascript>
                    alert("Saliendo de sesión...")
            </script>';
    session_destroy();

    echo '<script language = javascript> 
                        window.location.href = "../index.php";
    </script>';


?>