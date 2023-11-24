<?php

    include('info.php');

    $id = $_POST['id'];

    if (isset($id)) {
        $query = "DELETE FROM task WHERE id = $id";
        $result = mysqli_query($connection, $query);

        if (!$result) {
            die('Query Error'. mysqli_error($connection));
        }

        echo "Task Deleted Successfully";
    }
?>