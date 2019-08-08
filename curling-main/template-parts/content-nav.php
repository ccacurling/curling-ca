<?php
    $menu_locations = get_nav_menu_locations();
    $top_left_menu_items = wp_get_nav_menu_items( $menu_locations['top-menu'] );
    $top_right_menu_items = wp_get_nav_menu_items( 'Top Right' );
    $primary_menu_items = wp_get_nav_menu_items( $menu_locations['primary'] );

    $header_config = isset($header_config) ? $header_config : null;
    $header_color = parse_config($header_config, 'header_color', 'red');

    $sample_menu_items1 = [
        (object)[
            'title' => 'Menu Item 1'
        ], (object)[
            'title' => 'Menu Item 2'
        ], (object)[
            'title' => 'Menu Item 3'
        ], (object)[
            'title' => 'Menu Item 4'
        ]
    ];
    $sample_menu_items2 = [
        (object)[
            'title' => 'Menu Item 5'
        ], (object)[
            'title' => 'Menu Item 6'
        ], (object)[
            'title' => 'Menu Item 7'
        ], (object)[
            'title' => 'Menu Item 8'
        ]
    ];
?>

<div class="header-<?php echo $header_color; ?>">
    <div class="nav-menu-top">
        <div class="nav-menu-top-wrapper content-fixed">
            <div class="nav-menu-top-left-wrapper">
                <?php
                    if ($top_left_menu_items) {
                ?>
                    <ul class="menu-nav">
                        <?php
                            foreach( $top_left_menu_items as $menu_item ) {
                        ?>
                            <li class="menu-item"><h4 class="menu-item-title"><?php echo $menu_item->title; ?></h4></li>
                        <?php
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
                            <li class="menu-item"><h4 class="menu-item-title"><?php echo $menu_item->title; ?></h4></li>
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
    <div class="nav-menu-primary">
        <div class="nav-menu-primary-wrapper content-fixed">
            <img class="menu-logo" src="<?php echo get_stylesheet_directory_uri()."/images/logo-main.svg"; ?>" alt="Site Logo" />
            <?php
                if ($primary_menu_items) {
            ?>
                <ul class="menu-nav">
                    <?php
                        // TODO: TEMP
                        $i = 0;
                        foreach( $primary_menu_items as $menu_item ) {
                    ?>
                        <li class="menu-item" <?php echo $i%2===0?null:'data-menu="'.$menu_item->post_name.'"'; ?>>
                            <h4 class="menu-item-title"><?php echo $menu_item->title; ?></h4>
                            <?php 
                                if ($i % 2 !== 0) {
                            ?>
                                <img class="menu-item-arrow" src="<?php echo get_stylesheet_directory_uri()."/images/triangle-down.svg"; ?>" alt="Triangle" />
                            <?php
                                }
                            ?>
                        </li>
                    <?php
                            ++$i;
                        }
                    ?>
                </ul>
            <?php
                }
            ?>
        </div>
    </div>
    <?php
        $i = 0;
        foreach( $primary_menu_items as $menu_item ) {
            create_menu_bar($menu_item->post_name, $i++%2===0 ? $sample_menu_items1 : $sample_menu_items2);
        }
    ?>
</div>

<?php
function create_menu_bar($name, $menu_items) {
  if ($menu_items) {
?>
  <div class="nav-menu-popup" data-name="<?php echo $name; ?>">
    <div class="nav-menu-popup-wrapper content-fixed">
      <ul class="menu-nav">
        <?php
          foreach( $menu_items as $menu_item ) {
        ?>
          <li class="menu-item"><h4 class="menu-item-title"><?php echo $menu_item->title; ?></h4><div class="arrow arrow-up"></div></li>
        <?php
          }
        ?>
      </ul>
    </div>
  </div>
<?php 
    }
  }
?>
