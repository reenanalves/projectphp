<?php

class AddressService{    

    public static function store(AddressModel $address)
    {
        $repository = new AddressRepository();
        return $repository->store($address);
    }

    public static function findByPrimaryKey($id){
        $repository = new AddressRepository();
        return $repository->findByPrimaryKey($id);
    }

    public static function loadAll($page, $limit){
        $repository = new AddressRepository();
        return $repository->loadAll($limit, ($page * $limit) - $limit);
    }

    public static function countAllRecords(){
        $repository = new AddressRepository();
        return $repository->countAllRecords();
    }

    public static function delete($id){
        $repository = new AddressRepository();
        return $repository->delete($id);
    }

}