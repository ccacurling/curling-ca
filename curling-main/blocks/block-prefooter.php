
<?php
/**
 * Block Name: Pre-Footer
 *
 * This is the template that displays the prefooter block.
 */
?>

<?php

$current_lang = apply_filters( 'wpml_current_language', NULL );


$prefooter_title = get_field( 'prefooter_title' );
$prefooter_body = get_field( 'prefooter_body' );
$prefooter_image = get_field( 'prefooter_image' );
$prefooter_enable_background = get_field( 'prefooter_enable_background' );
$prefooter_background_colour = get_field( 'prefooter_background_colour' );
$prefooter_type = get_field( 'prefooter_type' );
$prefooter_image_x_offset = get_field( 'prefooter_image_x_offset' );
$prefooter_image_y_offset = get_field( 'prefooter_image_y_offset' );

$prefooter_button_one = get_field( 'prefooter_button_one' );
$prefooter_button_two = get_field( 'prefooter_button_two' );

if ( !isset($prefooter_button_one_label) || empty($prefooter_button_one_label) ){
  $prefooter_button_one_label = $prefooter_button_one;
}

if ( !isset($prefooter_button_two_label) || empty($prefooter_button_two_label) ){
  $prefooter_button_two_label = $prefooter_button_two;
}

echo "<pre class='debug' style='display:none;'>";
print_r($prefooter_shop_link);
print_r($prefooter_donate_link);
print_r($current_lang);
echo "</pre>";


$prefooter_shop_link = get_field( 'settings_shop_link', 'Options' );
$prefooter_donate_link = get_field( 'settings_donate_link', 'Options' );

if ($current_lang == "fr"){

  if ($prefooter_shop_link['title'] == "Shop"){
    $prefooter_shop_link['title'] = 'Boutique';
  }
  
  if ($prefooter_donate_link['title'] == "Donate") {
    $prefooter_donate_link['title'] = 'Dons';
  }

}

echo "<pre class='debug' style='display:none;'>";
print_r($prefooter_shop_link);
print_r($prefooter_donate_link);
print_r($current_lang);
echo "</pre>";

?>

<div class="block-prefooter <?php echo $prefooter_enable_background ? '' : 'block-prefooter-simple'; ?> <?php echo !$prefooter_enable_background ? 'block-prefooter-'.$prefooter_background_colour : 'block-prefooter-white'?>">
  <div class="block-prefooter-info <?php echo $prefooter_type ? ($prefooter_type === 'tlbr' ? 'block-prefooter-info-left' : 'block-prefooter-info-right') : ''; ?>">
    <h1 class="block-prefooter-info-title"><?php echo $prefooter_title; ?></h1>
    <p class="block-prefooter-info-body"><?php echo $prefooter_body; ?></p>
    <div class="block-prefooter-info-btns">
      <?php //if ( isset($prefooter_button_one) && !empty($prefooter_button_one) ) { ?>
        <!-- a class="block-prefooter-info-btn btn btn-large <?php //echo $prefooter_enable_background ? 'btn-white' : 'btn-red'; ?>" href="<?php //echo $prefooter_button_one['url']; ?>" target="<?php //echo $prefooter_button_one['target']; ?>"><?php //echo $prefooter_button_one['title']; ?></a -->
      <?php //} else { ?>
        <a class="block-prefooter-info-btn btn btn-large <?php echo $prefooter_enable_background ? 'btn-white' : 'btn-red'; ?>" href="<?php echo $prefooter_shop_link['url']; ?>" target="<?php echo $prefooter_shop_link['target']; ?>"><?php echo __($prefooter_shop_link['title']); ?></a>
      <?php //} ?>
      <?php //if ( isset($prefooter_button_two) && !empty($prefooter_button_two) ) { ?>
        <!-- a class="block-prefooter-info-btn btn btn-large <?php //echo $prefooter_enable_background ? 'btn-white' : 'btn-red'; ?>" href="<?php //echo $prefooter_button_two['url']; ?>" target="<?php //echo $prefooter_button_two['target']; ?>"><?php //echo $prefooter_button_two['title']; ?></a -->
        <?php //} else { ?>
        <a class="block-prefooter-info-btn btn btn-large <?php echo $prefooter_enable_background ? 'btn-white' : 'btn-red'; ?>" href="<?php echo $prefooter_donate_link['url']; ?>" target="<?php echo $prefooter_donate_link['target']; ?>"><?php echo __($prefooter_donate_link['title']); ?></a>
      <?php //} ?>
    </div>
  </div>
  <?php
    if ($prefooter_enable_background) {
  ?>
    <?php
      if ($prefooter_image) {
    ?>
      <div class="block-prefooter-img-container block-prefooter-img-<?php echo ($prefooter_type === 'tlbr' ? 'right' : 'left'); ?>"
        style="bottom:<?php echo $prefooter_image_y_offset;?>px;<?php echo ($prefooter_type === 'tlbr' ? 'right' : 'left'); ?>:<?php echo $prefooter_image_x_offset; ?>px">
        <img class="block-prefooter-img" src="<?php echo $prefooter_image['url']; ?>" alt="<?php echo $prefooter_image['alt']; ?>" />
      </div>
    <?php
      }
    ?>
    <div class="prefooter-slash-container prefooter-slash-<?php echo $prefooter_type; ?>">
      <img class="prefooter-slash prefooter-slash-1" src="<?php echo get_stylesheet_directory_uri(); ?>/images/img-slash-large-wide.svg" alt="<?php echo __("Slash"); ?>" />
      <img class="prefooter-slash prefooter-slash-mask prefooter-slash-1" src="<?php echo get_stylesheet_directory_uri(); ?>/images/img-slash-large-wide-mask.svg" alt="<?php echo __("Slash"); ?>" />
      <img class="prefooter-slash prefooter-slash-2" src="<?php echo get_stylesheet_directory_uri(); ?>/images/img-slash-large-wide.svg" alt="<?php echo __("Slash"); ?>" />
    </div>
    <?php
    }
  ?>
</div>
