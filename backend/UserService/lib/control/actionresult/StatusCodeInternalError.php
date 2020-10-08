<?php


class StatusCodeInternalError extends ActionResult
{
    
    public function __construct($response)
    {       
        $this->statuscode = 500;
        parent::__construct(Http::response($this->statuscode, false, $response));
    }
    
}