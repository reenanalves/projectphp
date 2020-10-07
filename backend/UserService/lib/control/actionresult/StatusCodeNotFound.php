<?php


class StatusCodeNotFound extends ActionResult
{
    
    public function __construct(string $response)
    {       
        $this->statuscode = 404;
        parent::__construct("");
    }
    
}