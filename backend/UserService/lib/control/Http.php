<?php

class Http
{
    public static function response(int $code, bool $status, $response)
    {
        return json_encode(["code" => $code, "status" => $status ? "success" : "false", "response" => $response]);
    }
}
