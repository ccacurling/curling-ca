<?php
/**
 * Block Name: package
 *
 * This is the template that displays the package block.
 */

$package_small_colour = get_field( 'package_colour' );
$package_small_name = get_field( 'package_name' );
$package_small_price = get_field( 'package_price' );
$package_small_price_info = get_field( 'package_price_info' );
$package_small_info = get_field( 'package_info' );
$package_small_link = get_field( 'package_link' );

$package_small_price_split = explode('.', $package_small_price);
$package_small_price_colour = $package_small_colour === 'red' || $package_small_colour === 'gray' ? 'inverted' : ($package_small_colour === 'white' ? 'red' : 'inverted');
$package_small_btn_colour = $package_small_colour === 'red' ? 'white' : ($package_small_colour === 'white' || $package_small_colour === 'gray' ? 'red' : '');
$package_small_btn_text_colour = $package_small_colour === 'white' || $package_small_colour === 'gray' ? 'white' : '';
?>

<section class="block-package-small block-package-small-<?php echo $package_small_colour; ?>">
  <div class="package-small-wrapper">
    <h2 class="package-small-name"><?php echo $package_small_name; ?></h2>
    <div class="package-small-price-container">
      <div class="package-small-price-wrapper">
        <h2 class="package-small-price-dollar-symbol <?php echo $package_small_price_colour; ?>">$</h2>
        <span class="package-small-price-dollar text-highlight <?php echo $package_small_price_colour; ?>"><?php echo $package_small_price_split[0]; ?></span>
        <h2 class="package-small-price-cents <?php echo $package_small_price_colour; ?>">.<?php echo $package_small_price_split[1]; ?></h2>
      </div>
      <h4 class="package-small-price-info <?php echo $package_small_price_colour; ?>"><?php echo $package_small_price_info; ?></h4>
    </div>
    <div class="package-small-info-container">
      <?php echo $package_small_info; ?>
    </div>
    <div class="package-small-button-container btn btn-<?php echo $package_small_btn_colour; ?>">
      <span class="package-small-button-text <?php echo $package_small_btn_text_colour; ?>">
        <a class="clear" href="<?php echo $package_small_link['url']; ?>" target="<?php echo $package_small_link['target']; ?>">
          <?php echo $package_small_link['title']; ?>
        </a>
      </span>
    </div>
  </div>
</section>