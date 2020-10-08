<?php

class CustomerService{    

    public static function store(CustomerModel $customer)
    {
        $repository = new CustomerRepository();
        return $repository->store($customer);
    }

    public static function findByPrimaryKey($id){
        $repository = new CustomerRepository();
        return $repository->findByPrimaryKey($id);
    }

    public static function loadAll($page, $limit){

        $repository = new CustomerRepository();

        return $repository->loadAll($limit, $page > 1 ? ($page * $limit) - $limit : 0);
        
    }

    public static function countAllRecords(){
        $repository = new CustomerRepository();
        return $repository->countAllRecords();
    }

    public static function delete($id){
        $repository = new CustomerRepository();        

        $object = $repository->findByPrimaryKey($id);

        if(!$object){
            throw new Exception("Object not found!");
        }  

        $object->status = CustomerModel::sDisable;

        return $repository->store($object);
        
    }

    public static function customerExists($id){
        $repository = new CustomerRepository();        

        $object = $repository->findByPrimaryKey($id);

        return !$object ? false : true;
    }

}