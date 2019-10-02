
<?php
/**
 * Block Name: Pre-Footer
 *
 * This is the template that displays the prefooter block.
 */
?>

<?php
$prefooter_title = get_field( 'prefooter_title' );
$prefooter_body = get_field( 'prefooter_body' );
$prefooter_image = get_field( 'prefooter_image' );
$prefooter_enable_background = get_field( 'prefooter_enable_background' );
$prefooter_background_colour = get_field( 'prefooter_background_colour' );

$prefooter_image_location = get_field( 'prefooter_image_location' );

?>

<div class="block-prefooter <?php echo $prefooter_enable_background ? '' : 'block-prefooter-simple'; ?> <?php echo !$prefooter_enable_background ? 'block-prefooter-'.$prefooter_background_colour : 'block-prefooter-white'?>">
  <div class="block-prefooter-info">
    <h1 class="block-prefooter-info-title"><?php echo $prefooter_title; ?></h1>
    <p class="block-prefooter-info-body"><?php echo $prefooter_body; ?></p>
    <div class="block-prefooter-info-btns">
      <a class="block-prefooter-info-btn btn btn-large <?php echo $prefooter_enable_background ? 'btn-white' : 'btn-red'; ?>" href="/" target="none">Shop</a><a class="block-prefooter-info-btn btn btn-large <?php echo $prefooter_enable_background ? 'btn-white' : 'btn-red'; ?>" href="/" target="none">Donate</a>
    </div>
  </div>
  <?php
    if ($prefooter_enable_background) {
  ?>
    <?php
      if ($prefooter_image) {
    ?>
      <div class="block-prefooter-img-container block-prefooter-img-<?php echo $prefooter_image_location; ?>">
        <img class="block-prefooter-img" src="<?php echo $prefooter_image['url']; ?>" alt="" />
      </div>
    <?php
      }
    ?>
    <div>
      <img class="prefooter-slash prefooter-slash-1" src="<?php echo get_stylesheet_directory_uri(); ?>/images/img-slash-large-wide.svg" alt="" />
      <img class="prefooter-slash prefooter-slash-mask prefooter-slash-1" src="<?php echo get_stylesheet_directory_uri(); ?>/images/img-slash-large-wide-mask.svg" alt="" />
      <img class="prefooter-slash prefooter-slash-2" src="<?php echo get_stylesheet_directory_uri(); ?>/images/img-slash-large-wide.svg" alt="" />
    </div>
    <?php
    }
  ?>
</div>
