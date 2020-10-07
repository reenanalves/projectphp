<?php

class AuthenticateService{    

    public static function isTokenValid($token)
    {

        $data = Auth::getDataToken($token);
        
        if ($data['expirein'] < strtotime('now'))
        {
            throw new Exception('Token expired!');
        }
        else
        {
            return true;
        }

    }

    public static function getUserByToken($token)
    {

        $data = Auth::getDataToken($token);

        $userid   = $data['userid'];
        $user  = $data['user'];
        $name    = $data['name'];
        
        $object = new UserModel();
        $object->id = $userid;
        $object->user = $user;
        $object->name = $name;

        return $object;

    }

    public static function Authenticate($user, $pass)
    {        
        $repository = new UserRepository();

        $user = $repository->findByUserAndPassAndStatus($user, $pass, UserModel::sEnable);

        if($user){
            return Auth::tokenGenerate(["userid"=>$user->id, "name"=> $user->name, "user"=> "user", "expirein" => strtotime("+ 3 hours")]);
        }
        else{
            return null;            
        }
    }

    public static function GetInfoToken($user, $pass)
    {        
        $repository = new UserRepository();

        $user = $repository->findByUserAndPassAndStatus($user, $pass, UserModel::sEnable);

        if($user){
            return Auth::tokenGenerate(["userid"=>$user->id, "name"=> $user->name, "user"=> "user", "expirein" => strtotime("+ 3 hours")]);
        }
        else{
            return null;            
        }
    }

    public static function UpdateToken($token)
    {

        $data = Auth::getDataToken($token);
        $data['expiresin'] = strtotime("+ 3 hours");

        return Auth::tokenGenerate($data);
    }

}