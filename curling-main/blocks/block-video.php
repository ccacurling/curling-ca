<?php
/**
 * Block Name: Video
 *
 * This is the template that displays the video block.
 */
  $video = get_field('video_embed');

  $url = '';
  if (preg_match('/src="(.*?)" /', $video, $match) == 1) {
    $url = $match[1];
  }
?>

<section class="block-video">
  <?php
    if ($url) {
  ?>
    <iframe width="100%" height="100%" src="<?php echo $url; ?>" allowfullscreen>
    </iframe>
  <?php
    }
  ?>
</section>
