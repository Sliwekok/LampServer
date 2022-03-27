<?php
    session_start();
    // get to root directory level
    $root =  dirname(__FILE__, 3);
    include_once($root.'/app/controllers/deviceController.php');
    $device = new Device;
    if(empty($_GET['deviceId'])){
        die("No data provided");
    }
    $deviceId = $_GET['deviceId'];
    $msg = $device->turnOff($deviceId);
    echo $msg;
    return;
?>