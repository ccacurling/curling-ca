<?php
/**
 * Block Name: Team - Small
 *
 * This is the template that displays the small Team block.
 */

$team_small_post = get_field( 'team_small_post' );
$team_small_cta = get_field( 'team_small_cta' );
$team_small_link = get_field( 'team_small_link' );

$team_small_thumbnail = get_the_post_thumbnail_url( $team_small_post, 'large' );
$team_small_title = get_the_title( $team_small_post );
$team_small_location_name = get_field( 'team_location_name', $team_small_post );
$team_small_team_city = get_field( 'team_city', $team_small_post );
$team_small_social_media = get_field( 'social_media_links', $team_small_post );
$team_small_members = get_field( 'team_members', $team_small_post );

?>

<section class="block-team-small">
  <div role="team" class="team-small-container">
    <?php
      if ($team_small_title) {
    ?>
      <div class="team-small-thumbnail-container">
        <img class="team-small-thumbnail" src="<?php echo $team_small_thumbnail; ?>" alt="<?php echo __("Team Thumbnail"); ?>" />
      </div>
    <?php
      }
    ?>
    <div class="team-small-info">
      <?php
        if ($team_small_title) {
      ?>
        <h2 class="team-small-title"><?php echo $team_small_title; ?></h2>
      <?php
        }
      ?>
      <?php
        if ($team_small_location_name || $team_small_team_city) {
      ?>
        <p class="team-small-location">
          <?php echo $team_small_location_name ? $team_small_location_name : ''; ?><?php echo $team_small_location_name && $team_small_team_city ? ', ' : ''; ?><?php echo $team_small_team_city ? $team_small_team_city : ''; ?>
        </p>
      <?php
        }
      ?>
      <div class="team-small-members-container">
        <?php
          if ($team_small_members) {
            foreach ($team_small_members as $key => $team_member) {
        ?>
          <div class="team-small-member-item">
            <h4 class="team-small-member-position"><?php echo $team_member['team_member_position']; ?>:&nbsp;</h4>
            <p class="team-small-member-name"><?php echo $team_member['team_member_name']; ?></p>
          </div>
        <?php
            }
          }
        ?>
      </div>
      <?php
        if ($team_small_cta) {
      ?>
        <div class="team-small-link-container">
          <a class="clear" href="<?php echo $team_small_cta['url']; ?>" target="<?php echo $team_small_cta['target']; ?>">
            <div class="btn btn-small btn-red">
              <h3 class="inverted"><?php echo $team_small_cta['title']; ?></h3>
            </div>
          </a>
        </div>
      <?php
        }
      ?>
      <?php
        if ($team_small_link) {
      ?>
        <a class="team-small-link clear" href="<?php echo $team_small_link['url']; ?>" target="<?php echo $team_small_link['target']; ?>">
          <h4 class="btn-link-text red"><?php echo $team_small_link['title']; ?></h4>
          <img class="btn-link-arrow" src="<?php echo get_stylesheet_directory_uri() . "/images/arrow-right-large-red.svg"; ?>" alt="<?php echo __("arrow-right"); ?>">
        </a>
      <?php
        }
      ?>

      <?php
        if ($team_small_social_media) {
      ?>
        <div class="team-small-social">
          <?php
            if ($team_small_social_media['facebook']) {
          ?>
            <a href="<?php echo 'https://www.facebook.com/'.$team_small_social_media['facebook']; ?>" target="_blank"><img class="team-small-social-icon" src="<?php echo get_stylesheet_directory_uri()."/images/icon-facebook-gray.svg"; ?>" alt="<?php echo __("Facebook"); ?>" /></a>
          <?php
            }
          ?>
          <?php
            if ($team_small_social_media['twitter']) {
          ?>
            <a href="<?php echo 'https://twitter.com/'.$team_small_social_media['twitter']; ?>" target="_blank"><img class="team-small-social-icon" src="<?php echo get_stylesheet_directory_uri()."/images/icon-twitter-gray.svg"; ?>" alt="<?php echo __("Twitter"); ?>" /></a>
          <?php
            }
          ?>
          <?php
            if ($team_small_social_media['instagram']) {
          ?>
            <a href="<?php echo 'https://www.instagram.com/'.$team_small_social_media['instagram']; ?>" target="_blank"><img class="team-small-social-icon" src="<?php echo get_stylesheet_directory_uri()."/images/icon-instagram-gray.svg"; ?>" alt="<?php echo __("Instagram"); ?>" /></a>
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