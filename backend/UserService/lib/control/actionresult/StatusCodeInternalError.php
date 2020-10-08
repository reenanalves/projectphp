<?php


class StatusCodeInternalError extends ActionResult
{
    
    public function __construct($response)
    {       
        $this->statuscode = 500;
        parent::__construct(json_encode(["status" => "error", "code" => $this->statuscode, "response" => $response]));
    }
    
}