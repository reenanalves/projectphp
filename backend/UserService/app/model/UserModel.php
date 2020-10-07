<?php

class UserModel extends Model{

    public const sEnable = 1;
    public const sDisable = 0;

    public function __construct()
    {          
        $this->primarykey = "id";
        $this->setProperty("id", [new RequireValidator()]); 
        $this->setProperty("name", [new RequireValidator(), new MinLengthValidator(10), new MaxLengthValidator(30)]); 
        $this->setProperty("user", [new RequireValidator(), new MinLengthValidator(1), new MaxLengthValidator(30)]); 
        $this->setProperty("pass", [new RequireValidator(), new MinLengthValidator(8), new MaxLengthValidator(33)]); 
        $this->setProperty("status", [new RequireValidator()]); 

        parent::__construct();
    }
}