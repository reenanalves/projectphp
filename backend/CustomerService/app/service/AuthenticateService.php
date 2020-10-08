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

        if($response["Body"]->code == "200")
        {
            
            Session::set("userid", $response["Body"]->response->id);
            Session::set("username", $response["Body"]->response->name);
            Session::set("userlogin", $response["Body"]->response->user);

            return true;
        }
        else{
            return false;
        }
    }

}