<?php
/**
 * Block Name: Event Location
 *
 * This is the template that displays the event location block.
 */

  $event_location_title = strtoupper( get_field( 'event_location_title', 'option' ) );
  $event_date_start = get_field( 'event_date_start', 'option' );
  $event_date_end = get_field( 'event_date_end', 'option' );
  $event_map_id = get_field( 'event_map_id', 'option' );

  $start_date = date_create_from_format('Y-m-d H:i:s', $event_date_start);
  $end_date = date_create_from_format('Y-m-d H:i:s', $event_date_end);

  $start_date_string = strtoupper($start_date->format('M. j'));
  $end_date_string = strtoupper($end_date->format('M. j, Y'));

  $event_cta_one = get_field( 'event_cta_one' );
  $event_cta_two = get_field( 'event_cta_two' );
  $event_cta_three = get_field( 'event_cta_three' );
  $event_cta_four = get_field( 'event_cta_four' );

  $id = 'event-location' . $block['id'];
  $shortcode = '[wpgmza id="' . $event_map_id . '"]';
?>

<section id="<?php echo $id ?>" class="event-location-container">
  <div role="info" class="info-section">
    <div class="info-section-container">
      <h2 class="event-location-label"><?php echo __("LOCATION"); ?></h2>
      <p class="event-location"><?php echo $event_location_title ?></p>
      <h3 class="event-date-label"><?php echo __("DATE"); ?></h3>
      <p class="event-date"><?php echo $start_date_string ?> - <?php echo $end_date_string ?></p>
      <hr />
      <div class="event-links">
        <div>
          <?php if ($event_cta_one) { ?>
            <a class="event-location-link btn-link" href="<?php echo $event_cta_one['url']; ?>" target="<?php echo $event_cta_one['target']; ?>">
              <h4 class="btn-link-text red"><?php echo $event_cta_one['title']; ?></h4>
              <img class="btn-link-arrow" src="<?php echo get_stylesheet_directory_uri() . "/images/arrow-right-large-red.svg"; ?>" alt="<?php echo __("red-arrow"); ?>" />
            </a>
          <?php } ?>
          <?php if ($event_cta_three) { ?>
            <a class="event-location-link btn-link" href="<?php echo $event_cta_three['url']; ?>" target="<?php echo $event_cta_three['target']; ?>">
              <h4 class="btn-link-text red"><?php echo $event_cta_three['title']; ?></h4>
              <img class="btn-link-arrow" src="<?php echo get_stylesheet_directory_uri() . "/images/arrow-right-large-red.svg"; ?>" alt="<?php echo __("red-arrow"); ?>" />
            </a>
          <?php } ?>
        </div>
        <div>
          <?php if ($event_cta_two) { ?>
            <a class="event-location-link btn-link" href="<?php echo $event_cta_two['url']; ?>" target="<?php echo $event_cta_two['target']; ?>">
              <h4 class="btn-link-text red"><?php echo $event_cta_two['title']; ?></h4>
              <img class="btn-link-arrow" src="<?php echo get_stylesheet_directory_uri() . "/images/arrow-right-large-red.svg"; ?>" alt="<?php echo __("red-arrow"); ?>" />
            </a>
          <?php } ?>
          <?php if ($event_cta_four) { ?>
            <a class="event-location-link btn-link" href="<?php echo $event_cta_four['url']; ?>" target="<?php echo $event_cta_four['target']; ?>">
              <h4 class="btn-link-text red"><?php echo $event_cta_four['title']; ?></h4>
              <img class="btn-link-arrow" src="<?php echo get_stylesheet_directory_uri() . "/images/arrow-right-large-red.svg"; ?>" alt="<?php echo __("red-arrow"); ?>" />
            </a>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
  <div role="map" class="map-section">
    <?php
      if ($event_map_id && !is_admin()) {
        echo do_shortcode( $shortcode );
      } else if (is_admin() && $event_map_id) {
        echo __("*Map does not appear in editor*");
      }
    ?>
  </div>
</section>