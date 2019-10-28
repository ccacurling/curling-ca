<?php
/**
 * Block CTRS Events Results
 */

//$year = get_field('year');
$event_id = get_field('event_id');

function cca_ctrs_event_results ($eid) {
	$eventid = $eid; //$_POST["eventid"];
	$addLanguageUrl = "";
	$language = $_GET['lang'];

	if ($language=="fr") {
	  $addLanguageUrl = "?lang=fr";
	}

	$view = $_POST["view"];
	if ($eventid == "") {
		$eventid = "4322";
	}
	$xmlfile = "http://ctrs.curling.ca/event" . $eventid . ".xml";

		$sxe = simplexml_load_file($xmlfile);

		$eventid = $sxe->eventid;
		$eventname = $sxe->eventname;
		$eventyear = $eventyear;
		$startdate = $sxe->startdate;
		$enddate = $sxe->enddate;
		$eventcity = $sxe->city;
		$eventid_pair = $event->eventid_pair;
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
		
		$main .= "<h3>Event Results: " . $sxe->eventname . "</h3>
			<p>
			<table width='630' border='0' cellpadding='0' cellspacing='0'>
			<tr>";
	if ($language=="fr") {
		$main .= "<td width='150'><b>Hôte :</b></td>";
	} else {
		$main .= "<td width='150'><b>Host Curling Club:</b></td>";
	}
		$main .= "<td width='330'>$clubname</td>
			<td width='150' rowspan=10 align=center valign=top>SFM: ";
			if ($sxe->strength_of_field == '-1.00'):
				$main .= "<b>FIXED</b>";
			elseif ($sxe->strength_of_field == '0'):	
				$main .= "Not Set";
			else:
				$main .= $sxe->strength_of_field;	
			endif;
		if ($sxe->strength_of_field > 0):
		
			$main .= "<form name=viewDetail action=?$addLanguageUrl method=post>
				<input type=submit name=submit value=SFM>
				<input name=eventid type=hidden value=" . $sxe->eventid . ">
				<input name=view type=hidden value=sfm></form>
				<p><form name=viewDetail action=?$addLanguageUrl method=post>
				<input type=submit name=submit value=Results>
				<input name=eventid type=hidden value=" . $sxe->eventid . "></form>";

		endif;
		
		$main .= "</td>
			</tr>
			
			<tr>";
	if ($language=="fr") {
		$main .= "<td width='150'><b>Ville, Province :</b></td>";
	} else {
		$main .= "<td width='150'><b>City/Province:</b></td>";
	}
		$main .= "<td width='330'>" . $sxe->city . ", " . $sxe->prefix . "</td>
			</tr>

			<tr>
			<td width='150'><b>Dates:</b></td>
			<td width='330'>$eventdate</td>
			</tr>

			<tr>";
	if ($language=="fr") {
		$main .= "<td width='150'><b>Site web :</b></td>";
	} else {
		$main .= "<td width='150'><b>Website URL:</b></td>";
	}
		$main .= "<td width='330'><a href='" . $sxe->website . "' target='_blank'>" . $sxe->website . "</a></td>
			</tr>";

		if ($view == "sfm"):

			$main .= "<tr>";
	if ($language=="fr") {
		$main .= "<td colspan='3'><b>SFM pour l'événement</b></td>";
	} else {
		$main .= "<td colspan='3'><b>Strength of Field for Event</b></td>";
	}
		$main .= "</tr>
			<tr>
			<td colspan='3'>";
			
		
			$xmlfile = "http://ctrs.curling.ca/sfm_event" . $eventid . ".xml";
				$sfm = simplexml_load_file($xmlfile);
		
				$main .= "<table bgcolor='#999999' cellspacing='1' cellpadding='2' width='630' border='0'>
					<tr bgcolor='#DADADA'>
					<td width='430' colspan=2><b>Team Name</b></td>
					<td width='100' align='right'><b>SFM Value</b></td>
					<td width='100' align='right'><b>OOM Points</b></td>
				</tr>";
			
				$event_totalpoints = 0;
				
				foreach ($sfm->team as $team) {
		
					if ($bgcolor == "#FFFFFF"):
						$bgcolor = "#EEEEEE";
					else:
						$bgcolor = "#FFFFFF";
					endif;
					
					$event_totalpoints = $event_totalpoints + number_format((double)$team->sfmvalue, 3);
					
					$main .= "<tr bgcolor='$bgcolor'>
						<td align='right' width='40'>" . $team->ranking . ".&nbsp;</td>
						<td width='400'>" . $team->lastname . ", " . $team->firstname . "</td>
						<td align='right'>" . $team->sfmvalue . "</td>
						<td align='right'>" . $team->oompoints . "</td>
					</tr>";
				}
				
			
			
			$main .= "<tr>
				<td style='border-top:solid 1px #999999;' colspan='3' align='right'><b>" . number_format((double)$event_totalpoints,3) . "</b></td>
				<td></td>
			</tr>
			</table>";
		else:
			$main .= "<tr>";
	if ($language=="fr") {
		$main .= "<td colspan='3'><b>Résultats de l'événement</b></td>";
	} else {
		$main .= "<td colspan='3'><b>Results From Event</b></td>";
	}
		$main .= "</tr>
				<tr>
				<td colspan='3'>";

			$xmlfile = "http://ctrs.curling.ca/ctrs_event" . $eventid . "points.xml";
			
				$sle = simplexml_load_file($xmlfile);
		
				$main .= "<table bgcolor='#999999' cellspacing='1' cellpadding='2' width='630' border='0'>
					<tr bgcolor='#DADADA'>";
	if ($language=="fr") {
		$main .= "			<td width='480'><b>Équipe</b></td>
						<td width='75' align='center'><b>Classement</b></td>
						<td width='75' align='right'><b>Points</b></td>";
	} else {
		$main .= "			<td width='480'><b>Team Name</b></td>
						<td width='75' align='center'><b>Standing</b></td>
						<td width='75' align='right'><b>Points Won</b></td>";
	}
		$main .= "</tr>";
				
				$event_totalpoints = 0;
				
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
					
					$main .= "<form name=viewDetail action=../ctrs-team-results/$addLanguageUrl method=post>
					<tr bgcolor='$bgcolor'>
						<td><input type=submit name=submit value=Details> " . $team->skiplastname . ", " . $team->skipfirstname . "</td>
						<td align='center'>$teamstanding</td>
						<td align='right'>" . $team->pointtotal . "</td>
					</tr>
					<input name=teamid type=hidden value=" . $team->teamid . "></form>";
				}
					
				$main .= "<tr>
						<td style='border-top:solid 1px #999999;' colspan='3' align='right'><b>" . number_format((double)$event_totalpoints,3) . "</b></td>
					</tr>
					</table>";
		
		endif;
	$main .= "</td></tr></table>";
	return $main;
}
?>
<section class="ctrs-container">
    <div class="ctrs-wrapper ctrs-standings">
<?php echo cca_ctrs_event_results($event_id); ?>
    </div>
</section>