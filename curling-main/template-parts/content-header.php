<?php
    $top_right_menu_items = wp_get_nav_menu_items( 'Menu - Top Right' );
    $primary_menu_items = wp_get_nav_menu_items( 'Menu - Main' );

    $header_config = isset($header_config) ? $header_config : null;
    $header_color = parse_config($header_config, 'header_color', 'red');

    $current_page = 497698; // TODO: FIX!

    $languages = icl_get_languages();
    foreach ($languages as $key => $language) {
      if ($language['active']) {
        unset($languages[$key]);
      }
    }
    
    $menu_items = buildTree($primary_menu_items);

    function buildTree( array &$elements, $parentId = 0 ) {
        $branch = array();
        foreach ( $elements as &$element ) {
            if ( $element->menu_item_parent == $parentId ) {
                $children = buildTree( $elements, $element->ID );
                if ( $children ) {
                    $element->children = $children;
                }

                $branch[$element->ID] = $element;
                unset( $element );
            }
        }
        return $branch;
    }

?>

<div class="header header-<?php echo $header_color; ?> header-mobile js-curling-nav-mobile">
  <div class="nav-menu-top-mobile js-cta-topmenu-mobile">
    <img class="menu-logo-mobile" src="<?php echo get_stylesheet_directory_uri()."/images/logo-main.svg"; ?>" alt="Site Logo" />
    <img class="menu-hamburger-mobile js-cta-menu-mobile-hamburger" src="<?php echo get_stylesheet_directory_uri()."/images/img-hamburger.svg"; ?>" alt="Hamburger" />
  </div>
  <?php
    create_main_menu_mobile($top_right_menu_items, $menu_items);
    create_submenus_mobile($menu_items);
  ?>
</div>

<div class="header header-<?php echo $header_color; ?> header-desktop js-curling-nav">
    <div class="nav-menu-top content-fixed">
        <div class="nav-menu-top-wrapper content-container">
            <div class="nav-menu-top-left-wrapper">
                <ul class="menu-nav">
                    <?php
                        foreach( $menu_items as $menu_item ) {
                    ?>
                        <li class="menu-item menu-item-selectable">
                          <a href="">
                            <h4 class="menu-item-top-nav menu-item-content <?php echo $menu_item->ID === $current_page ? 'menu-item-selected' : ''; ?>"><?php echo $menu_item->title; ?></h4>
                          </a>
                        </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
            <div class="nav-menu-top-right-wrapper">
                <?php
                    if ($top_right_menu_items) {
                ?>
                    <ul class="menu-nav">
                        <?php
                            foreach( $top_right_menu_items as $menu_item ) {
                        ?>
                            <li class="menu-item menu-item-selectable">
                              <a href="">
                                <h4 class="menu-item-content menu-item-small"><?php echo $menu_item->title; ?></h4>
                              </a>
                            </li>
                        <?php
                            }
                        ?>
                        <li class="menu-item menu-item-donate">
                          <a href="">
                            <h4 class="menu-item-small inverted">Donate</h4>
                          </a>
                        </li>
                    </ul>
                    <?php
                      if (count($languages) > 0) {
                    ?>
                    <ul class="menu-nav menu-nav-language">
                      <?php 
                        foreach ($languages as $key => $language) {
                      ?>
                        <li class="menu-item menu-item-language menu-item-selectable">
                          <a href="<?php echo $language['url']; ?>">
                            <h4 class="menu-item-content menu-item-small"><?php echo $language['code']; ?></h4>
                          </a>
                        </li>
                      <?php
                        }
                      ?>
                    </ul>
                <?php
                    }
                  }
                ?>
            </div>
          </div>
        </div>
    <div class="nav-menu-primary content-fixed">
        <div class="nav-menu-primary-wrapper content-container">
            <img class="menu-logo" src="<?php echo get_stylesheet_directory_uri()."/images/logo-main.svg"; ?>" alt="Site Logo" />
            <?php
                if (array_key_exists($current_page, $menu_items)) {
            ?>
                <ul class="menu-nav nav-left-offset">
                    <?php
                        foreach ($menu_items[$current_page]->children as $id => $item) {
                            $test = $item->children;
                    ?>
                        <li class="menu-item" data-menu="<?php echo $id; ?>">
                          <a href="">
                            <h4 class="menu-item-content menu-item-title"><?php echo $item->title; ?></h4>
                            <?php 
                                if ($item->children != null && count($item->children) > 0) {
                            ?>
                                <img class="menu-item-arrow" src="<?php echo get_stylesheet_directory_uri()."/images/triangle-down.svg"; ?>" alt="Triangle" />
                            <?php
                                }
                            ?>
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
    <?php
        foreach( $menu_items as $id => $menu_item ) {
            if ($menu_item->children) {
                create_menu_bar_item($menu_item->ID, $menu_item->children);
            }
        }
    ?>
</div>

<?php
function create_main_menu_mobile($top_menu_items, $nav_items) {
?>
  <div class="nav-menu-popout-mobile js-cta-popout-mobile" data-id="0">
    <div class="nav-menu-top-right-mobile">
      <div class="menu-nav-mobile">
      <?php
          foreach( $top_menu_items as $menu_item ) {
      ?>
        <h4 class="nav-menu-item-mobile inverted"><?php echo $menu_item->title; ?></h4>
      <?php
          }
      ?>
      </div>
    </div>
    <?php
        foreach( $nav_items as $menu_item ) {
    ?>
      <ul class="menu-list-mobile js-cta-menu-list-mobile">
        <li class="menu-item-mobile menu-item-main-mobile">
          <div class="menu-item-container-mobile js-cta-menu-item-mobile">
            <h4 class="menu-item-title-mobile inverted"><?php echo $menu_item->title; ?></h4>
            <?php
              if (isset($menu_item->children) && count ($menu_item->children) > 0) {
            ?>
              <img class="arrow-right" src="<?php echo get_stylesheet_directory_uri()."/images/triangle-right-white.svg"; ?>" alt="triangle right" />
            <?php
              }
            ?>
          </div>
          <?php
            if (isset($menu_item->children) && count ($menu_item->children) > 0) {
          ?>
          <ul class="menu-list-mobile js-cta-menu-list-mobile">
            <?php
            foreach( $menu_item->children as $menu_subitem ) {
            ?>
              <li class="menu-item-mobile">
                <div class="menu-item-container-mobile menu-item-subcontainer-mobile js-cta-menu-subitem-mobile" data-id="<?php echo $menu_subitem->ID; ?>">
                  <h4 class="menu-item-title-mobile menu-item-subtitle-mobile gray"><?php echo $menu_subitem->title; ?></h4>
                    <?php
                      if (isset($menu_subitem->children) && count ($menu_subitem->children) > 0) {
                    ?>
                      <img class="arrow-right" src="<?php echo get_stylesheet_directory_uri()."/images/triangle-right.svg"; ?>" alt="triangle right" />
                    <?php
                      }
                    ?>
                </div>
              </li>
            <?php
            }
            ?>
          </ul>
          <?php
            }
          ?>
        </li>
      </ul>
    <?php
        }
    ?>
    <div class="nav-menu-popout-bottom-mobile">
      <div class="menu-item menu-item-donate">
        <h4 class="menu-item-small inverted">Donate</h4>
      </div>
      <div class="nav-menu-social-mobile">
        <img class="menu-item-social" src="<?php echo get_stylesheet_directory_uri()."/images/icon-facebook.svg"; ?>" alt="social" />
        <img class="menu-item-social" src="<?php echo get_stylesheet_directory_uri()."/images/icon-twitter.svg"; ?>" alt="social" />
        <img class="menu-item-social" src="<?php echo get_stylesheet_directory_uri()."/images/icon-instagram.svg"; ?>" alt="social" />
        <img class="menu-item-social" src="<?php echo get_stylesheet_directory_uri()."/images/icon-youtube.svg"; ?>" alt="social" />
        <img class="menu-item-social" src="<?php echo get_stylesheet_directory_uri()."/images/icon-linkedin.svg"; ?>" alt="social" />
      </div>
    </div>
  </div>
<?php
}
?>

<?php
function create_submenus_mobile($nav_items, $parent = NULL) {
  foreach( $nav_items as $menu_item ) {
    if ($menu_item->children && count($menu_item->children) > 0) {
      foreach( $menu_item->children as $menu_subitem ) {
        create_popup_mobile($menu_subitem);
      }
    }
  }
}
?>

<?php
function create_popup_mobile($menu_subitem, $parent = NULL) {
    if ($menu_subitem->children && count($menu_subitem->children) > 0) {
?>
  <div class="nav-menu-popout-mobile js-cta-popout-mobile" data-id="<?php echo $menu_subitem->ID; ?>" data-parent="<?php echo $parent ? $parent->ID : 0; ?>">
    <div class="nav-menu-top-right-mobile">
      <div class="menu-nav-mobile menu-subnav-mobile js-cta-subnav-back">
        <img class="arrow-right" src="<?php echo get_stylesheet_directory_uri()."/images/triangle-left-white.svg"; ?>" alt="triangle left" />
        <h3 class="nav-menu-item-mobile nav-menu-subitem-mobile inverted"><?php echo $menu_subitem->title; ?></h3>
      </div>
    </div>
    <ul class="menu-list-mobile js-cta-menu-list-mobile">
    <?php
      foreach( $menu_subitem->children as $menu_subsubitem ) {
        if ($menu_subsubitem->post_title === '[EVENTS]') { // TODO: TEMP
    ?>
      <li class="menu-item-mobile">
        <div class="menu-item-container-mobile menu-item-subcontainer-mobile menu-item-subsubcontainer-mobile">
          <h3 class="menu-item-toptitle-mobile gray">EXPLORE ALL UPCOMING EVENTS</h3>
        </div>
      </li>
      <li class="menu-item-mobile">
        <div class="menu-item-container-mobile menu-item-subcontainer-mobile menu-item-subsubcontainer-mobile js-cta-menu-subitem-mobile" data-id="-1">
          <div class="menu-item-wrapper-mobile">
            <h4 class="menu-item-title-mobile menu-item-subtitle-mobile gray">HOME HARDWARE CANADA CUP</h4>
            <span class="menu-item-description-mobile">November 27–December 1, 2019</span>
          </div>
          <img class="arrow-right" src="http://local.curling.ca/wp-content/themes/curling-main/images/arrow-right.svg" alt="triangle right">
        </div>
      </li>
      <li class="menu-item-mobile">
        <div class="menu-item-container-mobile menu-item-subcontainer-mobile menu-item-subsubcontainer-mobile js-cta-menu-subitem-mobile" data-id="-1">
          <div class="menu-item-wrapper-mobile">
            <h4 class="menu-item-title-mobile menu-item-subtitle-mobile gray">CONTINENTAL CUP</h4>
            <span class="menu-item-description-mobile">January 9-12, 2020</span>
          </div>
          <img class="arrow-right" src="http://local.curling.ca/wp-content/themes/curling-main/images/arrow-right.svg" alt="triangle right">
        </div>
      </li>
      <li class="menu-item-mobile">
        <div class="menu-item-container-mobile menu-item-subcontainer-mobile menu-item-subsubcontainer-mobile js-cta-menu-subitem-mobile" data-id="-1">
          <div class="menu-item-wrapper-mobile">
            <h4 class="menu-item-title-mobile menu-item-subtitle-mobile gray">SCOTTIES TOURNAMENT OF HEARTS</h4>
            <span class="menu-item-description-mobile">February 15-23, 2020</span>
          </div>
          <img class="arrow-right" src="http://local.curling.ca/wp-content/themes/curling-main/images/arrow-right.svg" alt="triangle right">
        </div>
      </li>
      <li class="menu-item-mobile">
        <div class="menu-item-container-mobile menu-item-subcontainer-mobile menu-item-subsubcontainer-mobile js-cta-menu-subitem-mobile" data-id="-1">
          <div class="menu-item-wrapper-mobile">
            <h4 class="menu-item-title-mobile menu-item-subtitle-mobile gray">TIM HORTONS BRIER</h4>
            <span class="menu-item-description-mobile">February 28–March 8, 2020</span>
          </div>
          <img class="arrow-right" src="http://local.curling.ca/wp-content/themes/curling-main/images/arrow-right.svg" alt="triangle right">
        </div>
      </li>
      <li class="menu-item-mobile">
        <div class="menu-item-container-mobile menu-item-subcontainer-mobile menu-item-subsubcontainer-mobile js-cta-menu-subitem-mobile" data-id="-1">
          <div class="menu-item-wrapper-mobile">
            <h4 class="menu-item-title-mobile menu-item-subtitle-mobile gray">WORLD WOMEN’S CURLING CHAMPIONSHIP</h4>
            <span class="menu-item-description-mobile">March 14-22, 2020</span>
          </div>
          <img class="arrow-right" src="http://local.curling.ca/wp-content/themes/curling-main/images/arrow-right.svg" alt="triangle right">
        </div>
      </li>
      <li class="menu-item-events-mobile">
        <img class="event-item" src="<?php echo get_stylesheet_directory_uri()."/images/img-event-sample1.png"; ?>" alt="Event1" />
      </li>
    <?php
        } else {
    ?>
      <li class="menu-item-mobile">
        <div class="menu-item-container-mobile menu-item-subcontainer-mobile menu-item-subsubcontainer-mobile js-cta-menu-subitem-mobile" data-id="<?php echo $menu_subsubitem->ID; ?>">
          <h4 class="menu-item-title-mobile menu-item-subtitle-mobile gray"><?php echo $menu_subsubitem->title; ?></h4>
          <img class="arrow-right" src="http://local.curling.ca/wp-content/themes/curling-main/images/arrow-right.svg" alt="triangle right">
        </div>
      </li>
    <?php
        }
      }
    ?>
    </ul>
    <div class="nav-menu-popout-bottom-mobile">
      <div class="menu-item menu-item-donate">
        <h4 class="menu-item-small inverted">Donate</h4>
      </div>
      <div class="nav-menu-social-mobile">
        <img class="menu-item-social" src="<?php echo get_stylesheet_directory_uri()."/images/icon-facebook.svg"; ?>" alt="social" />
        <img class="menu-item-social" src="<?php echo get_stylesheet_directory_uri()."/images/icon-twitter.svg"; ?>" alt="social" />
        <img class="menu-item-social" src="<?php echo get_stylesheet_directory_uri()."/images/icon-instagram.svg"; ?>" alt="social" />
        <img class="menu-item-social" src="<?php echo get_stylesheet_directory_uri()."/images/icon-youtube.svg"; ?>" alt="social" />
        <img class="menu-item-social" src="<?php echo get_stylesheet_directory_uri()."/images/icon-linkedin.svg"; ?>" alt="social" />
      </div>
    </div>
  </div>
<?php
  }
}
?>

<?php
function create_menu_bar_item($parent_id, $menu_items) {
  if (count($menu_items) > 0) {
      create_menu_bar($parent_id, $menu_items);

      foreach( $menu_items as $id => $menu_item ) {
          if ($menu_item->children) {
              create_menu_bar_item($menu_item->ID, $menu_item->children);
          }
      }
  }
}
?>
<?php
function create_menu_bar($name, $menu_items) {
  if ($menu_items && count($menu_items) > 0) {
    $first_item = array_shift($menu_items);
    $is_events = $first_item->title === '[EVENTS]';
?>
  <div class="nav-menu-popup <?php echo $is_events ? 'nav-menu-popup-event' : 'nav-left-offset'; ?>" data-name="<?php echo $name; ?>">
    <div class="nav-menu-popup-wrapper content-fixed content-fixed-padding">
      <div class="<?php echo $is_events ? 'nav-menu-popup-event-left' : 'nav-menu-popup-left'; ?>">
        <?php
          if ($is_events) {
        ?>
          <h2 class="menu-event-h2 gray">EXPLORE ALL UPCOMING EVENTS</h2>
          <ul class="menu-nav menu-nav-events">
            <li class="menu-subitem menu-subitem-event">
              <div class="menu-subitem-wrapper menu-item-selectable">
                <span class="menu-item-content menu-item-title menu-item-subtitle gray">HOME HARDWARE CANADA CUP</span>
                <span class="menu-item-content menu-item-title menu-item-subtitle menu-item-info gray">November 27–Dececember 1, 2019</span>
              </div>
              <img class="arrow-right" src="<?php echo get_stylesheet_directory_uri()."/images/arrow-right.svg"; ?>" alt="arrow-right" />
            </li>
            <li class="menu-subitem menu-subitem-event">
              <div class="menu-subitem-wrapper menu-item-selectable">
                <span class="menu-item-content menu-item-title menu-item-subtitle gray">CONTINENTAL CUP</span>
                <span class="menu-item-content menu-item-title menu-item-subtitle menu-item-info gray">January 9–12, 2020</span>
              </div>
              <img class="arrow-right" src="<?php echo get_stylesheet_directory_uri()."/images/arrow-right.svg"; ?>" alt="arrow-right" />
            </li>
            <li class="menu-subitem menu-subitem-event">
              <div class="menu-subitem-wrapper menu-item-selectable">
                <span class="menu-item-content menu-item-title menu-item-subtitle gray">SCOTTIES TOURNAMENT OF HEARTS</span>
                <span class="menu-item-content menu-item-title menu-item-subtitle menu-item-info gray">February 15-23, 2020</span>
              </div>
              <img class="arrow-right" src="<?php echo get_stylesheet_directory_uri()."/images/arrow-right.svg"; ?>" alt="arrow-right" />
            </li>
            <li class="menu-subitem menu-subitem-event">
              <div class="menu-subitem-wrapper menu-item-selectable">
                <span class="menu-item-content menu-item-title menu-item-subtitle gray">TIM HORTONS BRIER</span>
                <span class="menu-item-content menu-item-title menu-item-subtitle menu-item-info gray">February 28–March 8, 2020</span>
              </div>
              <img class="arrow-right" src="<?php echo get_stylesheet_directory_uri()."/images/arrow-right.svg"; ?>" alt="arrow-right" />
            </li>
            <li class="menu-subitem menu-subitem-event">
              <div class="menu-subitem-wrapper menu-item-selectable">
                <span class="menu-item-content menu-item-title menu-item-subtitle gray">WORLD WOMEN’S CURLING CHAMPIONSHIP</span>
                <span class="menu-item-content menu-item-title menu-item-subtitle menu-item-info gray">March 14-22, 2020</span>
              </div>
              <img class="arrow-right" src="<?php echo get_stylesheet_directory_uri()."/images/arrow-right.svg"; ?>" alt="arrow-right" />
            </li>
          </ul>
        <?php
          } else {
        ?>
          <h2 class="menu-h2 gray"><?php echo $first_item->title; ?></h2>
          <div class="menu-item-selectable">
            <span class="menu-item-content menu-item-title menu-item-subtitle gray">SEE ALL</span>
            <img class="arrow-right" src="<?php echo get_stylesheet_directory_uri()."/images/arrow-right.svg"; ?>" alt="arrow-right" />
          </div>
        <?php
          }
        ?>
      </div>
      <div class="<?php echo $is_events ? 'nav-menu-popup-event-centre' : 'nav-menu-popup-centre'; ?>">
        <?php
          if ($is_events) {
        ?>
          <img class="event-item" src="<?php echo get_stylesheet_directory_uri()."/images/img-event-sample1.png"; ?>" alt="Event1" />
          <img class="event-item" src="<?php echo get_stylesheet_directory_uri()."/images/img-event-sample2.png"; ?>" alt="Event2" />
        <?php
          } else {
        ?>
        <ul class="nav-menu-popup-centre-menu-nav">
          <?php
            foreach( $menu_items as $menu_item ) {
          ?>
            <li class="nav-menu-popup-centre-menu-subitem menu-subitem">
              <div class="menu-item-selectable">
                <span class="menu-item-content menu-item-title menu-item-subtitle gray"><?php echo $menu_item->title; ?></span>
                <img class="menu-item-content arrow-right" src="<?php echo get_stylesheet_directory_uri()."/images/arrow-right.svg"; ?>" alt="arrow-right" />
              </div>
            </li>
          <?php
            }
          ?>
        </ul>
        <?php
          }
        ?>
      </div>
      <div class="<?php echo $is_events ? 'nav-menu-popup-event-right' : 'nav-menu-popup-right'; ?>">
        <img class="ad" src="<?php echo get_stylesheet_directory_uri()."/images/img-ad-sample.png"; ?>" alt="Ad" />
      </div>
    </div>
  </div>
<?php 
    }
  }
?>
