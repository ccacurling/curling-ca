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
  $date_string = date_format($date, 'l, F j');

  $draws = get_field('schedule_draws', $draw_schedule);

?>

<section class="block-schedule js-schedule js-accordion">
  <div class="schedule-date-container js-accordion-trigger">
    <h3 class="schedule-date js-schedule-title"><?php echo $date_string; ?></h3>
    <img class="schedule-date-arrow" src="<?php echo get_stylesheet_directory_uri()."/images/triangle-down.svg"; ?>" alt="Triangle">
  </div>
  <div class="schedule-details js-accordion-content">
    <div class="schedule-info-container">
      <p><?php echo $draw_schedule_info; ?></p>
    </div>
    <div class="schedule-list-container">
      <?php
        foreach ($draws as $key => $draw) {
          $time = date_create_from_format('H:i:s', $draw['draw_time'] );
          $time_string = date_format($time, 'g:i A');
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
