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
  <div class="info-section">
    <h2 class="event-location-label">LOCATION</h2>
    <p class="event-location"><?php echo $event_location_title ?></p>
    <h3 class="event-date-label">DATE</h3>
    <p class="event-date"><?php echo $start_date_string ?> - <?php echo $end_date_string ?></p>
    <hr />
    <div class="event-links">
      <div>
        <?php if ($event_cta_one) { ?>
          <p>
            <a href="<?php echo $event_cta_one['url']; ?>" target="<?php echo $event_cta_one['target']; ?>">
              <?php echo strtoupper( $event_cta_one['title'] ); ?> <img src="<?php echo get_stylesheet_directory_uri() . "/images/arrow-right-large-red.svg"; ?>" alt="red-arrow" />
            </a>
          </p>
        <?php } ?>
        <?php if ($event_cta_three) { ?>
          <p>
            <a href="<?php echo $event_cta_three['url']; ?>" target="<?php echo $event_cta_three['target']; ?>">
              <?php echo strtoupper( $event_cta_three['title'] ); ?> <img src="<?php echo get_stylesheet_directory_uri() . "/images/arrow-right-large-red.svg"; ?>" alt="red-arrow" />
            </a>
          </p>
        <?php } ?>
      </div>
      <div>
        <?php if ($event_cta_two) { ?>
          <p>
            <a href="<?php echo $event_cta_two['url']; ?>" target="<?php echo $event_cta_two['target']; ?>">
              <?php echo strtoupper( $event_cta_two['title'] ); ?> <img src="<?php echo get_stylesheet_directory_uri() . "/images/arrow-right-large-red.svg"; ?>" alt="red-arrow" />
            </a>
          </p>
        <?php } ?>
        <?php if ($event_cta_four) { ?>
          <p>
            <a href="<?php echo $event_cta_four['url']; ?>" target="<?php echo $event_cta_four['target']; ?>">
              <?php echo strtoupper( $event_cta_four['title'] ); ?> <img src="<?php echo get_stylesheet_directory_uri() . "/images/arrow-right-large-red.svg"; ?>" alt="red-arrow" />
            </a>
          </p>
        <?php } ?>
      </div>
    </div>
  </div>
  <div class="map-section">
    <?php
      if ($event_map_id && !is_admin()) {
        echo do_shortcode( $shortcode );
      } else if (is_admin() && $event_map_id) {
        echo "*Map does not appear in editor*";
      }
    ?>
  </div>
</section>