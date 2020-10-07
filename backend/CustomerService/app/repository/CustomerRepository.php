<?php


class CustomerRepository implements Repository{
    

    private $connection; 

    public function __construct(){
        $this->connection = new PDODatabase(); 
    }

    public function store($object){

    }

    public function loadAll(){

    }

    public function findByPrimaryKey($id){
        return null;
    }

    public function delete($id){

    }
}