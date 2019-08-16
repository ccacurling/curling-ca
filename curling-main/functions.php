<?php

include 'functions_test.php';

add_action('init', 'create_taxonomy');
add_action('init', 'create_post_type');

add_action('wp_enqueue_scripts', 'add_curling_styles');
// add_action('admin_menu', 'remove_admin_menus' );

function add_curling_styles() {
    wp_enqueue_style('main', get_stylesheet_directory_uri() . '/css/main.min.css');

    wp_enqueue_script('main', get_stylesheet_directory_uri() . "/js/dist/main.min.js", [ 'jquery' ], '3.1.0');
}

function remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
}

function create_taxonomy() {

}

function new_nav_menu_items($items,$args) {
	if (function_exists('icl_get_languages')) {
		$languages = icl_get_languages('skip_missing=0');
		if(1 < count($languages)){
			foreach($languages as $l){
				if(!$l['active']){
					if( $args->theme_location == 'top-menu' )
					$items = $items.'<li id="menu-item-7777" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-7777 gdlr-normal-menu"><a href="'.$l['url'].'">'.$l['native_name'].'</a></li>';
				}
			}
		}
	}
	return $items;
}
add_filter( 'wp_nav_menu_items', 'new_nav_menu_items',10,2 );

function create_post_type() {
    register_post_type('Events', [
        'labels' => [
            'name' => __('Events'),
            'singular_name' => __('Event'),
        ],
        'menu_icon' => 'dashicons-megaphone',
        'public' => true,
        // 'taxonomies' => [ 'event_tag' ],
        'supports' => ['title', 'editor', 'thumbnail'],
        'has_archive' => true,
        'show_in_rest' => true,
        'rewrite' => [
            'slug' => 'event'
        ]
    ]);
}

function parse_config($config, $property, $default) {
    if (isset($config) && isset($config[$property])) {
        return $config[$property];
    }
    return $default;
}
