<?php

$root =  dirname(__FILE__, 3);
include_once($root.'/vendor/autoload.php');
include_once($root.'/app/services/JWTService.php');

$dotenv = Dotenv\Dotenv::createImmutable($root);
$dotenv->load();

use ReallySimpleJWT\Token;

Class JWT{

    public $secret;

    public function __construct(){
        $this->secret = $_ENV['SECRET'];
    }

    // create JWT token, lifetime: 1 year
    public function createJWT($username){
        $payload = [
            'iat'       => strtotime('now'),    // token create moment
            'exp'       => strtotime('+1 year'),// token expiration
            'username'  => $username,           // user connected
        ];

        $token = Token::customPayload($payload, $this->secret);
        return $token;
    }
    // get single data value from token
    public function getJWTData($token, $data){
        $array = Token::getPayload($token, $this->secret);
        return $array["$data"];        
    }

    // check token, it is correct (not hacked)
    public function checkToken($token){
        $secret = $this->secret;
        if(
            Token::validateExpiration($token, $secret) &&   // check if token is not expired
            Token::validate($token, $secret)                // check if not hacked
        ) return true;
        return false;
    }

}

?>