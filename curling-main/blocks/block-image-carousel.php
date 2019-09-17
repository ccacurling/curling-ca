<?php
/**
 * Block Name: Image Carousel
 *
 * This is the template that displays the image carousel block.
 */

$carousel_type = get_field( 'image_carousel_type' );
$carousel_background_colour = get_field( 'image_carousel_background_colour' );
$carousel_title = get_field( 'image_carousel_title' );
$carousel_top_body = get_field( 'image_carousel_top_body' );
$carousel_layout = get_field( 'image_carousel_layout' );
$carousel_gallery = get_field( 'image_carousel_gallery' );
$carousel_bottom_body = get_field( 'image_carousel_bottom_body' );
$carousel_links = get_field( 'image_carousel_links' );

$carousel_gallery_chucks = array_chunk($carousel_gallery, 4);
?>

<section class="block-image-carousel <?php echo $carousel_background_colour === 'gray' ? 'image-carousel-gray' : ''; ?> js-image-carousel">
  <div class="image-carousel-container">
    <div class="image-carousel-sub-container">
      <h3 class="image-carousel-title"><?php echo $carousel_title; ?></h3>

      <?php
        if ($carousel_top_body) {
      ?>
        <p class="image-carousel-top-body"><?php echo $carousel_top_body; ?></p>
      <?php
        }
      ?>
    </div>

    <div class="image-carousel-gallery-mobile <?php echo $carousel_layout === 'large_right' ? 'image-carousel-rtl' : ''; ?>">
        <div class="image-carousel-slides js-slider-mobile">
          <?php
            foreach ($carousel_gallery as $key => $image) {
          ?>
            <div class="image-carousel-slide">
              <div class="image-carousel-image-container">
                <img class="image-carousel-image" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
              </div>
            </div>
          <?php
            }
          ?>
        </div>
        <div class="image-carousel-navigation js-carousel-mobile-nav">
          <div class="image-carousel-navigation-arrows">
            <button class="image-carousel-navigation-arrow image-carousel-navigation-arrow-prev js-carousel-mobile-nav-prev"><img src=<?php echo get_stylesheet_directory_uri()."/images/arrow-left-nav-white.svg"; ?> alt=""/></button>
            <h4 class="image-carousel-navigation-pagination js-carousel-mobile-nav-pagination"></h4>
            <button class="image-carousel-navigation-arrow image-carousel-navigation-arrow-next js-carousel-mobile-nav-next"><img src=<?php echo get_stylesheet_directory_uri()."/images/arrow-right-nav-white.svg"; ?> alt=""/></button>
          </div>
        </div>
      </div>

    <?php
      if ($carousel_type === 'normal') {
    ?>
    <div class="image-carousel-gallery <?php echo $carousel_layout === 'large_right' ? 'image-carousel-rtl' : ''; ?>">
      <div class="image-carousel-slides js-slider">
        <?php
          foreach ($carousel_gallery_chucks as $key => $image_chunks) {
        ?>
          <div class="image-carousel-slide">
            <?php
              if ($image_chunks[0]) {
            ?>
              <div class="image-carousel-image-container-left">
                <div class="image-carousel-image-container image-carousel-image-0">
                  <img class="image-carousel-image" src="<?php echo $image_chunks[0]['url']; ?>" alt="<?php echo $image_chunks[0]['alt']; ?>" />
                </div>
              </div>
            <?php
              }
            ?>
              <div class="image-carousel-image-container-right">
                <?php
                  for ($i = 1; $i < count($image_chunks); $i++) {
                    $image = $image_chunks[$i];
                ?>
                  <div class="image-carousel-image-container image-carousel-image-<?php echo $i; ?>">
                    <img class="image-carousel-image" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                  </div>
                <?php
                  }
                ?>
              </div>
          </div>
        <?php
          }
        ?>
      </div>
      <div class="image-carousel-navigation js-carousel-nav">
        <div class="image-carousel-navigation-arrows">
          <button class="image-carousel-navigation-arrow image-carousel-navigation-arrow-prev js-carousel-nav-prev"><img src=<?php echo get_stylesheet_directory_uri()."/images/arrow-left-nav-white.svg"; ?> alt=""/></button>
          <h4 class="image-carousel-navigation-pagination js-carousel-nav-pagination"></h4>
          <button class="image-carousel-navigation-arrow image-carousel-navigation-arrow-next js-carousel-nav-next"><img src=<?php echo get_stylesheet_directory_uri()."/images/arrow-right-nav-white.svg"; ?> alt=""/></button>
        </div>
      </div>
    </div>

    <?php
      } else {
    ?>
    <div class="image-carousel-gallery image-carousel-gallery-circular <?php echo $carousel_layout === 'large_right' ? 'image-carousel-rtl' : ''; ?> ">
      <div class="image-carousel-slides js-slider js-slider-circular">
        <?php
          foreach ($carousel_gallery as $key => $image) {
        ?>
          <div class="image-carousel-slide">
            <div class="image-carousel-image-container">
              <img class="image-carousel-image" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
            </div>
          </div>
        <?php
          }
        ?>
      </div>
      <div class="image-carousel-navigation js-carousel-nav">
        <div class="image-carousel-navigation-arrows">
          <button class="image-carousel-navigation-arrow image-carousel-navigation-arrow-prev js-carousel-nav-prev"><img src=<?php echo get_stylesheet_directory_uri()."/images/arrow-left-nav-white.svg"; ?> alt=""/></button>
          <h4 class="image-carousel-navigation-pagination js-carousel-nav-pagination"></h4>
          <button class="image-carousel-navigation-arrow image-carousel-navigation-arrow-next js-carousel-nav-next"><img src=<?php echo get_stylesheet_directory_uri()."/images/arrow-right-nav-white.svg"; ?> alt=""/></button>
        </div>
      </div>
    </div>

    <?php
      }
    ?>
    <div class="image-carousel-sub-container">
      <?php
        if ($carousel_bottom_body) {
      ?>
        <p class="image-carousel-bottom-body"><?php echo $carousel_bottom_body; ?></p>
      <?php
        }
      ?>
    </div>

    <?php
      if ($carousel_links) {
    ?>
      <div class="image-carousel-sub-container">
        <div class="image-carousel-links">
          <?php
            foreach ($carousel_links as $key => $carousel_link) {
              $image_link = $carousel_link['image_carousel_link'];
          ?>
          <a class="image-carousel-link clear" href="<?php echo $image_link['url']; ?>" target="<?php echo $image_link['target']; ?>">
            <h4 class="btn-link-text red"><?php echo $image_link['title']; ?></h4>
            <img class="btn-link-arrow" src="<?php echo get_stylesheet_directory_uri() . "/images/arrow-right-large-red.svg"; ?>" alt="arrow-right">
          </a>
          <?php
            }
          ?>
        </div>
      </div>
    <?php
      }
    ?>
  </div>
</section>
