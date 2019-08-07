<?php
    $menu_locations = get_nav_menu_locations();
    $top_left_menu_items = wp_get_nav_menu_items( $menu_locations['top-menu'] );
    $top_right_menu_items = wp_get_nav_menu_items( 'Top Right' );
    $primary_menu_items = wp_get_nav_menu_items( $menu_locations['primary'] );
?>

<?php echo !WP_DEBUG ?: "<!-- Begin output from ".basename(__FILE__)."-->"; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(''); ?></title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) : ?>
	<?php if ( get_theme_mod('site_favicon') ) : ?>
	<link rel="shortcut icon" href="<?php echo esc_url(get_theme_mod('site_favicon')); ?>" />
	<?php endif; ?>
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body class="<?php echo join(' ', get_body_class()); ?>">
    <header class="header-red">
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
                                <li class="menu-item"><h4 class="inverted"><?php echo $menu_item->title; ?></h4></li>
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
                                <li class="menu-item"><h4 class="inverted"><?php echo $menu_item->title; ?></h4></li>
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
                <img class="menu-logo" src="<?php echo get_stylesheet_directory_uri()."/images/logo-full.svg"; ?>" alt="Site Logo" />
                <?php
                    if ($primary_menu_items) {
                ?>
                    <ul class="menu-nav">
                        <?php
                            foreach( $primary_menu_items as $menu_item ) {
                        ?>
                            <li class="menu-item"><h4 class="inverted"><?php echo $menu_item->title; ?></h4></li>
                        <?php
                            }
                        ?>
                    </ul>
                <?php
                    }
                ?>
            </div>
        </div>
    </header>
<?php echo !WP_DEBUG ?: "<!-- End output from ".basename(__FILE__)."-->"; ?>