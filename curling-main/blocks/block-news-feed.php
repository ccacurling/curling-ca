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

  $category = $news_feed_category ? get_category($news_feed_category) : '';
?>

<section class="block-news-feed js-news-feed" data-category="<?php echo $category ? $category->slug : ''; ?>">
  <div class="news-feed-title-container">
    <h3><?php echo $news_feed_title; ?></h3>
  </div>
 <div class="js-news-feed-items"></div>
</section>