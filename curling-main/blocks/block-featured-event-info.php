
<?php
/**
 * Block Name: Featured Event Info
 *
 * This is the template that displays the Featured Event Info block.
 * TODO: Translate to french
 */

$site_url = get_field( 'event_microsite_url' );
$sites = get_sites();

$site = NULL;

foreach ($sites as $key => $value) {
  if (substr($value->path, 1, -1) == $site_url) {
    $site = $value;
    break;
  }
}

if ($site) {
  $id = $site->blog_id;
  switch_to_blog($id);
}
$start_date_value = get_field( 'event_date_start', 'Options' );
$end_date_value = get_field( 'event_date_end', 'Options' );
$timezone = get_field( 'event_timezone', 'Options' );
$name = get_field( 'event_name', 'Options' );
$location = get_field( 'event_location_title', 'Options' );
$timer_link = get_field( 'event_location_page_link', 'Options' );
$operated_by = get_field( 'event_operated_by', 'Options' );
$buy_tickets_link = get_field( 'event_buy_tickets_link', 'Options' );
$draw_schedule_link = get_field( 'event_draw_schedule_link', 'Options' );
$where_to_watch_link = get_field( 'event_where_to_watch_link', 'Options' );
$meet_the_teams_link = get_field( 'event_meet_the_teams_link', 'Options' );
$sponsors_posts = get_field( 'event_sponsors', 'Options' );

$event_page_link = get_home_url();

$sponsors = array_map(function($sponsor) {
  $sponsor_post = $sponsor['event_sponsor'];
  return [
    'image' => get_field( 'featured_image', $sponsor_post->ID )
  ];
}, $sponsors_posts);

restore_current_blog();

$start_date_value = $start_date_value ? $start_date_value.' '.$timezone : '2019-01-01 00:00:00 '.$timezone;
$end_date_value = $end_date_value ? $end_date_value.' '.$timezone : '2019-01-01 00:00:00 '.$timezone;

$start_date = date_create_from_format('Y-m-d H:i:s e', $start_date_value);
$end_date = date_create_from_format('Y-m-d H:i:s e', $end_date_value);
$current_date = new DateTime();

$start_date_unix = $start_date ? date_format($start_date, 'U') : 0;
$current_date_unix = date_format($current_date, 'U');

$start_date_string = $start_date ? $start_date->format('F j') : '';
$end_date_short_string = $end_date ? $end_date->format('F j') : '';
$end_date_string = $end_date ? $end_date->format('F j Y') : '';

$totalseconds = ((int)$start_date_unix - (int)$current_date_unix);
$totalseconds = $totalseconds < 0 ? 0 : $totalseconds;
$days = floor($totalseconds / (3600 * 24));
$hours = floor(($totalseconds - ($days * (3600 * 24))) / 3600);
$minutes = floor(($totalseconds - ($days * (3600 * 24)) - ($hours * 3600)) / 60);
$seconds = floor($totalseconds - ($days * (3600 * 24)) - ($hours * 3600) - ($minutes * 60));

?>
<div class="block-featured-event js-timer" data-date="<?php echo $start_date_unix; ?>">
  <div class="block-featured-event-wrapper block-featured-event-top-wrapper">
    <div class="block-featured-event-top-left-wrapper">
      <div class="">
        <p class="item-label">EXT EVENT</p>
      </div>
      <?php
        if ($name) {
      ?>
        <h2><?php echo $name; ?></h2>
      <?php
        }
      ?>
      <?php
        if ($operated_by) {
      ?>
        <p class="block-featured-event-operated-by">Operated by <?php echo $operated_by; ?></p>
      <?php
        }
      ?>
    </div>
    <div class="block-featured-event-top-right-wrapper">
      <?php
        if ($buy_tickets_link) {
      ?>
        <a href="<?php echo $buy_tickets_link; ?>" target="blank" class="btn btn-large btn-red">Buy Tickets</a>
      <?php
        }
      ?>
    </div>
  </div>
	<div class="block-featured-event-wrapper">
    <div class="block-featured-event-scores-mobile">
      <a class="clear block-featured-event-scores-link" href="" target="">
        <h3 class="inverted arrow-right-extralarge-white">See the latest scores</h3>
      </a>
    </div>
		<div class="block-featured-event-counter">
			<div class="block-featured-event-counter-container block-featured-event-days-container block-featured-event-border-right">
				<div class="block-featured-event-value">
					<h2 class="inverted js-days"><?php echo $days; ?></h2>
				</div>
				<div class="block-featured-event-label">
					<h4 class="inverted">DAYS</h4>
				</div>
			</div>
			<div class="block-featured-event-counter-container block-featured-event-hours-container block-featured-event-border-right">
				<div class="block-featured-event-value">
					<h2 class="inverted js-hours"><?php echo $hours; ?></h2>
				</div>
				<div class="block-featured-event-label">
					<h4 class="inverted">HOURS</h4>
				</div>
			</div>
			<div class="block-featured-event-counter-container block-featured-event-minutes-container block-featured-event-border-right">
				<div class="block-featured-event-value">
					<h2 class="inverted js-minutes"><?php echo $minutes; ?></h2>
				</div>
				<div class="block-featured-event-label">
					<h4 class="inverted">MINUTES</h4>
				</div>
			</div>
			<div class="block-featured-event-counter-container block-featured-event-seconds-container">
				<div class="block-featured-event-value">
					<h2 class="inverted js-seconds"><?php echo $seconds; ?></h2>
				</div>
				<div class="block-featured-event-label">
					<h4 class="inverted">SECONDS</h4>
				</div>
			</div>
		</div>
		<div class="block-featured-event-info-container">
			<div class="block-featured-event-info-top">
				<h3 class="block-featured-event-info-date inverted"><?php echo $start_date_string; ?><?php echo $start_date_string !== $end_date_short_string ? ' - '.$end_date_string : ''; ?></h3>
				<h4 class="block-featured-event-info-location cool-gray"><?php echo $location; ?></h4>
      </div>
      <?php
        if ($timer_link) {
      ?>
        <div class="block-featured-event-link-container">
          <a href="<?php echo $timer_link['url']; ?>" target="<?php echo $timer_link['target']; ?>">
            <h4 class="btn-link-text cool-gray arrow-right-large-cool-gray"><?php echo $timer_link['title']; ?></h4>
          </a>
        </div>
      <?php
        }
      ?>
    </div>
  </div>
  
  <div class="block-featured-event-wrapper block-featured-event-sponsor-wrapper">
    <?php
      if ($sponsors) {
        foreach ($sponsors as $key => $sponsor) {
          if ($sponsor['image']) {
    ?>
      <div class="block-featured-event-sponsor">
        <img src="<?php echo $sponsor['image']['url']; ?>" alt="sponsor" />
      </div>
<?php
      }
    }
  }
?>
</div>
<div class="block-featured-event-wrapper block-featured-event-links-wrapper">
  <?php
    if ($draw_schedule_link) {
  ?>
    <a class="block-featured-event-cta" href="<?php echo $draw_schedule_link; ?>" target="_blank">
      <h3 class="block-featured-event-cta-text">Draw Schedule</h3>
    </a>
  <?php
    }
  ?>
  <?php
    if ($draw_schedule_link) {
  ?>
    <a class="block-featured-event-cta" href="<?php echo $where_to_watch_link; ?>" target="_blank">
      <h3 class="block-featured-event-cta-text">Where to Watch</h3>
    </a>
  <?php
    }
  ?>
  <?php
    if ($draw_schedule_link) {
  ?>
    <a class="block-featured-event-cta" href="<?php echo $meet_the_teams_link; ?>" target="_blank">
      <h3 class="block-featured-event-cta-text">Meet the Team</h3>
    </a>
  <?php
    }
  ?>
  </div>
</div>
