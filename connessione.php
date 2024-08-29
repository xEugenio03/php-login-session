<?php
    $host="127.0.0.1";
    $user="root";
    $passwordDB="root";
    $database="universita";

    $conn=new mysqli($host,$user,$passwordDB,$database);
    if($conn->connect_error)
        die("ERRORE DI CONNESSIONE: ".$conn->connect_error);
?>