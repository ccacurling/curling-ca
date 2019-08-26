<?php
    $top_right_menu_items = wp_get_nav_menu_items( 'Menu - Top Right' );
    $primary_menu_items = wp_get_nav_menu_items( 'Menu - Main' );

    $header_config = isset($header_config) ? $header_config : null;
    $header_color = parse_config($header_config, 'header_color', 'red');

    $current_page = 497698; // TODO: FIX!
    
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

<div class="header header-<?php echo $header_color; ?> header-mobile">
  <div class="nav-menu-top-mobile">
    <img class="menu-logo-mobile" src="<?php echo get_stylesheet_directory_uri()."/images/logo-main.svg"; ?>" alt="Site Logo" />
    <img class="menu-hamburger-mobile" src="<?php echo get_stylesheet_directory_uri()."/images/img-hamburger.svg"; ?>" alt="Hamburger" />
  </div>
  <div class="nav-menu-popout-mobile">
    <div class="menu-nav-popout-item" data-id="0" data-parent="-1">
      <div class="nav-menu-top-right-mobile">
          <ul class="menu-nav">
          <?php
              foreach( $top_right_menu_items as $menu_item ) {
          ?>
              <h4 class="menu-item menu-item-small inverted"><?php echo $menu_item->title; ?></h4>
          <?php
              }
          ?>
          </ul>
      </div>
      <?php
        create_popout_item($menu_items, 0);
      ?>
    </div>
    <?php
      foreach ($menu_items as $key => $menu_item) {
        create_popout($menu_item, 1);
      }
    ?>
  </div>
</div>

<div class="header header-<?php echo $header_color; ?> header-desktop">
    <div class="nav-menu-top content-fixed">
        <div class="nav-menu-top-wrapper content-container">
            <div class="nav-menu-top-left-wrapper">
                <ul class="menu-nav">
                    <?php
                        foreach( $menu_items as $menu_item ) {
                    ?>
                        <li class="menu-item menu-item-selectable">
                          <h4 class="menu-item-top-nav menu-item-content <?php echo $menu_item->ID === $current_page ? 'menu-item-selected' : ''; ?>"><?php echo $menu_item->title; ?></h4>
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
                              <h4 class="menu-item-content menu-item-small"><?php echo $menu_item->title; ?></h4>
                            </li>
                        <?php
                            }
                        ?>
                        <li class="menu-item menu-item-donate">
                          <h4 class="menu-item-small inverted">Donate</h4>
                        </li>
                    </ul>
                    <ul class="menu-nav menu-nav-language">
                        <li class="menu-item menu-item-language menu-item-selectable">
                          <h4 class="menu-item-content menu-item-small">Fr</h4>
                        </li>
                    </ul>
                <?php
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
                            <h4 class="menu-item-content menu-item-title"><?php echo $item->title; ?></h4>
                            <?php 
                                if ($item->children != null && count($item->children) > 0) {
                            ?>
                                <img class="menu-item-arrow" src="<?php echo get_stylesheet_directory_uri()."/images/triangle-down.svg"; ?>" alt="Triangle" />
                            <?php
                                }
                            ?>
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
</div>

<?php
function create_popout($menu_item, $level) {
  if (isset($menu_item->children) && count ($menu_item->children) > 0) {
    foreach ($menu_item->children as $key => $menu_subitem) {
      if (isset($menu_subitem->children) && count ($menu_subitem->children) > 0) {
?>
        <div class="menu-nav-popout-item" data-id="<?php echo $menu_subitem->ID; ?>" data-parent="0">
          <div class="nav-menu-top-right-mobile">
            <img src="<?php echo get_stylesheet_directory_uri()."/images/triangle-left-white.svg"; ?>" alt="triangle left" />
              <h3 class="menu-item inverted"><?php echo $menu_subitem->title; ?></h3>
          </div>
          <?php
            create_popout_item($menu_subitem->children, $level);
          ?>
        </div>
<?php
      }
    }
  }
}

function create_popout_item($menu_items, $level) {
?>
  <div class="nav-menu-mobile">
    <?php
      if ($menu_items) {
    ?>
      <ul class="nav-menu-list-mobile">
        <?php
          foreach( $menu_items as $menu_item ) {
        ?>
          <li class="menu-item-mobile menu-item-main-mobile">
            <div class="menu-item-container-mobile">
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
              create_submenu($menu_item, $level);
            ?>
          </li>
        <?php
          }
        ?>
      </ul>
    <?php
      }
    ?>
  </div>
<?php
}
?>

<?php
function create_submenu($items, $level) {
    if (isset($items->children) && count ($items->children) > 0) {
      $extras = [];
?>
        <ul class="menu-list">
<?php
        foreach( $items->children as $menu_subitem ) {
          if ($level > 0) {
            array_push($extras, $menu_subitem);
          }
?>
            <li class="menu-item-mobile">
                <div class="menu-item-container-mobile menu-item-subcontainer-mobile blex" data-id="<?php echo $menu_subitem->ID; ?>">
                    <h4 class="menu-item-title-mobile menu-item-subtitle-mobile gray"><?php echo $menu_subitem->title.' '.$level; ?></h4>
                    <?php
                        if (isset($menu_subitem->children) && count ($menu_subitem->children) > 0) {
                    ?>
                        <img class="arrow-right" src="<?php echo get_stylesheet_directory_uri()."/images/triangle-left.svg"; ?>" alt="triangle right" />
                    <?php
                        }
                    ?>
                </div>
    <?php
        }
    ?>
            </li>
        </ul>
<?php
      foreach ($extras as $key => $value) {
        create_popout($value, $level + 1);
      }
    }
}

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
