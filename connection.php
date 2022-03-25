<?php
class Connection{
    public function con(){
        $db_host = 'localhost';
        $db_name = 'root';
        $db_pass = '';
        $db_database = 'lampa';
    
        $con = mysqli_connect($db_host, $db_name,$db_pass, $db_database);
        if(!$con){
            die("Could not connect to database");
        }
        return $con;
    }
} 
?>