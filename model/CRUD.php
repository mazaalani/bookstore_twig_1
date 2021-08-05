<?php
abstract class CRUD extends PDO{

    protected $table;
    protected $primaryKey;

    public function __construct(){
      //connection PDO
      parent::__construct('mysql:host=192.168.64.2;dbname=client20602', 'marcos', 'marcos');
    }

    public function insert($data){
          $fieldName = implode(", ",array_keys($data));
          $fieldValues = ':'.implode(", :", array_keys($data));
          $sql ="INSERT INTO $this->table ($fieldName) VALUES ($fieldValues)";
          $stmt = $this->prepare($sql);

          foreach($data as $key => $value){
            $stmt->bindValue(":".$key, $value);
          }

            if(!$stmt->execute()){
              $stmt->erroInfo();
            }else{
              return $this->lastInsertId();
            }
    }

    public function select($orderField = null, $order = null){
       //$this->('utf 8');
        if($orderField == null){
          $sql = "SELECT * FROM $this->table";
        }else{
          $sql = "SELECT * FROM $this->table ORDER BY $orderField $order";
        }
        $stmt=$this->query($sql);

        return $stmt->fetchAll();
    }

    public function selectId($value){
       $sql = "SELECT * FROM $this->table WHERE $this->primaryKey = $value";
       $stmt=$this->query($sql);
       $count = $stmt->rowCount();
       if($count==1){
         return $stmt->fetch();
       }else{
         return FALSE;
       }

    }

    public function update($data){
      $fieldDetails = null;
      foreach($data as $key=>$value){
          $fieldDetails .= "$key=:$key,";
      }
      $fieldDetails = rtrim($fieldDetails, ',');
      $sql= "UPDATE $this->table SET $fieldDetails  WHERE $this->primaryKey = {$data[$this->primaryKey]}";
      $stmt = $this->prepare($sql);
      foreach($data as $key=>$value){
        $stmt->bindValue(":$key", $value);
      }
      if(!$stmt->execute()){
        print_r($stmt->errorInfo());
      }else{
         return $valueId;
      }
    }

    public function delete($valueId){
        $sql = "DELETE FROM $this->table WHERE $this->primaryKey =:$this->primaryKey";
        $stmt = $this->prepare($sql);
        $stmt->bindValue(":$this->primaryKey", $valueId);
        if(!$stmt->execute()){
          print_r($stmt->errorInfo());
        }else{
           return "Deleted";
        }
    }


}



 ?>
