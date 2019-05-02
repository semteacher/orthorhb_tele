<?php
//require_once (dirname(__FILE__) ."/../../../../library/sql.inc");
include_once("../../globals.php");
require_once($GLOBALS['srcdir'].'/sql.inc');

  class SensorRecordModel {
    // object properties
    private $table_name = "form_orthorhb_sensor_data";

    public $id;
    public $sensorid;
    public $formid;
    public $timerec;
    public $datavalue;

     public function __construct($id, $sensorid, $formid, $timerec, $datavalue) {
        $this->id  = $id;
        $this->sensorid  = $sensorid;
        $this->formid  = $formid;
        $this->timerec  = $timerec;
        $this->datavalue  = $datavalue;
    }

    public static function get_tablename() {
        return 'form_orthorhb_sensor_data';
    }

    public static function get_all_sensordata() {
        $list = array();
        $db = get_db();
        $req = $db->Execute('SELECT * FROM ' . SENSORSDATA_DBTABLE . ' s ORDER BY s.id DESC');
        // we create a list of SensorRecordModel objects from the database results
        foreach($req as $sensordata) {
            $list[] = new SensorRecordModel($sensordata['id'], $sensordata['sensorid'], $sensordata['formid'], $sensordata['timerec'], $sensordata['datavalue']);
        }
        return $list;
    }

    public static function get_sensordata_id($id) {
        //$list = array();
        $db = get_db();
        $req = $db->Execute('SELECT * FROM ' . SENSORSDATA_DBTABLE . ' s WHERE s.id= ' . $id . ';');
        // we create a list of SensorRecordModel objects from the database results
        foreach($req as $sensordata) {
            $rec = new SensorRecordModel($sensordata['id'], $sensordata['sensorid'], $sensordata['formid'], $sensordata['timerec'], $sensordata['datavalue']);
        }
        return $rec;
    }

    public static function get_sensordata_formid($formid) {
        $list = array();
        $db = get_db();
        $req = $db->Execute('SELECT sd.id, sd.sensorid, s.sensorname, sd.formid, sd.timerec  
                             FROM ' . SENSORSDATA_DBTABLE . ' sd 
                             LEFT JOIN ' . SENSORS_DBTABLE . ' s ON s.id=sd.sensorid
                             WHERE sd.formid= ' . $formid . ';');
        // we create a list of SensorRecordModel objects from the database results
        foreach($req as $sensordata) {
            $list[] = new SensorRecordModel($sensordata['id'], $sensordata['sensorid'], $sensordata['formid'], $sensordata['timerec'], $sensordata['sensorname']);
        }
        return $list;
        //return $req;
    }

    public static function get_sensordata_value_id($id) {
        //$list = array();
        $db = get_db();
        $req = $db->GetOne('SELECT s.datavalue FROM ' . SENSORSDATA_DBTABLE . ' s WHERE s.id= ' . $id . ';');
        // we create a list of SensorRecordModel objects from the database results
        //foreach($req as $sensordata) {
        //    $rec = new SensorRecordModel($sensordata['id'], $sensordata['sensorid'], $sensordata['formid'], $sensordata['timerec'], $sensordata['datavalue']);
        //}
        return $req;
    }
  }
?>