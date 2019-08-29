<?php

include 'blocks-setup.php';

add_action('acf/init', 'afc_blocks_init');

function afc_blocks_init() {
	if( function_exists('acf_register_block') ) {
		acf_register_block([
			'name'				=> 'hero',
			'title'				=> __('Hero'),
			'description'		=> __('A hero block.'),
			'render_callback'	=> 'block_render_callback',
			'category'			=> 'common',
			'icon'				=> 'admin-comments',
            'keywords'			=> [ 'hero' ]
    ]);
    acf_register_block([
			'name'				=> 'promo',
			'title'				=> __('Promo'),
			'description'		=> __('A promo block.'),
			'render_callback'	=> 'block_render_callback',
			'category'			=> 'common',
			'icon'				=> 'admin-comments',
      'keywords'			=> [ 'promo' ]
		]);
  }
  
  $post_type_object = get_post_type_object( 'page' );
  $post_type_object->template = [ 
      [ 'acf/hero' ],
      [ 'cossette/block-container' ]
  ];
      
  $post_type_object->template_lock = 'all';
}

function block_render_callback( $block ) {
	$slug = str_replace('acf/', '', $block['name']);
    
    $file = get_stylesheet_directory() . "/blocks/block-{$slug}.php";
	if( file_exists( $file ) ) {
		include( $file );
	}
}

?>
