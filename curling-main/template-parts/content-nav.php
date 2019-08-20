<?php
    $top_left_menu_items = wp_get_nav_menu_items( 'Menu - Top Left' );
    $top_right_menu_items = wp_get_nav_menu_items( 'Menu - Top Right' );
    $primary_menu_items = wp_get_nav_menu_items( 'Menu - Main' );

    $header_config = isset($header_config) ? $header_config : null;
    $header_color = parse_config($header_config, 'header_color', 'red');

    $menu_items = buildTree($primary_menu_items);

    function buildTree( array &$elements, $parentId = 0 ) {
        $branch = array();
        foreach ( $elements as &$element )
        {
            if ( $element->menu_item_parent == $parentId )
            {
                $children = buildTree( $elements, $element->ID );
                if ( $children )
                    $element->children = $children;

                $branch[$element->ID] = $element;
                unset( $element );
            }
        }
        return $branch;
    }

?>

<div class="header header-<?php echo $header_color; ?>">
    <div class="nav-menu-top">
        <div class="nav-menu-top-wrapper content-fixed content-fixed-padding">
            <div class="nav-menu-top-left-wrapper">
                <?php
                    if ($top_left_menu_items) {
                ?>
                    <ul class="menu-nav">
                        <?php
                            $is_first = true; // TODO: TEMP
                            foreach( $top_left_menu_items as $menu_item ) {
                        ?>
                            <li class="menu-item"><h4 class="menu-item-title <?php echo $is_first ? 'menu-item-selected' : ''; ?>"><?php echo $menu_item->title; ?></h4></li>
                        <?php
                              $is_first = false;
                            }
                        ?>
                    </ul>
                <?php
                    }
                ?>
            </div>
            <div class="nav-menu-top-right-wrapper">
                <?php
                    if ($top_right_menu_items) {
                ?>
                    <ul class="menu-nav">
                        <?php
                            foreach( $top_right_menu_items as $menu_item ) {
                        ?>
                            <li class="menu-item"><h4 class="menu-item-title menu-item-small"><?php echo $menu_item->title; ?></h4></li>
                        <?php
                            }
                        ?>
                        <li class="menu-item menu-item-donate"><h4 class="menu-item-title menu-item-small">Donate</h4></li>
                    </ul>
                    <ul class="menu-nav menu-nav-language">
                        <li class="menu-item menu-item-language"><h4 class="menu-item-title menu-item-small">Fr</h4></li>
                    </ul>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="nav-menu-primary">
        <div class="nav-menu-primary-wrapper content-fixed content-fixed-padding">
            <img class="menu-logo" src="<?php echo get_stylesheet_directory_uri()."/images/logo-main.svg"; ?>" alt="Site Logo" />
            <?php
                if ($primary_menu_items) {
            ?>
                <ul class="menu-nav nav-left-offset">
                    <?php
                        foreach ($menu_items as $id => $item) {
                            $test = $item->children;
                    ?>
                        <li class="menu-item" data-menu="<?php echo $id; ?>">
                            <h4 class="menu-item-title"><?php echo $item->title; ?></h4>
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
          <h2 class="menu-h2 gray">EXPLORE ALL UPCOMING EVENTS</h2>
          <ul class="menu-nav menu-nav-events">
            <li class="menu-subitem menu-subitem-event">
              <div class="menu-subitem-wrapper">
                <span class="menu-item-title menu-item-subtitle gray">HOME HARDWARE CANADA CUP</span>
                <span class="menu-item-title menu-item-subtitle menu-item-info gray">November 27–Dececember 1, 2019</span>
              </div>
              <img class="arrow-right" src="<?php echo get_stylesheet_directory_uri()."/images/arrow-right.svg"; ?>" alt="arrow-right" />
            </li>
            <li class="menu-subitem menu-subitem-event">
              <div class="menu-subitem-wrapper">
                <span class="menu-item-title menu-item-subtitle gray">CONTINENTAL CUP</span>
                <span class="menu-item-title menu-item-subtitle menu-item-info gray">January 9–12, 2020</span>
              </div>
              <img class="arrow-right" src="<?php echo get_stylesheet_directory_uri()."/images/arrow-right.svg"; ?>" alt="arrow-right" />
            </li>
            <li class="menu-subitem menu-subitem-event">
              <div class="menu-subitem-wrapper">
                <span class="menu-item-title menu-item-subtitle gray">SCOTTIES TOURNAMENT OF HEARTS</span>
                <span class="menu-item-title menu-item-subtitle menu-item-info gray">February 15-23, 2020</span>
              </div>
              <img class="arrow-right" src="<?php echo get_stylesheet_directory_uri()."/images/arrow-right.svg"; ?>" alt="arrow-right" />
            </li>
            <li class="menu-subitem menu-subitem-event">
              <div class="menu-subitem-wrapper">
                <span class="menu-item-title menu-item-subtitle gray">TIM HORTONS BRIER</span>
                <span class="menu-item-title menu-item-subtitle menu-item-info gray">February 28–March 8, 2020</span>
              </div>
              <img class="arrow-right" src="<?php echo get_stylesheet_directory_uri()."/images/arrow-right.svg"; ?>" alt="arrow-right" />
            </li>
            <li class="menu-subitem menu-subitem-event">
              <div class="menu-subitem-wrapper">
                <span class="menu-item-title menu-item-subtitle gray">WORLD WOMEN’S CURLING CHAMPIONSHIP</span>
                <span class="menu-item-title menu-item-subtitle menu-item-info gray">March 14-22, 2020</span>
              </div>
              <img class="arrow-right" src="<?php echo get_stylesheet_directory_uri()."/images/arrow-right.svg"; ?>" alt="arrow-right" />
            </li>
          </ul>
        <?php
          } else {
        ?>
          <h2 class="menu-h2 gray"><?php echo $first_item->title; ?></h2>
          <span class="menu-item-title menu-item-subtitle gray">SEE ALL</span><img class="arrow-right" src="<?php echo get_stylesheet_directory_uri()."/images/arrow-right.svg"; ?>" alt="arrow-right" />
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
            <li class="nav-menu-popup-centre-menu-subitem menu-subitem"><span class="menu-item-title menu-item-subtitle gray"><?php echo $menu_item->title; ?></span><img class="arrow-right" src="<?php echo get_stylesheet_directory_uri()."/images/arrow-right.svg"; ?>" alt="arrow-right" /></li>
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
