<?php

use \Firebase\JWT\JWT;

class Auth
{

    private static $ini;

    public static function setIni()
    {
        self::$ini = parse_ini_file('app/config/config.ini', true);
    }

    public static function passwordEncrypter($password)
    {
        self::setIni();
        return md5(self::$ini['config']['encrypt'] . "_" . $password);
    }

    public static function tokenGenerate(array $data = []){
        self::setIni();

        return JWT::encode($data, self::$ini['config']['token']);
    }

    public static function getDataToken($token){
        
        if(!$token){
            throw new Exception("Token is required!");
        }

        $ini = parse_ini_file('app/config/config.ini', true);
        $key = $ini['config']['token'];
        
        try{
            $data = (array) JWT::decode($token, $key, array('HS256'));
        }
        catch(Exception $e){
            throw new Exception("Token invalid!");
        }
        return $data;
    }
}
