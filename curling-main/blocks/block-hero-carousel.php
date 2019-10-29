<?php
/**
 * Block Name: Hero
 *
 * This is the template that displays the hero block.
 */

  $featured_posts = get_field( 'hero_carousel_featured_posts' );

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
?>
<section class="block-hero-carousel js-hero-carousel">
  <div class="master-slider ms-skin-default js-slider" data-delay="5">
    <?php 
      foreach ($featured_posts as $key => $post) {
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
    ?>
      <div class="ms-slide">
        <div class="hero-carousel-caption-container">
          <img class="hero-carousel-image" src="<?php echo $featured_post_thumbnail; ?>" data-src="<?php echo $featured_post_thumbnail; ?>" alt="Hero Image"/>     
          <h1 class="hero-carousel-caption inverted"><?php echo $featured_post_title; ?></h1>
        </div>
        <div class="hero-carousel-thumbnail ms-thumb">
          <a class="hero-carousel-thumbnail-link clear" href="<?php echo $featured_post_url; ?>" target="_self">
            <div class="hero-carousel-thumbnail-top">
              <img class="hero-carousel-thumbnail-image" src="<?php echo $featured_post_thumbnail; ?>" alt="Thumbnail"/>
              <div class="hero-carousel-thumbnail-content">
                <h3 class="hero-carousel-thumbnail-text"><?php echo $featured_post_title; ?></h3>
              </div>
            </div>
          </a>
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
