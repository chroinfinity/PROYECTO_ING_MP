<?php

    //conexion a la BDD e inicio de sesión.
    include '../php/connection.php';

    //se realiza validación en caso de que ya exista una sesión, manejo de accesos.
    if (isset($_SESSION['id'])) {
        if(isset($_SESSION['nivelUsuario'] )){
            if($_SESSION['nivelUsuario'] <= 3){
                header("Location: ../vistasusser/home.php");
            }
        }

    }else{
        header("Location: ../index.php");
    }

    //obtención de datos de archivo:

    //Requerir el lector de pdf
    include "../vendor/autoload.php";
    

 	$ruta = $_GET['rutaFile'];
	
	$idArchivo = $_GET['idArchivo'];
    $nombreArchivo = $_GET['nameFile'];
	$extensionArchivo = $_GET['type'];
	$idPropietario = $_GET['idUsuario'];

    //Para el analisis
    $numeroPalabras = 0;
    $numeroLineas = 0;
    $numeroCaracteres = 0;
    $numeroParrafos = 0;

    

    //Captura de variables de sesion (USUARIO-ADMIN)
    $id_usuario = $_SESSION['id'];
    $nombre_usuario = $_SESSION['nombreUsuario'];
    $nivel = $_SESSION['nivelUsuario'];
    $habilitado = $_SESSION['habilitarUsuario'];
    $correo_usuario = $_SESSION['correoUsuario'];



    //Funciones auxiliares
    //##############################################################################################

    //Función para limpiar letras

    function eliminar_acentos($cadena){
        
        //Reemplazamos la A y a
        $cadena = str_replace(
        array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
        array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
        $cadena
        );
    
        //Reemplazamos la E y e
        $cadena = str_replace(
        array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
        array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
        $cadena );
    
        //Reemplazamos la I y i
        $cadena = str_replace(
        array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
        array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
        $cadena );
    
        //Reemplazamos la O y o
        $cadena = str_replace(
        array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
        array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
        $cadena );
    
        //Reemplazamos la U y u
        $cadena = str_replace(
        array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
        array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
        $cadena );
    
        //Reemplazamos C y c
        $cadena = str_replace(
        array('Ç', 'ç'),
        array('C', 'c'),
        $cadena
        );
        
        return $cadena;
    }

    //Alfabeto
    $letras = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','ñ','o','p','q','r','s','t',
        'u','v','w','x','y','z');


    //ANALIZAR TXT
    //##############################################################################################

    if($extensionArchivo == 'txt'){

        $actual = 0;
        $anterior = 0;

        //Lineas y parrafos

        //var_dump(file($ruta));

        foreach(file($ruta) as $linea) {
            $actual = strlen($linea);
            if($actual == 2 and $anterior > 2){
                $numeroParrafos = $numeroParrafos + 1;
            }

            if($actual > 2){
                $numeroLineas++;
            }
            $anterior = $actual;

        } 

        if($actual > 2 ){
            $numeroParrafos = $numeroParrafos + 1;
        }

        //Caracteres y palabras
        $texto = file_get_contents($ruta);

        /*echo "<prev>";
        echo $texto;
        echo "</prev>";*/


        $limpia = eliminar_acentos($texto);
        $minusculas = mb_strtolower($limpia, 'UTF-8');
        $arrayListo = str_split($minusculas);

        //for ($i=0; $i < count($arrayListo); $i++) { 
        //    echo $arrayListo[$i];
        //}
        
        //Número de caracteres
        $numeroCaracteres =  count($arrayListo);

        //Palabras
        $diccionario = array();
        $temp = "";

        $flag = false;
        for ($i=0; $i < count($arrayListo); $i++) { 
            if(in_array($arrayListo[$i], $letras)){
                //echo $arrayListo[$i].' -> Agregado</br>';
                $temp = $temp.$arrayListo[$i];
                $flag = true;
            }else{
    
                //Al menos contiene un caracter valido
    
                if($flag){
                    //echo "Recolectado: ".$temp.'</br>';
                    $flag = false;
                    $numeroPalabras = $numeroPalabras + 1;
                    //Agregamos la palbra 
    
                    //Primera vez
                    if(!isset($diccionario[$temp])){
                        $diccionario[$temp] = 1;
                    }else{
                        //Ya existe
                        $diccionario[$temp] = $diccionario[$temp] + 1;
                    }
    
                    $temp = "";
    
                }
                //echo $arrayListo[$i].'NOP </br>';
            }
        }
 

        //Palabra sobrante 
        if(strlen($temp)>0){
            //echo "Recolectado: ".$temp.'</br>';
            //Agregamos la palbra 
            $numeroPalabras = $numeroPalabras + 1;
            //Primera vez
            if(!isset($diccionario[$temp])){
                $diccionario[$temp] = 1;
            }else{
                //Ya existe
                $diccionario[$temp] = $diccionario[$temp] + 1;
            }
            $temp = "";
        }

        //FILTRADO DE PLABRAS QUE SOLO APARECEN UNA VEZ:
        $diccionariofiltrado = array();
        /* foreach ($diccionariofiltrado as $key => $value) {
            
            echo($value);
        } */

        foreach($diccionario as $key => $value){
            if($value > 1){
                $diccionariofiltrado[$key] = $value;
            }
        }

        
        /* foreach ($diccionario as $key => $value) {
            echo ("Key:".$key);
            echo("Value:".$value."\n\n");
        } */

        /* foreach ($diccionariofiltrado as $key => $value) {
            echo ("Key:".$key);
            echo($value);
        } */
        //----
        
        //acomodo de diccionario acomodado:
        $diccionario_acomodado = arsort($diccionario);

        $diccionario = $diccionario;

    }

    ### ANALIZAR PDF ###################################################################################

    if($extensionArchivo == 'pdf'){

        //Caracteres y palabras
        $parseador = new \Smalot\PdfParser\Parser();
        $documentoPDF = $parseador->parseFile($ruta);
        $contenidoPDF = $documentoPDF->getText();


        //var_dump("CONTENIDO PDF SIN BREAKS: ".$contenidoPDF);
        $contenidobreakeadoPDF = $documentoPDF->getText();


        //SEGUNDO TEXTO CON <BR> SALTOS DE LINEA EN CADA CORTE
        $pdfText= nl2br($contenidobreakeadoPDF);


        //test conteo de parrafos:
        /* for($i=0;$i<strlen($pdfText);$i++)
        {
            //contar saltos de linea:
            if(strpos($pdfText[$i],'n')){
                echo "linea #".$i."contiene doble salto de linea";
            }
        } */


        //separacin por saltos de linea
        $arreglo_lineas = explode("\n",$contenidoPDF);
        $numeroLineas = 0;
        // Recorremos cada carácter de la cadena
        for($i=0;$i<count($arreglo_lineas);$i++)
        {
            // Mostramos cada uno de los caracteres...
            // con $cadena[0] se muestra el primera caracter, [1], el segundo, etc...
            //echo "NUMERO ".$i.":".$arreglo_lineas[$i] ."<br>";
            $numeroLineas++;
            
        }

        //echo nl2br("CONTENIDO PDF con BREAKS: ".$pdfText);

        //test de parrafos y lineas:
         //Lineas y parrafos
         /*
         for($i=0;$i<strlen($contenidoPDF);$i++)
         {
             // Mostramos cada uno de los caracteres...
             // con $cadena[0] se muestra el primera caracter, [1], el segundo, etc...
             echo "<br>".$contenidoPDF[$i];
         } //fin test */


        //impresion de contenido puro SIN PROCESAR del parsser: El Elemento HTML <pre> (o Texto HTML Preformateado) representa texto preformateado
        /*$texto = $documentoPDF->getText();
        echo "<pre>";
        echo $texto;
        echo "</pre>"; */

        $arrayPDF = str_split($contenidoPDF);

        //var_dump($arrayPDF);

        $array_contenido= $arrayPDF ;

       /* //impresion de contenido inicio
        for ($i=0; $i < count($array_contenido); $i++){
            echo ("linea: ".$i.":".$array_contenido[$i]);
        } //impresion de contenido - fin */

        //Caracteres
        $numeroCaracteres =  count($arrayPDF);

        //Palabras y recurrencia
        $pegado = implode($arrayPDF);
        $limpia = eliminar_acentos($pegado);
        $minusculas = mb_strtolower($limpia, 'UTF-8');
        $arrayListo = str_split($minusculas);

        //Palabras
        $diccionario = array();
        $temp = "";

        $flag = false;
        for ($i=0; $i < count($arrayListo); $i++) { 
            if(in_array($arrayListo[$i], $letras)){
                //echo $arrayListo[$i].' -> Agregado</br>';
                $temp = $temp.$arrayListo[$i];
                $flag = true;
            }else{
    
                //Al menos contiene un caracter valido
    
                if($flag){
                    //echo "Recolectado: ".$temp.'</br>';
                    $flag = false;
                    $numeroPalabras = $numeroPalabras + 1;
                    //Agregamos la palbra 
    
                    //Primera vez
                    if(!isset($diccionario[$temp])){
                        $diccionario[$temp] = 1;
                    }else{
                        //Ya existe
                        $diccionario[$temp] = $diccionario[$temp] + 1;
                    }
    
                    $temp = "";
    
                }
                //echo $arrayListo[$i].'NOP </br>';
            }
        }

        //Palabra sobrante 
        if(strlen($temp)>0){
            //echo "Recolectado: ".$temp.'</br>';
            //Agregamos la palbra 
            $numeroPalabras = $numeroPalabras + 1;
            //Primera vez
            if(!isset($diccionario[$temp])){
                $diccionario[$temp] = 1;
            }else{
                //Ya existe
                $diccionario[$temp] = $diccionario[$temp] + 1;
            }
            $temp = "";
        }

        $diccionario_acomodado = arsort($diccionario);

        
        $diccionario = $diccionario;
    }


    ############## ANALIZAR DOCX ##########################################

    if($extensionArchivo == 'docx'){
        //echo "Not Available";

        $path_to_file = $ruta;

    //FUNCION PARA CONTAR PALABRAS REPETIDAS:
    function docx2text($filename) {
        return readZippedXML($filename, "word/document.xml");
    }
    
    function readZippedXML($archiveFile, $dataFile) {
        // Create new ZIP archive
        $zip = new ZipArchive;
    
        // Open received archive file
        if (true === $zip -> open($archiveFile)) {
        // If done, search for the data file in the archive
        if (($index = $zip -> locateName($dataFile)) !== false) {
            // If found, read it to the string
            $data = $zip -> getFromIndex($index);
            // Close archive file
            $zip -> close();
            // Load XML from a string
            // Skip errors and warnings
            $xml = new DOMDocument();
            $xml -> loadXML($data, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
            // Return data without XML formatting tags
            return strip_tags($xml -> saveXML());
        }
        $zip -> close();
        }
    
        // In case of failure return empty string
        return "";
    }

    $contenido_word = docx2text($ruta); // Save this contents into a string
    //echo $contenido_word; 


    $limpia = eliminar_acentos($contenido_word);
    $minusculas = mb_strtolower($limpia, 'UTF-8');
    //impresion de contenido "limpio"
    //echo ("ESTE ES EL CONTENIDO LIMPIO!!!!: ".$minusculas); 


    //testing de break con word:////////////////////////////////////////////////
   /*  $contenido_breakeado_word= nl2br($contenido_word);
    $doc_conlineas = explode("\n",$contenido_breakeado_word);

    foreach ($doc_conlineas as $key => $value) {
        echo ("LINEA #".$key.":".$value."\n");
    } */
    //////////////////////////////////////////////////////777

    $arraylisto = str_split($minusculas);

    $array_tmp= array(); //arreglo temporal para vaciar espacios
    //echo("IMPRESION DE ARREGLO TRABAJADO CON ESPACIOS, DOCX");
    foreach ($arraylisto as $key => $value) {
        if($value != " " && $value != ""){
            $array_tmp[]= $value;
        }
        /* echo ("Key:".$key);
        echo("Value:".$value."/\n\n"); */
    }


    //ARREGLO SIN ESPACIOS
    /* echo ("ARREGLO SIN ESPACIOS:");
    foreach ($array_tmp as $key => $value) {
        echo ("Key:".$key);
        echo("Value:".$value."/\n\n");
    } */

    //ARREGLO SIN ESPACIOS SE PASA A ARREGLO LISTO
    $numeroCaracteres = count($arraylisto);
    //echo "UNION DE ARREGLO LIMPIO:".(implode($array_tmp));

    //var_dump($numeroCaracteres);


    //Palabras
    $diccionario = array();
    $temp = "";

    $flag = false;
    for ($i=0; $i < count($arraylisto); $i++) { 
        if(in_array($arraylisto[$i], $letras)){
            //echo $arrayListo[$i].' -> Agregado</br>';
            $temp = $temp.$arraylisto[$i];
            $flag = true;
        }else{

            //Al menos contiene un caracter valido

            if($flag){
                //echo "Recolectado: ".$temp.'</br>';
                $flag = false;
                $numeroPalabras = $numeroPalabras + 1;
                //Agregamos la palbra 

                //Primera vez
                if(!isset($diccionario[$temp])){
                    $diccionario[$temp] = 1;
                }else{
                    //Ya existe
                    $diccionario[$temp] = $diccionario[$temp] + 1;
                }

                $temp = "";

            }
            //echo $arrayListo[$i].'NOP </br>';
        }
    }
        //Acomodo de diccionario de palabras:
        $diccionario_acomodado = arsort($diccionario);
        
        //FUNCION PARA DATOS DE ANALISIS

        $source= 'archivodocxtest_limpio.docx';

        $zip = new ZipArchive;
        $doc_file = $ruta;
        $zip->open($doc_file);
        $zip->extractTo('./tmp');


        // CARGA DE ARCHIVO:
        $xmlDoc = new DOMDocument();
        $xmlDoc->load("./tmp/docProps/app.xml");

        //print $xmlDoc->saveXML();

        $x = $xmlDoc->documentElement;
        foreach ($x->childNodes AS $item) {
            if($item->nodeName == "Lines"){
                //echo "NUMERO DE LINEAS: ".$item->nodeValue;
                $numeroLineas = $item->nodeValue;
        }

        if($item->nodeName == "Words"){
            //echo "NUMERO DE PALABRAS: ".$item->nodeValue;
            $numeroPalabras = $item->nodeValue;
        }

        if($item->nodeName == "Characters"){
            //echo "NUMERO DE CARACTERES: ".$item->nodeValue;
            //$numeroCaracteres = $item->nodeValue;
    
        }

        if($item->nodeName == "Paragraphs"){
            //echo "NUMERO DE PARRAFOS: ".$item->nodeValue;
            $numeroParrafos = $item->nodeValue;

        }

    }
           
    } //FIN DOC

    

     ############## ANALIZAR DOC ##########################################

     if($extensionArchivo == 'doc'){
        //echo "Not Available";

        $path_to_file = $ruta;

        $fileHandle = fopen($path_to_file, 'r');
        $line       = @fread($fileHandle, filesize($path_to_file));
        $lines      = explode(chr(0x0D), $line);
        $response   = '';
        $contador_lineas = 0;
        
        foreach ($lines as $current_line) {
            $contador_lineas++;
            
            $pos = strpos($current_line, chr(0x00));
            
            if ( ($pos !== FALSE) || (strlen($current_line) == 0) ) {
                
            } else {
                $response .= $current_line . ' -TEST';
            }
        }
        
        $response = preg_replace('/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/', '', $response);

        echo $response;
        echo "numero de lineas:".$contador_lineas; 
    }

?>

<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="../resources/img/icons/logo_ico.ico">
    <title>Inicio</title>
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- FONTS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Red+Rose&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto&amp;display=swap">
    
    <!--STYLE SHEETS -->
    <link rel="stylesheet" href="../css/ussers/styles.css">
    <link rel="stylesheet" href="../css/ussers/btn.css">

    <!-- CHART JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js" integrity="sha512-GMGzUEevhWh8Tc/njS0bDpwgxdCJLQBWG3Z2Ct+JGOpVnEmjvNx6ts4v6A2XJf1HOrtOsfhv3hBKpK9kE5z8AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
</head>


<body>
    
    <!-- CABECERA PROYECTO (LOGOUT)-->
    <div class="" style="background-color: #ffffff;">
        <img src="../resources/img/icons/LOGO_LARGE.png" style="width: 200px;margin-left: 23px; margin-top: auto;"><a href="../php/logout.php"><img class="float-end" src="../resources/img/icons/logout.png" style="width: 50px;margin-top: 10px;margin-right: 10px;"></a>
    </div>
    <div>

        <!-- NAV BAR -->
        <nav class="navbar navbar-light navbar-expand-md" style="background: #57638F;">
            <div class="container-fluid"><a class="navbar-brand" href="#"></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link active usser_nick m-lg-1 usser_nick p-lg-0.1" href="../vistasadmin/home_admin.php" style="font-family: 'Red Rose', serif;background: #98bd9d;border-radius: 7px;color: rgb(255,255,255);text-align: center;">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link usser_nick m-lg-1 usser_nick p-lg-0.1" href="../vistasadmin/archiveroadmin.php" style="font-family: 'Red Rose', serif;background: #ffffff;border-radius: 7px;color: #98bd9d;text-align: center;">Archivos</a></li>
                        <li class="nav-item"><a class="nav-link usser_nick m-lg-1 usser_nick p-lg-0.1" href="../vistasadmin/lista_de_usuarios_admin.php" style="font-family: 'Red Rose', serif;background: #98bd9d;border-radius: 7px;color: rgb(255,255,255);text-align: center;">Lista de usuarios</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>


    <!-- CANVAS DE GRÁFICAS-->

    <div class="container">
        <div class="row">
            <div class="col-md">
                <div class="container" style="box-shadow: 5px 5px 5px rgba(33,37,41,0.39);background-color: #ffffff; border-radius: 5px; margin-top: 20px; max-width: 600px; max-height: 800px;">
                    <canvas id="miGrafica" width="100px" height="100px"></canvas>
                </div>
            </div>
    
            <div class="col-md">
                <div class="container border-light" style="box-shadow: 5px 5px 5px rgba(33,37,41,0.39);text-align: center; background-color: #57638F;border-style: solid;border-color:#ffffff; border-radius: 5px; margin-top: 20px; color: white;">
                    <br>
                    <h3>Estadisticas</h3><br>
                        <h6 style="color:#ffffff">Archivo: <div style="color:#98bd9d; padding:2px"><?php echo $nombreArchivo;?></div></h6>
                        <hr>
                        Numero de Palabras: <h6 id="num_palabras"><?php echo $texto;?></h6> <br>
                        <?php if($extensionArchivo != "pdf"){  ?>Numero de Parrafos: <h6 id="num_parrafos"><?php echo $numeroParrafos;?></h6> <br> <?php } ?>
                        Numero de caracteres: <h6 id="num_caracteres"><?php echo $numeroCaracteres; ?></h6> <br>
                        Numero de Líneas: <h6 id="num_lineas"><?php echo $numeroLineas; ?></h6> <br>
                </div>

                <!-- BOTON DE REGRESO A ARCHIVERO -->
                <div  style="margin-top: 20px;">
                    <a href="../vistasadmin/archiveroadmin.php"><button  class="btn-outline-primary analisis_btn_back">Regresar</button></a>
                </div>
                <br>
                
                
            </div>
        </div>

    </div>

    <!-- TABLA DE PALABRAS -->
    <div class="container" style="background-color:#57638F; border-radius:5px;">
        <h2 style="margin-top:20px; text-align:center; color:white;">ANALISIS DE CONTENIDO</h2>
    </div>
     <!--Tabla con el analisis-->
     <div class="container" style="margin-top:20px; background-color:#ffffff; border-radius:5px; margin-top:20px; height: 600px;overflow: scroll;">
    	<div class="row justify-content-center" >
    		<div class="col-10">

                 
    			<table class="table table-fixed" style="margin-top:20px;">

                    <thead>
                        <tr>

                            <th style="color:#98bd9d;">Palabra</th>
                            <th style="color:#98bd9d;"># Repeticiones</th>
                            
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($diccionario as $key => $value) { ?>
                        
                            <tr>
    
                                <td>
                                    <?php echo $key; ?>
                                </td>
    
                                <td>
                                    <?php echo $value; ?>
                                </td>
    
                            </tr>
                        <?php } ?>

                    </tbody>

                </table>

    		</div>
    	</div>
    </div>
    

      
    
</body>

<?php if($extensionArchivo != "pdf"){?>
    <script>

       //variables prueba:
       num_palabras= <?php echo $numeroPalabras;?>;
        num_lineas = <?php echo $numeroLineas; ?>;
        num_parrafos = <?php echo $numeroParrafos;?>;
        num_caracteres = <?php echo $numeroCaracteres; ?>;

        var label_palabras = document.getElementById('num_palabras');
        var label_lineas = document.getElementById('num_lineas');
        var label_parrafos = document.getElementById('num_parrafos');
        var label_caracteres = document.getElementById('num_caracteres');

        //agregado de información
        label_palabras.innerHTML= num_palabras;
        label_lineas.innerHTML= num_lineas;
        label_parrafos.innerHTML= num_parrafos;
        label_caracteres.innerHTML= num_caracteres;
        //obtencion de canvas
        let miCanvas=document.getElementById("miGrafica").getContext("2d");

        //variable de libreri char: https://www.chartjs.org/docs/latest/samples/other-charts/radar-skip-points.html

        var chart = new Chart(miCanvas,{
            type: "bar",
            data: {
                
                labels:["# de palabras","# de lineas","# de parrafos","# de caracteres"],
                datasets: [
                    {
                        
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)'
                            ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)'
                            ],
                        borderWidth: 1,
                        data:[num_palabras,num_lineas,num_parrafos,num_caracteres]
                    }
                ]
            },

            options: {
                responsive: true,
                plugins: {
                title: {
                    display: true,
                    text: 'Analisis de documento'
                },

                legend: {
                        display: false,
                        labels: {
                            color: 'rgb(255, 99, 132)'
                        }
                },

                }
            },
        })
    
    
    </script>

    <?php } ?>


    <?php if($extensionArchivo == "pdf"){?>
    <script>

       //variables prueba:
       num_palabras= <?php echo $numeroPalabras;?>;
        num_lineas = <?php echo $numeroLineas; ?>;
        num_caracteres = <?php echo $numeroCaracteres; ?>;

        var label_palabras = document.getElementById('num_palabras');
        var label_lineas = document.getElementById('num_lineas');
        var label_caracteres = document.getElementById('num_caracteres');

        //agregado de información
        label_palabras.innerHTML= num_palabras;
        label_lineas.innerHTML= num_lineas;
        label_caracteres.innerHTML= num_caracteres;

        //obtencion de canvas
        let miCanvas=document.getElementById("miGrafica").getContext("2d");

        //variable de libreri char: https://www.chartjs.org/docs/latest/samples/other-charts/radar-skip-points.html

        var chart = new Chart(miCanvas,{
            type: "bar",
            data: {
                
                labels:["# de palabras","# de lineas","# de caracteres"],
                datasets: [
                    {
                        
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)'
                            ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)'
                            ],
                        borderWidth: 1,
                        data:[num_palabras,num_lineas,num_caracteres]
                    }
                ]
            },

            options: {
                responsive: true,
                plugins: {
                title: {
                    display: true,
                    text: 'Analisis de documento'
                },
                legend: {
                        display: false,
                        labels: {
                            color: 'rgb(255, 99, 132)'
                        }
                }
                },
            },
        })
    
    
    </script>

    <?php } ?>

    <!-- DO NOT TOUCH:  Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <!-- LIBRERIA CHART JS (CDN) -->

<footer class="container" style="text-align: center; color:#57638F">
    <br>
    <h4>Packfile - 2021</h4>
</footer>

</html>