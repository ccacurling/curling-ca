<?php
/**
 * Block Name: Promo
 *
 * This is the template that displays the promo block.
 */

$promo_name = get_field( 'promo_name' );
$promo_price = get_field( 'promo_price' );
$promo_price_info = get_field( 'promo_price_info' );
$promo_info = get_field( 'promo_info' );
$promo_link = get_field( 'promo_link' );

$promo_price_split = explode('.', $promo_price);


?>

<section class="block-promo">
  <div class="promo-price-container">
    <div class="promo-price-wrapper">
      <h2 class="promo-price-dollar-symbol red">$</h2>
      <span class="promo-price-dollar highlight red"><?php echo $promo_price_split[0]; ?></span>
      <h2 class="promo-price-cents red">.<?php echo $promo_price_split[1]; ?></h2>
  </div>
    <h4 class="promo-price-info red"><?php echo $promo_price_info; ?></h4>
  </div>
  <div class="promo-wrapper">
    <h2 class="promo-name"><?php echo $promo_name; ?></h2>
    <div class="promo-price-container-mobile">
      <div class="promo-price-wrapper">
        <h2 class="promo-price-dollar-symbol red">$</h2>
        <span class="promo-price-dollar highlight red"><?php echo $promo_price_split[0]; ?></span>
        <h2 class="promo-price-cents red">.<?php echo $promo_price_split[1]; ?></h2>
      </div>
      <h4 class="promo-price-info red"><?php echo $promo_price_info; ?></h4>
    </div>
    <div class="promo-info-container">
      <?php echo $promo_info; ?>
    </div>
    <div class="promo-button-container btn btn-red">
      <span class="promo-button-text inverted">
        <a class="clear" href="<?php echo $promo_link['url']; ?>" target="<?php echo $promo_link['target']; ?>">
          <?php echo $promo_link['title']; ?>
        </a>
      </span>
    </div>
  </div>
</section>