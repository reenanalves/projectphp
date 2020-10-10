<?php


class Router extends Routes{

    public function __construct(){
        /*
        Register routes here
        */    
        $this->registerRoute(new Route(new URI("user", "v1", "Authenticate"),"UserController","AuthenticateV1", false),HTTPVerbs::POST);        
        $this->registerRoute(new Route(new URI("user", "v1", "UpdateToken"),"UserController","UpdateTokenV1", true),HTTPVerbs::POST);        
        $this->registerRoute(new Route(new URI("user", "v1", "TokenValidate"),"UserController","TokenValidateV1", true),HTTPVerbs::POST);        
    }

}