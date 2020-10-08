<?php


class StatusCodeForbidden extends ActionResult
{
    
    public function __construct($response)
    {       
        $this->statuscode = 403;
        parent::__construct(json_encode(["status" => "error", "code" => $this->statuscode, "response" => $response]));
    }
    
}