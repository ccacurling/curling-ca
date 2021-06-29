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
  <div role="schedule-links" class="schedule-links-heading-container">
  <?php if (!empty($heading)): ?>  
    <h4><?php echo $heading; ?></h4>
  <?php endif; ?>
  </div>
  <div class="schedule-links-container js-schedule-links">
  </div>
</section>
