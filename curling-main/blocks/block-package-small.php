<?php
/**
 * Block Name: package
 *
 * This is the template that displays the package block.
 */

$current_lang = apply_filters( 'wpml_current_language', NULL );

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

$price_markup = "";
if ($current_lang == "fr") {
  $price_markup .= "<span class='package-small-price-dollar text-highlight $package_small_price_colour'>{$package_small_price_split[0]}</span>";
  $price_markup .= "<h2 class='package-small-price-cents $package_small_price_colour'>,{$package_small_price_split[1]}</h2>";
  $price_markup .= "<h2 class='package-small-price-dollar-symbol $package_small_price_colour'> $</h2>";
} else {
  $price_markup .= "<h2 class='package-small-price-dollar-symbol $package_small_price_colour'>$</h2>";
  $price_markup .= "<span class='package-small-price-dollar text-highlight $package_small_price_colour'>{$package_small_price_split[0]}</span>";
  $price_markup .= "<h2 class='package-small-price-cents $package_small_price_colour'>.{$package_small_price_split[1]}</h2>";
}


?>

<section class="lang-<?php echo current_lang; ?> block-package-small block-package-small-<?php echo $package_small_colour; ?>">
  <div class="package-small-wrapper">
    <h2 class="package-small-name"><?php echo $package_small_name; ?></h2>
    <div class="package-small-price-container">
      <div class="package-small-price-wrapper">
        <?php echo $price_markup; ?>
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
