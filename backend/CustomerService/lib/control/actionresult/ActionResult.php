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

        echo $this->content;
        http_response_code($this->statuscode);        
    }

}