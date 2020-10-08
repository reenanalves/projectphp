<?php


class AddressRepository implements Repository
{


    private $connection;

    public function __construct()
    {
        $this->connection = new PDODatabase();
    }

    public function store($object)
    {

        $query = "";

        if(!$object->id){
            $query = "INSERT INTO address (".implode(",",$object->getProperties(false)).")".
                     " VALUES (".implode(',', $object->getParamsToQuery(false)).") ";
        }
        else{
            $query = "UPDATE address SET ".implode(",",$object->getParamsToUpdateQuery(false)). " WHERE id = :id";
        }        

        $queryResult = $this->connection->execQuery( $query, $object->getValuesParamsToQuery($object->id), !$object->id);

        if($queryResult)
        {
            
            if(!$object->id){
                $object->id = $queryResult;
            }

            return $object;
        }   

        throw new Exception( !$object->id ? " Fail in insert!" : " Fail in update!");
    }

    public function loadAll($limit, $offset)
    {

        $query = "SELECT * FROM address WHERE status = :status LIMIT ".$limit." OFFSET ".$offset;        
        $queryResult = $this->connection->execQuery( $query, [':status'=> AddressModel::sEnable]);
        
        if($queryResult)
        {
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

    public function findLastId()
    {

        $query = 'SELECT max(id) as id FROM address';
        
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

    public function countAllRecords()
    {

        $query = 'SELECT count(id) as count FROM address';
        
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

    public function findByPrimaryKey($id)
    {
        $query = 'SELECT * FROM address WHERE id = :id and status = :status LIMIT 1';
        
        $queryResult = $this->connection->execQuery( $query, [':id' => $id, ':status'=>AddressModel::sEnable]);

        if($queryResult){
            $object = $queryResult->fetchAll(PDO::FETCH_ASSOC);

            if(count($object) > 0){

                $data = Utils::convertObjectToArray($object[0]);        

                $address = new AddressModel();
                $address->setValues($data);

                return $address;
            }
        }

        return null;  
    }

    public function delete($id)
    {
        $query = "delete from address where id = :id";

        $queryResult = $this->connection->execQuery($query, [':id' => $id]);

        return $queryResult;
    }
}
