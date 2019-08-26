<?php


add_action('init', 'create_taxonomy');
add_action('init', 'create_post_type');

include 'blocks/functions.php';

add_action('wp_enqueue_scripts', 'add_curling_styles');
add_action('admin_enqueue_scripts', 'add_curling_admin_styles');
// add_action('admin_menu', 'remove_admin_menus' );
add_action('init', 'block_container_init');

function block_container_init() {
    $file = get_stylesheet_directory_uri().'/js/blocks/compiled/block-container.js';
    $filem = get_stylesheet_directory().'/js/blocks/compiled/block-container.js';
    wp_register_script(
        'cossette-block-container',
        $file,
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-i18n'),
        filemtime($filem)
    );

    register_block_type('cossette/block-container', array(
        'editor_script' => 'cossette-block-container',
        'render_callback' => function( $attributes, $content = '' ) {
            return $content;
        },
        'attributes' => [
		]
    ));
}

function add_curling_styles() {
    wp_enqueue_style('main', get_stylesheet_directory_uri() . '/css/main.min.css');

    // Blocks
    wp_enqueue_script('block-timer', get_stylesheet_directory_uri() . '/js/dist/block-timer.min.js', [ 'jquery' ], '0.0.1');

    wp_enqueue_script('main', get_stylesheet_directory_uri() . "/js/dist/main.min.js", [ 'jquery' ], '3.1.0');
}

function add_curling_admin_styles() {
    wp_enqueue_style('admin', get_stylesheet_directory_uri() . '/css/admin.min.css');

    wp_enqueue_script('main', get_stylesheet_directory_uri() . "/js/dist/main.min.js", [ 'jquery' ], '3.1.0');
}

function remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
}

function create_taxonomy() {

}

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
