
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
?>

<div class="block-prefooter">
  <div class="block-prefooter-info">
    <h1 class="block-prefooter-info-title"><?php echo $prefooter_title; ?></h1>
    <p class="block-prefooter-info-body"><?php echo $prefooter_body; ?></p>
    <div class="block-prefooter-info-btns">
      <a class="block-prefooter-info-btn btn btn-large btn-white" href="/" target="none">Shop</a><a class="block-prefooter-info-btn btn btn-large btn-white" href="/" target="none">Donate</a>
    </div>
  </div>
  <div class="block-prefooter-img-container">
    <img class="block-prefooter-img" src="<?php echo $prefooter_image['url']; ?>" alt="" />
  </div>
  <img class="prefooter-slash" src="<?php echo get_stylesheet_directory_uri(); ?>/images/img-slash-large.svg" alt="" />
</div>
