<?php

abstract class Routes {
    public $GET;
    public $POST;
    public $PUT;
    public $DELETE;

    protected function registerRoute(Route $route, int $verb){

        switch($verb)
        {
            case HTTPVerbs::GET : 
                $this->GET[$route->getRoute()->getURI()] = $route;
            break;
            case HTTPVerbs::POST : 
                $this->POST[$route->getRoute()->getURI()] = $route;
            break;
            case HTTPVerbs::PUT : 
                $this->PUT[$route->getRoute()->getURI()] = $route;
            break;
            case HTTPVerbs::DELETE : 
                $this->DELETE[$route->getRoute()->getURI()] = $route;
            break;
        }

        
    }
}