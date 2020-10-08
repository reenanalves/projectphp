<?php


class StatusCodeBadRequest extends ActionResult
{

    public function __construct($response)
    {
        $this->statuscode = 400;
        parent::__construct(json_encode(["status" => "error", "code" => $this->statuscode, "response" => $response]));
    }
}
