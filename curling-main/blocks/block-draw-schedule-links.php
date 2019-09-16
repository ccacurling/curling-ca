<?php
/**
 * Block Name: Draw Schedule Links
 *
 * This is the template that displays the Draw Schedule Links block.
 */
?>

<?php
  $heading = get_field('draw_schedule_links_heading');

?>

<section class="block-schedule-links">
  <div class="schedule-links-heading-container">
    <h4><?php echo $heading; ?></h4>
  </div>
  <div class="schedule-links-container js-schedule-links">
  </div>
</section>
