<?php
require_once($GLOBALS['srcdir'] . "/forms.inc");
require_once(MODEL_DIR."sensorModel.class.php");
require_once(MODEL_DIR."sensorRecordModel.class.php");

require_once(VIEW_DIR."ReportByPatient.class.php");

//main controller class
class OrthoRehab_Exam_Form_Controller {

    public $form_folder;
    public $form_idexam;
    public $form_pid;
    public $returnurl;
    public $form_mode;
    public $table_name;
    public $createdate;
    public $form_encounter;
    public $form_userauthorized;
    public $sensorid;
    public $sensorassigndate;
    public $sensorreleasedate;
    public $notes;

    public function __construct() {
        $this->form_folder = FORM_FOLDER;
        $this->form_name = FORM_NAME;
        $this->table_name = PATIENTEXAM_DBTABLE;
        $this->form_encounter = $_SESSION['encounter'];
        $this->form_pid = $_SESSION['pid'];
        $this->form_userauthorized = $_SESSION['userauthorized'];
        $this->returnurl =$GLOBALS['form_exit_url'];
        $this->sensorid = 0;
        $this->sensorassigndate = date(DATEFORMAT, time());
        $this->sensorreleasedate = date(DATEFORMAT, (time()+86400)); //should be +1 day at list
        $this->notes = NULL;
    }
    
    public function default_action() {
        $this->form_name = $this->form_name. " (default)";
        //get all sensors
        //TODO: get only available sensors
        $Sensors = SensorModel::get_all_sensors();
        //display form
        require_once(VIEW_DIR.'OrthoRehab_Patient_Monitoring_Form.html');
        return;
	}

    public function new_action() {
        $this->form_name = $this->form_name. " (new)";
        $this->form_mode = "new";
        $this->createdate = time();

        //get all sensors
        //TODO: get only available sensors
        $Sensors = SensorModel::get_all_sensors();
        //TODO: get previous observations
        //display form
        require_once(VIEW_DIR.'OrthoRehab_Patient_Monitoring_Form.html');
        //require_once(VIEW_DIR.'test.html');

        return;
    }

	public function view_action($form_idexam) {
        //show form patient data
        $form_idexam = intval($form_idexam);
        //fetch form data
        $form_data = formFetch($this->table_name, $form_idexam);

		if ($form_data) {
            $this->form_idexam = $form_idexam;
            //var_dump($form_data);
           // $this->form_pid = $_SESSION['pid'];
            $this->sensorid = $form_data[sensorid];
            $this->sensorassigndate = date(DATEFORMAT, $form_data[sensorassigndate]);
            $this->sensorreleasedate = date(DATEFORMAT,  $form_data[sensorreleasedate]);
            $this->createdate = $form_data[createdate];
            $this->notes = $form_data[notes];
    	}
    	else {
    		//error??
    	}
        $this->form_name = $this->form_name. " (view)";
        $this->form_mode = "update";
        //get all sensors
        //TODO: get only available sensors
        $Sensors = SensorModel::get_all_sensors();
        //get sensor record belong to this form
        $SensorRecordValues = SensorRecordModel::get_sensordata_formid($this->form_idexam);
        //display form
        require_once(VIEW_DIR.'OrthoRehab_Patient_Monitoring_Form.html');

        return;

	}

    public function report_action($form_idexam) {
        //show form report on the encounter page
        $form_idexam = intval($form_idexam);
        //fetch form data
        $form_data = formFetch($this->table_name, $form_idexam);
        if ($form_data) {
            $this->form_idexam = $form_idexam;
            $this->sensorid = $form_data[sensorid];
            $this->sensorassigndate = date(DATEFORMAT, $form_data[sensorassigndate]);
            $this->sensorreleasedate = date(DATEFORMAT,  $form_data[sensorreleasedate]);
            $this->createdate = $form_data[createdate];
            $this->notes = $form_data[notes];
            //get sensor record belong to this form
            $SensorRecordValues = SensorRecordModel::get_sensordata_formid($this->form_idexam);
            //display form
            $report_form = new ReportByPatient($form_data, $SensorRecordValues);
        }
        return;
    }
    
    public function save_action_process() {
        $this->form_idexam = $_POST['id'];
        if ($_POST['pid']) {$this->form_pid = $_POST['pid'];}else{$this->form_pid = $_SESSION['pid'];}

        if ($_POST['sensorid']) {$this->sensorid = intval($_POST['sensorid']);}else{$this->sensorid = 0;}

        //$createdate = DateTime::createFromFormat(DATEFORMAT, $_POST['createdate']);
        $createdate = intval($_POST['createdate']);
        $sensorassigndate = DateTime::createFromFormat(DATEFORMAT, $_POST['sensorassigndate']);
        $sensorreleasedate = DateTime::createFromFormat(DATEFORMAT, $_POST['sensorreleasedate']);
        //if ($createdate->getTimestamp()) {$this->createdate = $createdate->getTimestamp();}else{$this->createdate = time();}
        if ($createdate) {$this->createdate = $createdate;}else{$this->createdate = time();}
        if ($sensorassigndate->getTimestamp()) {
            $this->sensorassigndate = $sensorassigndate->getTimestamp();
        }else{
            $this->sensorassigndate = time();
        }
        if ($sensorreleasedate->getTimestamp()) {
            $this->sensorreleasedate = $sensorreleasedate->getTimestamp();
        }else{
            $this->sensorreleasedate = time()+86400;
        }
        if ($_POST['notes']) {$this->notes = $_POST['notes'];}else{$this->notes = Null;}

        $this->form_encounter = $_SESSION['encounter'];
        $this->form_userauthorized = $_SESSION['userauthorized'];

        //save new/update patient form data
        if ($_GET["mode"] == "new") {

            /* NOTE - for customization you can replace $_POST with your own array
             * of key=>value pairs where 'key' is the table field name and
             * 'value' is whatever it should be set to
             * ex)   $newrecord['parent_sig'] = $_POST['sig'];
             *       $newid = formSubmit($table_name, $newrecord, $_GET["id"], $userauthorized);
             */

            /* save the data into the form's own table */
            $newid = formSubmit($this->table_name, array('encounter'=>$this->form_encounter, 'createuser'=>$_SESSION['authUser'], 'createdate'=>$this->createdate, 'sensorid'=>$this->sensorid, 'sensorassigndate'=> $this->sensorassigndate,  'sensorreleasedate'=>$this->sensorreleasedate, 'notes'=>$this->notes), $_GET["id"], $this->form_userauthorized);

            $this->form_idexam = $newid;
            /* link the form to the encounter in the 'forms' table */
            addForm($this->form_encounter, $this->form_name, $newid, $this->form_folder, $this->form_pid, $this->form_userauthorized);
        }
        elseif ($_GET["mode"] == "update") {
            /* update existing record */
            $success = formUpdate($this->table_name, array('encounter'=>$this->form_encounter, 'sensorid'=>$this->sensorid, 'sensorassigndate'=> $this->sensorassigndate, 'sensorreleasedate'=>$this->sensorreleasedate, 'notes'=>$this->notes), $_GET["id"], $this->form_userauthorized);
        } else {
            //TODO: throw error
            return;
        }
//die;
		return;
	} 
}

?>