<?php


class StatusCodeUnauthorized extends ActionResult
{
    
    public function __construct(string $response)
    {       
        $this->statuscode = 401;
        parent::__construct("");
    }
        
}