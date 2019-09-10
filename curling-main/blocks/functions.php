<?php

//Adds support for Featured Image
add_theme_support( 'post-thumbnails' );

include 'blocks-setup.php';

add_action('acf/init', 'acf_blocks_init');

function acf_blocks_init() {
	if( function_exists('acf_register_block') ) {
		acf_register_block([
			'name' 						=> 'hero',
			'title'						=> __('Hero'),
			'description'			=> __('A hero block.'),
			'render_callback'	=> 'block_render_callback',
			'category'				=> 'common',
			'icon'						=> 'admin-comments',
      'keywords'				=> [ 'hero' ]
    ]);
    acf_register_block([
			'name'						=> 'hero-carousel',
			'title'						=> __('Hero Carousel'),
			'description'			=> __('A hero carousel block'),
			'render_callback'	=> 'block_render_callback',
			'category'				=> 'common',
			'icon'						=> 'admin-comments',
      'keywords'				=> [ 'hero', 'carousel' ]
    ]);
    acf_register_block([
			'name'						=> 'package',
			'title'						=> __('Package'),
			'description'			=> __('A package block.'),
			'render_callback'	=> 'block_render_callback',
			'category'				=> 'common',
			'icon'						=> 'admin-comments',
      'keywords'				=> [ 'package' ]
    ]);
    acf_register_block([
			'name'						=> 'package-small',
			'title'						=> __('Package - Small'),
			'description'			=> __('A small package block.'),
			'render_callback'	=> 'block_render_callback',
			'category'				=> 'common',
			'icon'						=> 'admin-comments',
      'keywords'				=> [ 'package' ]
    ]);
    acf_register_block([
			'name'						=> 'ticket',
			'title'						=> __('Ticket'),
			'description'			=> __('A ticket block.'),
			'render_callback'	=> 'block_render_callback',
			'category'				=> 'common',
			'icon'						=> 'admin-comments',
      'keywords'				=> [ 'ticket' ]
		]);
		// Module #3-4 - Event Details / Event Location Block
    acf_register_block([
			'name'						=> 'event-location',
			'title'						=> __('Event Location'),
			'description'			=> __('An event location and map block.'),
			'render_callback'	=> 'block_render_callback',
			'category'				=> 'common',
			'icon'						=> 'calendar-alt',
      'keywords'				=> [ 'event location', 'map' ]
    ]);
    // Module 10 - News/News Promo
    acf_register_block([
    'name'				=> 'news-promo',
    'title'				=> __('News Promo'),
    'description'		=> __('Used to display your latest or a featured post'),
    'render_callback'	=> 'block_render_callback',
    'category'			=> 'common',
    'icon'				=> 'admin-comments',
      'keywords'			=> [ 'news', 'promo', 'featured', 'post' ]
		]);
		// Module #2-2 - Sponsors block
		acf_register_block([
			'name'				=> 'sponsors',
			'title'				=> __('Sponsors'),
			'description'		=> __('Used to display selected sponsors'),
			'render_callback'	=> 'block_render_callback',
			'category'			=> 'common',
			'icon'				=> 'groups',
				'keywords'			=> [ 'sponsor', 'sponsors', 'partner', 'partners' ]
		]);

    acf_register_block([
			'name'						=> 'prefooter',
			'title'						=> __('Pre-Footer'),
			'description'			=> __('A block to display before the footer'),
			'render_callback'	=> 'block_render_callback',
			'category'				=> 'common',
			'icon'						=> 'admin-comments',
      'keywords'				=> [ 'footer' ]
    ]);

    acf_add_options_page('Options');
  }
}

function block_render_callback( $block ) {
	$slug = str_replace('acf/', '', $block['name']);
    
	$file = get_stylesheet_directory() . "/blocks/block-{$slug}.php";
	
	error_log($file);

	if( file_exists( $file ) ) {
		include( $file );
	}
}

?>
