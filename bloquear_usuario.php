<?php

    include('info.php');
    
    $userid = $_POST['userid'];
    $motivo = $_POST['motivo'];

    if($userid == 15){
	echo "No te podes autobanear";
    }
    else {
    	    $query = "UPDATE usuarios SET bloqueo = 'si', motivo = '$motivo' WHERE id = '$userid'";
            $result = mysqli_query($connection, $query);
            if(!$result) {
                die('Query Error'. mysqli_error($connection));
            }
            else {
            echo "Usuario baneado exitosamente papu Bv"; 
            }
    }