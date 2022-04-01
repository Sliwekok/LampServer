<?php
    session_start();
    // get to root directory level
    $root =  dirname(__FILE__, 3);
    include_once($root.'/app/services/JWTService.php');
    $jwt = new JWT;
    if(empty($_GET['token'])){
        die("No data provided");
    }
    $token = $_GET['token'];
    $data = $_GET['data'];
    $msg = $jwt->getJWTData($token, $data);
    echo $msg;
    return;
?>