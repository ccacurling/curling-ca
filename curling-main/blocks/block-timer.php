
<?php
/**
 * Block Name: Hero
 *
 * This is the template that displays the hero block.
 */

$start_date_value = get_field( 'event_date_start', 'Options' );
$end_date_value = get_field( 'event_date_end', 'Options' );
$timezone = get_field( 'event_timezone', 'Options' );
$location = get_field( 'event_location_title', 'Options' );
$timer_link = get_field( 'event_location_page_link', 'Options' );

$lang = apply_filters( 'wpml_current_language', NULL ); //Store current language

$start_date_value = $start_date_value ? $start_date_value.' '.$timezone : '2019-01-01 00:00:00 '.$timezone;
$end_date_value = $end_date_value ? $end_date_value.' '.$timezone : '2019-01-01 00:00:00 '.$timezone;

$start_date = date_create_from_format('Y-m-d H:i:s e', $start_date_value);
$end_date = date_create_from_format('Y-m-d H:i:s e', $end_date_value);
$current_date = new DateTime();

$start_date_unix = $start_date ? date_format($start_date, 'U') : 0;
$current_date_unix = date_format($current_date, 'U');

if ($lang == 'fr') {
	$start_date_string = $start_date ?  dateToFrench($start_date, 'j F') : '';
	$end_date_short_string = $end_date ? dateToFrench($end_date, 'j F') : '';
	$end_date_string = $end_date ? dateToFrench($end_date, 'j F Y') : '';
} else {
	$start_date_string = $start_date ? $start_date->format('F j') : '';
	$end_date_short_string = $end_date ? $end_date->format('F j') : '';
	$end_date_string = $end_date ? $end_date->format('F j Y') : '';
}


$totalseconds = ((int)$start_date_unix - (int)$current_date_unix);
$totalseconds = $totalseconds < 0 ? 0 : $totalseconds;
$days = floor($totalseconds / (3600 * 24));
$hours = floor(($totalseconds - ($days * (3600 * 24))) / 3600);
$minutes = floor(($totalseconds - ($days * (3600 * 24)) - ($hours * 3600)) / 60);
$seconds = floor($totalseconds - ($days * (3600 * 24)) - ($hours * 3600) - ($minutes * 60));

?>
<div class="block-timer js-timer" data-date="<?php echo $start_date_unix; ?>">
	<div class="block-timer-wrapper">
		<div class="block-timer-counter">
			<div class="block-timer-counter-container block-timer-days-container block-timer-border-right">
				<div class="block-timer-value">
					<h2 class="js-days"><?php echo $days; ?></h2>
				</div>
				<div class="block-timer-label">
					<h4><?php echo __("DAYS"); ?></h4>
				</div>
			</div>
			<div class="block-timer-counter-container block-timer-hours-container block-timer-border-right">
				<div class="block-timer-value">
					<h2 class="js-hours"><?php echo $hours; ?></h2>
				</div>
				<div class="block-timer-label">
					<h4><?php echo __("HOURS"); ?></h4>
				</div>
			</div>
			<div class="block-timer-counter-container block-timer-minutes-container block-timer-border-right">
				<div class="block-timer-value">
					<h2 class="js-minutes"><?php echo $minutes; ?></h2>
				</div>
				<div class="block-timer-label">
					<h4><?php echo __("MINUTES"); ?></h4>
				</div>
			</div>
			<div class="block-timer-counter-container block-timer-seconds-container">
				<div class="block-timer-value">
					<h2 class="js-seconds"><?php echo $seconds; ?></h2>
				</div>
				<div class="block-timer-label">
					<h4><?php echo __("SECONDS"); ?></h4>
				</div>
			</div>
		</div>
		<div class="block-timer-info-container">
			<div class="block-timer-info-top">
				<h3 class="block-timer-info-date inverted"><?php echo $start_date_string; ?><?php echo $start_date_string !== $end_date_short_string ? ' - '.$end_date_string : ''; ?></h3>
				<h3 class="block-timer-info-location inverted"><?php echo $location; ?></h3>
      </div>
      <?php
        if ($timer_link) {
      ?>
        <div class="block-timer-link-container">
          <a href="<?php echo $timer_link['url']; ?>" target="<?php echo $timer_link['target']; ?>">
          <h4 class="btn-link-text inverted"><?php echo $timer_link['title']; ?></h4>
            <img class="btn-link-arrow" src="<?php echo get_stylesheet_directory_uri()."/images/arrow-right-large-white.svg"; ?>" alt="<?php echo __("arrow-right"); ?>" />
          </a>
        </div>
      <?php
        }
      ?>
    </div>
	</div>
</div>
