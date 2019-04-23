<?php
class Sensor{
 
    // database connection and table name
    private $conn;
    private $table_name = "form_orthorhb_sensors";
 
    // object properties
    public $id;
    public $sensorname;
    public $sensordesc;
    public $sensortoken;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
// read sensors
function readall(){
 
    // select all query
    $query = "SELECT 
                *
            FROM
                " . $this->table_name . " s
            ORDER BY
                s.id DESC";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute();
 
    return $stmt;
}
}