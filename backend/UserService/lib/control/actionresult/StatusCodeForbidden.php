<?php


class StatusCodeForbidden extends ActionResult
{
    
    public function __construct(string $response)
    {       
        $this->statuscode = 403;
        parent::__construct("");
    }
    
}