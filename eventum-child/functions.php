<?php 

/* 
 * CUSTOM FUNCTIONS FOR CURLING CANADA 
 */

remove_action( 'init', 'themeum_eventum_post_type_speaker'); 

function my_themeum_eventum_post_type_speaker(){

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
		'public'             	=> true,
		'publicly_queryable' 	=> true,
		'show_in_menu'       	=> true,
		'show_in_admin_bar'   	=> true,
		'can_export'          	=> true,
		'has_archive'        	=> false,
		'rewrite' 				=> array('slug' => 'teams'),
		'hierarchical'       	=> false,
		'menu_position'      	=> null,
		'menu_icon'				=> true,
		'supports'           	=> array( 'title','editor','thumbnail','comments')
		);

	register_post_type( 'speaker',$args );

}

add_action('init','my_themeum_eventum_post_type_speaker');