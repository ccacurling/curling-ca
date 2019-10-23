<?php
/**
 * Block Name: Ad Banner
 *
 * This is the template that displays the ad banner block.
 */
  
  $banner_type = get_field('banner_type');

  if ( $banner_type == 'custom' ) {
    $adsnippet = get_field('adsnippet');
  } else if ( $banner_type == 'wide' ) {
    $adsnippet = get_field('ad_snippet_wide', 'Options');
  } else if ( $banner_type == 'square' ) {
    $adsnippet = get_field('ad_snippet_square', 'Options');
  } else {
    $adsnippet = get_field('ad_snippet_square_national', 'Options');
  }
?>

<section class="block-ad-banner <?php echo $banner_type === 'wide' ? 'ad-banner-wide' : ''; ?>">
  <?php 
    if ($adsnippet) {
      echo $adsnippet; 
    }
  ?>
</section>
