<?php
/**
 * Block Name: Draw Schedule
 *
 * This is the template that displays the Draw Schedule block.
 */
?>

<?php
  $draw_schedule = get_field('draw_schedule');
  $draw_schedule_info = get_field('draw_schedule_info');

  $schedule_date = get_field('schedule_date', $draw_schedule);

  $date = date_create_from_format('Ymd', $schedule_date );
  
  echo "<pre class='debug' style='display:none;'>";
  print_r($date); 
  echo "</pre>";

  $current_lang = apply_filters( 'wpml_current_language', NULL );
  if ( $current_lang == "fr" ) {
    $date_string = dateToFrench($date, 'l j F');
  } else {
    $date_string = date_format($date, 'l, F j');
  }


  $draws = get_field('schedule_draws', $draw_schedule);
  $id = rand(10000000, 99999999);
?>

<section class="block-schedule js-schedule js-accordion" data-id="<?php echo $id; ?>">
  <div role="schedule-dates" class="schedule-date-container js-accordion-trigger" data-id="<?php echo $id; ?>">
    <h3 class="schedule-date js-schedule-title"><?php echo $date_string; ?></h3>
    <img class="schedule-date-arrow" src="<?php echo get_stylesheet_directory_uri()."/images/triangle-down.svg"; ?>" alt="<?php echo __("Triangle"); ?>">
  </div>
  <div role="details" class="schedule-details js-accordion-content" data-id="<?php echo $id; ?>">
    <div class="schedule-info-container">
      <?php
        if ($draw_schedule_info) {
      ?>
        <p class="schedule-info-text"><?php echo $draw_schedule_info; ?></p>
      <?php
        }
      ?>
    </div>
    <div class="schedule-list-container">
      <?php
        foreach ($draws as $key => $draw) {
          $time = date_create_from_format('H:i:s', $draw['draw_time'] );

          if ($current_lang == 'fr') {
            $time_string = date_format($time, 'G:i');
          } else {
            $time_string = date_format($time, 'g:i A');
          }
          
          $draw_link = $draw['draw_link'];
      ?>
          <div class="schedule-match-container">
            <div class="schedule-match-header schedule-match-row">
              <div class="schedule-match-name schedule-match-cell">
                <h4><?php echo $time_string; ?></h4>
              </div>
              <div class="schedule-match-info schedule-match-cell">
                <h4><?php echo $draw['draw_name']; ?></h4>
              </div>
            </div>
            <?php
              foreach ($draw['draw_matches'] as $key => $match) {
            ?>
              <div class="schedule-match-row">
                <div class="schedule-match-name schedule-match-cell">
                  <p><?php echo $match['match_name']; ?></p>
                </div>
                <div class="schedule-match-info schedule-match-cell">
                  <p><?php echo $match['match_info']; ?></p>
                </div>
              </div>
            <?php
              }
            ?>
            <?php
              if ($draw_link) {
            ?>
              <div class="schedule-match-link-container">
                <a class="clear" href="<?php echo $draw_link['url']; ?>" target="<?php echo $draw_link['target']; ?>">
                  <div class="btn btn-red">
                    <h3 class="inverted"><?php echo $draw_link['title']; ?></h3>
                  </div>
                </a>
              </div>
            <?php
              }
            ?>
          </div>

      <?php
        }
      ?>
    </div>
  </div>
</section>
