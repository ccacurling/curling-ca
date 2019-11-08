<?php
/**
 * Block Name: package
 *
 * This is the template that displays the package block.
 */

$package_colour = get_field( 'package_colour' );
$package_name = get_field( 'package_name' );
$package_price = get_field( 'package_price' );
$package_price_info = get_field( 'package_price_info' );
$package_info = get_field( 'package_info' );
$package_link = get_field( 'package_link' );

$package_price_split = explode('.', $package_price);
$package_price_colour = $package_colour === 'red' || $package_colour === 'gray' ? 'inverted' : ($package_colour === 'white' ? 'red' : 'inverted');
$package_btn_colour = $package_colour === 'red' ? 'white' : ($package_colour === 'white' || $package_colour === 'gray' ? 'red' : '');
$package_btn_text_colour = $package_colour === 'white' || $package_colour === 'gray' ? 'white' : '';

$price_html = "";
$current_lang = apply_filters( 'wpml_current_language', NULL );
if ( $current_lang == "fr" ) {
  $price_html .= "<span class='package-price-dollar text-highlight $package_price_colour'>{$package_price_split[0]}</span>";
  $price_html .= "<h2 class='package-price-cents $package_price_colour'>,{$package_price_split[1]}</h2>";
  $price_html .= "<h2 class='package-price-dollar-symbol $package_price_colour'> $</h2>";
} else {
  $price_html .= "<h2 class='package-price-dollar-symbol $package_price_colour'>$</h2>";
  $price_html .= "<span class='package-price-dollar text-highlight $package_price_colour'>{$package_price_split[0]}</span>";
  $price_html .= "<h2 class='package-price-cents $package_price_colour'>.{$package_price_split[1]}</h2>";
}
?>

<section class="block-package block-package-<?php echo $package_colour; ?>">
  <div class="package-price-container">
    <div class="package-price-wrapper english-price">
      <?php echo $price_html; ?>
    </div>
    <h4 class="package-price-info <?php echo $package_price_colour; ?>"><?php echo $package_price_info; ?></h4>
  </div>
  <div class="package-wrapper">
    <h2 class="package-name"><?php echo $package_name; ?></h2>
    <div class="package-price-container-mobile">
      <div class="package-price-wrapper english-price">
        <?php echo $price_html; ?>
      </div>
      <h4 class="package-price-info <?php echo $package_price_colour; ?>"><?php echo $package_price_info; ?></h4>
    </div>
    <div class="package-info-container">
      <?php echo $package_info; ?>
    </div>
    <div class="package-button-container btn btn-<?php echo $package_btn_colour; ?>">
      <span class="package-button-text <?php echo $package_btn_text_colour; ?>">
        <a class="clear" href="<?php echo $package_link['url']; ?>" target="<?php echo $package_link['target']; ?>">
          <?php echo $package_link['title']; ?>
        </a>
      </span>
    </div>
  </div>
</section>