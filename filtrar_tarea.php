<?php

    include('info.php');

    $search = $_POST['search'];
    $userid = $_POST['userid'];

    if (isset($search) && isset($userid)) {

        $search = $connection->real_escape_string($search);
        if (!empty($search) && !empty($userid)) {
	
		if ($userid == 15){
			$query = "SELECT * FROM task WHERE nombre LIKE '$search%'";
        		$result = mysqli_query($connection, $query);
		}else{
 			$query = "SELECT * FROM task WHERE nombre LIKE '$search%' AND user_id = '$userid'";
        		$result = mysqli_query($connection, $query);
		}

            if (!$result) {
                die('Query Error'. mysqli_error($connection));    
            }
            
            $json = array();
            while ($row = mysqli_fetch_array($result)) {
                $json[] = array(
                    'id' => $row['id'],
                    'nombre' => $row['nombre'],
                    'edad' => $row['edad'],
                    'email' => $row['email'],
                    'dni' => $row['dni'],
                    'imagen' => $row['imagen'] 
                );
            }
            $jsonstring = json_encode($json);
            echo $jsonstring; 
        }
    } 
?>

