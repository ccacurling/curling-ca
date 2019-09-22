<?php
/**
 * Block Name: Video
 *
 * This is the template that displays the video block.
 */
  $adsnippet = get_field('adsnippet');
?>

<section class="block-ad-banner">
  <?php 
    if ($adsnippet) {
      echo $adsnippet; 
    }
  ?>
</section>
