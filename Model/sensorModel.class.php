<?php
//require_once (dirname(__FILE__) ."/../../../../library/sql.inc");
include_once("../../globals.php");
require_once($GLOBALS['srcdir'].'/sql.inc');

  class SensorModel {
    // object properties
    private $table_name = "form_orthorhb_sensors";

    public $id;
    public $sensorname;
    public $sensordesc;
    public $sensortoken;

     public function __construct($id, $sensorname, $sensordesc, $sensortoken) {
        $this->id  = $id;
        $this->sensorname  = $sensorname;
        $this->sensordesc  = $sensordesc;
        $this->sensortoken  = $sensortoken;
    }

    public static function get_tablename() {
        return $this->table_name;
    }

    public static function get_all_sensors() {
        $list = array();
        $db = get_db();
        $req = $db->Execute('SELECT * FROM ' . SENSORS_DBTABLE . ' s ORDER BY s.id DESC');
        // we create a list of SensorModel objects from the database results
        foreach($req as $sensor) {
            $list[] = new SensorModel($sensor['id'], $sensor['sensorname'], $sensor['sensordesc'], $sensor['sensortoken']);
        }
        return $list;
    }

  }
?>