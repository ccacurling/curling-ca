<?php
/**
 * Block Name: News Promo
 *
 * This is the template that displays the News Promo block.
 */

$promo_colour = get_field( 'background_colour' ); //Grey or White
$promo_post = get_field('promo_post'); //Selected Post

?>

<section class="block-news-promo block-news-promo-<?php echo $promo_colour; ?>">

  <div>
    <p class='featured-indicator'>Featured News</p>
  </div>

  <div>
    <?php echo get_the_post_thumbnail( $promo_post, 'thumbnail' ); ?>
  </div>
  <div>
    <h3><?php echo $promo_post->post_title; ?></h3>
    <p><?php echo $promo_post->post_date; ?></p>
    <p><?php echo $promo_post->post_excerpt; ?></p>
    <hr/>
    <a href='<?php echo get_permalink($promo_post->ID); ?>'><?php echo $promo_post->post_title; ?></a>
  </div>

</section>