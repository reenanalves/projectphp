<?php


class URI{
    private $route;
    private $version;
    private $service;

    public function __construct($route, $version, $service){
        $this->route = $route;
        $this->version = $version;
        $this->service = $service;
    }

    public function getURI(){
        return $this->route."/".$this->version."/".$this->service;
    }
}