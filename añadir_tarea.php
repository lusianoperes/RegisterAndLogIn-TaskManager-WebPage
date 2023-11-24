<?php 

    include('info.php');
    
    $userid = $_POST['userid'];
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $email = $_POST['email'];
    $dni = $_POST['dni'];

    if (isset($nombre) && isset($edad) && isset($email) && isset($dni) && isset($userid)){
        $nombre = $connection->real_escape_string($nombre);
        $email = $connection->real_escape_string($email);
        $nombre = $connection->real_escape_string($nombre);

        if (!empty($nombre) && !empty($edad) && !empty($email) && !empty($dni) && !empty($userid)){

            $query = "INSERT into task(user_id, nombre, edad, email, dni) VALUES ('$userid','$nombre', '$edad', '$email' , '$dni')";
            $result = mysqli_query($connection, $query);
            if(!$result) {
                die('Query Error'. mysqli_error($connection));
            }

            echo "Task Added Successfully";
        }
    }

?>
