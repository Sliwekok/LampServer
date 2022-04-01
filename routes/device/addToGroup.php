<?php
    session_start();
    // get to root directory level
    $root =  dirname(__FILE__, 3);
    include_once($root.'/app/controllers/deviceController.php');
    $device = new Device;
    if(empty($_GET['deviceId']) || empty($_GET['token']) || empty($_GET['newGroup'])){
        die("No data provided");
    }
    $deviceId = $_GET['deviceId'];
    $newGroup = $_GET['newGroup'];
    $token = $_GET['token'];
    $msg = $device->addToGroup($deviceId, $newGroup, $token);
    echo $msg;
    return;
?>