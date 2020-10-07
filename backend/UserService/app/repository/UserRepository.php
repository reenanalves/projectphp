<?php


class UserRepository implements Repository{
    

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

    public function findByUserAndPassAndStatus($user, $pass, $status) {

        $query = 'SELECT * FROM user WHERE user = :user and pass = :pass and status = :status LIMIT 1';
        
        $queryResult = $this->connection->execQuery( $query, [':user' => $user, ':pass' => Auth::passwordEncrypter($pass), ':status'=>$status]);

        $object = $queryResult->fetchAll(PDO::FETCH_ASSOC);

        if(count($object) > 0){

            $data = Utils::convertObjectToArray($object[0]);        

            $user = new UserModel();
            $user->setValues($data);

            return $user;
        }

        return null;               
    }

    public function delete($id){

    }
}