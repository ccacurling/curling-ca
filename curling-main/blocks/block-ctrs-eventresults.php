<?php
/**
 * Block CTRS Events Results
 */

//$year = get_field('year');
$event_id = get_field('event_id');

function cca_ctrs_event_results ($eid) {

	if (isset($eid) && !empty($eid)){
		$eventid = $eid; //$_POST["eventid"];
	} else {
		$eventid = $_POST["eventid"];
	}
	$addLanguageUrl = "";
	$language = $_GET['lang'];

	if ($language=="fr") {
	  $addLanguageUrl = "?lang=fr";
	}

	$view = $_POST["view"];
	if ($eventid == "") {
		$eventid = "6015";
	}
	$xmlfile = "http://ctrs.curling.ca/event" . $eventid . ".xml";

	$sxe = simplexml_load_file($xmlfile);

	$eventid = $sxe->eventid;
	$eventname = $sxe->eventname;
	$eventyear = $sxe->eventyear;
	$startdate = $sxe->startdate;
	$enddate = $sxe->enddate;
	$eventcity = $sxe->city;
	$eventid_pair = $sxe->eventid_pair;
	$locationprov = $sxe->province;
	$paypaladdress = $sxe->paypaladdress;
	$contact = $sxe->contact;
	$contactemail = $sxe->contactemail;
	$contactphone = $sxe->contactphone;
	$contactfax = $sxe->contactfax;
	$numteams = $sxe->numteams;
	$numqualify = $sxe->numqualify;
	$formattype = $sxe->formattype;
	$rr_tournamentid = $sxe->rr_tournamentid;
	$tb_tournamentid = $sxe->tb_tournamentid;
	$po_tournamentid = $sxe->po_tournamentid;
	$yeardisplay = date("Y", strtotime($sxe->startdate));
	$standingtype = $sxe->standingtype;
	$qualifyonly = $sxe->qualifyonly;
	$eventpagecounter = $sxe->counter;
	$website = $sxe->website;
	$showteamname = $sxe->showteamname;
	$etimezoneid = $sxe->timezoneid;
	$showteams = $sxe->showteams;
	$showteamsondraw = $sxe->showteamsondraw;
	$eventdescription = str_replace("[lf]",chr(10),str_replace("[cr]",chr(13),$sxe->description));
	$paymentinfo = str_replace("[lf]",chr(10),str_replace("[cr]",chr(13),$sxe->paymentinfo));
	$hostclubid = $sxe->clubid;
	$onlineregister = $sxe->onlineregister;
	$eventsetid = $sxe->eventsetid;
	$strength_of_field = $sxe->strength_of_field;
		
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
		
	if ($sxe->eventpurse <> 0):
		$purse = "$" . number_format((double)$sxe->eventpurse) . " " . $sxe->currency;
	else:
		$purse = "TBA";
	endif;
	
	if ($sxe->entrycost <> 0):
		$entryfee = "$" . number_format((double)$sxe->entrycost) . " " . $sxe->currency;
	else:
		$entryfee = "TBA";
	endif;

	if ($sxe->curlingclub <> ""):
		$clubname = $sxe->curlingclub;
	else:
		$clubname = $sxe->city;
	endif;
		
	//Beginning of output building
	$main .= "<div class='ctrs-team-results-team-container'><h3 class='ctrs-team-results-title'>" . __("Event Results:") . " {$sxe->eventname}</h3>";

	$main .= "<div class='standings-container'>";

	if ($language=="fr") {
		$host_label = "Hôte";
	} else {
		$host_label = "Host Curling Club";
	}

	if ($sxe->strength_of_field == '-1.00'):
		$sfm_val = "FIXED";
	elseif ($sxe->strength_of_field == '0'):	
		$sfm_val = "Not Set";
	else:
		$sfm_val = $sxe->strength_of_field;	
	endif;

	$main .= "<p class='ctrs-position'><span class=''>$host_label: </span><span class=''>$clubname</span></p>";

	$main .= "<p class=''><span class=''>SFM: $sfm_val</span>";
	if ($sxe->strength_of_field > 0):
		
		$main .= "<span><form name=viewDetail action=?$addLanguageUrl method=post>
		<input type=submit name=submit value=SFM>
		<input name=eventid type=hidden value=" . $sxe->eventid . ">
		<input name=view type=hidden value=sfm></form></span>
		<span><form name=viewDetail action=?$addLanguageUrl method=post>
		<input type=submit name=submit value=Results>
		<input name=eventid type=hidden value=" . $sxe->eventid . "></form></span>";

	endif;

	$main .= "</p>";

	if ($language=="fr") {
		$local_label = "Ville, Province :";
	} else {
		$local_label = "City/Province:";
	}

	$main .= "<p class='ctrs-position'><span class=''>$local_label </span><span class=''>{$sxe->city}, {$sxe->prefix}</span></p>";
	$main .= "<p class='ctrs-position'><span class=''>Dates: </span><span class=''>{$eventdate}</span></p>";

	if ($language=="fr") {
		$site_label = "Site web :";
	} else {
		$site_label = "Website URL:";
	}

	$main .= "<p class='ctrs-position'><span class=''>{$site_label} </span><span class=''>{$sxe->website}</span></p>";

	$main .= "</div></div>";


	if ($view == "sfm"):

		if ($language=="fr") {
			$table_label .= "SFM pour l'événement";
		} else {
			$table_label = "Strength of Field for Event";
		}

		$main .= "<div class='ctrs-team-results-team-container'><h4 class='ctrs-team-results-title'>" . __($table_label) . "</h4>";
		$main .= "<div class='standings-container'>";
		
		$xmlfile = "http://ctrs.curling.ca/sfm_event" . $eventid . ".xml";
		$sfm = simplexml_load_file($xmlfile);

		$main .= "<p class='title-row'><span class='event-name'>Team Name</span><span>SFM Value</span><span>OOM Points</span></p>";
					
		$event_totalpoints = 0;
		$bgcolor = "#FFFFFF";
		foreach ($sfm->team as $team) {

			if ($bgcolor == "#FFFFFF"):
				$bgcolor = "#EEEEEE";
			else:
				$bgcolor = "#FFFFFF";
			endif;
					
			$event_totalpoints = $event_totalpoints + number_format((double)$team->sfmvalue, 3);

			$main .= "<p class='rank-row' style='background-color: $bgcolor;'><span class='event-name'>{$team->ranking} - {$team->lastname}, {$team->firstname}</span><span>{$team->sfmvalue}</span><span>{$team->oompoints}</span></p>";

		}

		$main .= "<p class='total-row'><b>" . number_format((double)$event_totalpoints,3) . "</b></p>";

		$main .= "</div></div>";

	else:
		
		if ($language=="fr") {
			$table_label .= "Résultats de l'événement";
		} else {
			$table_label = "Results From Event";
		}

		$main .= "<div class='ctrs-team-results-team-container'><h4 class='ctrs-team-results-title'>" . __($table_label) . "</h4>";
		$main .= "<div class='standings-container'>";


		$xmlfile = "http://ctrs.curling.ca/ctrs_event" . $eventid . "points.xml";
			
		$sle = simplexml_load_file($xmlfile);

		if ($language=="fr") {
			$main .= "<p class='title-row'><span class='event-name'>Équipe</span><span>Classement</span><span>Points</span></p>";
		} else {
			$main .= "<p class='title-row'><span class='event-name'>Team Name</span><span>Standing</span><span>Points Won</span></p>";
		}

				
		$event_totalpoints = 0;
		$bgcolor = "#FFFFFF";
		foreach ($sle->team as $team) {		

			if ($bgcolor == "#FFFFFF"):
				$bgcolor = "#EEEEEE";
			else:
				$bgcolor = "#FFFFFF";
			endif;
					
			$event_totalpoints = $event_totalpoints + $team->pointtotal;
					
			if ($team->place >= 1):
				$teamstanding = $team->place;
			else:
				$teamstanding = "N/A";
			endif;
					
			$event_link = "../ctrs-team-results/$addLanguageUrl";

			$main .= "<form name=viewDetail action='$event_link' method='post'>";
			$main .= "<p class='rank-row' style='background-color: $bgcolor;'>";
			$main .= "<span class='event-name'><input type=submit name=submit value=Details>{$team->skiplastname}, {$team->skipfirstname}</span><span>$teamstanding</span><span>{$team->pointtotal}</span></p>";
			$main .= "<input name=eventid type=hidden value=" . $team->teamid . "></form>";
		}

		$main .= "<p class='total-row'><b>" . number_format((double)$event_totalpoints,3) . "</b></p>";
		$main .= "</div></div>";
		
	endif;
	
	return $main;
}
?>
<section class="ctrs-container">
    <div class="ctrs-wrapper ctrs-teams">
	<?php echo cca_ctrs_event_results($event_id); ?>
    </div>
</section>