<?php
/**
 * Block Name: Event Info Slider
 *
 * This is the template that displays the event info slider block.
 */
?>
<?php
  $title = get_field( 'event_slider_title' );
  $events = get_field( 'event_slider_events' );
  $link = get_field( 'event_slider_link' );

  $sites = [];
  
  $sites = array_map(function($site) {
    $site_url = $site['event_microsite_url'];
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
    $current_date_unix = date_format($current_date, 'U');
    $end_date_unix = date_format($end_date, 'U');

    $start_date_string = $start_date ? $start_date->format('F j') : '';
    $end_date_short_string = $end_date ? $end_date->format('F j') : '';
    $end_date_string = $end_date ? $end_date->format('F j Y') : '';

    $date = $start_date == $end_date ? ($end_date_string ? $end_date_string : $start_date_string) : ($end_date_string ? $start_date_string.'&nbsp;-&nbsp;'.$end_date_string : $start_date_string);
    $is_live = $current_date_unix >= $start_date_unix && $current_date_unix <= $end_date_unix;

    return [
      'event_logo' => $event_logo,
      'name' => $name,
      'operated_by' => $operated_by,
      'start_date_string' => $start_date_string,
      'date' => $date,
      'location' => $location,
      'event_page_link' => $event_page_link,
      'draw_schedule_link' => $draw_schedule_link,
      'meet_the_teams_link' => $meet_the_teams_link,
      'buy_tickets_link' => $buy_tickets_link,
      'is_live' => $is_live
    ];
  }, $events);

  function create_item($site) {
?>
  <div class="block-event-slider-slide block-event-info block-event-info-row">
    <?php
      if ($site['is_live']) {
    ?>
      <div class="event-info-live-container">
        <h4 class="event-info-live-text inverted">Live now</h4>
      </div>
    <?php
      }
    ?>
    <div class="event-info-top-container">
      <?php
        if ($site['event_logo']) {
      ?>
        <img class="event-info-top-image" src="<?php echo $site['event_logo']['url']; ?>" alt="Event Logo" />
      <?php
        }
      ?>
    </div>

    <div class="block-event-info-details gray">
      <div class="block-event-info-detail-top-container">
        <?php
          if ($site['name']) {
        ?>
          <h3 class="block-event-sponsor-header"><?php echo $site['name']; ?></h3>
        <?php
          }
        ?>
        <?php
          if ($site['operated_by']) {
        ?>
          <p class="block-event-sponsor-operated-by">Operated by <?php echo $site['operated_by']; ?></p>
        <?php
          }
        ?>
        <?php
          if ($site['start_date_string']) {
        ?>
          <h4 class="block-event-sponsor-date"><?php echo $site['date']; ?></h4>
        <?php
          }
        ?>
        <?php
          if ($site['location']) {
        ?>
          <h4 class="block-event-sponsor-location"><?php echo $site['location']; ?></h4>
        <?php
          }
        ?>
      </div>
      <div class="event-info-bottom-container">
        <?php
          if ($site['buy_tickets_link']) {
        ?>
          <a class="block-event-sponsor-tickets-btn btn btn-red" href="<?php echo $site['buy_tickets_link']; ?>" target="blank">Find Tickets</a>
        <?php
          }
        ?>
        <div class="block-event-sponsor-links-container">
          <?php
            if ($site['event_page_link']) {  
          ?>
            <a class="block-event-sponsor-link subdomain red arrow-right-large-red" target="blank" href="<?php echo $site['event_page_link']; ?>">More Information</a>
            <?php
            }
          ?>
          <?php
            if ($site['draw_schedule_link']) {
          ?>
            <a class="block-event-sponsor-link subdomain red arrow-right-large-red" target="blank" href="<?php echo $site['draw_schedule_link']; ?>">Event Schedule</a>
          <?php
            }
          ?>
          <?php
            if ($site['meet_the_teams_link']) {
          ?>
            <a class="block-event-sponsor-link subdomain red arrow-right-large-red" target="blank" href="<?php echo $site['meet_the_teams_link']; ?>">Meet the teams</a>
          <?php
            }
          ?>
        </div>
      </div>
    </div>
  </div>
<?php
  }
?>
<section class="block-event-slider">
  <div class="event-slider-mobile">
    <div class="event-slider js-slick">
      <?php
        foreach ($sites as $key => $site) {
          create_item($site);
        }
      ?>
    </div>
  </div>
  <div class="event-slider-desktop">
    <div class="event-slider-header">
      <h3><?php echo $title; ?></h3>
      <a class="event-slider-link clear" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><h4 class="arrow-right-large-gray gray"><?php echo $link['title']; ?></h4></a>
    </div>
    <div class="event-slider-container">
      <?php
        $i = 0;
        foreach ($sites as $key => $site) {
          create_item($site);
          if (++$i >= 2) {
            break;
          }
        }
      ?>
    </div>
  </div>
</section>