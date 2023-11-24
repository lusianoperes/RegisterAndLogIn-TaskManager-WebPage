<?php

include('info.php');

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
    
    $username = $connection->real_escape_string($username);
    $password = $connection->real_escape_string($password);
    
    $query = "SELECT * FROM usuarios WHERE username='$username' OR useremail='$email'";
    $result = mysqli_query($connection, $query);
    
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            echo 1; 
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $fecha = date('Y-m-d');
            $query2 = "INSERT INTO usuarios(username, passwd, useremail, fecha_registro) VALUES ('$username', '$hashedPassword', '$email', '$fecha')";
            $result2 = mysqli_query($connection, $query2);
            if ($result2) {
                echo 0; 
            } else {
                die('Error en la consulta: ' . mysqli_error($connection));
            }
        }
     }
     else {
        die('Error en la consulta: ' . mysqli_error($connection));
    }
?>