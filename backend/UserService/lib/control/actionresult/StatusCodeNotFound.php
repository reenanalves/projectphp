<?php


class StatusCodeNotFound extends ActionResult
{
    
    public function __construct($response)
    {       
        $this->statuscode = 404;
        parent::__construct($response);
    }
    
}