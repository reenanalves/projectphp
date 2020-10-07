<?php

class AuthenticateService{    

    public static function Authenticate($token)
    {
        if(!$token){
            throw new Exception("Token is required!");
        }   

        $ini = Utils::getIniConfig();

        $url_resquest = $ini["config"]["url_userservice"] . "user/v1/TokenValidate";
        
        $params = ["Token" => $token];

        $response = HttpRequest::request($url_resquest,'POST', $params);

        if($response["Code"] == "200")
        {
            
            Session::set("userid", $response["Body"]->id);
            Session::set("username", $response["Body"]->name);
            Session::set("userlogin", $response["Body"]->user);

            return true;
        }
        else{
            return false;
        }
    }

}