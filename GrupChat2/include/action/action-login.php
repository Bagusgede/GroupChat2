<?php

    session_start();
    require '../connection.php';
    require '../class/UserClass.php';
    
    $classUsers = new UsersClass($pdo);
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login = $classUsers->login($username, $password);
    if ($login) {
        header("Location:../../dashboard.php");
    }
    else {
        header("Location:../../index.php?error=0");
    }
?>