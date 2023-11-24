<?php

    $HOST = "localhost";
    $USER = "seis";
    $PASS = "seis6321";
    $DB = "seis";

    $connection =  mysqli_connect  ($HOST ,$USER , $PASS, $DB);

    if (!$connection) {
        die ('Error de Conexión:' . mysqli_connect_error());
    }

    //if ($connection) {
       //echo "Database is connected.";
    //}

?>
