<?php

    include('info.php');

    $userid = $_POST['userid'];

    if($userid==15){
       $query2 = "SELECT * from task";
       $result = mysqli_query($connection, $query2);
    }else{
        $query = "SELECT * from task WHERE user_id = '$userid'";
        $result = mysqli_query($connection, $query);
    }
    if (!$result) {
        die('Query Error'. mysqli_error($connection));
    }


    $json = array();
    while ($row = mysqli_fetch_array($result,1)) {
        $json[] = array(
            'id' => $row['taskid'],
            'nombre' => $row['nombre'],
            'edad' => $row['edad'],
            'dni' => $row['dni'],
            'email' => $row['email']
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring; 
?>
