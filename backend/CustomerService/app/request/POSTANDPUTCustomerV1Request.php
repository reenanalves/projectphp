<?php


class POSTANDPUTCustomerV1Request extends Model
{
    public function __construct()
    {
        $this->setProperty("name", [new RequireValidator(), new MinLengthValidator(10), new MaxLengthValidator(30)]); 
        $this->setProperty("birthday", [new RequireValidator(), new DateValidator()]); 
        $this->setProperty("document_cpf", [new RequireValidator(), new CPFValidator()]); 
        $this->setProperty("document_rg", [new RequireValidator(), new MinLengthValidator(10), new MaxLengthValidator(30)]); 
        $this->setProperty("phone", [new RequireValidator()]); 
        
        parent::__construct();
    }
}