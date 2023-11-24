<?php

 include ('info.php');

  $query = "CREATE TABLE IF NOT EXISTS task (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(60),
    edad INT,
    email TEXT,
    dni INT,
    imagen TEXT
 )";

  $mysql= mysqli_query($connection,$query);
  if($mysql)
  {
    echo "Tabla creada";
  }
  else{
     die('Query Error'. mysqli_error($connection));
  }
?>
