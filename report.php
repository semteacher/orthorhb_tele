<?php
include_once("../../globals.php");
include_once($GLOBALS["srcdir"]."/api.inc");

include_once("config.inc.php");

require_once ("Controller/OrthoRehab_Exam_Form_Controller.class.php");

function orthorhb_tele_report( $pid, $encounter, $cols, $id) {

    $c = new OrthoRehab_Exam_Form_Controller();
    echo $c->report_action($id);

}

?> 
