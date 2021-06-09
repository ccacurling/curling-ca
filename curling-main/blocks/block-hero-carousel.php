<?php
/**
 * Block Name: Hero
 *
 * This is the template that displays the hero block.
 */
  $featured_posts = get_field( 'hero_carousel_featured_posts' );

if (!function_exists("get_image")){
  function get_image($hero_featured_post, $size = 'large') {
    if ($hero_featured_post) {
      $image = get_field( 'hero_image', $hero_featured_post->ID);
      if ($image) {
        return $image['url'];
      } else if (has_post_thumbnail( $hero_featured_post, $size )) {
        return get_the_post_thumbnail_url( $hero_featured_post, $size );
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
}
?>
<section class="block-hero-carousel js-hero-carousel" >
  <div class="master-slider ms-skin-default js-slider" data-delay="5">
    <?php 
      foreach ($featured_posts as $key => $post) {
        $type = $post['hero_carousel_item_type'];

        if ($type === 'post') {
          $featured_post = $post['hero_carousel_featured_post'];
          $featured_post_thumbnail = get_image( $featured_post, 'small' );
          $featured_post_hero = get_image( $featured_post, 'large' );
          $featured_post_title = get_the_title( $featured_post );
          $featured_post_url = get_permalink( $featured_post );

          if (!$featured_post_thumbnail) {
            $featured_post_thumbnail = get_stylesheet_directory_uri()."/images/img-blank.svg";
          }

          if (!$featured_post_hero) {
            $featured_post_hero = get_stylesheet_directory_uri()."/images/img-blank.svg";
          }
        } else if ($type === 'youtube_video') {
          $video_title = $post['hero_carousel_title'];
          $video_youtube_video_id = $post['hero_carousel_youtube_video_id'];
          $video_thumbnail = 'https://img.youtube.com/vi/'.$video_youtube_video_id.'/maxresdefault.jpg';
          $video_url = 'https://www.youtube.com/watch?v='.$video_youtube_video_id;
          $video_link = $post['hero_carousel_link'];
        } else {
          $video_title = $post['hero_carousel_title'];
          $video_video = $post['hero_carousel_video'];
          $video_thumbnail = $post['hero_carousel_video_thumbnail'];
          $video_link = $post['hero_carousel_link'];
        }
    ?>
      <div class="ms-slide" data-delay="7">
        <div class="hero-carousel-caption-container">
          <?php if ($type === 'post') { ?>
            <img class="hero-carousel-image" src="<?php echo $featured_post_thumbnail; ?>" data-src="<?php echo $featured_post_thumbnail; ?>" alt="<?php echo __("Hero Image"); ?>"/>     
            <h1 class="hero-carousel-caption inverted"><a class="clear" href="<?php echo $featured_post_url; ?>"><?php echo $featured_post_title; ?></a></h1>
          <?php } else if ($type === 'youtube_video') { ?>
            <div class="hero-carousel-image">
              <a href="<?php echo $video_url; ?>" data-lity>
                <img class="callout-thumbnail" src="<?php echo $video_thumbnail; ?>" alt="<?php echo __("Youtube Thumbnail"); ?>" />
                <img class="video-promo-img-play js-btn-play" src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-play-arrow.svg" alt="<?php echo __("Play"); ?>" />
              </a>
            </div>
            <a class="clear" href="<?php echo $video_link; ?>"><h1 class="hero-carousel-caption inverted"><?php echo $video_title; ?></h1></a>
          <?php } else { ?>
            <div class="hero-carousel-image">
              <a href="<?php echo $video_video['url']; ?>" data-lity>
                <img class="callout-thumbnail" src="<?php echo $video_thumbnail['url']; ?>" alt="<?php echo __("Youtube Thumbnail"); ?>" />
                <img class="video-promo-img-play js-btn-play" src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-play-arrow.svg" alt="<?php echo __("Play"); ?>" />
              </a>
            </div>
            <a class="clear" href="<?php echo $video_link; ?>"><h1 class="hero-carousel-caption inverted"><?php echo $video_title; ?></h1></a>
          <?php } ?>
        </div>
        <div class="hero-carousel-thumbnail ms-thumb">
          <?php if ($type === 'post') { ?>
              <div class="hero-carousel-thumbnail-top">
                <img class="hero-carousel-thumbnail-image" src="<?php echo $featured_post_thumbnail; ?>" alt="<?php echo __("Thumbnail"); ?>"/>
                <div class="hero-carousel-thumbnail-content">
                  <h3 class="hero-carousel-thumbnail-text"><?php echo $featured_post_title; ?></h3>
                </div>
              </div>
          <?php } else if ($type === 'youtube_video') { ?>
              <div class="hero-carousel-thumbnail-top">
                <img class="hero-carousel-thumbnail-image" src="<?php echo $video_thumbnail; ?>" alt="<?php echo __("Thumbnail"); ?>"/>
                <div class="hero-carousel-thumbnail-content">
                  <h3 class="hero-carousel-thumbnail-text"><?php echo $video_title; ?></h3>
                </div>
              </div>
          <?php } else { ?>
              <div class="hero-carousel-thumbnail-top">
                <img class="hero-carousel-thumbnail-image" src="<?php echo $video_thumbnail['url']; ?>" alt="<?php echo __("Thumbnail"); ?>"/>
                <div class="hero-carousel-thumbnail-content">
                  <h3 class="hero-carousel-thumbnail-text"><?php echo $video_title; ?></h3>
                </div>
              </div>
          <?php } ?>
          <div class="hero-carousel-thumbnail-timer">
            <div class="hero-carousel-thumbnail-timer-progress js-hero-carousel-thumbnail-timer-progress"></div>
          </div>
        </div>
      </div>
    <?php
      }
    ?>
  </div>
</section>
