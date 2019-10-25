<?php
/**
 * Block CTRS Events
 */

$year = get_field('year');
$type_id = get_field('type_id');

function cca_ctrs_events($year, $type_id) {

    if ( !isset($year) || empty($year) ){
        $year = "2020";
    }

    if ( !isset($type_id) || empty($type_id) ){
        $type_id = "82";
    }

	$eventyear = $year; //2020;
	$eventtypeid = $type_id;  //82 womens, 81 mens

	$addLanguageUrl = "";
	$language = $_GET['lang'];

	if ($language=="fr") {
	  $addLanguageUrl = "?lang=fr";
	}
    $main = '';
	$main .= "<table bgcolor=#999999 cellspacing=1 cellpadding=2 width=630 border=0>
	    	<tr bgcolor=#DADADA>
	    	<td width=530><b>Event</b></td>
	    	<td width=100 align=center><b>Results</b></td>
	    </tr>";

	$filename = "http://ctrs.curling.ca/" . $eventyear . "schedule_eventtype" . $eventtypeid . ".xml";

	$sxe = simplexml_load_file($filename);
		    
	foreach ($sxe->event as $event) {
	
	    if ($bgcolor == "#FFFFFF"):
			$bgcolor = "#EEEEEE";
		else:
			$bgcolor = "#FFFFFF";
		endif;
				
		$startdate = $event->startdate;
		$enddate = $event->enddate;
				
		$displayyear = date("Y", strtotime($startdate));
		if (strtotime($startdate) <> strtotime($enddate)):
			if (date("Y", strtotime($startdate)) <> date("Y", strtotime($enddate))):
				$eventdate = date("M j", strtotime($startdate));
			else:
				$eventdate = date("M j", strtotime($startdate));
			endif;
			$eventdate .= " - ";
			if (date("M", strtotime($startdate)) <> date("M", strtotime($enddate))):
				$eventdate .= date("M j, Y", strtotime($enddate));
			else:
				$eventdate .= date("j, Y", strtotime($enddate));
			endif;
		else:
			$eventdate = date("M j, Y", strtotime($startdate));
		endif;
		        
		$main .= "<form name=viewDetail action=../ctrs-event-results/$addLanguageUrl method=post>
	        <tr bgcolor='$bgcolor'>
	        <td valign=top><b>" . $event->eventname . "</b><br>" . $event->city . ", " . $event->prefix . "<br>" . $eventdate . "<br><a href='" . $event->website . "' target=_blank>" . $event->website . "</a></td>
	        <td align=center><b><input type=submit name=submit value=Results></b></td>
	        </tr>
	        <input name=eventid type=hidden value=" . $event->eventid . "></form>";
				
	}
	$main .= "</table>";
	return $main;
}
?>
<section class="ctrs-container">
    <div class="ctrs-wrapper ctrs-standings">
<?php echo cca_ctrs_events($year, $type_id); ?>
    </div>
</section>