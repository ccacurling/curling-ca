<?php
  /**
   * Block Name: Activity Schedule
   *
   * This is the template that displays an activities schedule
   */

   $activity_post = get_field('activity_post');
   $post_id = $activity_post->ID;
   $activity_title = $activity_post->post_title;
   $activity_description = get_field('description', $post_id);
?>

<section class="activity-schedule-block">
  <h3><?php echo $activity_title; ?></h3>
  <p class="activity-description"><?php echo $activity_description; ?></p>
  <div class="schedule-table">
    <div class="table-title-row">
      <div><h3>DATE</h3></div>
      <div><h3>TIME</h3></div>
      <div><h3>PARTICIPANTS</h3></div>
    </div>
    <?php if ( have_rows( 'activity_details', $post_id) ) {
      while ( the_repeater_field( 'activity_details', $post_id ) ) {
        $date = get_sub_field( 'date' );
        $time = get_sub_field( 'time' );
        $participants = get_sub_field( 'participants' ); ?>

        <div class="activity-row">
          <div><?php echo $date ?></div>
          <div><?php echo $time ?></div>
          <!-- Fix participants, check if it should just be a text field -->
          <div><?php echo $participants[0]->post_title . " vs. " . $participants[1]->post_title; ?></div>
        </div>

      <?php } ?>
    <?php } ?>
  </div>
</section>
