<?php
  $host = "localhost";
  $db   = "db_eog";
  $user = "root";
  $pass = "";


  //$con = mysqli_connect($host,$user,$pass,$db) or trigger_error(mysql_error(),E_USER_ERROR);
  $con = new mysqli($host, $user,$pass,$db);
    if ($con->connect_errno) {
        printf("Connect failed: %s\n", $con->connect_error);
        exit();
    }
    else {
        echo 'Acessou com usuário';
    }
?>