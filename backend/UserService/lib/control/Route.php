<?php

class Route{
    private $controller;
    private $route;    
    private $method;
    private $authenticate;

    public function __construct(URI $route, string $controller, string $method, bool $authenticate){        
        $this->setRoute($route);
        $this->setController($controller);
        $this->setMethod($method);
        $this->setAuthenticate($authenticate);
    }

    public function setController(string $controller){
        $this->controller = $controller;
    }

    public function setRoute(URI $route){
        $this->route = $route;
    }

    public function setMethod(string $method){
        $this->method = $method;
    }

    public function setAuthenticate(bool $authenticate){
        $this->authenticate = $authenticate;
    }

    public function getController(){
        return $this->controller;
    }

    public function getRoute(){
        return $this->route;
    }

    public function getMethod(){
        return $this->method;
    }

    public function getAuthenticate(){
        return $this->authenticate;
    }
}