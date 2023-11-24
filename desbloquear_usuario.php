<?php

    include('info.php');
    
    $userid = $_POST['userid'];
	
    if($userid == 15){
	echo "No te podes autodesbanear";
    }
    else {
    	    $query = "UPDATE usuarios SET bloqueo = 'no', motivo = '' WHERE id = '$userid'";
            $result = mysqli_query($connection, $query);
            if(!$result) {
                die('Query Error'. mysqli_error($connection));
            }
            else {
            echo "Usuario desbaneado exitosamente :'v"; 
            }
    }