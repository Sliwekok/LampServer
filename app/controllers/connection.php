<?php

include_once($root.'/vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

class Connection{
    public function con(){
        $db_host = $_ENV['DB_HOST'];
        $db_name = $_ENV['DB_USERNAME'];
        $db_pass = $_ENV['DB_PASSWORD'];
        $db_database = $_ENV['DB_DATABASE'];
    
        $con = mysqli_connect($db_host, $db_name,$db_pass, $db_database);
        if(!$con){
            die("Could not connect to database");
        }
        return $con;
    }
} 
?>