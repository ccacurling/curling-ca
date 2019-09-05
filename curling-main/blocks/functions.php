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
			'name'						=> 'promo',
			'title'						=> __('Promo'),
			'description'			=> __('A promo block.'),
			'render_callback'	=> 'block_render_callback',
			'category'				=> 'common',
			'icon'						=> 'admin-comments',
      'keywords'				=> [ 'promo' ]
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
    acf_register_block([
			'name'						=> 'event-location',
			'title'						=> __('Event Location'),
			'description'			=> __('An event location and map block.'),
			'render_callback'	=> 'block_render_callback',
			'category'				=> 'common',
			'icon'						=> 'admin-comments',
      'keywords'				=> [ 'event location', 'map' ]
    ]);
	
	//Module 10 - News/News Promo
	acf_register_block([
	'name'				=> 'news-promo',
	'title'				=> __('News Promo'),
	'description'		=> __('Used to display your latest or a featured post'),
	'render_callback'	=> 'block_render_callback',
	'category'			=> 'common',
	'icon'				=> 'admin-comments',
	  'keywords'			=> [ 'news', 'promo', 'featured', 'post' ]
	]);

    acf_add_options_page('Options');
  }
  
  // $post_type_object = get_post_type_object( 'page' );
  // $post_type_object->template = [ 
  //     [ 'acf/hero' ],
  //     [ 'cossette/block-container' ]
  // ];
      
  // // $post_type_object->template_lock = 'all';
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
