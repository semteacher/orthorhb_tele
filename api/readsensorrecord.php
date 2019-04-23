<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// database connection will be here
// include database and object files
include_once 'database.php';
include_once 'sensorrecord.class.php';
 
// instantiate database and sensorrecord object
$database = new Database();
$db = $database->getConnection();

// initialize object
$sensorrecord = new SensorRecord($db);

// read products will be here
// query products
$stmt = $sensorrecord->readall();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
 
    // products array
    $sensor_records_arr=array();
    $sensor_records_arr["sensorrecords"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $sensor_record_item=array(
            "id" => $id,
            "sensorid" => $sensorid,
            "assignid" => $assignid,
            "timerec" => $timerec,
            "datavalue" => $datavalue
        );
 
        array_push($sensor_records_arr["sensorrecords"], $sensor_record_item);
    }
 
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($sensor_records_arr);
}
 
// no products found will be here
else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No sensor records found.")
    );
}