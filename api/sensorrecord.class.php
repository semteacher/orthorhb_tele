<?php
class SensorRecord{
 
    // database connection and table name
    private $conn;
    private $table_name = "form_orthorhb_sensor_data";
 
    // object properties
    public $id;
    public $sensorid;
    public $formid;
    public $timerec;
    public $datavalue;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read ALL sensor records
    function readAll(){
        // select all query
        $query = "SELECT *
                  FROM " . $this->table_name . " sr
                  ORDER BY sr.id DESC";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
        // execute query
        $stmt->execute();
        return $stmt;
    }

// create sensor record
function createRecord(){
    // query to insert record
    $query = "INSERT INTO " . $this->table_name . "
            SET sensorid=:sensorid, formid=:formid, timerec=:timerec, datavalue=:datavalue";
 
    // prepare query
    $stmt = $this->conn->prepare($query);
 
    // sanitize
    $this->sensorid=htmlspecialchars(strip_tags($this->sensorid));
    $this->formid=htmlspecialchars(strip_tags($this->formid));
    $this->timerec=htmlspecialchars(strip_tags($this->timerec));
    //$this->datavalue=htmlspecialchars(strip_tags($this->datavalue));
 
    // bind values
    $stmt->bindParam(":sensorid", $this->sensorid);
    $stmt->bindParam(":formid", $this->formid);
    $stmt->bindParam(":timerec", $this->timerec);
    $stmt->bindParam(":datavalue", $this->datavalue);
 
    // execute query
    if($stmt->execute()){
        return true;
    }
    return false;
}
}