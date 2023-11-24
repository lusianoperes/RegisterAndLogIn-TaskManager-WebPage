<?php

    include('info.php');

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $email = $_POST['email'];
    $dni = $_POST['dni'];

    if (isset($id) && isset($nombre) && isset($edad) && isset($email) && isset($dni))  {
            $query = "UPDATE task SET nombre = '$nombre', edad = '$edad', email = '$email', dni = '$dni' WHERE taskid = '$id'";
            $result = mysqli_query($connection, $query);
            if(!$result) {
                die('Query Error'. mysqli_error($connection));
       }
    }
?>
