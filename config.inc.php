<?php

//define path
define ('DS', DIRECTORY_SEPARATOR);
define ('HOME', dirname(__FILE__));

define('VIEW_DIR', HOME . DS.'View'.DS);
define('MODEL_DIR', HOME . DS.'Model'.DS);

//define form general
define("FORM_NAME", "OrthoRehabilitation - Telemedical Form");
define("FORM_FOLDER", "orthorhb_tele");

//define database table names
define("SENSORS_DBTABLE", "form_orthorhb_sensors");
define("SENSORSDATA_DBTABLE", "form_orthorhb_sensor_data");

define("PATIENTEXAM_DBTABLE", "form_orthorhb_patient_exam");
define("DATEFORMAT", "Y-m-d H:i:s");
//print_r('<br>DB connect througt ADOdb_Active_Record');
//establish persistent database connection
//include_once("$srcdir/adodb/adodb-active-record.inc.php");
require_once(dirname(__FILE__) . "/../../../vendor/adodb/adodb-php/adodb-active-record.inc.php");
$form_db = get_db();
ADOdb_Active_Record::SetDatabaseAdapter($form_db);

ADODB_Active_Record::$_changeNames = FALSE;//??????? but required