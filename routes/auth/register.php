<?php
session_start();
// get to root directory level
$root =  dirname(__FILE__, 3);
include_once($root.'/app/controllers/AuthController.php');
$auth = new Auth;
// get data and validate it
$username = htmlspecialchars($_POST['username']);
$password = htmlspecialchars($_POST['password']);

if(strlen($username) == 0 || strlen($password) == 0){
    die("no data provided");
}

$msg = $auth->register($username, $password);
echo $msg;
return;
?>