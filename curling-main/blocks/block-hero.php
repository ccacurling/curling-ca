<?php
/**
 * Block Name: Hero
 *
 * This is the template that displays the hero block.
 */

$image = get_field( 'hero_image' );
$is_embeded_video = get_field( 'hero_use_embedded_video' );
$video = get_field( 'hero_video' );
$external_video = get_field( 'hero_external_video_link' );
$is_video_inline = get_field( 'hero_show_video_inline' );
$hero_size = get_field( 'hero_size' );
$headline = get_field( 'hero_headline' );
$text_position = get_field( 'hero_text_position' ) ? get_field( 'hero_text_position' ) : 'left';
$has_timer = get_field( 'has_timer' );
$show_post_type = get_field( 'hero_show_post_type' );
$show_date = get_field( 'hero_show_date' );
$body = get_field( 'hero_body' );
$caption = get_field( 'hero_caption' );
$link = get_field( 'hero_link' );

$post_type = get_post_type( get_the_ID() );

$hero_class = '';

if ($image) {
  switch ($hero_size) {
    case 'small':
      $hero_class = 'block-hero-small';
      break;
    case 'medium':
      $hero_class = 'block-hero-medium';
      break;
    case 'large':
      $hero_class = 'block-hero-large';
      break;
  }
}
?>

<section class="block-hero <?php echo $hero_class; ?> js-hero-container content-fixed">
  <div class="hero-media-container">
  <?php
      if ((!$is_embeded_video && $video) || ($is_embeded_video && $external_video)) {
    ?>
      <div class="hero-background-video-container js-video-player">
        <?php
          if (!$is_embeded_video && $is_video_inline) {
        ?>
          <video class="hero-background-video js-video" width="100%" height="100%" poster="<?php echo $image['url']; ?>" muted loop>
            <source src="<?php echo $video['url']; ?>" type="<?php echo $video['mime_type']; ?>">
          </video>
          <div class="hero-background-overlay js-video-overlay hidden"></div>
          <img class="hero-background-play-image js-btn-play" src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-play-arrow.svg" alt="Play" />
        <?php
          } else  {
        ?>
          <a class="hero-background-video" href="<?php echo ($is_embeded_video) ? $external_video : $video['url']; ?>" data-lity>
            <img class="hero-background-image" src="<?php echo $image['url']; ?>" alt="Background" />
          </a>
          <img class="hero-background-play-image js-btn-play" src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-play-arrow.svg" alt="Play" />
        <?php
          }
        ?>
      </div>
    <?php
      } else {
    ?>
      <img class="hero-background-image" src="<?php echo $image['url']; ?>" alt="Background" />
    <?php
      }
    ?>

  <?php 
    if ($show_post_type) {
  ?>
    <div class="hero-post-type-container-mobile">
        <span class="hero-post-type"><?php echo $post_type; ?></span>
    </div>
  <?php
    }
  ?>
  <?php
    if ($caption) {
  ?>
    <div class="hero-caption-container-mobile">
      <div class="hero-caption-wrapper-mobile">
        <p class="hero-caption"><?php echo $caption; ?></p>
      </div>
    </div>
  <?php 
    }
  ?>

  </div>
  <?php
    if (!$image) {
  ?>
    <h2>
      Add Hero Image...
    </h2>
  <?php
    } else {
  ?>
    <div class="block-hero-inner <?php echo $text_position; ?> js-hero-content">
      <?php 
        if ($show_post_type) {
      ?>
        <div class="hero-post-type-container">
            <span class="hero-post-type"><?php echo $post_type; ?></span>
        </div>
      <?php
        }
      ?>
      <div class="hero-title-container <?php echo !$show_post_type ? 'hero-no-post-type' : ''; ?>">
        <?php 
          if ($text_position === 'centre') {
        ?>
          <h2 class="hero-title">
            <?php echo $headline; ?>
          </h2>
        <?php
          } else {
        ?>
          <h2 class="hero-title">
            <?php echo $headline; ?>
          </h2>
        <?php
          }
        ?>
      </div>
      <div class="hero-date-container">
        <h4 class="hero-date"><?php echo get_the_date('M j, Y'); ?></h4>
      </div>
      <div class="hero-body-container">
        <p class="hero-body"><?php echo $body ?></p>
      </div>
      <?php
        if ($link) {
      ?>
        <div class="hero-link-container">
          <a class="btn-secondary hero-link" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><?php echo $link['title'] ?></a>
        </div>
      <?php
        }
      ?>
    </div>
  <?php
    }
  ?>
  <?php
    if ($caption) {
  ?>
    <div class="hero-caption-container">
      <p class="hero-caption"><?php echo $caption; ?></p>
    </div>
  <?php 
    }
  ?>
</section>

<?php
  if ($has_timer) {
    include 'block-timer.php';
  }
?>
