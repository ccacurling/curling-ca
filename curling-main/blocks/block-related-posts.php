<?php
/**
 * Block Name: Related Posts
 *
 * This is the template that displays related posts.
 */

$is_automatic = get_field( 'related_posts_is_automatic' );
$related_posts_categories = get_field( 'related_posts_categories' );
$related_posts_posts = get_field( 'related_posts_posts' );

$posts = $is_automatic ? get_recent_posts($related_posts_categories) : ['', ''];

$post1 = $is_automatic ? $posts[0] : $related_posts_posts[0]['related_posts_post'];
$post1_cta = $is_automatic ? 'View More' : $related_posts_posts[0]['related_posts_cta_label'];
$post2 = $is_automatic ? $posts[1] : $related_posts_posts[1]['related_posts_post'];
$post2_cta = $is_automatic ? 'View More' : $related_posts_posts[1]['related_posts_cta_label'];

$callout_image1 = !$post1 ? '' : get_the_post_thumbnail_url($post1, 'large' );
$callout_title1 = !$post1 ? '' : $post1->post_title;
$callout_body_text1 = !$post1 ? '' : $post1->post_excerpt;
$callout_link1 = !$post1 ? '' : get_permalink($post1->ID);

$callout_image2 = !$post2 ? '' : get_the_post_thumbnail_url($post2, 'large' );
$callout_title2 = !$post2 ? '' : $post2->post_title;
$callout_body_text2 = !$post2 ? '' : $post2->post_excerpt;
$callout_link2 = !$post2 ? '' : get_permalink($post2->ID);

function get_recent_posts($related_posts_categories) {

  $category = '';
  if ($related_posts_categories) {
    foreach ($related_posts_categories as $key => $category_term) {
      if ($category_term) {
        if ($category) {
          $category = $category.','.$category_term->slug;
        } else {
          $category = $category.$category_term->slug;
        }
      }
    }

    $args = [
      'category_name' => $category,
      'posts_per_page' => 2,
      'orderby' => 'date',
      'order'   => 'DESC',
      'post_status' => 'publish'
    ];

    $query = new WP_Query($args);

    return $query->posts;
  }
}

?>

<section class="block-related-posts content-full-wrapper">
  <section class="block-callout block-related-callout">
    <div class="callout-wrapper">
      <div class="callout-thumbnail-container">
        <?php 
          if ($callout_image1) {
        ?>
          <img class="callout-thumbnail" src="<?php echo $callout_image1; ?>" alt="Related" />
        <?php
          }
        ?>
      </div>
      <div class="callout-info">
        <?php
          if ($callout_title1) {
        ?>
          <h4 class="callout-title"><?php echo $callout_title1; ?></h4>
        <?php
          }
        ?>
        <?php
          if ($callout_body_text1) {
        ?>
          <p class="callout-excerpt"><?php echo $callout_body_text1; ?></p>
        <?php
          }
        ?>
        <?php
          if ($callout_link1) {
        ?>
          <a class="callout-link btn-link" href="<?php echo $callout_link1; ?>" target="blank">
            <h3 class="btn-link-text red"><?php echo $post1_cta; ?></h3>
            <img class="btn-link-arrow" src="<?php echo get_stylesheet_directory_uri()."/images/arrow-right-large-red.svg"; ?>" alt="arrow-right" />
          </a>
        <?php
          }
        ?>
      </div>
    </div>
  </section>

  <section class="block-callout block-related-callout">
    <div class="callout-wrapper">
      <div class="callout-thumbnail-container">
        <?php 
          if ($callout_image2) {
        ?>
          <img class="callout-thumbnail" src="<?php echo $callout_image2; ?>" alt="Related" />
        <?php
          }
        ?>
      </div>
      <div class="callout-info">
        <?php
          if ($callout_title2) {
        ?>
          <h4 class="callout-title"><?php echo $callout_title2; ?></h4>
        <?php
          }
        ?>
        <?php
          if ($callout_body_text2) {
        ?>
          <p class="callout-excerpt"><?php echo $callout_body_text2; ?></p>
        <?php
          }
        ?>
        <?php
          if ($callout_link2) {
        ?>
          <a class="callout-link btn-link" href="<?php echo $callout_link2; ?>" target="blank">
            <h3 class="btn-link-text red"><?php echo $post2_cta; ?></h3>
            <img class="btn-link-arrow" src="<?php echo get_stylesheet_directory_uri()."/images/arrow-right-large-red.svg"; ?>" alt="arrow-right" />
          </a>
        <?php
          }
        ?>
      </div>
    </div>
  </section>
</section>
