<?php

add_action('acf/init', 'afc_block_hero_init');

function afc_block_hero_init() {
	
	// check function exists
	if( function_exists('acf_register_block') ) {
		
		// register a testimonial block
		$test = acf_register_block([
			'name'				=> 'hero',
			'title'				=> __('Hero'),
			'description'		=> __('A hero block.'),
			'render_callback'	=> 'block_hero_render_callback',
			'category'			=> 'common',
			'icon'				=> 'admin-comments',
            'keywords'			=> [ 'hero' ]
        ]);
    }
    
    $post_type_object = get_post_type_object( 'page' );
    $post_type_object->template = [ 
        [ 'acf/hero' ],
        [ 'cossette/block-container' ]
    ];
        
    $post_type_object->template_lock = 'all';
}

function block_hero_render_callback( $block ) {
	// convert name ("acf/testimonial") into path friendly slug ("testimonial")
	$slug = str_replace('acf/', '', $block['name']);
    
    $file = get_stylesheet_directory() . "/blocks/block-{$slug}.php";
	if( file_exists( $file ) ) {
		include( $file );
	}
}

?>
