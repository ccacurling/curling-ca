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
	$main ="<style>.events-title span {font-family: 'Knockout';font-size: 20px;color: #000000;letter-spacing: 1px;line-height: 20px;font-weight: 300;text-transform: uppercase;} </style>";
    $main .= "<div class='ctrs-team-results-team-container' style='width: 100%;'><div class='standings-container' style='border: 1px solid #979797;'>";
	$main .= "<p class='title-row events-title' style='border-bottom: 1px solid #979797;padding: 20px;background-color:#fff;display: flex;flex-direction: row;justify-content: space-between;'>
			<span style=''>Event</span>
			<span style=''>Results</span></p>";

	$filename = "http://ctrs.curling.ca/" . $eventyear . "schedule_eventtype" . $eventtypeid . ".xml";

	$sxe = simplexml_load_file($filename);
	$bgcolor = "#FFFFFF";
		    
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
		<p class='rank-row' style='background-color: $bgcolor;padding: 20px;display: flex;flex-direction: row;justify-content: space-between;'>
			<span class='event-name'>{$event->eventname}<br>{$event->city}, {$event->prefix}<br>{$eventdate}<br>
				<a href='{$event->website}' target=_blank>{$event->website}</a></span>
			<span><input name='eventid' type=hidden value=" . $event->eventid . "><input type=submit name=submit value=Results></span>
		</p></form>";
				
	}
	$main .= "</div></div>";
	return $main;
}
?>
<section class="ctrs-container">
    <div class="ctrs-wrapper ctrs-standings">
<?php echo cca_ctrs_events($year, $type_id); ?>
    </div>
</section>