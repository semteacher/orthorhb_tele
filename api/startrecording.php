<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
//header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection and sensor_data object
include_once 'database.php';
include_once 'rehabilitationform.class.php';
include_once 'sensorrecord.class.php';

//echo json_encode($__REQUEST); 
$database = new Database();
$db = $database->getConnection();

// get PUT data
$data = json_decode(file_get_contents("php://input"));
//echo json_encode($data);
$rehabilitationform = new RehabilitationForm($db);
// make sure data is not empty
if(!empty($data->sensorid)){
    $patientform = $rehabilitationform->getFormAssignedToSensor(intval($data->sensorid));
    // create the product
    if($patientform['id']){
        $sensorrec = new SensorRecord($db);
        // set sensorrecord defaults
        $sensorrec->sensorid = intval($data->sensorid);
        $sensorrec->formid = $patientform['id'];
        $sensorrec->timerec = time();
        $sensorrec->datavalue = null;
        if($res=$sensorrec->createRecord()){
            // set response code - 201 created
            http_response_code(201);
            // tell the user
            echo json_encode(array("message" => "Record session was started!", "res"=>$res));
        } else {
            http_response_code(503);
            // tell the user
            echo json_encode(array("message" => "Unable to create SensorRecord."));          
        }
    } else {
        // if unable to create the sensorrecord, tell the user
        // set response code - 503 service unavailable
        http_response_code(503);
        // tell the user
        echo json_encode(array("message" => "Unable to retreive RehabilitationForm ID."));
    }
} else {
    // tell the user data is incomplete
    // set response code - 400 bad request
    http_response_code(400);
    // tell the user
    echo json_encode(array("message" => "Unable to create SensorRecord. Data is incomplete."));
}
?>