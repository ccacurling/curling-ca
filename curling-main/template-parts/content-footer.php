<?php
    $top_left_menu_items = wp_get_nav_menu_items( 'Menu - Footer' );
    $primary_menu_items = wp_get_nav_menu_items( 'Menu - Legal' );

    $contact_form_id = get_field('contact_form_id', 'option');
?>

<div class="footer footer-gray">
  <div class="footer-wrapper">
      <div class="footer-content-left-wrapper">
        <a href="/" target="_blank"><img class="footer-logo" src="<?php echo get_stylesheet_directory_uri()."/images/logo-main-footer.svg"; ?>" alt="Site Logo" /></a>
      </div>
      <div class="footer-content-centre-wrapper">
          <?php
              if ($top_left_menu_items) {
          ?>
                <ul class="footer-nav-menu menu-nav">
                    <?php
                        foreach( $top_left_menu_items as $menu_item ) {
                    ?>
                        <li class="footer-menu-item menu-item menu-item-selectable">
                          <a class="clear" href="<?php $menu_item->url; ?>">
                            <h4 class="menu-item-content menu-item-title menu-item-subtitle inverted menu-item-link"><?php echo $menu_item->title; ?></h4>
                          </a>
                        </li>
                    <?php
                        }
                    ?>
                </ul>
          <?php
              }
          ?>
      </div>
      <div class="footer-content-right-wrapper">
          <div>
            <h4 class="newsletter-signup-title inverted">Sign up for the Newsletter</h4>
            <!-- <form id="newsletter-signup" class="footer-form">
                <input class="newsletter-signup-input" type="text" />
                <button class="newsletter-signup-submit btn btn-small btn-red" type="submit">Submit</button>
            </form> -->
            <?php 
            if ( isset($contact_form_id) && !empty($contact_form_id) ) {
                echo do_shortcode('[contact-form-7 id="' . $contact_form_id . '"]');
            }
            ?>
          </div>
          <div class="footer-nav-menu-social">
              <a href="/" target="_blank"><img class="menu-item-social" src="<?php echo get_stylesheet_directory_uri()."/images/icon-facebook-white.svg"; ?>" alt="social" /></a>
              <a href="/" target="_blank"><img class="menu-item-social" src="<?php echo get_stylesheet_directory_uri()."/images/icon-twitter-white.svg"; ?>" alt="social" /></a>
              <a href="/" target="_blank"><img class="menu-item-social" src="<?php echo get_stylesheet_directory_uri()."/images/icon-instagram-white.svg"; ?>" alt="social" /></a>
              <a href="/" target="_blank"><img class="menu-item-social" src="<?php echo get_stylesheet_directory_uri()."/images/icon-youtube-white.svg"; ?>" alt="social" /></a>
              <a href="/" target="_blank"><img class="menu-item-social" src="<?php echo get_stylesheet_directory_uri()."/images/icon-linkedin-white.svg"; ?>" alt="social" /></a>
          </div>
      </div>
  </div>
</div>
<div class="footer-legal footer-legal-gray">
  <div class="footer-legal-wrapper">
      <div class="footer-legal-content">
          <div class="footer-legal-content-left-wrapper">
              <p class="legal">© 2019 CURLING CANADA. ALL RIGHTS RESERVED.</p>
          </div>
          <div class="footer-legal-content-right-wrapper">
              <?php
                  if ($primary_menu_items) {
              ?>
                  <ul class="menu-nav">
                      <?php
                          foreach( $primary_menu_items as $menu_item ) {
                      ?>
                          <li class="menu-item-selectable menu-item">
                            <a class="clear" href="">
                              <h4 class="menu-item-content legal menu-item-link"><?php echo $menu_item->title; ?></h4>
                            </a>
                          </li>
                      <?php
                          }
                      ?>
                  </ul>
              <?php
                  }
              ?>
          </div>
      </div>
  </div>
</div>
