<?php
    session_start();
    // get to root directory level
    $root =  dirname(__FILE__, 3);
    include_once($root.'/app/controllers/AuthController.php');
    $auth = new Auth;
    $username = $_POST['username'];
    $password = $_POST['password'];
    if(strlen($username) == 0 || strlen($password) == 0){
        die("no data provided");
    }
    $msg = $auth->login($username, $password);
    echo $msg;
    return;
?>