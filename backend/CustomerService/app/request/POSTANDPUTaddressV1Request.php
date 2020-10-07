<?php


class POSTANDPUTaddressV1Request extends Model
{
    public function __construct()
    {
        $this->setProperty("customer_id", [new RequireValidator()]); 
        $this->setProperty("street", [new RequireValidator(),  new MaxLengthValidator(100)]); 
        $this->setProperty("district", [new RequireValidator(),  new MaxLengthValidator(100)]); 
        $this->setProperty("number", [new RequireValidator(),  new MaxLengthValidator(20)]); 
        $this->setProperty("complement", [new RequireValidator(),  new MaxLengthValidator(30)]); 
        $this->setProperty("city", [new RequireValidator(), new MaxLengthValidator(20)]); 
        $this->setProperty("state", [new RequireValidator(), new MaxLengthValidator(2)]); 
        
        parent::__construct();
    }
}