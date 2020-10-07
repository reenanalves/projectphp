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
        return $repository->loadAll($limit, ($page * $limit) - $limit);
    }

    public static function countAllRecords(){
        $repository = new CustomerRepository();
        return $repository->countAllRecords();
    }

    public static function delete($id){
        $repository = new CustomerRepository();
        return $repository->delete($id);
    }

}