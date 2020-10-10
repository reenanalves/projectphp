<?php


class Router extends Routes{

    public function __construct(){
        /*
        Register routes here
        */    
        $this->registerRoute(new Route(new URI("customer", "v1", ""),"CustomerController","POSTCustomerV1", true),HTTPVerbs::POST);        
        $this->registerRoute(new Route(new URI("customer", "v1", ""),"CustomerController","PUTCustomerV1", true),HTTPVerbs::PUT);        
        $this->registerRoute(new Route(new URI("customer", "v1", ""),"CustomerController","DELETECustomerV1", true),HTTPVerbs::DELETE);        
        $this->registerRoute(new Route(new URI("customer", "v1", ""),"CustomerController","GETCustomerV1", true),HTTPVerbs::GET);        
        $this->registerRoute(new Route(new URI("customers", "v1", ""),"CustomerController","GETCustomersV1", true),HTTPVerbs::GET);  
        
        $this->registerRoute(new Route(new URI("address", "v1", ""),"AddressController","POSTaddressV1", true),HTTPVerbs::POST);        
        $this->registerRoute(new Route(new URI("address", "v1", ""),"AddressController","PUTaddressV1", true),HTTPVerbs::PUT);  
        $this->registerRoute(new Route(new URI("address", "v1", ""),"AddressController","DELETEAddressV1", true),HTTPVerbs::DELETE);        
        $this->registerRoute(new Route(new URI("address", "v1", ""),"AddressController","GETAddressV1", true),HTTPVerbs::GET);        
        $this->registerRoute(new Route(new URI("addresses", "v1", ""),"AddressController","GETAddressesV1", true),HTTPVerbs::GET);  
    }

}