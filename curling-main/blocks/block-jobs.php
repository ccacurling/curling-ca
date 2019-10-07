<?php
/**
 * Block Name: Jobs
 *
 * This is the template that displays the jobs info block.
 */
?>

<?php
  $jobs = get_posts([
    'post_type' => 'job'
  ]);
  $jobs_include_ad = get_field( 'jobs_include_ad' );
  $job_ad = get_field( 'jobs_ad_space' );
?>

<section class="block-jobs content content-full-wrapper">
  <div class="jobs-container">
    <?php
      if ($jobs_include_ad) {
    ?>
      <div class="jobs-ad">
        <div class="jobs-ad-container">
          <?php echo $job_ad; ?>
        </div>
      </div>
    <?php
      }
    ?>
    <?php
      foreach ($jobs as $key => $job) {
        $title = $job->post_title;
        $date = date( 'F j, Y', strtotime($job->post_date) );
        $location = get_field( 'job_location', $job );
        $link = get_field( 'job_link' , $job );
    ?>
      <div class="jobs-item">
        <div class="jobs-item-container">
          <h4 class="job-item-date"><?php echo $date; ?></h4>
          <h3 class="job-item-title"><?php echo $title; ?></h3>
          <h3 class="job-item-location"><?php echo $location; ?></h3>
          <?php
            if ($link) {
          ?>
            <div class="job-link-container">
              <a class="job-item-link btn-link arrow-right-item arrow-right-large-red" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><h4 class="btn-link-text red"><?php echo $link['title']; ?></h4></a>
            </div>
          <?php
            }
          ?>
        </div>
      </div>
    <?php
      }
    ?>
  </div>
</section>