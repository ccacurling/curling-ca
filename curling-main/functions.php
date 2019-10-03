<?php

add_action('init', 'create_taxonomy');
add_action('init', 'create_post_type');
add_action('init', 'create_sponsors_post_type');
add_action('init', 'create_activity_post_type');
add_action('init', 'create_draw_schedule_post_type');

include 'blocks/functions.php';
include 'functions-ajax.php';

add_action('wp_enqueue_scripts', 'add_curling_styles');
add_action('admin_enqueue_scripts', 'add_curling_admin_styles');
// add_action('admin_menu', 'remove_admin_menus' );
add_action('init', 'block_container_init');
add_action('init', 'block_2_column_init');
add_action('init', 'block_3_column_init');

// Pull in Eventum-child custom post type registration for speakers (Teams)
remove_action( 'init', 'themeum_eventum_post_type_speaker');
add_action('init','my_themeum_eventum_post_type_speaker');
add_filter( 'term_link', 'wpa_alter_cat_links', 10, 3 );

function wpa_alter_cat_links( $termlink, $term, $taxonomy ){
  if( 'category' != $taxonomy ) return $termlink;

  $url = '/category-'.$term->slug;
  if (get_page_by_path($url)) {
    return get_site_url().$url;
  } else {
    return $termlink;
  }
}

function block_container_init() {
    $file = get_stylesheet_directory_uri().'/js/dist/block-container.min.js';
    $filem = get_stylesheet_directory().'/js/dist/block-container.min.js';

    wp_register_script(
        'cossette-block-container',
        $file,
        array('wp-blocks', 'wp-element', 'wp-editor', 'wp-i18n'),
        filemtime($filem)
    );

    register_block_type('cossette/block-container', array(
        'editor_script' => 'cossette-block-container',
        'render_callback' => function( $attributes, $content = '' ) {
            return '<div class="block-container">'.$content.'</div>';
        },
        'attributes' => [
          'is_narrow_width' => [
            'default' => 'default',
            'type' => 'boolean'
          ],
		    ]
    ));
}

function block_2_column_init() {
  $file = get_stylesheet_directory_uri().'/js/dist/block-column-2.min.js';
  $filem = get_stylesheet_directory().'/js/dist/block-column-2.min.js';

  wp_register_script(
      'cossette-block-column-2',
      $file,
      array('wp-blocks', 'wp-element', 'wp-editor', 'wp-i18n'),
      filemtime($filem)
  );

  register_block_type('cossette/block-column-2', array(
      'editor_script' => 'cossette-block-column-2',
      'render_callback' => function( $attributes, $content = '' ) {
          return '<div class="block-column '.
            'column-'.str_replace('_', '-', $attributes['type']).' '.
            ($attributes['is_fullwidth'] ? '' : 'column-smallwidth' ).
            ($attributes['left_column_is_sidebar'] ? ' '.'column-sidebar' : '' ).
            '">'.$content.'</div>';
      },
      'attributes' => [
        'type' => [
          'default' => '25_75',
          'type' => 'string'
        ],
        'is_fullwidth' => [
          'default' => false,
          'type' => 'boolean'
        ],
        'left_column_is_sidebar' => [
          'default' => false,
          'type' => 'boolean'
        ]
      ]
  ));
}

function block_3_column_init() {
  $file = get_stylesheet_directory_uri().'/js/dist/block-column-3.min.js';
  $filem = get_stylesheet_directory().'/js/dist/block-column-3.min.js';

  wp_register_script(
      'cossette-block-column-3',
      $file,
      array('wp-blocks', 'wp-element', 'wp-editor', 'wp-i18n'),
      filemtime($filem)
  );

  register_block_type('cossette/block-column-3', array(
      'editor_script' => 'cossette-block-column-3',
      'render_callback' => function( $attributes, $content = '' ) {
          return '<div class="block-column '.
           'column-33-33-33 '.
            ($attributes['is_fullwidth'] ? '' : 'column-smallwidth' ).
            '">'.$content.'</div>';
      },
      'attributes' => [
        'is_fullwidth' => [
          'default' => true,
          'type' => 'boolean'
        ]
      ]
  ));
}

function add_curling_styles() {
    wp_enqueue_style('litty', get_stylesheet_directory_uri() . "/css/vendor/lity.min.css");
    wp_enqueue_style('main', get_stylesheet_directory_uri() . '/css/main.min.css');
    
    wp_enqueue_script('litty', get_stylesheet_directory_uri() . "/js/vendor/lity.min.js", [ 'jquery' ], '3.1.0');
    wp_enqueue_script('slick', get_stylesheet_directory_uri() . "/js/vendor/slick.min.js", [ 'jquery' ], '1.8.1');
    wp_enqueue_script('main', get_stylesheet_directory_uri() . "/js/dist/main.min.js", [ 'jquery', 'slick' ], '2.4.0');

    wp_localize_script( 'main', 'curling_ajax', [ 
      'ajax_url' => admin_url( 'admin-ajax.php' )
    ] );
}

function add_curling_admin_styles() {
    wp_enqueue_style('litty', get_stylesheet_directory_uri() . "/css/vendor/lity.min.css");
    wp_enqueue_style('admin', get_stylesheet_directory_uri() . '/css/admin.min.css');
    
    wp_enqueue_script('litty', get_stylesheet_directory_uri() . "/js/vendor/lity.min.js", [ 'jquery' ], '3.1.0');
    wp_enqueue_script('slick', get_stylesheet_directory_uri() . "/js/vendor/slick.min.js", [ 'jquery' ], '1.8.1');
    wp_enqueue_script('main', get_stylesheet_directory_uri() . "/js/dist/main.min.js", [ 'jquery', 'slick' ], '2.4.0');

    wp_localize_script( 'main', 'curling_ajax', [ 
      'ajax_url' => admin_url( 'admin-ajax.php' )
    ] );
}

function remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
}

function create_taxonomy() {

}

function create_post_type() {
    $is_event = function_exists('get_field') ? get_field('is_event', 'Options') : false;
    register_post_type('Team', [
        'labels' => [
            'name' => __('Team'),
            'singular_name' => __('Team'),
        ],
        'menu_icon' => 'dashicons-megaphone',
        'public' => $is_event,
        // 'taxonomies' => [ 'team_tag' ],
        'supports' => ['title', 'thumbnail'],
        'has_archive' => true,
        'show_in_rest' => true,
        'rewrite' => [
            'slug' => 'team'
        ]
    ]);
}

function parse_config($config, $property, $default) {
    if (isset($config) && isset($config[$property])) {
        return $config[$property];
    }
    return $default;
}

function my_themeum_eventum_post_type_speaker() {
    $is_event = function_exists('get_field') ? get_field('is_event', 'Options') : false;
    $labels = array( 
        'name'                	=> esc_html__( 'Teams', 'Teams', 'themeum-eventum' ),
        'singular_name'       	=> esc_html__( 'Team', 'Team', 'themeum-eventum' ),
        'menu_name'           	=> esc_html__( 'Teams', 'themeum-eventum' ),
        'parent_item_colon'   	=> esc_html__( 'Parent Team:', 'themeum-eventum' ),
        'all_items'           	=> esc_html__( 'All Teams', 'themeum-eventum' ),
        'view_item'           	=> esc_html__( 'View Team', 'themeum-eventum' ),
        'add_new_item'        	=> esc_html__( 'Add New Team', 'themeum-eventum' ),
        'add_new'             	=> esc_html__( 'New Team', 'themeum-eventum' ),
        'edit_item'           	=> esc_html__( 'Edit Team', 'themeum-eventum' ),
        'update_item'         	=> esc_html__( 'Update Team', 'themeum-eventum' ),
        'search_items'        	=> esc_html__( 'Search Team', 'themeum-eventum' ),
        'not_found'           	=> esc_html__( 'No article found', 'themeum-eventum' ),
        'not_found_in_trash'  	=> esc_html__( 'No article found in Trash', 'themeum-eventum' )
        );

    $args = array(  
        'labels'             	=> $labels,
        'public'             	=> $is_event,
        'publicly_queryable' 	=> true,
        'show_in_menu'       	=> true,
        'show_in_admin_bar'   	=> true,
        'can_export'          	=> true,
        'has_archive'        	=> false,
        'rewrite' 				=> array('slug' => 'teams'),
        'hierarchical'       	=> false,
        'menu_position'      	=> null,
        'menu_icon'				=> 'dashicons-groups',
        'supports'           	=> array( 'title','editor','thumbnail','comments')
        );

    register_post_type( 'speaker', $args );
}

function create_sponsors_post_type() {
    register_post_type('Sponsors', [
        'labels' => [
            'name'          => __('Sponsors'),
            'singular_name' => __('Sponsor'),
            'menu_name'     => __('Sponsors'),
            'all_items'     => __('All Sponsors')
        ],
        'menu_icon' => 'dashicons-groups',
        'public' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
        'has_archive' => true,
        'show_in_rest' => true,
        'rewrite' => [
            'slug' => 'sponsor'
        ]
    ]);
}

function create_activity_post_type() {
    $is_event = function_exists('get_field') ? get_field('is_event', 'Options') : false;
    register_post_type('Activity', [
        'labels' => [
            'name'          => __('Activity'),
            'singular_name' => __('Activity'),
            'menu_name'     => __('Activities'),
            'all_items'     => __('All Activities')
        ],
        'menu_icon' => 'dashicons-editor-table',
        'public' => $is_event,
        'supports' => ['title', 'editor', 'thumbnail'],
        'has_archive' => true,
        'show_in_rest' => true,
        'rewrite' => [
            'slug' => 'activity'
        ]
    ]);
}

function create_draw_schedule_post_type() {
    $is_event = function_exists('get_field') ? get_field('is_event', 'Options') : false;
    register_post_type('Draw Schedule', [
        'labels' => [
            'name'          => __('Draw Schedules'),
            'singular_name' => __('Draw Schedule'),
            'menu_name'     => __('Draw Schedules'),
            'all_items'     => __('All Draw Schedules')
        ],
        'menu_icon' => 'dashicons-groups',
        'public' => $is_event,
        'supports' => [ 'title' ],
        'has_archive' => true,
        'show_in_rest' => true,
        'rewrite' => [
            'slug' => 'draw-schedule'
        ],
        'public' => false
    ]);
}
