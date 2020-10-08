<?php


class StatusCodeOK extends ActionResult
{
    
    public function __construct($response)
    {       
        $this->statuscode = 200;
        parent::__construct(Http::response($this->statuscode, true, $response));
    }
    
}