<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "packfile";

    $link = new mysqli($servername, $username, $password, $db);

    if($link->connect_error){
        die("Connection failed: " . $link->connect_error);
    }else{
        /* echo "Connected successfully"; */
    }
    

    if(!isset($_SESSION)) 
		    { 
		        session_start(); 
		    }

?>