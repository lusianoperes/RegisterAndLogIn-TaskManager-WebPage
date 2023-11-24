<?php
    include('info.php');

    $id = $_POST['id'];

    if (isset($id)) {
        $query = "SELECT * from task WHERE taskid = $id";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            die('Query Error'. mysqli_error($connection));
        }

        $json = array();
        while ($row = mysqli_fetch_array($result)) {
            $json[] = array(
                'id' => $row['taskid'],
                'nombre' => $row['nombre'],
                'edad' => $row['edad'],
                'email' => $row['email'],
                'dni' => $row['dni']
            );
        }

        $jsonstring = json_encode($json[0]);

        echo $jsonstring;
    }
?>

