<?php


class StatusCodeBadRequest extends ActionResult
{
    
    public function __construct(string $response)
    {       
        $this->statuscode = 400;
        parent::__construct("");
    }
    
}