<?php
/**
 * Block Name: Video
 *
 * This is the template that displays the video block.
 */
  if ( get_field('banner_type') == 'custom' ) {
    $adsnippet = get_field('adsnippet');
  } else if ( get_field('banner_type') == 'wide' ) {
    $adsnippet = get_field('ad_snippet_wide', 'Options');
  } else {
    $adsnippet = get_field('ad_snippet_square', 'Options');
  }
?>

<section class="block-ad-banner">
  <?php 
    if ($adsnippet) {
      echo $adsnippet; 
    }
  ?>
</section>
