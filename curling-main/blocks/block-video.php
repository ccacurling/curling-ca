<?php
/**
 * Block Name: Video
 *
 * This is the template that displays the video block.
 */
  $video = get_field('video_embed');
?>

<section class="block-video">
  <?php echo $video; ?>
</section>
