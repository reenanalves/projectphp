<?php


class AuthenticateV1Request extends Model
{
    public function __construct()
    {
        $this->setProperty("user", [new RequireValidator(), new MinLengthValidator(1)]);
        $this->setProperty("pass", [new RequireValidator(), new MinLengthValidator(5)]);

        parent::__construct();
    }
}