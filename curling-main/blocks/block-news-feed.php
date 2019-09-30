<?php
/**
 * Block Name: News Feed
 *
 * This is the template that displays the News Feed block.
 */
?>

<?php
  $news_feed_title = get_field( 'news_feed_title' );
  $news_feed_category = get_field( 'news_feed_category' );

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

<section class="block-news-feed js-news-feed" data-category="<?php echo $category; ?>">
  <div class="news-feed-title-container">
    <h3><?php echo $news_feed_title; ?></h3>
  </div>
 <div class="js-news-feed-items"></div>
</section>