<?php

add_action('init', 'create_taxonomy');
add_action('init', 'create_post_type');
add_action('init', 'create_sponsors_post_type');
add_action('init', 'create_activity_post_type');
add_action('init', 'create_draw_schedule_post_type');
add_action('init', 'create_job_post_type');
add_action('after_setup_theme', 'create_nav_structure');

include 'blocks/functions.php';
include 'functions-ajax.php';

add_action('wp_enqueue_scripts', 'add_curling_styles');
add_action('admin_enqueue_scripts', 'add_curling_admin_styles');
// add_action('admin_menu', 'remove_admin_menus' );

add_action('init', 'block_container_init');
add_action('init', 'block_2_column_init');
add_action('init', 'block_3_column_init');
add_action('init', 'block_accordion_container_init');

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

function block_accordion_container_init() {
  $file = get_stylesheet_directory_uri().'/js/dist/block-accordion-container.min.js';
  $filem = get_stylesheet_directory().'/js/dist/block-accordion-container.min.js';

  wp_register_script(
      'cossette-block-accordion-container',
      $file,
      array('wp-blocks', 'wp-element', 'wp-editor', 'wp-i18n'),
      filemtime($filem)
  );

  register_block_type('cossette/block-accordion-container', array(
      'editor_script' => 'cossette-block-accordion-container',
      'render_callback' => function( $attributes, $content = '' ) {
          return '<div class="block-accordion-container '.($attributes['is_single_item'] ? 'accordion-container-single ' : ' ').'js-accordion">'.
            '<div class="accordion-container-top">'.
            '<'.($attributes['is_single_item'] ? 'h3' : 'h4').' class="gray">'.$attributes['title'].'</'.($attributes['is_single_item'] ? 'h3' : 'h4').'>'.
            '<div class="accordion-container-links">'.
            '<a class="accordion-container-link accordion-container-link-open gray js-accordion-trigger" href="#" onClick="return false;"><p class="js-accordion-trigger-text" data-trigger-show="'.$attributes['show_label'].'" data-trigger-hide="'.$attributes['hide_label'].'">'.$attributes['show_label'].'</p></a>'.
            ($attributes['is_single_item'] ? '<a class="accordion-container-link accordion-container-link-close gray js-accordion-trigger" href="#" onClick="return false;"><img class="" src="'.get_stylesheet_directory_uri().'/images/symbol-close.svg" alt="Site Logo" /></a>' : '').
            '<a class="accordion-container-link gray js-accordion-trigger" href="#" onClick="return false;"><p>'.$attributes['additional_link_title'].'</p></a>'.
            '</div>'.
            '</div>'.
            '<div class="accordion-container-border"></div>'.
            '<div class="accordion-container-content js-accordion-content">'.
            (!$attributes['is_single_item'] ? '<a class="accordion-container-link gray js-accordion-trigger" href="#" onClick="return false;"><img class="accordion-container-close" src="'.get_stylesheet_directory_uri().'/images/symbol-close.svg" alt="Site Logo" /></a>' : '').
            $content.
            '</div>'.
            '</div>';
      },
      'attributes' => [
        'title' => [
          'default' => '',
          'type' => 'string'
        ],
        'show_label' => [
          'default' => 'Show',
          'type' => 'string'
        ],
        'hide_label' => [
          'default' => 'Hide',
          'type' => 'string'
        ],
        'is_single_item' => [
          'default' => '',
          'type' => 'boolean'
        ],
        'additional_link_title' => [
          'default' => '',
          'type' => 'string'
        ],
        'additional_link_url' => [
          'default' => '',
          'type' => 'string'
        ],
        'additional_link_target' => [
          'default' => '',
          'type' => 'string'
        ]
      ]
  ));
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
            ($attributes['is_fullwidth'] ? ' ' : 'column-smallwidth ' ).
            ($attributes['left_column_is_sidebar'] ? ' '.'column-sidebar ' : ' ' ).
            ($attributes['nopadding'] ? 'no-padding ' : ' ').
            '">'.$content.'</div>';
      },
      'attributes' => [
        'type' => [
          'default' => '50-50',
          'type' => 'string'
        ],
        'is_fullwidth' => [
          'default' => false,
          'type' => 'boolean'
        ],
        'left_column_is_sidebar' => [
          'default' => false,
          'type' => 'boolean'
        ],
        'nopadding' => [
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
            ($attributes['is_fullwidth'] ? ' ' : 'column-smallwidth ' ).
            ($attributes['nopadding'] ? ' ' : 'no-padding ' ).
            '">'.$content.'</div>';
      },
      'attributes' => [
        'is_fullwidth' => [
          'default' => true,
          'type' => 'boolean'
        ],
        'nopadding' => [
          'default' => false,
          'type' => 'boolean'
        ]
      ]
  ));
}

function add_curling_styles() {
    wp_enqueue_style('litty', get_stylesheet_directory_uri() . "/css/vendor/lity.min.css");
    wp_enqueue_style('main', get_stylesheet_directory_uri() . '/css/main.min.css');
    wp_enqueue_style('masterslider', get_stylesheet_directory_uri() . '/css/masterslider.main.css');
    
    wp_enqueue_script('masterslider', get_stylesheet_directory_uri() . "/js/vendor/masterslider.min.js", [ 'jquery' ], '1.0.0');
    wp_enqueue_script('slick', get_stylesheet_directory_uri() . "/js/vendor/slick.min.js", [ 'jquery' ], '1.8.1');
    wp_enqueue_script('litty', get_stylesheet_directory_uri() . "/js/vendor/lity.min.js", [ 'jquery' ], '3.1.0');
    wp_enqueue_script('main', get_stylesheet_directory_uri() . "/js/dist/main.min.js", [ 'jquery', 'slick' ], '2.4.0');

    wp_localize_script( 'main', 'curling_ajax', [ 
      'ajax_url' => admin_url( 'admin-ajax.php' )
    ] );
}

function add_curling_admin_styles() {
    wp_enqueue_style('litty', get_stylesheet_directory_uri() . "/css/vendor/lity.min.css");
    wp_enqueue_style('admin', get_stylesheet_directory_uri() . '/css/admin.min.css');
    wp_enqueue_style('masterslider', get_stylesheet_directory_uri() . '/css/masterslider.main.css');
    
    wp_enqueue_script('masterslider', get_stylesheet_directory_uri() . "/js/vendor/masterslider.min.js", [ 'jquery' ], '1.0.0');
    wp_enqueue_script('slick', get_stylesheet_directory_uri() . "/js/vendor/slick.min.js", [ 'jquery' ], '1.8.1');
    wp_enqueue_script('litty', get_stylesheet_directory_uri() . "/js/vendor/lity.min.js", [ 'jquery' ], '3.1.0');
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

    //Register Additional Fields
    if( function_exists('acf_add_local_field_group') ):
      acf_add_local_field_group(array(
        'key' => 'group_5dae3e6b41436',
        'title' => 'Team Additional Fields',
        'fields' => array(
          array(
            'key' => 'field_5dae4125309b8',
            'label' => 'Team Location Name',
            'name' => 'team_location_name',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
          ),
          array(
            'key' => 'field_5dae4138309b9',
            'label' => 'Team City',
            'name' => 'team_city',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
          ),
          array(
            'key' => 'field_5dae414b309ba',
            'label' => 'Social Media Links',
            'name' => 'social_media_links',
            'type' => 'group',
            'instructions' => 'Proper format is just the path without \'www.facebook.com\' or \'instagram.com\'.',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'layout' => 'block',
            'sub_fields' => array(
              array(
                'key' => 'field_5dae416d309bb',
                'label' => 'Facebook',
                'name' => 'facebook',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => '',
                ),
                'default_value' => '',
                'placeholder' => 'teamexample/',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
              ),
              array(
                'key' => 'field_5dae4210309bc',
                'label' => 'Instagram',
                'name' => 'instagram',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => '',
                ),
                'default_value' => '',
                'placeholder' => 'teamexample/',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
              ),
              array(
                'key' => 'field_5dae4254309bd',
                'label' => 'Twitter',
                'name' => 'twitter',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                  'width' => '',
                  'class' => '',
                  'id' => '',
                ),
                'default_value' => '',
                'placeholder' => 'teamexample/',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
              ),
            ),
          ),
        ),
        'location' => array(
          array(
            array(
              'param' => 'post_type',
              'operator' => '==',
              'value' => 'team',
            ),
          ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
      ));
    endif;
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
    register_post_type('Draw Schedule', [
        'labels' => [
            'name'          => __('Draw Schedules'),
            'singular_name' => __('Draw Schedule'),
            'menu_name'     => __('Draw Schedules'),
            'all_items'     => __('All Draw Schedules')
        ],
        'menu_icon' => 'dashicons-groups',
        'public' => true,
        'supports' => [ 'title' ],
        'has_archive' => true,
        'show_in_rest' => true,
        'rewrite' => [
            'slug' => 'draw-schedule'
        ]
    ]);
}

function create_job_post_type() {
  register_post_type('Job', [
      'labels' => [
          'name'          => __('Jobs'),
          'singular_name' => __('Job'),
          'menu_name'     => __('Jobs'),
          'all_items'     => __('All Jobs')
      ],
      'menu_icon' => 'dashicons-groups',
      'public' => true,
      'supports' => [ 'title' ],
      'has_archive' => true,
      'show_in_rest' => true,
      'rewrite' => [
          'slug' => 'draw-schedule'
      ]
  ]);
}


//Builds the Required Nav Structure
function create_nav_structure(){

  //This will give us Nav Menus Support
  //register_nav_menus( array(
  //  'primary' => 'Primary Navigation'
  //));
  add_theme_support('nav-menus');
  
  register_nav_menus( array(
    'primary' => 'Primary Navigation'
  ));

  if (function_exists("get_field")){
    $is_event = get_field('is_event', 'Options');
  } else {
    $is_event = false;
  }
  
  //Menu - Top Left
  if ( !wp_get_nav_menu_object( 'Menu - Top Left' ) ){

    $menu_id = wp_create_nav_menu('Menu - Top Left');

    wp_update_nav_menu_item($menu_id, 0, array(
      'menu-item-title' =>  __('Curling Canada'),
      'menu-item-classes' => 'curling-canada',
      'menu-item-url' => home_url( '/' ), 
      'menu-item-type' => 'custom',
      'menu-item-status' => 'publish'));
    

    wp_update_nav_menu_item($menu_id, 0, array(
      'menu-item-title' =>  __('About Curling'),
      'menu-item-classes' => 'about-curling',
      'menu-item-url' => home_url( '/' ), 
      'menu-item-type' => 'custom',
      'menu-item-status' => 'publish'));
    

    wp_update_nav_menu_item($menu_id, 0, array(
      'menu-item-title' =>  __('Our Organization'),
      'menu-item-classes' => 'our-organization',
      'menu-item-url' => home_url( '/' ), 
      'menu-item-type' => 'custom',
      'menu-item-status' => 'publish'));
  }


  //Menu - Top Right
  if ( !wp_get_nav_menu_object( 'Menu - Top Right' ) ){

    $menu_id = wp_create_nav_menu('Menu - Top Right');

    wp_update_nav_menu_item($menu_id, 0, array(
      'menu-item-title' =>  __('Tickets'),
      'menu-item-classes' => 'tickets',
      'menu-item-url' => home_url( '/' ), 
      'menu-item-type' => 'custom',
      'menu-item-status' => 'publish'));
    

    wp_update_nav_menu_item($menu_id, 0, array(
      'menu-item-title' =>  __('Shop'),
      'menu-item-classes' => 'shop',
      'menu-item-url' => home_url( '/' ), 
      'menu-item-type' => 'custom',
      'menu-item-status' => 'publish'));
  }

  //Menu - Footer
  if ( !wp_get_nav_menu_object( 'Menu - Footer' ) ){

    $menu_id = wp_create_nav_menu('Menu - Footer');

    wp_update_nav_menu_item($menu_id, 0, array(
      'menu-item-title' =>  __('Curling Canada'),
      'menu-item-classes' => 'curling-canada',
      'menu-item-url' => 'https://curling.ca', 
      'menu-item-type' => 'custom',
      'menu-item-status' => 'publish'));

    wp_update_nav_menu_item($menu_id, 0, array(
      'menu-item-title' =>  __('Philanthropy'),
      'menu-item-classes' => 'philanthropy',
      'menu-item-url' => '/', 
      'menu-item-type' => 'custom',
      'menu-item-status' => 'publish'));
    
    wp_update_nav_menu_item($menu_id, 0, array(
      'menu-item-title' =>  __('Media'),
      'menu-item-object' => 'page',
      'menu-item-object-id' => get_page_by_path('Media')->ID,
      'menu-item-type' => 'post_type',
      'menu-item-status' => 'publish'));

    wp_update_nav_menu_item($menu_id, 0, array(
      'menu-item-title' =>  __('Curling I/O'),
      'menu-item-classes' => 'curling-io',
      'menu-item-url' => 'https://curling.io', 
      'menu-item-type' => 'custom',
      'menu-item-status' => 'publish'));
    
    wp_update_nav_menu_item($menu_id, 0, array(
      'menu-item-title' =>  __('Contact Us'),
      'menu-item-object' => 'page',
      'menu-item-object-id' => get_page_by_path('Contact Us')->ID,
      'menu-item-type' => 'post_type', 
      'menu-item-status' => 'publish'));

    wp_update_nav_menu_item($menu_id, 0, array(
      'menu-item-title' =>  __('Safe Sport'),
      'menu-item-classes' => 'safe-sport',
      'menu-item-url' => '/', 
      'menu-item-type' => 'custom',
      'menu-item-status' => 'publish'));
    
    wp_update_nav_menu_item($menu_id, 0, array(
      'menu-item-title' =>  __('Sponsorship &amp; Corporate Partners'),
      'menu-item-classes' => 'sponsorship-corporate-partners',
      'menu-item-url' => '/', 
      'menu-item-type' => 'custom',
      'menu-item-status' => 'publish'));

    wp_update_nav_menu_item($menu_id, 0, array(
      'menu-item-title' =>  __('The Curling Brand'),
      'menu-item-classes' => '-curling-brand',
      'menu-item-url' => '/', 
      'menu-item-type' => 'custom',
      'menu-item-status' => 'publish'));
  }

  //Menu - Legal
  if ( !wp_get_nav_menu_object( 'Menu - Legal' ) ){

    $menu_id = wp_create_nav_menu('Menu - Legal');

    wp_update_nav_menu_item($menu_id, 0, array(
      'menu-item-title' =>  __('Privacy Policy'),
      'menu-item-object' => 'page',
      'menu-item-object-id' => get_page_by_path('Privacy Policy')->ID,
      'menu-item-type' => 'post_type', 
      'menu-item-status' => 'publish'));

    wp_update_nav_menu_item($menu_id, 0, array(
      'menu-item-title' =>  __('Cookies'),
      'menu-item-object' => 'page',
      'menu-item-object-id' => get_page_by_path('Cookies')->ID,
      'menu-item-type' => 'post_type', 
      'menu-item-status' => 'publish'));
  }

  //Check if this is an Event Microsite
  if ($is_event) {
    //Event Micro Site Main Memu
    if ( !wp_get_nav_menu_object( 'Menu - Events' ) ){

      $menu_id = wp_create_nav_menu('Menu - Events');

      wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title' =>  __('Tickets'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('tickets-2')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));
  
      //Sub Nav - Event Details
      $sub_nav = wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title' =>  __('Event Details'),
        'menu-item-classes' => 'event-details',
        'menu-item-url' => '',
        'menu-item-type' => 'custom',
        'menu-item-status' => 'publish'));
      
      wp_update_nav_menu_item($menu_id , 0, array(
          'menu-item-parent-id' => $sub_nav,
          'menu-item-title' =>  __('About [Insert Event Name]'),
          'menu-item-object' => 'page',
          'menu-item-object-id' => get_page_by_path('about')->ID,
          'menu-item-type' => 'post_type', 
          'menu-item-status' => 'publish'));
      
      wp_update_nav_menu_item($menu_id , 0, array(
        'menu-item-parent-id' => $sub_nav,
          'menu-item-title' =>  __('Teams'),
          'menu-item-object' => 'page',
          'menu-item-object-id' => get_page_by_path('team')->ID,
          'menu-item-type' => 'post_type', 
          'menu-item-status' => 'publish'));

      wp_update_nav_menu_item($menu_id , 0, array(
        'menu-item-parent-id' => $sub_nav,
          'menu-item-title' =>  __('Draw Schedule'),
          'menu-item-object' => 'page',
          'menu-item-object-id' => get_page_by_path('Draw Schedule')->ID,
          'menu-item-type' => 'post_type', 
          'menu-item-status' => 'publish'));

      wp_update_nav_menu_item($menu_id , 0, array(
        'menu-item-parent-id' => $sub_nav,
        'menu-item-title' =>  __('Eye Opener'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('Eye Opener')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));

      wp_update_nav_menu_item($menu_id , 0, array(
        'menu-item-parent-id' => $sub_nav,
        'menu-item-title' =>  __('Fan Zone'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('Fan Zone')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));

      wp_update_nav_menu_item($menu_id , 0, array(
        'menu-item-parent-id' => $sub_nav,
        'menu-item-title' =>  __('Gallery'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('Gallery')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));
          
      //Sub Nav - Event Details
      $sub_nav = wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title' =>  __('Participate'),
        'menu-item-classes' => 'participate',
        'menu-item-url' => '', 
        'menu-item-type' => 'custom',
        'menu-item-status' => 'publish'));

      wp_update_nav_menu_item($menu_id , 0, array(
        'menu-item-parent-id' => $sub_nav,
        'menu-item-title' =>  __('Volunteering'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('volunteers')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));

      wp_update_nav_menu_item($menu_id , 0, array(
        'menu-item-parent-id' => $sub_nav,
        'menu-item-title' =>  __('Apply to be a Future Star'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('future-stars')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));

      wp_update_nav_menu_item($menu_id , 0, array(
        'menu-item-title' =>  __('Our Sponsors'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('Our Sponsors')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));

      wp_update_nav_menu_item($menu_id , 0, array(
        'menu-item-title' =>  __('News'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('News')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));
      
      wp_update_nav_menu_item($menu_id , 0, array(
        'menu-item-title' =>  __('Contact Us'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('Contact Us')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));
    }

  } else {
    //Curling.ca Main Menu
    if ( !wp_get_nav_menu_object( 'Menu - Main' ) ){

      $menu_id = wp_create_nav_menu('Menu - Main');
      
      $sub_nav = wp_update_nav_menu_item($menu_id , 0, array(
        'menu-item-title' =>  __('Tickets & Events'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('tickets-events')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));
  
      wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-parent-id' => $sub_nav,
        'menu-item-title' =>  __('[EVENTS]'),
        'menu-item-classes' => 'events',
        'menu-item-url' => home_url( '/events' ), 
        'menu-item-type' => 'custom',
        'menu-item-status' => 'publish'));

      $sub_nav = wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title' =>  __('Championship'),
        'menu-item-classes' => 'championship',
        'menu-item-url' => home_url( '/championship' ), 
        'menu-item-type' => 'custom',
        'menu-item-status' => 'publish'));
          
      wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-parent-id' => $sub_nav,
        'menu-item-title' =>  __('Upcoming Events'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('Upcoming Events')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));
                  
      wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-parent-id' => $sub_nav,
        'menu-item-title' =>  __('Broadcast Schedule'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('Broadcast Schedule')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));
                  
      wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-parent-id' => $sub_nav,
        'menu-item-title' =>  __('Download Publications'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('Download Publications')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));
                          
      wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-parent-id' => $sub_nav,
        'menu-item-title' =>  __('Bidding Documents'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('Bidding Documents')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));
                          
      wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-parent-id' => $sub_nav,
        'menu-item-title' =>  __('Volunteer Newsletter Sign Up'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('Volunteer Newsletter Sign Up')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));
                          
      wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-parent-id' => $sub_nav,
        'menu-item-title' =>  __('Championship Archives'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('Championship Archives')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));
                          
      wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-parent-id' => $sub_nav,
        'menu-item-title' =>  __('Resources'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('Resources')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));
                          
      wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-parent-id' => $sub_nav,
        'menu-item-title' =>  __('For Media'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('For Media')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));
                          
      wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-parent-id' => $sub_nav,
        'menu-item-title' =>  __('Sponsorship & Corporate Partners'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('sponsorship-corporate-partners')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));

      $sub_nav = wp_update_nav_menu_item($menu_id , 0, array(
        'menu-item-title' =>  __('News & Video'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('category-posts')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));
                                  
      wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-parent-id' => $sub_nav,
        'menu-item-title' =>  __('All Posts'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('category-posts')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));
                                          
      wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-parent-id' => $sub_nav,
        'menu-item-title' =>  __('Our News'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('category-posts')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));
                                                  
      wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-parent-id' => $sub_nav,
        'menu-item-title' =>  __('Our Champions'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('category-national-championships')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));
                                                  
      wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-parent-id' => $sub_nav,
        'menu-item-title' =>  __('Our Stories'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('category-posts')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));
                                                  
      wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-parent-id' => $sub_nav,
        'menu-item-title' =>  __('Our Video'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('Our Video')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));
                                          
      wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title' =>  __('Scores'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('Scores')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));
                                                  
      $sub_nav = wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title' =>  __('Members'),
        'menu-item-classes' => 'members',
        'menu-item-url' => '', 
        'menu-item-type' => 'custom',
        'menu-item-status' => 'publish'));
                                                  
      wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-parent-id' => $sub_nav,
        'menu-item-title' =>  __('Find a Curling Centre'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('Find a Curling Centre')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));
                                                  
      wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-parent-id' => $sub_nav,
        'menu-item-title' =>  __('Curling I/O'),
        'menu-item-classes' => 'curling-io',
        'menu-item-url' => 'https://curling.io', 
        'menu-item-type' => 'custom',
        'menu-item-status' => 'publish'));
                                                  
      wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-parent-id' => $sub_nav,
        'menu-item-title' =>  __('Become a Member'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('Become a Member')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));
                                                          
      wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-parent-id' => $sub_nav,
        'menu-item-title' =>  __('Benefits of Membership'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('Benefits of Membership')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));
                                                          
      wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-parent-id' => $sub_nav,
        'menu-item-title' =>  __('Member Resources'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('Member Resources')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));
                                                          
      $sub_nav = wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title' =>  __('Team Canada'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('Team Canada')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));
                                                                  
      wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-parent-id' => $sub_nav,
        'menu-item-title' =>  __('Our 2019 Teams'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('Our National Teams')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));
                                                                          
      wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-parent-id' => $sub_nav,
        'menu-item-title' =>  __('Becoming Team Canada'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('Becoming Team Canada')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));
                                                                                  
      wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-parent-id' => $sub_nav,
        'menu-item-title' =>  __('Canadian Team Ranking System (CTRS)'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('canadian-team-ranking-system-ctrs')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));
                                                                                          
      wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-parent-id' => $sub_nav,
        'menu-item-title' =>  __('Mixed Doubles Rankings'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('Mixed Doubles Rankings')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));
                                                                                                  
      wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-parent-id' => $sub_nav,
        'menu-item-title' =>  __('Safe Sport'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('Safe Sport')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));
                                                                                          
      wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-parent-id' => $sub_nav,
        'menu-item-title' =>  __('Athletes'),
        'menu-item-object' => 'page',
        'menu-item-object-id' => get_page_by_path('HP Athletes')->ID,
        'menu-item-type' => 'post_type', 
        'menu-item-status' => 'publish'));
      
      wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title' =>  __('Shop'),
        'menu-item-classes' => 'championship',
        'menu-item-url' => 'https://shop.curling.ca', 
        'menu-item-type' => 'custom',
        'menu-item-status' => 'publish'));

        
      
    }

  }


}

/*
//Setup Block Templates
function myplugin_register_template() {
  $post_type_object = get_post_type_object( 'post' );

  $template_image = array();
  $template_image[] = 'core/image';

  $template_para = array();
  $template_para[] = 'core/paragraph';
  $template_para[] = array('placeholder' => 'Image Details');

  $template_label = array();
  $template_label[] = 'acf/item-label';
  $template_label[] = array('acf-field-5d7952a3a9efb' => 'Works');


  $post_type_object->template = array(
      //array( 'core/image' ),
      $template_image, 
      $template_para, 
      $template_label
  );
}
add_action( 'init', 'myplugin_register_template' );
*/