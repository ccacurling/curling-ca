<?php
/**
 * Block Name: Event Info
 *
 * This is the template that displays the event info block.
 */
?>

<?php
  $event_include_timer = get_field( 'event_include_timer' );
  $site_url = get_field( 'event_microsite_url' );
  $direction = get_field( 'event_direction' );

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
  $event_logo = get_field( 'event_logo', 'Options' );
  $event_page_link = get_home_url();

  restore_current_blog();

  $start_date_value = $start_date_value ? $start_date_value.' '.$timezone : '2019-01-01 00:00:00 '.$timezone;
  $end_date_value = $end_date_value ? $end_date_value.' '.$timezone : '2019-01-01 00:00:00 '.$timezone;

  $start_date = date_create_from_format('Y-m-d H:i:s e', $start_date_value);
  $end_date = date_create_from_format('Y-m-d H:i:s e', $end_date_value);
  $current_date = new DateTime();

  $start_date_unix = $start_date ? date_format($start_date, 'U') : 0;
  $end_date_unix = $end_date ? date_format($end_date, 'U') : 0;
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

  $is_live = $current_date_unix >= $start_date_unix && $current_date_unix <= $end_date_unix;
  // $is_live = true; // TODO: TEST
?>

<div class="block-event-info <?php echo $direction == 'left_to_right' ? 'block-event-info-row' : 'block-event-info-column'; ?> js-timer" data-date="<?php echo $start_date_unix; ?>">
  <?php
    if ($is_live) {
  ?>
    <div class="event-info-live-container">
      <h4 class="event-info-live-text inverted">Live now</h4>
    </div>
  <?php
    }
  ?>
  <div class="event-info-top-container">
    <?php
      if ($event_logo) {
    ?>
      <img class="event-info-top-image" src="<?php echo $event_logo['url']; ?>" alt="Event Logo" />
    <?php
      }
    ?>
  </div>

  <?php
    if ($event_include_timer) {
  ?>
    <div class="block-event-counter">
      <div class="block-event-counter-container block-event-days-container block-event-border-right">
        <div class="block-event-value">
          <h2 class="block-event-value-text inverted js-days"><?php echo $days; ?></h2>
        </div>
        <div class="block-event-label">
          <h4 class="inverted">DAYS</h4>
        </div>
      </div>
      <div class="block-event-counter-container block-event-hours-container block-event-border-right">
        <div class="block-event-value">
          <h2 class="block-event-value-text inverted js-hours"><?php echo $hours; ?></h2>
        </div>
        <div class="block-event-label">
          <h4 class="inverted">HOURS</h4>
        </div>
      </div>
      <div class="block-event-counter-container block-event-minutes-container block-event-border-right">
        <div class="block-event-value">
          <h2 class="block-event-value-text inverted js-minutes"><?php echo $minutes; ?></h2>
        </div>
        <div class="block-event-label">
          <h4 class="inverted">MINUTES</h4>
        </div>
      </div>
      <div class="block-event-counter-container block-event-seconds-container">
        <div class="block-event-value">
          <h2 class="block-event-value-text inverted js-seconds"><?php echo $seconds; ?></h2>
        </div>
        <div class="block-event-label">
          <h4 class="inverted">SECONDS</h4>
        </div>
      </div>
    </div>
  <?php
    }
  ?>

  <div class="block-event-info-details <?php echo $event_include_timer ? 'white' : 'gray'; ?>">
    <div class="block-event-info-detail-top-container">
      <?php
        if ($name) {
      ?>
        <h3 class="block-event-sponsor-header"><?php echo $name; ?></h3>
      <?php
        }
      ?>
      <?php
        if ($operated_by) {
      ?>
        <p class="block-event-sponsor-operated-by">Operated by <?php echo $operated_by; ?></p>
      <?php
        }
      ?>
      <?php
        if ($start_date_string) {
      ?>
        <h4 class="block-event-sponsor-date"><?php echo $start_date == $end_date ? ($end_date_string ? $end_date_string : $start_date_string) : ($end_date_string ? $start_date_string.'&nbsp;-&nbsp;'.$end_date_string : $start_date_string); ?></h4>
      <?php
        }
      ?>
      <?php
        if ($location) {
      ?>
        <h4 class="block-event-sponsor-location"><?php echo $location; ?></h4>
      <?php
        }
      ?>
    </div>
    <div class="event-info-bottom-container">
      <?php
        if ($buy_tickets_link) {
      ?>
        <a class="block-event-sponsor-tickets-btn btn btn-red" href="<?php echo $buy_tickets_link; ?>" target="blank"><?php echo $direction == 'left_to_right' ? 'Buy Tickets' : 'View Ticket Packages'; ?></a>
      <?php
        }
      ?>
      <div class="block-event-sponsor-links-container">
        <?php
          if ($event_page_link) {  
        ?>
          <a class="block-event-sponsor-link subdomain red arrow-right arrow-right-large-red" target="blank" href="<?php echo $event_page_link; ?>">More Information</a>
          <?php
          }
        ?>
        <?php
          if ($draw_schedule_link) {
        ?>
          <a class="block-event-sponsor-link subdomain red arrow-right arrow-right-large-red" target="blank" href="<?php echo $draw_schedule_link; ?>">Event Schedule</a>
        <?php
          }
        ?>
        <?php
          if ($meet_the_teams_link) {
        ?>
          <a class="block-event-sponsor-link subdomain red arrow-right arrow-right-large-red" target="blank" href="<?php echo $meet_the_teams_link; ?>">Meet the teams</a>
        <?php
          }
        ?>
      </div>
    </div>
  </div>
</div>