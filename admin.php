<?php

  include('info.php'); 

  $userid = $_POST['userid'];

  if($userid==15){
    $query = "SELECT * from usuarios LEFT JOIN task ON usuarios.id = task.user_id";
    $result = mysqli_query($connection, $query);

    if($result)
    {
        $json = array();
        while ($row = mysqli_fetch_array($result,1)) {
            $json[] = array(
                'userid' => $row['id'],
                'username' => $row['username'],
                'useremail' => $row['useremail'],
                'fecharegistro' => $row['fecha_registro'],
                'ultimoingreso' => $row['ultimo_ingreso'],
                'cantidadingresos' => $row['cantidad_ingresos'],
		        'bloqueo' => $row['bloqueo'],
                'motivo' => $row['motivo'],
                'nombre' => $row['nombre'],
                'edad' => $row['edad'],
                'email' => $row['email'],
                'dni' => $row['dni']
            );
        }

        $jsonstring = json_encode($json);
        echo $jsonstring; 
    
    }else
    {
        die('Query Error'. mysqli_error($connection));
    }

 }
?>