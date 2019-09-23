<?php
/**
 * Block Name: News Promo
 *
 * This is the template that displays the News Promo block.
 */

$promo_colour = get_field( 'background_colour' ); //Grey or White
$promo_post = get_field( 'promo_post' ); //Selected Post
$promo_thumbnail = $promo_post ? get_the_post_thumbnail_url( $promo_post, 'large' ) : '';
$promo_date = $promo_post ? $promo_post->post_date : '';
$promo_image_caption = $promo_post ? get_field( 'featured_image_caption', $promo_post ) : '';
$promo_is_large = get_field( 'news_promo_is_large' );

$date = $promo_date ? date_create_from_format('Y-m-d H:i:s', $promo_date) : '';
$date_string = $date ? $date->format('F j, Y') : '';
?>

<?php
  if ($promo_post) {
?>
  <section class="block-news-promo block-news-promo-<?php echo $promo_colour; ?>">
    <div class="news-promo-container <?php echo $promo_is_large ? 'news-promo-large' : ''; ?>">
      <?php 
        if ($promo_thumbnail) {
      ?>
        <div class="news-promo-thumbnail-container">
          <img class="news-promo-thumbnail" src="<?php echo $promo_thumbnail; ?>" alt="" />
          <?php
            if ($promo_image_caption) {
          ?>
            <div class="news-promo-caption-container">
              <div class="news-promo-caption-wrapper">
                <p class="news-promo-caption"><?php echo $promo_image_caption; ?></p>
              </div>
            </div>
          <?php 
            }
          ?>
        </div>
      <?php
        }
      ?>
      <div class="news-promo-info">
        <?php
          if ($promo_is_large) {
        ?>
          <h2 class="news-promo-title"><?php echo $promo_post->post_title; ?></h2>
        <?php
          } else {
        ?>
          <h3 class="news-promo-title"><?php echo $promo_post->post_title; ?></h3>
        <?php
          }
        ?>
        <h4 class="news-promo-date"><?php echo $date_string; ?></h4>
        <p class="news-promo-excerpt"><?php echo $promo_post->post_excerpt; ?></p>
        <a class="news-promo-link btn-link" href="<?php echo get_permalink($promo_post->ID); ?>">
          <h4 class="btn-link-text red">Continue Reading</h4>
          <img class="btn-link-arrow" src="<?php echo get_stylesheet_directory_uri()."/images/arrow-right-large-red.svg"; ?>" alt="arrow-right" />
        </a>
      </div>
    </div>
  </section>
<?php
  }
?>
