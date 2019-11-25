<?php
/**
 * Block Name: News Feed
 *
 * This is the template that displays the News Feed block.
 */
?>

<?php
  $news_feed_category = get_field( 'news_feed_category' );
  $lang = apply_filters( 'wpml_current_language', NULL ); //Store current language

  $category = "";

  if ($news_feed_category) {
    foreach ($news_feed_category as $key => $category_id) {
      $category_term = get_category($category_id);
      if ($category_term) {
        if ($category) {
          $category = $category.','.$category_term->slug;
        } else {
          $category = $category.$category_term->slug;
        }
      }
    }
  }
?>

<section class="block-news-feed js-news-feed <?php echo is_admin() ? 'block-admin' : ''; ?>" data-category="<?php echo $category; ?>" data-lang="<?php echo $lang; ?>">
 <div class="js-news-feed-items"></div>
</section>
