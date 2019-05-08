<?php

class ReportByPatient {

    public function __construct($form_data, $SensorRecordValues)
    {
        print "<style>.borderedtable, .borderedtable th, .borderedtable td { border: 1px solid black; }</style>";
        print "<style>.centertext { text-align: center; }</style>";
        print "<style>.warningtext { background-color: gold; }</style>";
        print "<style>.display-flex { display: flex; }</style>";
        print "<style>.display-margin { margin: 5px; }</style>";

        print "<div class=bold>Form Review:";
        print "<br>";

        print "<div><span>Monitoring started: </span><span class='bold warningtext'>".date(DATEFORMAT,  $form_data[sensorassigndate])."</span></div>";
        print "<br>";

        print "<span class=bold>Details:</span>";
        print "<table class=borderedtable>";
        print "<tr><th>Rec. date</th><th>Sensor</th><th>Datarecords</th></tr>";
        foreach ($SensorRecordValues as $key=>$sensorRecordData) {
            print "<tr><td class=bold>".date(DATEFORMAT, $sensorRecordData->timerec)."</td><td class='text centertext'>$sensorRecordData->datavalue</td><td class='text centertext'></td></tr>";
        }
        print "</table>";
        print "</div>";
        print "</div>";

        print "<hr>";
        print "<div class='display-margin display-flex'>";
        print "<div class='display-margin bold'>Form Created:";
        print "<div><span>- User: </span><span class=text>$form_data[createuser]</span></div>";
        print "<div><span>- Date/time: </span><span class=text>".date(DATEFORMAT,  $form_data[createdate])."</span></div>";
        print "</div>";
        print "<br>";
        print "<div class='display-margin bold'>Form Updated:";
        print "<div><span>- User: </span><span class=text>$form_data[user]</span></div>";
        print "<div><span>- Date/time: </span><span class=text>$form_data[date]</span></div>";
        print "</div>";

        print "</div>";
        print "<hr>";
    }
}
?>