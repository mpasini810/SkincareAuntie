<?php

function getDB() {
    $mysql = new mysqli("localhost", "root", "root", "skincareauntie", 8888);
    if ($mysql->connect_errno) {
        echo ("Failed to connect to MySQL: ".$mysql->error);
    }
    return  $mysql;
}


function createUser($email, $firstName, $lastName, $password, $admin){
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $mysql = getDB();
    $pstmt = $mysql->prepare("insert into users (email, firstName, lastName, password, admin) values (?, ?, ?, ?, ?)");
    $pstmt->bind_param("sssss", $email, $firstName, $lastName, $hashedPassword, $admin);
    $pstmt->execute();
}


function checkPassword($email, $passwordToCheck){
    $mysql = getDB();
    $result = $mysql->query("select password from users where email = '$email'");
    if($result->num_rows < 1){
        return false;
    }

    $result->data_seek(1);
    $aRow = $result->fetch_assoc();
    return ($aRow['password'] == hash("sha256", $passwordToCheck));
}

?>
