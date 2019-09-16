<?php

//Adds support for Featured Image
add_theme_support( 'post-thumbnails' );

include 'blocks-setup.php';

add_action('acf/init', 'acf_blocks_init');

// ------
// Uncomment to export acf-import.json file
// export_acf_json();
// ------

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
		// Module #4-PDF-2 - PDF with Image Block
		acf_register_block([
			'name'				=> 'pdf-image-block',
			'title'				=> __('PDF w/ Image'),
			'description'		=> __('Used to display a PDF download block with image and title'),
			'render_callback'	=> 'block_render_callback',
			'category'			=> 'common',
			'icon'				=> 'id-alt',
				'keywords'			=> [ 'PDF', 'PDF with Image', 'download' ]
		]);
		//Module - Single Callout
    acf_register_block([
		'name'				=> 'single-callout',
		'title'				=> __('Single Callout'),
		'description'		=> __('Used to a single callout'),
		'render_callback'	=> 'block_render_callback',
		'category'			=> 'common',
		'icon'				=> 'admin-comments',
		  'keywords'			=> [ 'single', 'callout', 'cta' ]
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

    acf_register_block([
			'name'						=> 'callout',
			'title'						=> __('Callout'),
			'description'			=> __('A block to display callouts'),
			'render_callback'	=> 'block_render_callback',
			'category'				=> 'common',
			'icon'						=> 'admin-comments',
      'keywords'				=> [ 'callout' ]
    ]);

    acf_register_block([
			'name'						=> 'featured-team',
			'title'						=> __('Featured Team'),
			'description'			=> __('A block to feature a Team'),
			'render_callback'	=> 'block_render_callback',
			'category'				=> 'common',
			'icon'						=> 'admin-comments',
      'keywords'				=> [ 'team' ]
    ]);
    
    //Styled Button
    acf_register_block([
      'name'						=> 'styled-button',
      'title'						=> __('Styled Button'),
      'description'			=> __('A Curling Styled Button'),
      'render_callback'	=> 'block_render_callback',
      'category'				=> 'common',
      'icon'						=> 'admin-comments',
        'keywords'				=> [ 'button', 'link' ]
    ]);

    //Item/Page Label
    acf_register_block([
      'name'						=> 'item-label',
      'title'						=> __('Item Label'),
      'description'			=> __('An Item or Page Label'),
      'render_callback'	=> 'block_render_callback',
      'category'				=> 'common',
      'icon'						=> 'admin-comments',
        'keywords'				=> [ 'label', 'item', 'page' ]
    ]);

    //Presented By
    acf_register_block([
      'name'						=> 'presented-by',
      'title'						=> __('Presented by Sponsor'),
      'description'			=> __('Sponsor with Presented By label'),
      'render_callback'	=> 'block_render_callback',
      'category'				=> 'common',
      'icon'						=> 'admin-comments',
        'keywords'				=> [ 'presented', 'by', 'sponsor' ]
    ]);

    acf_register_block([
      'name'						=> 'image-carousel',
      'title'						=> __('Image Carousel'),
      'description'			=> __('A block to render an Image Carousel'),
      'render_callback'	=> 'block_render_callback',
      'category'				=> 'common',
      'icon'						=> 'admin-comments',
      'keywords'				=> [ 'image', 'carousel' ]
  	]);
	
    //
    acf_register_block([
      'name'						=> 'text-callouts',
      'title'						=> __('Text Callouts'),
      'description'			=> __('A block to render three text callouts with optional image'),
      'render_callback'	=> 'block_render_callback',
      'category'				=> 'common',
      'icon'						=> 'admin-comments',
        'keywords'				=> [ 'text', 'image', '' ]
    ]);

    acf_register_block([
      'name'						=> 'news-feed',
      'title'						=> __('News Feed'),
      'description'			=> __('A block to render a News Feed'),
      'render_callback'	=> 'block_render_callback',
      'category'				=> 'common',
      'icon'						=> 'admin-comments',
      'keywords'				=> [ 'news', 'feed' ]
    ]);

    acf_register_block([
      'name'						=> 'draw-schedule',
      'title'						=> __('Draw Schedule'),
      'description'			=> __('A block to render a Draw Schedules'),
      'render_callback'	=> 'block_render_callback',
      'category'				=> 'common',
      'icon'						=> 'admin-comments',
      'keywords'				=> [ 'draw', 'schedule' ]
    ]);

    acf_add_options_page('Options');
  }
}

function block_render_callback( $block ) {
	$slug = str_replace('acf/', '', $block['name']);
    
	$file = get_stylesheet_directory() . "/blocks/block-{$slug}.php";

	if( file_exists( $file ) ) {
		include( $file );
	}
}

function export_acf_json() {
  $groups = acf_get_local_field_groups();
  $json = [];

  foreach ($groups as $group) {
      $fields = acf_get_local_fields($group['key']);
      unset($group['ID']);
      $group['fields'] = $fields;
      $json[] = $group;
  }

  $json = json_encode($json, JSON_PRETTY_PRINT);

  $file = get_template_directory() . '/bin/json/acf-import.json';
  file_put_contents($file, $json );
}

?>
