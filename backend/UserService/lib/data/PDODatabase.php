<?php


class PDODatabase
{
    private $conn;

    private function connect()
    {
        $config  = Utils::getDatabaseConfig();
        $this->conn = new PDO("mysql:host={$config['host']};port={$config['port']};dbname={$config['name']}", $config['user'], $config['pass'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    }

    private function setProperty($stmt, $key, $value)
    {
        $stmt->bindParam($key, $value);
    }

    private function query($stmt, $parameters)
    {
        foreach ($parameters as $key => $value) 
        {
            $this->setProperty($stmt, $key, $value);
        }
    }

    public function execQuery(string $query, array $parameters = [], $lastInserted = false)
    {
        $this->connect();

        $stmt = $this->conn->prepare($query);
        
        $this->query($stmt, $parameters);

        if (!$stmt->execute()) {
            return false;
        }

        if ($lastInserted) {
            return $this->conn->lastInsertId();
        }

        return $stmt;
    }
}
