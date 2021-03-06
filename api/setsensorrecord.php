<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
//header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection and sensor_data object
include_once 'database.php';
include_once 'sensorrecord.class.php';
 
$database = new Database();
$db = $database->getConnection();

$sensorrec = new SensorRecord($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->sensorid) &&
    !empty($data->formid) &&
    !empty($data->datavalue)
){
 
    // set product property values
    $sensorrec->sensorid = $data->sensorid;
    $sensorrec->formid = $data->formid;
    $sensorrec->datavalue = $data->datavalue;
    if (!empty($data->timerec)) {
        //$sensorrec->timerec = $data->timerec;
        $sensorrec->timerec = date('Y-m-d H:i:s');
    } else {
        $sensorrec->timerec = date('Y-m-d H:i:s');
    }
 
    // create the SensorRecord
    if($sensorrec->createRecord()){
        // set response code - 201 created
        http_response_code(201);
        // tell the user
        echo json_encode(array("message" => "SensorRecord was created."));
    } else {
        // if unable to create the SensorRecord, tell the user
        // set response code - 503 service unavailable
        http_response_code(503);
        // tell the user
        echo json_encode(array("message" => "Unable to create SensorRecord."));
    }
} else {
    // tell the user data is incomplete
    // set response code - 400 bad request
    http_response_code(400);
    // tell the user
    echo json_encode(array("message" => "Unable to create SensorRecord. Data is incomplete."));
}
?>