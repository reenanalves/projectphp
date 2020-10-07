<?php

class AddressModel extends Model{

    public const sEnable = 1;
    public const sDisable = 0;

    public function __construct()
    {          
        $this->primarykey = "id";
        $this->setProperty("id", [new RequireValidator()]); 
        $this->setProperty("customer_id", [new RequireValidator()]); 
        $this->setProperty("street", [new RequireValidator(),  new MaxLengthValidator(100)]); 
        $this->setProperty("district", [new RequireValidator(),  new MaxLengthValidator(100)]); 
        $this->setProperty("number", [new RequireValidator(),  new MaxLengthValidator(20)]); 
        $this->setProperty("complement", [new RequireValidator(),  new MaxLengthValidator(30)]); 
        $this->setProperty("city", [new RequireValidator(), new MaxLengthValidator(20)]); 
        $this->setProperty("state", [new RequireValidator(), new MaxLengthValidator(2)]); 
        $this->setProperty("status", [new RequireValidator()]); 

        parent::__construct();
    }
}