<?php
/**
 * Block CTRS Events Results
 */


$teamid = $_REQUEST["teamid"];

$events_details_link = get_field("event_details_link");

if (!$events_details_link){
	$events_details_link = "/team-canada/ctrs-event-results";
}

//$events_details_link .= '/' . $addLanguageUrl;

$language = apply_filters( 'wpml_current_language', NULL );


function do_ctrs_team_results ($teamid, $language, $event_link) {
	
	$addLanguageUrl = "";
	$eventsPlayedInText = "Events this team has played in:";

	if ($language=="fr") {
	  $addLanguageUrl = "?lang=fr";
	  $eventsPlayedInText = "Événements joué par cette équipe :";
	}

	$maxeventcount = 8;

	if ($teamid == "") {
		$teamid = "97472"; //Default Team
	}

	$sxe = simplexml_load_file("http://ctrs.curling.ca/ctrsteam" . $teamid . ".xml");
	
	$fourthpos = "Fourth";
	$thirdpos = "Third";
	$secondpos = "Second";
	$leadpos = "Lead";
	
	if ($language=="fr") {
		$fourthpos = "4ème";
		$thirdpos = "3ème";
		$secondpos = "2ème";
		$leadpos = "1er";
	}	
	
	if ($sxe->skipid == $sxe->fourthid):
		$fourthpos = "Skip";
	elseif ($sxe->skipid == $sxe->thirdid):
		$thirdpos = "Skip";
	elseif ($sxe->skipid == $sxe->secondid):
		$secondpos = "Skip";	
	elseif ($sxe->skipid == $sxe->leadid):
		$leadpos = "Skip";
	endif;



	$main .= "<div role='team-results' class='ctrs-team-results-team-container'><h3 class='ctrs-team-results-title'>" . __("CTRS Team Results") . "</h3>";

	$main .= "<div class='standings-container'>";

	$main .= "<p class='ctrs-position'><span class='pos'>$fourthpos</span><span class='name'>{$sxe->fourthfirstname} {$sxe->fourthlastname}</span></p>";
	$main .= "<p class='ctrs-position'><span class='pos'>$thirdpos</span><span class='name'>{$sxe->thirdfirstname} {$sxe->thirdlastname}</span></p>";
	$main .= "<p class='ctrs-position'><span class='pos'>$secondpos</span><span class='name'>{$sxe->secondfirstname} {$sxe->secondlastname}</span></p>";
	$main .= "<p class='ctrs-position'><span class='pos'>$leadpos</span><span class='name'>{$sxe->leadfirstname} {$sxe->leadlastname}</span></p>";
			
	if ($sxe->spareid <> 0):
		$main .= "<p class='ctrs-position'><span class='pos'>Alt:</span><span class='name'>{$sxe->sparefirstname} {$sxe->sparelastname}</span></p>";
	endif;
	$main .= "</div></div>";
	

	$main .= "<div class='ctrs-team-results-team-container'><h4 class='ctrs-team-results-title'>" . __($eventsPlayedInText) . "</h4>";
	$main .= "<div class='standings-container'>";


	if ($language=="fr") {
		$main .= "<p class='title-row'><span class='event-name'>Événement</span><span>Classement</span><span>Points</span></p>";
	} else {
		$main .= "<p class='title-row'><span class='event-name'>Event Name</span><span>Standings</span><span>Points Won</span></p>";
	}


	$eventcount = 0;
	$pointstotal = 0.000;
	
	foreach ($sxe->event as $event) {
		$eventcount++;		
		$eventpoints = number_format((double)$event->pointtotal, 3);
		if ($event->qualifier == 1):
			$placename .= $event->place;
		else:
			$placename .= "N/A";
		endif;

		$pointstotal = number_format((double)$pointstotal + $eventpoints, 3);

		$main .= "<form role='form' name=viewDetail action='$event_link' method='post'>";
		
		if ($eventcount <= $maxeventcount):
			$main .= "<p class='rank-row'><span class='event-name'><input type=submit name=submit value=Details>$event->eventname</span><span>$placename</span><span>$event->pointtotal</span></p>";
		else:
			$main .= "<p class='old-rank-row'><span class='event-name'><input type=submit name=submit value=Details>$event->eventname</span><span>$placename</span><span>$event->pointtotal</span></p>";
		endif;

		$main .= "<input name=eventid type=hidden value=" . $event->eventid . "></form>";
	}
	
	$main .= "<p class='total-row'><b>Total: (Best $maxeventcount Results) " . number_format((double)$pointstotal,3) . "</b></p>";

	$main .= "</div></div>";

	return $main;
}


?>

<section class="ctrs-container">
    <div class="ctrs-wrapper ctrs-teams">
	<?php echo do_ctrs_team_results($teamid, $language, $events_details_link); ?>
    </div>
</section>