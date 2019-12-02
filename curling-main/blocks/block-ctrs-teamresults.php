<?php
/**
 * Block CTRS Events Results
 */


$teamid = $_GET["teamid"];

$language = apply_filters( 'wpml_current_language', NULL );


function do_ctrs_team_results ($teamid, $language) {
	
	$addLanguageUrl = "";
	
	$eventsPlayedInText = "Events this team has played in:";
	if ($language=="fr") {
	  $addLanguageUrl = "?lang=fr";
	  $eventsPlayedInText = "Événements joué par cette équipe :";
	}
		$maxeventcount = 8;
		if ($teamid == "") {
			$teamid = "97472";
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
			
		$main .= "<table width='580' border='0' cellpadding='0' cellspacing='0'>
		<tr>
		<td width='100'><b>$fourthpos:</b></td>

		<td width='480'>" . $sxe->fourthfirstname . " " . $sxe->fourthlastname . "</td>
		</tr>
		<tr>
		<td width='100'><b>$thirdpos:</b></td>
		<td width='480'>" . $sxe->thirdfirstname . " " . $sxe->thirdlastname . "</td>

		</tr>
		<tr>
		<td width='100'><b>$secondpos:</b></td>
		<td width='480'>" . $sxe->secondfirstname . " " . $sxe->secondlastname . "</td>
		</tr>


		<tr>
		<td width='100'><b>$leadpos:</b></td>
		<td width='480'>" . $sxe->leadfirstname . " " . $sxe->leadlastname . "</td>
		</tr>
		<tr>";
		
		if ($sxe->spareid <> 0):

			$main .= "<tr>
				<td width='100'><b>Alt:</b></td>
				<td width='480'>" . $sxe->sparefirstname . " " . $sxe->sparelastname . "</td>
				</tr>";
		endif;
		$main .= "<tr>
		<td colspan='2' class='title'>$eventsPlayedInText</td>
		</tr>
	   
		<tr>
		<td colspan='2'>
		<table bgcolor='#999999' cellspacing='1' cellpadding='2' width='630' border='0'>
			<tr bgcolor='#DADADA'>";
	if ($language=="fr") {
		$main .= "<td width='430'><b>Événement</b></td>
			<td width='75' align='center'><b>Classement</b></td>
			<td width='75' align='right'><b>Points</b></td>";
	} else {
		$main .= "<td width='430'><b>Event Name</b></td>
			<td width='75' align='center'><b>Standings</b></td>
			<td width='75' align='right'><b>Points Won</b></td>";
	}
		$main .= "</tr>";

		$eventcount = 0;
		$pointstotal = 0.000;
		foreach ($sxe->event as $event) {
			$eventcount++;		
			$eventpoints = number_format((double)$event->pointtotal, 3);
			if ($eventcount <= $maxeventcount):
				$pointstotal = number_format((double)$pointstotal + $eventpoints, 3);
				$main .= "<form name=viewDetail action=../ctrs-event-results/$addLanguageUrl method=post>
				<tr bgcolor='#CCCCFF'>
					<td><input type=submit name=submit value=Details> <b>" . $event->eventname . "</b></td>
					<td align=right><b>";
					if ($event->qualifier == 1):
						$main .= $event->place;
					else:
						$main .= "N/A";
					endif;
					$main .= "</b> </td>
					<td align=right><b>" . $event->pointtotal . "</b> </td>
				</tr>
				<input name=eventid type=hidden value=" . $event->eventid . "></form>";
			else:
				$main .= "<form name=viewDetail action=../ctrs-event-results/$addLanguageUrl method=post>
				<tr bgcolor='#DADADA'>
					<td><input type=submit name=submit value=Details> <i>" . $event->eventname . "</i></td>
					<td align=right><i>";
					if ($event->qualifier == 1):
						$main .= $event->place;
					else:
						$main .= "N/A";
					endif;
					$main .= "</i> </td>
					<td align=right><i>" . $event->pointtotal . "</i> </td>
				</tr>
				<input name=eventid type=hidden value=" . $event->eventid . "></form>";
			endif;
		}
		$main .= "<tr><td colspan=2 align=right><b>Total: (Best $maxeventcount Results)</b></td><td align=right><b>" . number_format((double)$pointstotal,3) . "</b> </td></tr>";
		$main .= "</table></td></tr></table>";
		return $main;
}


?>

<section class="ctrs-container">
    <div class="ctrs-wrapper ctrs-teams">
	<?php echo do_ctrs_team_results($teamid, $language); ?>
    </div>
</section>