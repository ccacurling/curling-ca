<?php
    global $wp;
    $current_page_title = get_the_title();
    $current_page_id = get_the_id();

    $shop_link = get_field( 'settings_shop_link', 'Options' );
    $donate_link = get_field( 'settings_donate_link', 'Options' );

    $is_event = get_field('is_event', 'Options');

    $logo = get_field('event_logo', 'Options');

    $about_curling_pages = get_field('about_curling_pages', 'Options');
    if ( !is_array($about_curling_pages) ) {
      $about_curling_pages = array();
    }


    $is_about_curling = false;

    foreach ($about_curling_pages as $key => $page) {
      if ($page->ID === $current_page_id) {
        $is_about_curling = true;
        break;
      }
    }

    $our_organization_pages = get_field('our_organization_pages', 'Options');
    if ( !is_array($our_organization_pages) ){
      $our_organization_pages = array();
    }
    $is_our_organization = false;

    foreach ($our_organization_pages as $key => $page) {
      if ($page->ID === $current_page_id) {
        $is_our_organization = true;
        break;
      }
    }

    $category = null;
    $category_slug = '';
    $is_category = is_category();

    $home_url = get_home_url().'/';

    $top_nav_ad_type = get_field( 'top_nav_ad_type', 'Options');
    $adsnippet = '';
    if ( $top_nav_ad_type == 'custom' ) {
      $adsnippet = get_field('adsnippet');
    } else if ( $top_nav_ad_type == 'square' ) {
      $adsnippet = get_field('ad_snippet_square', 'Options');
    } else {
      $adsnippet = get_field('ad_snippet_square_national', 'Options');
    }

    $site_list = [];

    $current_language = [
      'code' => 'en',
      'url' => get_permalink()
    ];
    $translation_language = [
      'code' => 'fr',
      'url' => get_permalink()
    ];
    $languages = function_exists('icl_get_languages') ? icl_get_languages() : [];
    foreach ($languages as $key => $language) {
      if ($language['active']) {
        $current_language = $language;
      } else {
        $translation_language = $language;
      }
    }

    $current_menu_item = null;

    if (!$is_event) {
      if (function_exists( "get_sites" )) {
        $sites = get_sites();
      }

      $site_list = array_filter($sites, function($site) {
        switch_to_blog($site->blog_id);
        $is_event = get_field( 'is_event', 'Options' );
        $has_not_passed = false;
        if ($is_event) {
          $event_date_end = get_field( 'event_date_end', 'option' );
          $end = strtotime($event_date_end);
          $current = time();
          $has_not_passed = $current <= $end;
        }
        restore_current_blog();
        return $is_event && $has_not_passed;
      });

      usort($site_list, function($a, $b) {
        switch_to_blog($a->blog_id);
        $astart = get_field( 'event_date_start', 'option' );
        restore_current_blog();
        switch_to_blog($b->blog_id);
        $bstart = get_field( 'event_date_start', 'option' );
        restore_current_blog();
        return ($astart < $bstart) ? -1 : 1; 
      });
    }

    if ($is_category) {
      $category = get_queried_object();
      $category_slug = $category->slug;
    }

    $top_left_menu_items = wp_get_nav_menu_items( 'Menu - Top Left' ) ? wp_get_nav_menu_items( 'Menu - Top Left' ) : [];
    $top_right_menu_items = wp_get_nav_menu_items( 'Menu - Top Right' ) ? wp_get_nav_menu_items( 'Menu - Top Right' ) : [];
    $primary_menu_items = [];
    
    if ($is_our_organization) {
      $primary_menu_items = wp_get_nav_menu_items( 'Menu - Our Organization' );
    } else if ($is_about_curling) {
      $primary_menu_items = wp_get_nav_menu_items( 'Menu - About Curling' );
    } else if ($is_event) {
      $primary_menu_items = wp_get_nav_menu_items( 'Menu - Events' );
    } else {
      $primary_menu_items = wp_get_nav_menu_items( 'Menu - Main' );
    }

    $header_config = isset($header_config) ? $header_config : null;
    $header_color = parse_config($header_config, 'header_color', 'red');

    $url = $is_category && $category ? get_category_link($category) : get_permalink();
    
    $menu_item_tree = $primary_menu_items ? buildTree($primary_menu_items, 0, $url === get_home_url() ? '' : $url) : [];

    $is_submenu = $primary_menu_items ? $menu_item_tree['is_current'] : false;
    $menu_items = $primary_menu_items ? $menu_item_tree['branch'] : [];

    function buildTree( array &$elements, $parentId = 0, $url = '' ) {
        $branch = array();
        $is_current = false;
        $is_event_menu = false;

        foreach ( $elements as &$element ) {
            if ( $element->menu_item_parent == $parentId ) {
                $tree = buildTree( $elements, $element->ID, $url );
                $children = $tree['branch'];
                $element_url = $element->url;
                $is_event_menu = $element->post_title == '[EVENTS]';

                if ($element_url === $url) {
                  $element->is_current_page = true;
                  $is_current = true;
                }
                if ($tree['is_current']) {
                  $element->is_current_page = true;
                  $is_current = true;
                }
                if ($is_event_menu) {
                  $element->is_event_menu = true;
                }
                if ($tree['is_event_menu']) {
                  $element->is_event_menu = true;
                }
                if ( $children ) {
                    $element->children = $children;
                }

                $branch[$element->ID] = $element;
                unset( $element );
            }
        }
        return [
          'branch' => $branch,
          'is_current' => $is_current,
          'is_event_menu' => $is_event_menu
        ];
    }

?>

<div class="header header-mobile <?php echo $is_event ? 'header-event' : 'header-main'; ?> js-curling-nav-mobile">
  <div class="nav-menu-top-mobile <?php echo $is_submenu ? 'nav-menu-top-submenu-mobile' : ''; ?> js-cta-topmenu-mobile">
    <div></div>
    <a href="<?php echo get_home_url(); ?>">
        <img class="menu-logo-mobile" src="<?php echo get_stylesheet_directory_uri()."/images/logo-main.svg"; ?>" alt="Site Logo" />
    </a>
    <img class="menu-hamburger-mobile js-cta-menu-mobile-hamburger" src="<?php echo get_stylesheet_directory_uri(); ?>/images/img-hamburger<?php echo $is_event ? '' : '-white'; ?>.svg" alt="Hamburger" />
  </div>
  <?php
    create_main_menu_mobile($top_right_menu_items, $menu_items, [
      'is_submenu' => $is_submenu,
      'current_page_title' => $current_page_title,
      'is_curling' => !($is_our_organization || $is_about_curling),
      'is_our_organization' => $is_our_organization,
      'is_about_curling' => $is_about_curling,
      'is_event' => $is_event,
    ], $top_left_menu_items, $translation_language);
    create_submenus_mobile($menu_items);
  ?>
</div>

<div class="header header-desktop <?php echo $is_event ? 'header-event' : 'header-main'; ?> js-curling-nav">
  <div class="nav-menu-top-container">
    <div class="nav-menu-top">
      <div class="nav-menu-top-wrapper content-container">
        <div class="nav-menu-top-left-wrapper">
          <?php
            if ($is_event) {
          ?>
            <a href="<?php echo get_home_url(); ?>">
              <img class="menu-event-logo" src="<?php echo $is_event ? get_stylesheet_directory_uri()."/images/logo-event.svg" : ''; ?>" alt="logo" />
            </a>
          <?php
            }
          ?>
          <ul class="menu-top-nav menu-nav">
            <?php
              foreach( $top_left_menu_items as $menu_item ) {
                $is_our_organization_menu = false;
                $is_about_curling_menu = false;
                if ($is_our_organization) {
                  foreach ($our_organization_pages as $key => $page) {
                    if ($page->ID == $menu_item->object_id) {
                      $is_our_organization_menu = true;
                      break;
                    }
                  }
                } else if ($is_about_curling) {
                  foreach ($about_curling_pages as $key => $page) {
                    if ($page->ID == $menu_item->object_id) {
                      $is_about_curling_menu = true;
                      break;
                    }
                  }
                }
            ?>
              <li class="menu-item menu-item-selectable <?php echo $menu_item->url && (($home_url === $menu_item->url && !$is_our_organization && !$is_about_curling) || ($is_our_organization && $is_our_organization_menu) || ($is_about_curling && $is_about_curling_menu)) ? 'menu-item-top-nav-selected' : ''; ?>">
                <?php
                  if ($menu_item->url) {
                ?>
                  <a class="clear" href="<?php echo $menu_item->url; ?>">
                <?php
                  }
                ?>
                  <h4 class="menu-item-top-nav menu-item-content menu-item-link gray"><?php echo $menu_item->title; ?></h4>
                <?php
                  if ($menu_item->url) {
                ?>
                  </a>
                <?php
                  }
                ?>
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
                  <?php
                    if ($menu_item->url) {
                  ?>
                    <a class="clear" href="<?php echo $menu_item->url; ?>">
                  <?php
                    }
                  ?>
                    <h4 class="menu-item-content menu-item-small menu-item-link gray"><?php echo $menu_item->title; ?></h4>
                  <?php
                    if ($menu_item->url) {
                  ?>
                    </a>
                  <?php
                    }
                  ?>
                </li>
              <?php
                }
              ?>
              <li class="menu-item menu-item-selectable search-menu">
                <a class="clear search-menu-link" href="#">
                  <h4 class="menu-item-content menu-item-small menu-item-link gray"><?php echo __("Search"); ?></h4>
                </a>
              </li>
              <li class="search-bar hide">
                <?php echo do_shortcode("[wpdreams_ajaxsearchlite]"); ?>
              </li>
              <li class="btn menu-item menu-item-donate">
                <pre class='debug' style='display: none;'>
                <?php var_dump($donate_link); ?>
                </pre>
                <a class="menu-item-donate-link clear" href="<?php echo $donate_link["url"]; ?>">
                  
                  <h4 class="menu-item-small inverted"><?php echo __("Donate", "curling-main-theme"); ?></h4>
                </a>
              </li>
            </ul>
            <ul class="menu-nav menu-nav-language">
              <li class="menu-item menu-item-language menu-item-selectable">
                <a class="clear" href="<?php echo $translation_language['url']; ?>">
                  <h4 class="menu-item-content menu-item-small gray"><?php echo $translation_language['code']; ?></h4>
                </a>
              </li>
            </ul>
          <?php
            }
          ?>
        </div>
      </div>
    </div>
  </div>

  <div class="nav-menu-primary-container">
    <div class="nav-menu-primary <?php echo $is_event ? 'nav-menu-primary-event' : ''; ?>">
      <div class="nav-menu-primary-wrapper content-container">
        <?php
          if ($logo) {
        ?>
          <a href="<?php echo get_home_url(); ?>">
            <img class="menu-logo" src="<?php echo $logo['url']; ?>" alt="Site Logo" />
          </a>
        <?php
          }
        ?>
        <ul class="menu-nav nav-left-offset">
          <?php
            foreach ($menu_items as $id => $item) {
          ?>
            <li class="menu-item <?php echo $item->is_current_page ? 'menu-item-selected' : ''; ?> <?php echo !$item->url || $item->url === '#' ? 'no-link' : ''; ?>" data-menu="<?php echo $id; ?>">
              <?php
                if ($item->url && $item->url !== '#') {
              ?>
                <a class="menu-item-link" href="<?php echo $item->url; ?>">
              <?php
                }
              ?>
              <h4 class="menu-item-content menu-item-title <?php echo !$item->url || $item->url === '#'? 'menu-item-link' : ''; ?>"><?php echo $item->title; ?></h4>
              <?php 
                if ($item->children != null && count($item->children) > 0) {
              ?>
                <img class="menu-item-arrow" src="<?php echo get_stylesheet_directory_uri()."/images/triangle-down".($is_event ? '-gray' : '').".svg"; ?>" alt="Triangle" />
              <?php
                }
              ?>
              <?php
                if ($item->url && $item->url !== '#') {
              ?>
                </a>
              <?php
                }
              ?>
            </li>
          <?php
            }
          ?>
        </ul>
        <?php
          if ($is_event) {
        ?>
          <div class="nav-menu-popup-container">
            <?php
              foreach( $menu_items as $id => $menu_item ) {
                if ($menu_item->is_event_menu) {
                  create_menu_bar_event_item($menu_item->ID, $site_list, $adsnippet);
                } else if ($menu_item->children) {
                  if ($menu_item->is_current_page && $current_menu_item == null) {
                    $current_menu_item = [
                      'id' => $menu_item->ID, 
                      'children' => $menu_item->children
                    ];
                  } else {
                    create_menu_bar_simple_item($menu_item->ID, $menu_item->children);
                  }
                }
              }
            ?>
            <?php
              if ($current_menu_item && $is_event) {
                create_menu_bar_simple_item($current_menu_item['id'], $current_menu_item['children'], true, $is_event);
              }
            ?>
          </div>
        <?php
          }
        ?>
      </div>
    </div>

    <?php
      if (!$is_event) {
    ?>
      <div class="nav-menu-popup-container">
        <?php
          foreach( $menu_items as $id => $menu_item ) {
            if ($menu_item->is_event_menu) {
              create_menu_bar_event_item($menu_item->ID, $site_list, $adsnippet);
            } else if ($menu_item->children) {
              if ($menu_item->is_current_page && $current_menu_item == null) {
                $current_menu_item = [
                  'id' => $menu_item->ID, 
                  'children' => $menu_item->children
                ];
              } else {
                create_menu_bar_simple_item($menu_item->ID, $menu_item->children);
              }
            }
          }
        ?>
      </div>
    <?php
      }
    ?>
  </div>
  <?php
    if ($current_menu_item && !$is_event) {
      create_menu_bar_simple_item($current_menu_item['id'], $current_menu_item['children'], true, $is_event);
    }
  ?>
</div>

<?php
function create_main_menu_mobile($top_menu_items, $nav_items, $options = [], $top_level_menu, $translation_language) { ?>
  <div class="nav-menu-popout-mobile <?php echo $options['is_submenu'] ? 'nav-menu-popout-submenu-mobile' : ''; ?> js-cta-popout-mobile" data-id="0">
    <div class="nav-menu-top-right-mobile <?php echo $options['is_submenu'] ? 'js-nav-title-mobile' : ''; ?>">
      <div class="menu-nav-mobile <?php echo $options['is_submenu'] ? 'menu-submenunav-mobile' : ''; ?>">
      <?php
        if ($options['is_submenu']) {
      ?>
        <h3 class="nav-menu-item-mobile"><?php echo $options['current_page_title']; ?></h3><img src="<?php echo get_stylesheet_directory_uri()."/images/triangle-down.svg"; ?>" alt="Triangle" />
      <?php
        } else {
      ?>
        <?php
            foreach( $top_menu_items as $menu_item ) {
        ?>
          <?php
            if ($menu_item->url) {
          ?>
            <a class="clear" href="<?php echo $menu_item->url; ?>">
          <?php
            }
          ?>
            <h4 class="nav-menu-item-mobile"><?php echo $menu_item->title; ?></h4>
          <?php
            if ($menu_item->url) {
          ?>
            </a>
          <?php
            }
          ?>
        <?php
          }
        ?>
      <?php
        }
      ?>
      </div>
      <div class="mobile-language-selector">
        <a class="clear" href="<?php echo $translation_language['url']; ?>">
          <h4 class="menu-item-content menu-item-small"><?php echo $translation_language['code']; ?></h4>
        </a>
      </div>
    </div>
    <div class="menu-list-container-mobile">
      
      <?php //Check which Site Area we're on 
      //print_r($top_level_menu); ?>

      <?php if ( $options['is_curling'] ) : ?>

        <ul class="menu-list-mobile js-cta-menu-list-mobile" <?php echo $top_level_menu[0]->url ? 'data-link="'.$top_level_menu[0]->url.'"' : ''; ?>>
          <li class="menu-item-mobile menu-item-main-mobile">
            <div class="menu-item-container-mobile js-cta-menu-item-mobile ultra-top-level">
              <h4 class="menu-item-title-mobile inverted"><?php echo $top_level_menu[0]->title; ?></h4>
            </div>
          </li>
        </ul>

      <?php elseif ( $options['is_about_curling'] ) : ?>
      
        <ul class="menu-list-mobile js-cta-menu-list-mobile" <?php echo $top_level_menu[0]->url ? 'data-link="'.$top_level_menu[0]->url.'"' : ''; ?>>
          <li class="menu-item-mobile menu-item-main-mobile">
            <div class="menu-item-container-mobile js-cta-menu-item-mobile ultra-top-level">
              <h4 class="menu-item-title-mobile inverted"><?php echo $top_level_menu[0]->title; ?></h4>
            </div>
          </li>
        </ul>
        <ul class="menu-list-mobile js-cta-menu-list-mobile" <?php echo $top_level_menu[1]->url ? 'data-link="'.$top_level_menu[1]->url.'"' : ''; ?>>
          <li class="menu-item-mobile menu-item-main-mobile">
            <div class="menu-item-container-mobile js-cta-menu-item-mobile ultra-top-level">
              <h4 class="menu-item-title-mobile inverted"><?php echo $top_level_menu[1]->title; ?></h4>
            </div>
          </li>
        </ul>

      <?php elseif ( $options['is_our_organization'] ) : ?>

        <ul class="menu-list-mobile js-cta-menu-list-mobile" <?php echo $top_level_menu[0]->url ? 'data-link="'.$top_level_menu[0]->url.'"' : ''; ?>>
          <li class="menu-item-mobile menu-item-main-mobile">
            <div class="menu-item-container-mobile js-cta-menu-item-mobile ultra-top-level">
              <h4 class="menu-item-title-mobile inverted"><?php echo $top_level_menu[0]->title; ?></h4>
            </div>
          </li>
        </ul>
        <ul class="menu-list-mobile js-cta-menu-list-mobile" <?php echo $top_level_menu[1]->url ? 'data-link="'.$top_level_menu[1]->url.'"' : ''; ?>>
          <li class="menu-item-mobile menu-item-main-mobile">
            <div class="menu-item-container-mobile js-cta-menu-item-mobile ultra-top-level">
              <h4 class="menu-item-title-mobile inverted"><?php echo $top_level_menu[1]->title; ?></h4>
            </div>
          </li>
        </ul>
        <ul class="menu-list-mobile js-cta-menu-list-mobile" <?php echo $top_level_menu[2]->url ? 'data-link="'.$top_level_menu[2]->url.'"' : ''; ?>>
          <li class="menu-item-mobile menu-item-main-mobile">
            <div class="menu-item-container-mobile js-cta-menu-item-mobile ultra-top-level">
              <h4 class="menu-item-title-mobile inverted"><?php echo $top_level_menu[2]->title; ?></h4>
            </div>
          </li>
        </ul>

      <?php endif; ?>
      
      <?php
          foreach( $nav_items as $menu_item ) {
      ?>
        <ul class="menu-list-mobile js-cta-menu-list-mobile" <?php echo $menu_item->url ? 'data-link="'.$menu_item->url.'"' : ''; ?>>
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
                  <?php
                    if ($menu_subitem->url) {
                  ?>
                    <a class="clear" href="<?php echo $menu_subitem->url; ?>">
                  <?php
                    }
                  ?>
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
                  <?php
                    if ($menu_subitem->url) {
                  ?>
                    </a>
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
          </li>
        </ul>
      <?php
          }
      ?>

<?php if ( $options['is_curling'] ) : ?>

<ul class="menu-list-mobile js-cta-menu-list-mobile" <?php echo $top_level_menu[1]->url ? 'data-link="'.$top_level_menu[1]->url.'"' : ''; ?>>
  <li class="menu-item-mobile menu-item-main-mobile">
    <div class="menu-item-container-mobile js-cta-menu-item-mobile ultra-top-level">
      <h4 class="menu-item-title-mobile inverted"><?php echo $top_level_menu[1]->title; ?></h4>
    </div>
  </li>
</ul>
<ul class="menu-list-mobile js-cta-menu-list-mobile" <?php echo $top_level_menu[2]->url ? 'data-link="'.$top_level_menu[2]->url.'"' : ''; ?>>
  <li class="menu-item-mobile menu-item-main-mobile">
    <div class="menu-item-container-mobile js-cta-menu-item-mobile ultra-top-level">
      <h4 class="menu-item-title-mobile inverted"><?php echo $top_level_menu[2]->title; ?></h4>
    </div>
  </li>
</ul>

<?php elseif ( $options['is_about_curling'] ) : ?>

<ul class="menu-list-mobile js-cta-menu-list-mobile" <?php echo $top_level_menu[2]->url ? 'data-link="'.$top_level_menu[2]->url.'"' : ''; ?>>
  <li class="menu-item-mobile menu-item-main-mobile">
    <div class="menu-item-container-mobile js-cta-menu-item-mobile ultra-top-level">
      <h4 class="menu-item-title-mobile inverted"><?php echo $top_level_menu[2]->title; ?></h4>
    </div>
  </li>
</ul>

<?php elseif ( $options['is_our_organization'] ) : ?>



<?php endif; ?>


      <div class="nav-menu-popout-bottom-mobile">
        <div class="btn menu-item menu-item-donate">
          <a class="menu-item-donate-link clear" href="">
            <h4 class="menu-item-small inverted"><?php echo __("Donate"); ?></h4>
          </a>
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
    ?>
      <li class="menu-item-mobile">
        <div class="menu-item-container-mobile menu-item-subcontainer-mobile menu-item-subsubcontainer-mobile js-cta-menu-subitem-mobile" data-id="<?php echo $menu_subsubitem->ID; ?>">
          <h4 class="menu-item-title-mobile menu-item-subtitle-mobile gray"><?php echo $menu_subsubitem->title; ?></h4>
          <img class="arrow-right" src="<?php echo get_stylesheet_directory_uri() . "/images/arrow-right.svg"; ?>" alt="triangle right">
        </div>
      </li>
    <?php
      }
    ?>
    </ul>
    <div class="nav-menu-popout-bottom-mobile">
      <div class="btn menu-item menu-item-donate">
        <a class="menu-item-donate-link clear" href="">
          <h4 class="menu-item-small inverted"><?php echo __('Donate'); ?></h4>
        </a>
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
function create_menu_bar_event_item($parent_id, $site_list, $adsnippet = '') {
?>
  <div class="nav-menu-popup nav-menu-popup-event" data-name="<?php echo $parent_id; ?>">
    <div class="nav-menu-popup-wrapper content-fixed-padding">
      <div class="nav-menu-popup-event-left">
        <?php
            event_submenu($site_list);
        ?>
      </div>
      <div class="nav-menu-popup-event-centre">
        <?php event_posters($site_list); ?>
      </div>
      <div class="nav-menu-popup-event-right">
        <?php
          if ($adsnippet) {
            echo $adsnippet; 
          }
        ?>
      </div>
    </div>
  </div>
<?php 
  }
?>

<?php
function create_menu_bar_simple_item($parent_id, $menu_items, $is_selected = false, $is_event = false) {
?>
  <div class="<?php echo $is_selected ? ($is_event ? 'nav-menu-popup nav-menu-popup-active' : 'nav-menu-popup-current') : 'nav-menu-popup'; ?>" <?php echo $is_selected ? '' : 'data-name="'.$parent_id.'"'; ?>>
    <ul class="nav-menu-popup-list">
      <?php
        foreach ($menu_items as $key => $menu_subitem) {
      ?>
        <li class="menu-event-subitem">
          <div class="menu-item-selectable <?php echo $menu_subitem->is_current_page ? 'menu-item-selected' : ''; ?>">
            <?php
              if ($menu_subitem->url) {
            ?>
              <a class="menu-item-selectable-text clear" href="<?php echo $menu_subitem->url; ?>">
            <?php
              }
            ?>
              <span class="menu-item-content menu-item-title menu-item-subtitle"><?php echo $menu_subitem->title; ?></span>
            <?php
              if ($menu_subitem->url) {
            ?>
              </a>
            <?php
              }
            ?>
            <div class="menu-item-underline"></div>
          </div>
        </li>
      <?php
        }
      ?>
    </ul>
  </div>
<?php
}
?>

<?php
  function event_submenu($site_list) {
    
?>
  <h2 class="menu-event-h2 gray"><?php echo __("EXPLORE ALL UPCOMING EVENTS"); ?></h2>
  <ul class="menu-nav menu-nav-events">
    <?php
      $i = 0;
      foreach ($site_list as $key => $site) {
        if ($i >= 5) {
          break;
        }
        switch_to_blog($site->blog_id);
        $name = get_field( 'event_name', 'option' );
        $start_date_value = get_field( 'event_date_start', 'Options' );
        $end_date_value = get_field( 'event_date_end', 'Options' );
        $timezone = get_field( 'event_timezone', 'Options' );
        $home_url = get_home_url( $site->blog_id );

        $start_date_value = $start_date_value ? $start_date_value.' '.$timezone : '2019-01-01 00:00:00 '.$timezone;
        $end_date_value = $end_date_value ? $end_date_value.' '.$timezone : '2019-01-01 00:00:00 '.$timezone;

        $start_date = date_create_from_format('Y-m-d H:i:s e', $start_date_value);
        $end_date = date_create_from_format('Y-m-d H:i:s e', $end_date_value);
        $current_date = new DateTime();

        $start_date_unix = $start_date ? date_format($start_date, 'U') : 0;
        $current_date_unix = date_format($current_date, 'U');

        $start_date_string = $start_date ? $start_date->format('F j') : '';
        $end_date_short_string = $end_date ? $end_date->format('F j') : '';
        $end_date_string = $end_date ? $end_date->format('F j Y') : '';
        
        $date = $start_date == $end_date ? ($end_date_string ? $end_date_string : $start_date_string) : ($end_date_string ? $start_date_string.'&nbsp;-&nbsp;'.$end_date_string : $start_date_string);
        restore_current_blog();
    ?>
      <li class="menu-subitem menu-subitem-event">
        <a class="clear" href="<?php echo $home_url; ?>">
          <div class="menu-subitem-wrapper menu-item-selectable">
            <span class="menu-item-content menu-item-title menu-item-subtitle gray"><?php echo $name; ?></span>
            <span class="menu-item-content menu-item-title menu-item-subtitle menu-item-info gray"><?php echo $date; ?></span>
          </div>
        </a>
        <img class="arrow-right" src="<?php echo get_stylesheet_directory_uri()."/images/arrow-right.svg"; ?>" alt="arrow-right" />
      </li>
    <?php
        $i++;
      }
    ?>
  </ul>
<?php
  }
?>

<?php
  function event_posters($site_list) {
?>
  <ul class="menu-nav-events-centre-list menu-nav menu-nav-events">
    <?php
      $i = 0;
      foreach ($site_list as $key => $site) {
        if ($i >= 2) {
          break;
        }
        switch_to_blog($site->blog_id);
        $name = get_field( 'event_name', 'option' );
        $start_date_value = get_field( 'event_date_start', 'Options' );
        $end_date_value = get_field( 'event_date_end', 'Options' );
        $timezone = get_field( 'event_timezone', 'Options' );

        $start_date_value = $start_date_value ? $start_date_value.' '.$timezone : '2019-01-01 00:00:00 '.$timezone;
        $end_date_value = $end_date_value ? $end_date_value.' '.$timezone : '2019-01-01 00:00:00 '.$timezone;

        $start_date = date_create_from_format('Y-m-d H:i:s e', $start_date_value);
        $end_date = date_create_from_format('Y-m-d H:i:s e', $end_date_value);
        $current_date = new DateTime();

        $start_date_unix = $start_date ? date_format($start_date, 'U') : 0;
        $current_date_unix = date_format($current_date, 'U');

        $start_date_string = $start_date ? $start_date->format('F j') : '';
        $end_date_short_string = $end_date ? $end_date->format('F j') : '';
        $end_date_string = $end_date ? $end_date->format('F j Y') : '';
        
        $date = $start_date == $end_date ? ($end_date_string ? $end_date_string : $start_date_string) : ($end_date_string ? $start_date_string.'&nbsp;-&nbsp;'.$end_date_string : $start_date_string);

        $logo = get_field('event_logo', 'options');
        $location = get_field ('event_location_title', 'options' );
        $url = get_home_url();
        $tickets_link = get_field ('event_buy_tickets_link', 'options' );

        restore_current_blog();
    ?>
      <li class="menu-event-poster">
        <div class="menu-event-poster-img-container">
          <img class="menu-event-poster-img" src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>"/>
        </div>
        <div class="menu-event-poster-bottom-container">
          <h4 class="menu-event-poster-name gray"><?php echo $name; ?></h4>
          <span class="menu-event-poster-date"><?php echo $date; ?></span>
          <span class="menu-event-poster-location"><?php echo $location; ?></span>
          <div class="menu-event-poster-link-container">
            <div class="menu-event-poster-link-wrapper">
              <a class="menu-event-poster-link btn-link-text red arrow-right-small-red-open" href="<?php echo $url; ?>"><?php echo __("More Info"); ?></a>
              <a class="menu-event-poster-link btn-link-text red arrow-right-small-red-open" href="<?php echo $tickets_link; ?>"><?php echo __("Tickets"); ?></a>
            </div>
          </div>
        </div>
      </li>
    <?php
        $i++;
      }
    ?>
  </ul>
<?php
  }
?>
