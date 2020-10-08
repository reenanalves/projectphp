<?php


class StatusCodeOK extends ActionResult
{
    
    public function __construct($response)
    {       
        $this->statuscode = 200;
        parent::__construct(json_encode(["status" => "success", "code" => $this->statuscode, "response" => $response]));
    }
    
}