<?php


class StatusCodeOK extends ActionResult
{
    
    public function __construct(string $response)
    {       
        $this->statuscode = 200;
        parent::__construct($response);
    }
    
}