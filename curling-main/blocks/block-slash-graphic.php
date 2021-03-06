<?php
/**
 * Block Name: Slash Graphic
 *
 * This is the template that displays a slash graphic
 */
?>
<?php
  $slash_image = get_field( 'slash_image' );
  $slash_image_position = get_field( 'slash_image_position' );
  $slash_position_offset = get_field( 'slash_position_offset' );
?>
<section class="block-slash">
  <div class="block-slash-container" style="bottom:<?php echo $slash_position_offset; ?>px;">
    <div class="slash-graphic">
      <?php
        if ($slash_image) {
      ?>
        <div class="block-slash-img-container block-slash-img-<?php echo $slash_image_position; ?>">
          <img class="block-slash-img" src="<?php echo $slash_image['url']; ?>" alt="<?php echo $slash_image['alt']; ?>" />
        </div>
      <?php
        }
      ?>
      <img class="slash" src="<?php echo get_stylesheet_directory_uri(); ?>/images/img-slash-large-wide.svg" alt="<?php echo __("Slash"); ?>" />
      <img class="slash slash-mask" src="<?php echo get_stylesheet_directory_uri(); ?>/images/img-slash-large-wide-mask.svg" alt="<?php echo __("Slash"); ?>" />
    </div>
  </div>
</section>