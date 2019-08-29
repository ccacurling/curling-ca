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

$hero_class = '';

if ($image) {
  switch ($hero_size) {
    case 'small':
      $hero_class = 'block-hero-small';
      break;
    case 'medium':
      $hero_class = 'block-hero-medium';
      break;
    case 'large':
      $hero_class = 'block-hero-large';
      break;
  }
}
?>

<section class="block-hero <?php echo $hero_class; ?> content-fixed" style="background-image: url(<?php echo $image['url']; ?>);">
  <?php
    if (!$image) {
  ?>
    <h2>
      Add Hero Image...
    </h2>
  <?php
    } else {
  ?>
    <div class="block-hero-inner">
      <h1 class="<?php echo $image ? 'inverted' : ''; ?>">
        <?php echo $headline; ?>
      </h1>
    </div>
  <?php
    }
  ?>
</section>

<?php
  if ($has_timer) {
    include 'block-timer.php';
  }
?>
