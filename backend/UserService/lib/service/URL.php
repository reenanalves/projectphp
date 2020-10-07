<?php

class URL{
    
    private $Url;
    private $Arr;
    public $UrlBase;
            
    function __construct() {
        $this->Url = filter_input(INPUT_GET, 'u', FILTER_DEFAULT);
        $this->UrlBase = $_SERVER['SERVER_ADDR'].'/';
        $this->UrlNiveis();
    }
    
    private function urlNiveis() {
        if(empty($this->Url)){
            $this->Arr = array('0' => 'home');
        }else{
            $this->Arr = explode("/", $this->Url);
        }
        
    }

    public function getPage($l) {
        if(array_key_exists($l, $this->Arr)):
            return $this->Arr[$l];
        else:
            return "";
        endif;
    }
    
    public function getUrlBase() {
        return $this->UrlBase;      
    }

    public function getURI(){
        $URI = new URI($this->getPage(0), $this->getPage(1), $this->getPage(2));

        return $URI->getURI();
    }
    
}