<?php

abstract class ActionResult
{
    public  $statuscode;
    private $content;

    public function __construct(string $content){    
        $this->content = $content;            
    }

    public function response()
    {        

        if(!$this->statuscode){
            throw new Exception("Status Code Invalid");
        }

        try{
            json_encode($this->content);
            header('Content-Type: application/json');
        }catch(Exception $e){

        }

        echo $this->content;
        http_response_code($this->statuscode);        
    }

}