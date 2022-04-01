<?php
    session_start();
    // get to root directory level
    $root =  dirname(__FILE__, 3);
    include_once($root.'/app/controllers/deviceController.php');
    $device = new Device;
    if(empty($_GET['deviceId']) || empty($_GET['newColor']) || empty($_GET['token'])){
        die("No data provided");
    }
    $deviceId = $_GET['deviceId'];
    $newColor = $_GET['newColor'];
    $token = $_GET['token'];
    $msg = $device->changeColor($deviceId, $newColor, $token);
    echo $msg;
    return;
?>