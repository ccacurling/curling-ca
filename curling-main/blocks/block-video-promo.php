<?php
/**
 * Block Name: Video Promo
 *
 * This is the template that displays the video promo block.
 */

  $video_promo_youtube_video_id = get_field( 'video_promo_youtube_video_id' );
  $video_promo_title = get_field( 'video_promo_title' );
  $video_promo_text = get_field('video_promo_text');
  $video_promo_link_label = get_field( 'video_promo_link_label' );

  $thumbnail = 'https://img.youtube.com/vi/'.$video_promo_youtube_video_id.'/hqdefault.jpg';
  $link = 'https://www.youtube.com/watch?v='.$video_promo_youtube_video_id;
?>

<section role="video" class="block-video-promo block-callout callout-colour-gray">
  <div class="callout-wrapper">
    <?php 
      if ($thumbnail) {
    ?>
      <div class="video-promo-thumbnail callout-thumbnail-container">
        <a href="<?php echo $link; ?>" data-lity> 
          <img class="callout-thumbnail" src="<?php echo $thumbnail; ?>" alt="<?php echo __("Youtube Thumbnail"); ?>" />
          <img class="video-promo-img-play js-btn-play" src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-play-arrow.svg" alt="<?php echo __("Play"); ?>" />
        </a>
      </div>
    <?php
      }
    ?>
    <div class="callout-info callout-info-medium">
      <?php if (!empty($video_promo_title)): ?>
        <h3 class="callout-title callout-title-medium"><?php echo $video_promo_title; ?></h3>
      <?php endif; ?>
      <?php if ( isset($video_promo_text) && !empty($video_promo_text) ) { ?>
        <p class="callout-text"><?php echo __($video_promo_text); ?></p>
      <?php } ?>

      <?php
        if ($video_promo_link_label) {
      ?>
        <a class="callout-link btn-link" href="<?php echo $link; ?>" target="_blank">
          <h4 class="btn-link-text red"><?php echo $video_promo_link_label ?></h4>
          <img class="btn-link-arrow" src="<?php echo get_stylesheet_directory_uri()."/images/arrow-right-large-red.svg"; ?>" alt="<?php echo __("arrow-right"); ?>" />
        </a>
      <?php
        }
      ?>
    </div>
  </div>
</section>
