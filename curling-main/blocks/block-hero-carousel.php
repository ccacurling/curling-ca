<?php
/**
 * Block Name: Hero
 *
 * This is the template that displays the hero block.
 */

$image = get_field( 'hero_carousel_image' );
$headline = get_field( 'hero_carousel_headline' );

$carousel_items = get_field( 'hero_carousel_items' );

?>

<section class="block-hero-carousel">
  <div class="hero-carousel-media-container">
    <img class="hero-carousel-background-image" src="<?php echo $image['url']; ?>" alt="Background" />
  </div>
  <?php
    if (!$image) {
  ?>
    <h2>
      Add Hero Image...
    </h2>
  <?php
    } else {
  ?>
    <div class="block-hero-carousel-inner">
      <div class="hero-carousel-title-container">
        <h1 class="hero-carousel-title">
          <?php echo $headline; ?>
        </h1>
      </div>
    </div>
  <?php
    }
  ?>

  <div class="hero-carousel-items-container">
    <div class="hero-carousel-item">
      <div class="hero-carousel-item-wrapper">
        <div class="hero-carousel-item-image-container">
          <img class="hero-carousel-item-image" src="<?php echo $image['url']; ?>" alt="Background" />
        </div>
        <div class="hero-carousel-item-title">
          <h3>Name of carousel content</h3>
        </div>
      </div>
      <div class="hero-carousel-item-progressbar">
      </div>
    </div>

    <div class="hero-carousel-item">
      <div class="hero-carousel-item-wrapper">
        <div class="hero-carousel-item-image-container">
          <img class="hero-carousel-item-image" src="<?php echo $image['url']; ?>" alt="Background" />
        </div>
        <div class="hero-carousel-item-title">
          <h3>Name of carousel content</h3>
        </div>
      </div>
      <div class="hero-carousel-item-progressbar">
      </div>
    </div>

    <div class="hero-carousel-item">
      <div class="hero-carousel-item-wrapper">
        <div class="hero-carousel-item-image-container">
          <img class="hero-carousel-item-image" src="<?php echo $image['url']; ?>" alt="Background" />
        </div>
        <div class="hero-carousel-item-title">
          <h3>Name of carousel content</h3>
        </div>
      </div>
      <div class="hero-carousel-item-progressbar">
      </div>
    </div>
  </div>
</section>
