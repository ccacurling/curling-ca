<?php
add_action('wp_enqueue_scripts', 'add_curling_styles');

function add_curling_styles() {
    wp_enqueue_style('main', get_stylesheet_directory_uri() . '/css/main.min.css');

    wp_enqueue_script('main', get_stylesheet_directory_uri() . "/js/dist/main.min.js", [ 'jquery' ], '3.1.0');
}

function parse_config($config, $property, $default) {
    if (isset($config) && isset($config[$property])) {
        return $config[$property];
    }
    return $default;
}
