<?php


class StatusCodeUnauthorized extends ActionResult
{
    
    public function __construct($response)
    {       
        $this->statuscode = 401;
        parent::__construct(Http::response($this->statuscode, false, $response));
    }
        
}