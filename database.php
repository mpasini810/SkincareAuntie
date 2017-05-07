<?php

function getDB() {
    $mysql = new mysqli("localhost", "root", "root", "skincareauntie", 8888);


    if ($mysql->connect_errno) {
        echo ("Failed to connect to MySQL: ".$mysql->error);
    }

    return  $mysql;
}

?>
