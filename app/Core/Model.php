<?php
namespace App\Core;

class Model {

    public function __construct(public \PDO $pdo)
    {
        
    }

    public function find($table, $fetchType = \PDO::FETCH_ASSOC){
        $statement = $this->pdo->prepare("SELECT * FROM $table;");
        $statement->execute();
        return $statement->fetchAll($fetchType);
    }

    public function findOne($table, $id, $fetchType = \PDO::FETCH_ASSOC){
        $statement = $this->pdo->prepare("SELECT * FROM $table WHERE id=:id");
        $statement->bindParam(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch($fetchType);
    }

    public function save($table, $values){
        $keys = array_keys($values);
        $fields = implode(',', $keys);
        $placeholder = implode(',', array_map(fn($key) => ":$key", $keys));
        $query = "INSERT INTO $table ($fields) VALUES ($placeholder)";
        $statement = $this->pdo->prepare($query);
        foreach ($values as $field => $fieldValue) {
            $statement->bindValue(":$field", $fieldValue);
        }
        return $statement->execute();
    }

}