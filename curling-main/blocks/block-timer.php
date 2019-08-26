
<?php
/**
 * Block Name: Hero
 *
 * This is the template that displays the hero block.
 * TODO: Need to edit date selection to account for timezones
 */

$start_date_value = get_field( 'start_date' );

$start_date = date_create_from_format('Y-m-d H:i:s', $start_date_value);
$current_date = new DateTime();

$start_date_unix = date_format($start_date, 'U');
$current_date_unix = date_format($current_date, 'U');

$start_date_string = $start_date->format('F j');
$end_date_string = $start_date->format('F j Y');

$totalseconds = ((int)$start_date_unix - (int)$current_date_unix);
$days = floor($totalseconds / (3600 * 24));
$hours = floor(($totalseconds - ($days * (3600 * 24))) / 3600);
$minutes = floor(($totalseconds - ($days * (3600 * 24)) - ($hours * 3600)) / 60);
$seconds = floor($totalseconds - ($days * (3600 * 24)) - ($hours * 3600) - ($minutes * 60));

?>
<div class="block-timer content-fixed" data-date="<?php echo $start_date_unix; ?>">
	<div class="block-timer-wrapper">
		<div class="block-timer-counter">
			<div class="block-timer-counter-container block-timer-days-container block-timer-border-right">
				<div class="block-timer-value">
					<h2 class="js-days"><?php echo $days; ?></h2>
				</div>
				<div class="block-timer-label">
					<h4>DAYS</h4>
				</div>
			</div>
			<div class="block-timer-counter-container block-timer-hours-container block-timer-border-right">
				<div class="block-timer-value">
					<h2 class="js-hours"><?php echo $hours; ?></h2>
				</div>
				<div class="block-timer-label">
					<h4>HOURS</h4>
				</div>
			</div>
			<div class="block-timer-counter-container block-timer-minutes-container block-timer-border-right">
				<div class="block-timer-value">
					<h2 class="js-minutes"><?php echo $minutes; ?></h2>
				</div>
				<div class="block-timer-label">
					<h4>MINUTES</h4>
				</div>
			</div>
			<div class="block-timer-counter-container block-timer-seconds-container">
				<div class="block-timer-value">
					<h2 class="js-seconds"><?php echo $seconds; ?></h2>
				</div>
				<div class="block-timer-label">
					<h4>SECONDS</h4>
				</div>
			</div>
		</div>
		<div class="block-timer-info-container">
			<div class="block-timer-info-top">
				<h3 class="block-timer-info-date inverted"><?php echo $start_date_string; ?> - <?php echo $end_date_string; ?></h3>
				<h3 class="block-timer-info-location inverted">ROGER'S ARENA AT THE BC PLACE STADIUM</h3>
			</div>
			<div class="block-timer-info-link-container">
				<h4 class="block-timer-info-link inverted">MORE DETAILS</h4>
				<img class="arrow-right-large" src="<?php echo get_stylesheet_directory_uri()."/images/arrow-right-large-white.svg"; ?>" alt="arrow-right" />
			</div>
		</div>
	</div>
</div>
