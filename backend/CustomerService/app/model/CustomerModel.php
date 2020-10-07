<?php

class CustomerModel extends Model{

    public const sEnable = 1;
    public const sDisable = 0;

    public function __construct()
    {          
        $this->primarykey = "id";
        $this->setProperty("id", [new RequireValidator()]); 
        $this->setProperty("name", [new RequireValidator(), new MinLengthValidator(10), new MaxLengthValidator(30)]); 
        $this->setProperty("birthday", [new RequireValidator(), new DateValidator()]); 
        $this->setProperty("document_cpf", [new RequireValidator(), new CPFValidator()]); 
        $this->setProperty("document_rg", [new RequireValidator(), new MinLengthValidator(10), new MaxLengthValidator(30)]); 
        $this->setProperty("phone", [new RequireValidator()]); 
        $this->setProperty("status", [new RequireValidator()]); 

        parent::__construct();
    }
}