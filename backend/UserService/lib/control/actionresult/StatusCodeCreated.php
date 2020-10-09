<?php


class StatusCodeCreated extends ActionResult
{
    
    public function __construct($response)
    {       
        $this->statuscode = 201;
        parent::__construct($response);
    }
    
}