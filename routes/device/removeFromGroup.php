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
    $newGroup = $_GET['newGroup'];
    $msg = $device->removeFromGroup($deviceId, $newGroup);
    echo $msg;
    return;
?>