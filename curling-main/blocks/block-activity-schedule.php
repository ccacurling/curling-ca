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
  <div role="activities" class="content-container">
  <?php if (!empty($activity_title)): ?>  
    <h3><?php echo $activity_title; ?></h3>
  <?php endif; ?>
    <p class="activity-description"><?php echo $activity_description; ?></p>
    <div role="schedule" class="schedule-table desktop-table">
      <div role="table-title" class="table-title-row">
        <div><h3><?php echo __("DATE"); ?></h3></div>
        <div><h3><?php echo __("TIME"); ?></h3></div>
        <div><h3><?php echo __("PARTICIPANTS"); ?></h3></div>
      </div>
      <?php if ( have_rows( 'activity_details', $post_id) ) {
        while ( the_repeater_field( 'activity_details', $post_id ) ) {
          $date = get_sub_field( 'date' );
          $time = get_sub_field( 'time' );
          $participants = get_sub_field( 'participants' ); ?>
  
          <div role="activitiy" class="activity-row">
            <div><p><?php echo $date ?></p></div>
            <div><p><?php echo $time ?></p></div>
            <!-- Fix participants, check if it should just be a text field -->
            <div><p><?php echo $participants[0]->post_title . " ".__("vs")." " . $participants[1]->post_title; ?></p></div>
          </div>
  
        <?php } ?>
      <?php } ?>
    </div>

    <!-- Mobile table, hidden until breakpoint 998px -->
    <div role="mobile-table" class="schedule-table mobile-table">
      <div class="table-title-row">
        <div><h3><?php echo __("DATE & TIME"); ?></h3></div>
        <div><h3><?php echo __("PARTICIPANTS"); ?></h3></div>
      </div>
      <?php if ( have_rows( 'activity_details', $post_id) ) {
        while ( the_repeater_field( 'activity_details', $post_id ) ) {
          $date = get_sub_field( 'date' );
          $time = get_sub_field( 'time' );
          $participants = get_sub_field( 'participants' ); ?>
  
          <div class="activity-row">
            <div><p><?php echo $date . " " . $time ?></p></div>
            <!-- Fix participants, check if it should just be a text field -->
            <div><p><?php echo $participants[0]->post_title . " vs. " . $participants[1]->post_title; ?></p></div>
          </div>
  
        <?php } ?>
      <?php } ?>
    </div>
  </div>
</section>
