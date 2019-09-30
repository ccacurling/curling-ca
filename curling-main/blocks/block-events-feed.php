<?php
/**
 * Block Name: Events Feed
 *
 * This is the template that displays the Events Feed block.
 */
?>

<?php
  $events_feed_title = get_field( 'events_feed_title' );
  $events_feed_category = get_field( 'events_feed_category' );

  $category = $events_feed_category ? get_category($events_feed_category) : '';
?>

<section class="block-events-feed js-events-feed" data-category="<?php echo $category ? $category->slug : ''; ?>">
  <div class="events-feed-title-container">
    <h3><?php echo $events_feed_title; ?></h3>
  </div>
 <div class="events-feed-items js-events-feed-items"></div>
</section>