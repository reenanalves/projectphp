<?php

abstract class ActionResult
{
    public  $statuscode;
    private $content;

    public function __construct($content){    
        $this->content = $content;            
    }

    public function response()
    {        

        if(!$this->statuscode){
            throw new Exception("Status Code Invalid");
        }

        try{
            $this->content = json_encode($this->content);
            header('Content-Type: application/json');
        }catch(Exception $e){

        }

        
        http_response_code($this->statuscode);  
        echo $this->content;      
    }

}