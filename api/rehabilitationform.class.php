<?php
class RehabilitationForm{
 
    // database connection and table name
    private $conn;
    private $table_name = "form_orthorhb_patient_exam";
 
    // object properties
    public $id;
    public $date;
    public $pid;
    public $user;
    public $encounter;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read forms
    public function getAll(){
     
        // select all query
        $query = "SELECT * 
                  FROM " . $this->table_name . " f
                  ORDER BY f.id DESC";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }

    public function getFormById($formid){
     
        // select all query
        $query = "SELECT * 
                  FROM " . $this->table_name . " f
                  WHERE f.id=" .$formid. ";";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
     
        return $stmt;
    }

    public function getFormAssignedToSensor($sensorid) {
                // select all query
        $query = "SELECT f.id, f.pid, f.encounter    
                  FROM " . $this->table_name . " f
                  WHERE (f.sensorid=" .$sensorid. ")AND(f.sensorassigndate<=".time().")AND(f.sensorreleasedate>=".time().");";
     
        // prepare query statement
        $stmt = $this->conn->prepare($query);
     
        // execute query
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
     
        return $row;
    } 

}