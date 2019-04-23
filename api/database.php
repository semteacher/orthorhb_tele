<?php
class Database{
 //http://openemr.loc/interface/forms/orthorhb_tele/readsensor.php
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "openemr";
    private $port	= "3306";
    private $username = "";
    private $password = "";
    public $conn;
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>