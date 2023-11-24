<?php

include('info.php');

$username = $_POST['username'];
$password = $_POST['password'];
    
$username = $connection->real_escape_string($username);
$password = $connection->real_escape_string($password);


    $query = "SELECT * FROM usuarios WHERE username='$username'";
    $result = mysqli_query($connection, $query);

        if($result)
        {
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $hashedPassword = $row['passwd'];

                if (password_verify($password, $hashedPassword)) 
                {
                        $bloq = $row['bloqueo'];

                        if($bloq == 'si')
                        {
                            $motivo = $row['motivo'];
                            echo $motivo;
                        }
                        else
                        {
                            $cantidadingresos = $row['cantidad_ingresos'];
                            $cantidadingresos = 1 + $cantidadingresos;
                            $fechalog = date('Y-m-d');
                            $iduser = $row['id'];
                            $query2 = "UPDATE usuarios SET ultimo_ingreso = '$fechalog', cantidad_ingresos = '$cantidadingresos' WHERE id = '$iduser'";
                            $result2 = mysqli_query($connection, $query2);
        
                                if(!$result2)
                                {
                                    die('Error en la consulta: ' . mysqli_error($connection));
                                }
                                else
                                {
                                    $userid = $row['id'];
                                    echo $userid;
                                }
                        }
                } 
                else
                {
                    echo -1;//pass incorrecta
                }
            } else 
            {
                echo -1;//user incorrecto
            }

        }else
        {
            die('Error en la consulta: ' . mysqli_error($connection));
        }

?>