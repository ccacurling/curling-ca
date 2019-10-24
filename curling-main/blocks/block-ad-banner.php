<?php
/**
 * Block Name: Video
 *
 * This is the template that displays the video block.
 */
  //error_log( "Banner Type" . get_field('banner_type') );

  if ( get_field('banner_type') == 'custom' ) {
    $adsnippet = get_field('adsnippet');
  } else if ( get_field('banner_type') == 'wide' ) {
    $adsnippet = get_field('ad_snippet_wide', 'Options');
  } else if ( get_field('banner_type') == 'square' ) {
    $adsnippet = get_field('ad_snippet_square', 'Options');
  } else {
    $adsnippet = get_field('ad_snippet_square_national', 'Options');
  }
?>

<section class="block-ad-banner">
  <?php 
    if ($adsnippet) {
      echo $adsnippet; 
    }
  ?>
</section>
