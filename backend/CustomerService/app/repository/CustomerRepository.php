<?php


class CustomerRepository implements Repository{
    

    private $connection; 

    public function __construct(){
        $this->connection = new PDODatabase(); 
    }

    public function store($object){
        
        $query = "";

        if(!$object->id){
            $query = "INSERT INTO customer (".implode(",",$object->getProperties(false)).")".
                     " VALUES (".implode(',:', $object->getProperties(false)).") ";
        }
        else{
            $query = "UPDATE customer SET ".$object->getParamsToUpdateQuery(false). " WHERE id = :id";
        }        

        $queryResult = $this->connection->execQuery( $query, $object->getValuesParamsToQuery($object->id), !$object->id);

        if($queryResult)
        {
            
            if(!$object->id){
                $object->id = $queryResult;
            }

            return $object;
        }   

        throw new Exception("Fail in insert!");
    }

    public function loadAll($limit, $offset){

        $query = 'SELECT * FROM customer WHERE status = :status LIMIT :limit OFFSET :offset';
        
        $queryResult = $this->connection->execQuery( $query, [':limit' => $limit, ':offset' => $offset, ':status'=>CustomerModel::sEnable]);

        if($queryResult){

            $object = $queryResult->fetchAll(PDO::FETCH_ASSOC);

            if(count($object) > 0){

                $data = [];

                foreach($object as $key => $value)
                {
                    $data[] = Utils::convertObjectToArray($value); 
                }                              

                return $data;
            }
        }
        return [];  
    }

    public function findLastId(){

        $query = 'SELECT max(id) as id FROM customer';
        
        $queryResult = $this->connection->execQuery( $query );

        if($queryResult){
            $object = $queryResult->fetchAll(PDO::FETCH_ASSOC);

            if(count($object) > 0){

                $data = Utils::convertObjectToArray($object[0]);        

                return $data["id"];
            }
        }

        return null;  
    }

    public function countAllRecords(){
        
        $query = 'SELECT count(id) as count FROM customer';
        
        $queryResult = $this->connection->execQuery( $query );

        if($queryResult){
            $object = $queryResult->fetchAll(PDO::FETCH_ASSOC);

            if(count($object) > 0){

                $data = Utils::convertObjectToArray($object[0]);        

                return $data["count"];

            }
        }
        return null;  
    }

    public function findByPrimaryKey($id){
        $query = 'SELECT * FROM customer WHERE id = :id and status = :status LIMIT 1';
        
        $queryResult = $this->connection->execQuery( $query, [':id' => $id, ':status'=>CustomerModel::sEnable]);

        if($queryResult){
            $object = $queryResult->fetchAll(PDO::FETCH_ASSOC);

            if(count($object) > 0){

                $data = Utils::convertObjectToArray($object[0]);        

                $customer = new CustomerModel();
                $customer->setValues($data);

                return $customer;
            }
        }

        return null;  
    }

    public function delete($id){
        $query = "delete from customer where id = :id";

        $queryResult = $this->connection->execQuery( $query, [':id' => $id]);

        return $queryResult;
    }
}