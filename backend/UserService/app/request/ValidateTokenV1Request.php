<?php


class ValidateTokenV1Request extends Model
{
    public function __construct()
    {
        $this->setProperty("Token", [new RequireValidator(), new MinLengthValidator(33)]);  
        
        parent::__construct();
    }
}