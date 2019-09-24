<?php
/**
 * Block Name: Hero
 *
 * This is the template that displays the hero block.
 */

$hero_featured_post = get_field('hero_featured_post');

$is_event = get_field('is_event', 'Options');
$image = get_image($hero_featured_post);

$is_embeded_video = $hero_featured_post ? false : get_field( 'hero_use_embedded_video' );
$external_video = $hero_featured_post ? null : get_field( 'hero_external_video_link' );

$hero_size = $hero_featured_post ? 'large' : get_field( 'hero_size' );
$headline = $hero_featured_post ? get_the_title($hero_featured_post) : get_field( 'hero_headline' );
$text_position = $hero_featured_post ? 'centre' : (get_field( 'hero_text_position' ) ? get_field( 'hero_text_position' ) : 'left');
$has_timer = get_field( 'has_timer' );
$show_post_type = $hero_featured_post ? true : get_field( 'hero_show_post_type' );
$show_date = $hero_featured_post ? true : get_field( 'hero_show_date' );
$date = $hero_featured_post ? get_the_date('M j, Y', $hero_featured_post) : get_the_date('M j, Y');
$body = $hero_featured_post ? get_the_excerpt($hero_featured_post) : get_field( 'hero_body' );
$caption = $hero_featured_post ? get_field( 'featured_image_caption', $hero_featured_post ) : get_field( 'hero_caption' );
$link = $hero_featured_post ? [ 'url' => get_post_permalink($hero_featured_post), 'target' => '_self', 'title' => 'Continue Reading' ] : get_field( 'hero_link' );

$post_type = $hero_featured_post ? get_post_type( $hero_featured_post->ID ) : get_post_type( get_the_ID() );

$hero_class = '';

function get_image($hero_featured_post) {
  if ($hero_featured_post) {
    $image = get_field( 'hero_image', $hero_featured_post->ID);
    if ($image) {
      return $image['url'];
    } else if (has_post_thumbnail( $hero_featured_post, 'large' )) {
      return get_the_post_thumbnail_url( $hero_featured_post, 'large' );
    } else {
      $image = get_field( 'hero_image' );
      if ($image) {
        return $image['url'];
      }
    }
  }
  $image = get_field( 'hero_image' );
  if ($image) {
    return $image['url'];
  } else {
    return null;
  }
}

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

<section class="block-hero <?php echo $hero_class; ?> <?php echo $is_event ? '' : 'block-hero-main'; ?> js-hero-container">
  <div class="hero-media-container">
  <?php
      if ($external_video) {
    ?>
      <div class="hero-background-video-container js-video-player">
        <?php
          if ($external_video) {
        ?>
          <a class="hero-background-video" href="<?php echo $external_video; ?>" data-lity>
            <img class="hero-background-image" src="<?php echo $image; ?>" alt="Background" />
          </a>
          <img class="hero-background-play-image js-btn-play" src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-play-arrow.svg" alt="Play" />
        <?php
          }
        ?>
      </div>
    <?php
      } else if ($image) {
    ?>
      <img class="hero-background-image" src="<?php echo $image; ?>" alt="Background" />
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
    if (!$image && is_admin()) {
  ?>
    <div class="block-admin-error block-hero-no-image-container">
      <h3 class="block-hero-no-image-message">Add hero image</h3>
    </div>
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
      <?php
        if ($show_date) {
      ?>
        <div class="hero-date-container">
          <h4 class="hero-date"><?php echo $date; ?></h4>
        </div>
      <?php
        }
      ?>
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
