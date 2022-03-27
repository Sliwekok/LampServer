<?php

$root =  dirname(__FILE__, 3);
include_once($root.'/connection.php');

class Device{

    // global property of connection to DB
    public $con;
    public $username;

    public function __construct(){
        $connection = new Connection;
        $this->con = $connection->con();
        $this->username = $_SESSION['username'];
    }

    public function __destruct(){
        $this->con->close();
    }

    // turn on device
    public function turnOn($deviceId){
        if(!$this->deviceExists($deviceId)){
            return "No device found";
        }
        $username = $_SESSION["username"];
        $con = $this->con;
        // update state in DB to see changes
        $sql = "UPDATE devices SET turned_on = 'true', user_connected = '$username' WHERE uid = '$deviceId'";
        $builder = mysqli_query($con, $sql);
        // if user device, return true
        if(!$builder){
            return  "Error";
        }
        else{
            return true;
        }
    }
    
    // turn off device
    public function turnOff($deviceId){
        if(!$this->deviceExists($deviceId)){
            return "No device found";
        }
        $username = $this->username;
        $con = $this->con;
        // update state in DB to see changes
        $sql = "UPDATE devices SET turned_on = 'false', user_connected = 'null' WHERE uid = '$deviceId'";
        $builder = mysqli_query($con, $sql);
        // if user device, return true
        if(!$builder){
            return  "Error";
        }
        else{
            return true;
        }
    }

    // get currently set color on lamp
    public function getColor($deviceId){
        if(!$this->deviceExists($deviceId)){
            return "No device found";
        }
        $con = $this->con;
        $sql = "SELECT uid, color FROM devices WHERE uid = '$deviceId' LIMIT 1";
        $builder = mysqli_query($con, $sql);
        // get data from database
        while($row = mysqli_fetch_array($builder)){
            $color = $row['color'];
        }
        return $color;
    }

    public function changeColor($deviceId, $newColor){
        if($this->isTurnedOn($deviceId)){
            $this->turnOn($deviceId);
        }
        $con = $this->con;
        // update state in DB to see changes
        $sql = "UPDATE devices SET color = '$newColor' WHERE uid = '$deviceId'";
        $builder = mysqli_query($con, $sql);
        // if user device, return true
        if(!$builder){
            return  "Error";
        }
        else{
            return true;
        }
    }

    public function doNotInterrupt($deviceId){
        $con = $this->con;
        $currentState = $this->getCurrentDNIState($deviceId);
        if($currentState == true) $currentState = false;
        else $currentState = true;
        // update state in DB to see changes
        $update = "UPDATE devices SET do_not_interrupt = '$currentState' WHERE uid = '$deviceId'";
        $builder = mysqli_query($con, $update);
        // if user device, return true
        if(!$builder){
            return  "Error";
        }
        else{
            return true;
        }
    }

    public function addToGroup($deviceId, $newGroup){
        $con = $this->con;
        $currentState = $this->getCurrentDNIState($deviceId);
        if($currentState == true) $currentState = false;
        else $currentState = true;
        // update state in DB to see changes
        $update = "UPDATE devices SET in_group = '$newGroup' WHERE uid = '$deviceId'";
        $builderDevices = mysqli_query($con, $update);
        // if user device, return true
        if(!$builderDevices){
            return  "Error";
        }
        else{
            $user = $this->username;
            $update = "UPDATE groups SET uid = '$deviceId' WHERE user = '$user'";
            $builderGroups = mysqli_query($con, $update);
            // if user device, return true
            if(!$builderGroups){
                return  "Error";
            }
            else{
                return true;
            }
        }
    }

    public function removeFromGroup($deviceId){
         $con = $this->con;
        $currentState = $this->getCurrentDNIState($deviceId);
        if($currentState == true) $currentState = false;
        else $currentState = true;
        // update state in DB to see changes
        $update = "UPDATE devices SET in_group = '' WHERE uid = '$deviceId'";
        $builderDevices = mysqli_query($con, $update);
        // if user device, return true
        if(!$builderDevices){
            return  "Error";
        }
        else{
            $user = $this->username;
            $update = "UPDATE groups SET uid = '' WHERE user = '$user'";
            $builderGroups = mysqli_query($con, $update);
            // if user device, return true
            if(!$builderGroups){
                return  "Error";
            }
            else{
                return true;
            }
        }
    }
    
    // function to check if device with given uid exists
    // params: deviceId
    // returns: bool
    private function deviceExists($deviceId){
        $con = $this->con;
        $sql = "SELECT uid FROM devices WHERE uid = '$deviceId' LIMIT 1";
        $builder = mysqli_query($con, $sql);
        $amount = mysqli_num_rows($builder);
        // if user device, return true
        if($amount = 0){
            return false;
        }
        else{
            return true;
        }
    }

    // check if device is turned on, if not - turn it on
    // params: deviceId
    private function isTurnedOn($deviceId){
        $con = $this->con;
        $sql = "SELECT uid, turned_on FROM devices WHERE uid = '$deviceId' LIMIT 1";
        $builder = mysqli_query($con, $sql);
        // get data from database
        while($row = mysqli_fetch_array($builder)){
            // check bcrypt hash
            $state = $row['turned_on'];
            if($state == true){
                return true;
            }
            else{
                return false;
            }
        }
    }

    // check if device has turned on Do Not Interrupt mode
    // params: deviceId
    private function getCurrentDNIState($deviceId){
        $con = $this->con;
        $sql = "SELECT uid, do_not_interrupt FROM devices WHERE uid = '$deviceId' LIMIT 1";
        $builder = mysqli_query($con, $sql);
        // get data from database
        while($row = mysqli_fetch_array($builder)){
            // check bcrypt hash
            $state = $row['do_not_interrupt'];
            if($state == true){
                return true;
            }
            else{
                return false;
            }
        }
    }

}

?>