<?php

$root =  dirname(__FILE__, 3);
include_once($root.'/connection.php');

class Auth{

    // global property of connection to DB
    public $con;

    public function __construct(){
        $connection = new Connection;
        $this->con = $connection->con();
    }

    public function __destruct(){
        $this->con->close();
    }

    public function login($username, $password){
        // check if username is already registered
        if(!$this->doesUserExist($username)){
            return "User doesn't exists";
        }
        // check for password 
        if(!$this->passwordMatches($username, $password)){
            return "Password doesn't match";
        }
        
        $_SESSION['logged'] = true;
        $_SESSION['username'] = $username;
        return true;
        
    }

    public function register($username, $password){
        // check if username is already registered
        if($this->doesUserExist($username)){
            return "User already exists";
        }
        $con = $this->con;
        // hash in bcrypt
        $hashedPass = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPass')";
        if(!mysqli_query($con, $sql)){
            return "error while handling request";
        }
        else{
            return "ok";
        }
    }

    // function to check if username is taken in DB
    // params: username
    // returns: bool
    private function doesUserExist($username){
        $con = $this->con;
        $sql = "SELECT username FROM users WHERE username LIMIT 1";
        $builder = mysqli_query($con, $sql);

        $amount = mysqli_num_rows($builder);
        // if user exists, return true
        if($amount = 0){
            return false;
        }
        else{
            return true;
        }
        
    }

    
    // function to check if user password matches with hash
    // params: username, password
    // returns: bool
    private function passwordMatches($username, $password){
        $con = $this->con;
        $sql = "SELECT username, password FROM users WHERE username = '$username' LIMIT 1";
        $builder = mysqli_query($con, $sql);
        // get data from database
        while($row = mysqli_fetch_array($builder)){
            // check bcrypt hash
            if(password_verify($password, $row['password'])){
                return true;
            }   
            else{
                return false;
            }
        }
    }

}

?>