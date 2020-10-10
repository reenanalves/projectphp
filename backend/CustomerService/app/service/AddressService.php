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

    public static function loadAll($idCustomer, $page, $limit){
        $repository = new AddressRepository();
        return $repository->loadAll($idCustomer, $limit, $page > 1 ? ($page * $limit) - $limit : 0);
    }

    public static function countAllRecords($idCustomer){
        $repository = new AddressRepository();
        return $repository->countAllRecords($idCustomer);
    }

    public static function delete($id){
        $repository = new AddressRepository();        

        $object = $repository->findByPrimaryKey($id);

        if(!$object){
            throw new Exception("Object not found!");
        }  

        $object->status = AddressModel::sDisable;

        return $repository->store($object);
    }

    public static function addressExists($id){
        $repository = new AddressRepository();        

        $object = $repository->findByPrimaryKey($id);

        return !$object ? false : true;
    }

}