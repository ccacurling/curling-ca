<?php
/**
 * Block Name: News Promo
 *
 * This is the template that displays the News Promo block.
 */

$promo_colour = get_field( 'background_colour' ); //Grey or White
$promo_post = get_field( 'promo_post' ); //Selected Post
$promo_thumbnail = get_the_post_thumbnail_url( $promo_post, 'large' );
$promo_date = $promo_post->post_date;

$date = date_create_from_format('Y-m-d H:i:s', $promo_date);
$date_string = $date->format('F j, Y');
?>

<section class="block-news-promo block-news-promo-<?php echo $promo_colour; ?>">
  <div class='featured-indicator'>
    <span class="featured-indicator-text">Featured News</span>
  </div>

  <div class="news-promo-container">
    <?php 
      if ($promo_thumbnail) {
    ?>
      <div class="news-promo-thumbnail-container">
        <img class="news-promo-thumbnail" src="<?php echo $promo_thumbnail; ?>" alt="" />
      </div>
    <?php
      }
    ?>
    <div class="news-promo-info">
      <h3 class="news-promo-title"><?php echo $promo_post->post_title; ?></h3>
      <h4 class="news-promo-date"><?php echo $date_string; ?></h4>
      <p class="news-promo-excerpt"><?php echo $promo_post->post_excerpt; ?></p>
      <a class="news-promo-link btn-link" href="<?php echo get_permalink($promo_post->ID); ?>">
				<h4 class="btn-link-text red">Continue Reading</h4>
				<img class="btn-link-arrow" src="<?php echo get_stylesheet_directory_uri()."/images/arrow-right-large-red.svg"; ?>" alt="arrow-right" />
      </a>
    </div>
  </div>
</section>