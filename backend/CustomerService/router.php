<?php


class Router extends Routes{

    public function __construct(){
        /*
        Register routes here
        */    
        $this->registerRoute(new Route(new URI("customer", "v1", ""),"CustomerController","POSTANDPUTCustomerV1", false),HTTPVerbs::POST);        
        $this->registerRoute(new Route(new URI("customer", "v1", ""),"CustomerController","POSTANDPUTCustomerV1", true),HTTPVerbs::PUT);        
        $this->registerRoute(new Route(new URI("customer", "v1", ""),"CustomerController","DELETECustomerV1", true),HTTPVerbs::DELETE);        
        $this->registerRoute(new Route(new URI("customer", "v1", ""),"CustomerController","GETCustomerV1", false),HTTPVerbs::GET);        
        $this->registerRoute(new Route(new URI("customers", "v1", ""),"CustomerController","GETCustomersV1", false),HTTPVerbs::GET);  
        
        $this->registerRoute(new Route(new URI("address", "v1", ""),"UserController","POSTANDPUTaddressV1", false),HTTPVerbs::POST);        
        $this->registerRoute(new Route(new URI("address", "v1", ""),"UserController","POSTANDPUTaddressV1", true),HTTPVerbs::PUT);  
        $this->registerRoute(new Route(new URI("address", "v1", ""),"UserController","DELETEAddressV1", true),HTTPVerbs::DELETE);        
        $this->registerRoute(new Route(new URI("address", "v1", ""),"UserController","GETAddressV1", false),HTTPVerbs::GET);        
        $this->registerRoute(new Route(new URI("addresses", "v1", ""),"UserController","GETAddressesV1", false),HTTPVerbs::GET);  
    }

}