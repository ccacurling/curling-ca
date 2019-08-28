
<?php
/**
 * Block Name: Hero
 *
 * This is the template that displays the hero block.
 */

$image = get_field( 'hero_image' );
$hero_size = get_field( 'hero_size' );
$headline = get_field( 'hero_headline' );
$has_timer = get_field( 'has_timer' );
?>
<section class="block-hero <?php echo $hero_size === 'small' ? 'block-hero-small' : ($hero_size === 'medium' ? 'block-hero-medium' : ''); ?> content-fixed" style="background-image: url(<?php echo $image['url']; ?>);">
  <div class="block-hero-inner">
    <h1 class="inverted"><?php echo $headline; ?></h1>
  </div>
</section>
<?php
  if ($has_timer) {
    include 'block-timer.php';
  }
?>
