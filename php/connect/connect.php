<?php
    $host = "localhost";
    $user = "ljy16";
    $pw = "rhqnr1159*";
    $db = "ljy16";

    $connect = new mysqli($host, $user, $pw, $db);
    $connect -> set_charset("utf-8");

    if(mysqli_connect_errno()){
        echo "DATABASE Connect False";
    } else {
        echo "DATABASE Connect True";
    }
?>