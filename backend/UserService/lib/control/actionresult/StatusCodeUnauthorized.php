<?php


class StatusCodeUnauthorized extends ActionResult
{
    
    public function __construct($response)
    {       
        $this->statuscode = 401;
        parent::__construct(json_encode(["status" => "error", "code" => $this->statuscode, "response" => $response]));
    }
        
}