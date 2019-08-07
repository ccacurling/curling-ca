<?php
add_action('wp_enqueue_scripts', 'add_curling_styles');

function add_curling_styles() {
    wp_enqueue_style('main', get_stylesheet_directory_uri() . '/css/main.min.css');
}