<?php 

    $nombre_archivo = $_GET["nameFile"];
    $ruta = $_GET["rutaFile"];
    $id_usuario_file = $_GET["idUsuario"];


    $filename = $nombre_archivo;
    //$file = "../files/2/".$filename; //$ruta_archivo;  php
    $file = $ruta;
    
    header('Content-type: application/octet-stream');
    header("Content-Type: ".mime_content_type($file));
    header("Content-Disposition: attachment; filename=".$filename);
    while (ob_get_level()) {
        ob_end_clean();
    }
    readfile($file);

?>