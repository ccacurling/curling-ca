<?php
/**
 * Block Name: Featured Team
 *
 * This is the template that displays a featured team block.
 */

$featured_team = get_field( 'featured_team' );
$featured_team_thumbnail = get_the_post_thumbnail_url( $featured_team, 'large' );
$featured_team_members = get_field( 'team_members', $featured_team );
$featured_team_link = get_field( 'featured_team_link' );

?>

<section class="block-featured-team">
  <div role="featured-team" class="featured-team-container">
    <?php 
      if ($featured_team_thumbnail) {
    ?>
      <div class="featured-team-thumbnail-container">
        <img class="featured-team-thumbnail" src="<?php echo $featured_team_thumbnail; ?>" alt="<?php echo __("thumbnail"); ?>" />
      </div>
    <?php
      }
    ?>
    <div role="info" class="featured-team-info">
      <div class="featured-team-info-container">
        <?php
          if ($featured_team) {
        ?>
          <h2 class="featured-team-title"><?php echo $featured_team->post_title; ?></h2>
        <?php
          }
        ?>
        <div class="featured-team-members-container">
        <?php
          if ($featured_team_members) {
            foreach ($featured_team_members as $key => $team_member) {
        ?>
          <div class="team-member-item">
            <h4 class="team-member-position"><?php echo $team_member['team_member_position']; ?>:&nbsp;</h4>
            <p class="team-member-name"><?php echo $team_member['team_member_name']; ?></p>
          </div>
        <?php
            }
          }
        ?>
        </div>

        <?php
          if ($featured_team) {
        ?>
          <a class="featured-team-link btn-link" href="<?php echo get_permalink($featured_team->ID); ?>">
            <h4 class="btn-link-text red"><?php echo __("Meet the team"); ?></h4>
            <img class="btn-link-arrow" src="<?php echo get_stylesheet_directory_uri()."/images/arrow-right-large-red.svg"; ?>" alt="<?php echo __("arrow-right"); ?>" />
          </a>
        <?php
          }
        ?>
      </div>
      <?php
        if ($featured_team_link) {
      ?>
        <a class="feature-team-btn btn btn-red btn-large" href="<?php echo $featured_team_link['url']; ?>" target="<?php echo $featured_team_link['target']; ?>"><?php echo $featured_team_link['title']; ?></a>
      <?php
        }
      ?>
    </div>
  </div>
</section>