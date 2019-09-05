<?php

if( function_exists('acf_add_local_field_group') ):

// acf_add_local_field_group(array(
// 	'key' => 'group_5d5591cdbb942',
// 	'title' => 'Hero',
// 	'fields' => array(
// 		array(
// 			'key' => 'field_5d56da661e123',
// 			'label' => 'Image',
// 			'name' => 'hero_image',
// 			'type' => 'image',
// 			'instructions' => '',
// 			'required' => 0,
// 			'conditional_logic' => 0,
// 			'wrapper' => array(
// 				'width' => '',
// 				'class' => '',
// 				'id' => '',
// 			),
// 			'return_format' => 'array',
// 			'preview_size' => 'medium',
// 			'library' => 'all',
// 			'min_width' => '',
// 			'min_height' => '',
// 			'min_size' => '',
// 			'max_width' => '',
// 			'max_height' => '',
// 			'max_size' => '',
// 			'mime_types' => '',
// 		),
// 		array(
// 			'key' => 'field_5d65a7325d1a2',
// 			'label' => 'Hero Size',
// 			'name' => 'hero_size',
// 			'type' => 'select',
// 			'instructions' => '',
// 			'required' => 0,
// 			'conditional_logic' => 0,
// 			'wrapper' => array(
// 				'width' => '',
// 				'class' => '',
// 				'id' => '',
// 			),
// 			'choices' => array(
// 				'large' => 'Large',
// 				'medium' => 'Medium',
// 				'small' => 'Small',
// 			),
// 			'default_value' => array(
// 			),
// 			'allow_null' => 0,
// 			'multiple' => 0,
// 			'ui' => 0,
// 			'return_format' => 'value',
// 			'ajax' => 0,
// 			'placeholder' => '',
// 		),
// 		array(
// 			'key' => 'field_5d65ac034846d',
// 			'label' => 'Headline',
// 			'name' => 'hero_headline',
// 			'type' => 'textarea',
// 			'instructions' => '',
// 			'required' => 0,
// 			'conditional_logic' => 0,
// 			'wrapper' => array(
// 				'width' => '',
// 				'class' => '',
// 				'id' => '',
// 			),
// 			'default_value' => '',
// 			'placeholder' => '',
// 			'maxlength' => '',
// 			'rows' => '',
// 			'new_lines' => '',
// 		),
// 		array(
// 			'key' => 'field_5d65aeb611f84',
// 			'label' => 'Has Timer',
// 			'name' => 'has_timer',
// 			'type' => 'true_false',
// 			'instructions' => '',
// 			'required' => 0,
// 			'conditional_logic' => 0,
// 			'wrapper' => array(
// 				'width' => '',
// 				'class' => '',
// 				'id' => '',
// 			),
// 			'message' => '',
// 			'default_value' => 0,
// 			'ui' => 0,
// 			'ui_on_text' => '',
// 			'ui_off_text' => '',
//     ),
//     array(
// 			'key' => 'field_5d65b989afd5d',
// 			'label' => 'Timezone',
// 			'name' => 'timezone',
// 			'type' => 'timezone_picker',
// 			'instructions' => '',
// 			'required' => 0,
// 			'conditional_logic' => array(
// 				array(
// 					array(
// 						'field' => 'field_5d65aeb611f84',
// 						'operator' => '==',
// 						'value' => '1',
// 					),
// 				),
// 			),
// 			'wrapper' => array(
// 				'width' => '',
// 				'class' => '',
// 				'id' => '',
// 			),
// 			'default_time_zone' => '',
// 		),
// 		array(
// 			'key' => 'field_5d65aecc11f85',
// 			'label' => 'Start Date',
// 			'name' => 'start_date',
// 			'type' => 'date_time_picker',
// 			'instructions' => '',
// 			'required' => 0,
// 			'conditional_logic' => array(
// 				array(
// 					array(
// 						'field' => 'field_5d65aeb611f84',
// 						'operator' => '==',
// 						'value' => '1',
// 					),
// 				),
// 			),
// 			'wrapper' => array(
// 				'width' => '',
// 				'class' => '',
// 				'id' => '',
// 			),
// 			'display_format' => 'F j, Y g:i a',
// 			'return_format' => 'Y-m-d H:i:s',
// 			'first_day' => 0,
//     ),
// 		array(
// 			'key' => 'field_5d65b0a81ff52',
// 			'label' => 'End Date',
// 			'name' => 'end_date',
// 			'type' => 'date_time_picker',
// 			'instructions' => '',
// 			'required' => 0,
// 			'conditional_logic' => array(
// 				array(
// 					array(
// 						'field' => 'field_5d65aeb611f84',
// 						'operator' => '==',
// 						'value' => '1',
// 					),
// 				),
// 			),
// 			'wrapper' => array(
// 				'width' => '',
// 				'class' => '',
// 				'id' => '',
// 			),
// 			'display_format' => 'F j, Y g:i a',
// 			'return_format' => 'Y-m-d H:i:s',
// 			'first_day' => 1,
// 		),
// 	),
// 	'location' => array(
// 		array(
// 			array(
// 				'param' => 'block',
// 				'operator' => '==',
// 				'value' => 'acf/hero',
// 			),
// 		),
// 	),
// 	'menu_order' => 0,
// 	'position' => 'normal',
// 	'style' => 'seamless',
// 	'label_placement' => 'top',
// 	'instruction_placement' => 'label',
// 	'hide_on_screen' => '',
// 	'active' => true,
// 	'description' => '',
// ));

// acf_add_local_field_group(array(
// 	'key' => 'group_5d680deb699b7',
// 	'title' => 'Ticket Promo',
// 	'fields' => array(
// 		array(
// 			'key' => 'field_5d68556025b23',
// 			'label' => 'Colour',
// 			'name' => 'promo_colour',
// 			'type' => 'select',
// 			'instructions' => '',
// 			'required' => 0,
// 			'conditional_logic' => 0,
// 			'wrapper' => array(
// 				'width' => '',
// 				'class' => '',
// 				'id' => '',
// 			),
// 			'choices' => array(
// 				'white' => 'White',
// 				'gray' => 'Gray',
// 				'red' => 'Red',
// 			),
// 			'default_value' => array(
// 			),
// 			'allow_null' => 0,
// 			'multiple' => 0,
// 			'ui' => 0,
// 			'return_format' => 'value',
// 			'ajax' => 0,
// 			'placeholder' => '',
// 		),
// 		array(
// 			'key' => 'field_5d680dfcb0e3c',
// 			'label' => 'Name',
// 			'name' => 'promo_name',
// 			'type' => 'text',
// 			'instructions' => '',
// 			'required' => 0,
// 			'conditional_logic' => 0,
// 			'wrapper' => array(
// 				'width' => '',
// 				'class' => '',
// 				'id' => '',
// 			),
// 			'default_value' => '',
// 			'placeholder' => '',
// 			'prepend' => '',
// 			'append' => '',
// 			'maxlength' => '',
// 		),
// 		array(
// 			'key' => 'field_5d680e0db0e3d',
// 			'label' => 'Price',
// 			'name' => 'promo_price',
// 			'type' => 'price',
// 			'instructions' => '',
// 			'required' => 0,
// 			'conditional_logic' => 0,
// 			'wrapper' => array(
// 				'width' => '',
// 				'class' => '',
// 				'id' => '',
// 			),
// 			'format' => '|2/./ |',
// 		),
// 		array(
// 			'key' => 'field_5d680e36b0e3e',
// 			'label' => 'Price Info',
// 			'name' => 'promo_price_info',
// 			'type' => 'text',
// 			'instructions' => '',
// 			'required' => 0,
// 			'conditional_logic' => 0,
// 			'wrapper' => array(
// 				'width' => '',
// 				'class' => '',
// 				'id' => '',
// 			),
// 			'default_value' => '',
// 			'placeholder' => '',
// 			'prepend' => '',
// 			'append' => '',
// 			'maxlength' => '',
// 		),
// 		array(
// 			'key' => 'field_5d680e63b0e3f',
// 			'label' => 'Info',
// 			'name' => 'promo_info',
// 			'type' => 'wysiwyg',
// 			'instructions' => '',
// 			'required' => 0,
// 			'conditional_logic' => 0,
// 			'wrapper' => array(
// 				'width' => '',
// 				'class' => '',
// 				'id' => '',
// 			),
// 			'default_value' => '',
// 			'tabs' => 'all',
// 			'toolbar' => 'full',
// 			'media_upload' => 1,
// 			'delay' => 0,
// 		),
// 		array(
// 			'key' => 'field_5d68233ae7d68',
// 			'label' => 'Link',
// 			'name' => 'promo_link',
// 			'type' => 'link',
// 			'instructions' => '',
// 			'required' => 0,
// 			'conditional_logic' => 0,
// 			'wrapper' => array(
// 				'width' => '',
// 				'class' => '',
// 				'id' => '',
// 			),
// 			'return_format' => 'array',
// 		),
// 	),
// 	'location' => array(
// 		array(
// 			array(
// 				'param' => 'block',
// 				'operator' => '==',
// 				'value' => 'acf/promo',
// 			),
// 		),
// 	),
// 	'menu_order' => 0,
// 	'position' => 'normal',
// 	'style' => 'default',
// 	'label_placement' => 'top',
// 	'instruction_placement' => 'label',
// 	'hide_on_screen' => '',
// 	'active' => true,
// 	'description' => '',
// ));

// acf_add_local_field_group(array(
// 	'key' => 'group_5d6ea1fac0e37',
// 	'title' => 'Ticket',
// 	'fields' => array(
// 		array(
// 			'key' => 'field_5d6ebefa548d5',
// 			'label' => 'Colour',
// 			'name' => 'ticket_colour',
// 			'type' => 'select',
// 			'instructions' => '',
// 			'required' => 0,
// 			'conditional_logic' => 0,
// 			'wrapper' => array(
// 				'width' => '',
// 				'class' => '',
// 				'id' => '',
// 			),
// 			'choices' => array(
// 				'white' => 'White',
// 				'gray' => 'Gray',
// 			),
// 			'default_value' => array(
// 			),
// 			'allow_null' => 0,
// 			'multiple' => 0,
// 			'ui' => 0,
// 			'return_format' => 'value',
// 			'ajax' => 0,
// 			'placeholder' => '',
// 		),
// 		array(
// 			'key' => 'field_5d6ea23a00b15',
// 			'label' => 'Title',
// 			'name' => 'ticket_title',
// 			'type' => 'text',
// 			'instructions' => '',
// 			'required' => 0,
// 			'conditional_logic' => 0,
// 			'wrapper' => array(
// 				'width' => '',
// 				'class' => '',
// 				'id' => '',
// 			),
// 			'default_value' => '',
// 			'placeholder' => '',
// 			'prepend' => '',
// 			'append' => '',
// 			'maxlength' => '',
// 		),
// 		array(
// 			'key' => 'field_5d6ea24c00b16',
// 			'label' => 'Price',
// 			'name' => 'ticket_price',
// 			'type' => 'price',
// 			'instructions' => '',
// 			'required' => 0,
// 			'conditional_logic' => 0,
// 			'wrapper' => array(
// 				'width' => '',
// 				'class' => '',
// 				'id' => '',
// 			),
// 			'format' => '|2/./,|',
// 		),
// 		array(
// 			'key' => 'field_5d6ea462cf0b9',
// 			'label' => 'Price Info',
// 			'name' => 'ticket_price_info',
// 			'type' => 'text',
// 			'instructions' => '',
// 			'required' => 0,
// 			'conditional_logic' => 0,
// 			'wrapper' => array(
// 				'width' => '',
// 				'class' => '',
// 				'id' => '',
// 			),
// 			'default_value' => '',
// 			'placeholder' => '',
// 			'prepend' => '',
// 			'append' => '',
// 			'maxlength' => '',
// 		),
// 		array(
// 			'key' => 'field_5d6ea28000b17',
// 			'label' => 'Options',
// 			'name' => 'ticket_options',
// 			'type' => 'repeater',
// 			'instructions' => '',
// 			'required' => 0,
// 			'conditional_logic' => 0,
// 			'wrapper' => array(
// 				'width' => '',
// 				'class' => '',
// 				'id' => '',
// 			),
// 			'collapsed' => '',
// 			'min' => 0,
// 			'max' => 0,
// 			'layout' => 'block',
// 			'button_label' => 'Add Option',
// 			'sub_fields' => array(
// 				array(
// 					'key' => 'field_5d6ea29c00b18',
// 					'label' => 'Option Price',
// 					'name' => 'option_price',
// 					'type' => 'price',
// 					'instructions' => '',
// 					'required' => 0,
// 					'conditional_logic' => 0,
// 					'wrapper' => array(
// 						'width' => '',
// 						'class' => '',
// 						'id' => '',
// 					),
// 					'format' => '|2/./,|',
// 				),
// 				array(
// 					'key' => 'field_5d6ea2af00b19',
// 					'label' => 'Option Description',
// 					'name' => 'option_description',
// 					'type' => 'text',
// 					'instructions' => '',
// 					'required' => 0,
// 					'conditional_logic' => 0,
// 					'wrapper' => array(
// 						'width' => '',
// 						'class' => '',
// 						'id' => '',
// 					),
// 					'default_value' => '',
// 					'placeholder' => '',
// 					'prepend' => '',
// 					'append' => '',
// 					'maxlength' => '',
// 				),
// 			),
// 		),
// 		array(
// 			'key' => 'field_5d6ea2c200b1a',
// 			'label' => 'Link',
// 			'name' => 'ticket_link',
// 			'type' => 'link',
// 			'instructions' => '',
// 			'required' => 0,
// 			'conditional_logic' => 0,
// 			'wrapper' => array(
// 				'width' => '',
// 				'class' => '',
// 				'id' => '',
// 			),
// 			'return_format' => 'array',
// 		),
// 		array(
// 			'key' => 'field_5d6ea2ce00b1b',
// 			'label' => 'Legal',
// 			'name' => 'ticket_legal',
// 			'type' => 'text',
// 			'instructions' => '',
// 			'required' => 0,
// 			'conditional_logic' => 0,
// 			'wrapper' => array(
// 				'width' => '',
// 				'class' => '',
// 				'id' => '',
// 			),
// 			'default_value' => '',
// 			'placeholder' => '',
// 			'prepend' => '',
// 			'append' => '',
// 			'maxlength' => '',
// 		),
// 	),
// 	'location' => array(
// 		array(
// 			array(
// 				'param' => 'block',
// 				'operator' => '==',
// 				'value' => 'acf/ticket',
// 			),
// 		),
// 	),
// 	'menu_order' => 0,
// 	'position' => 'normal',
// 	'style' => 'default',
// 	'label_placement' => 'top',
// 	'instruction_placement' => 'label',
// 	'hide_on_screen' => '',
// 	'active' => true,
// 	'description' => '',
// ));

endif;
?>

<?php

// $groups = acf_get_local_field_groups();
// $json = [];

// foreach ($groups as $group) {
//     // Fetch the fields for the given group key
//     $fields = acf_get_local_fields($group['key']);

//     // Remove unecessary key value pair with key "ID"
//     unset($group['ID']);

//     // Add the fields as an array to the group
//     $group['fields'] = $fields;

//     // Add this group to the main array
//     $json[] = $group;
// }

// $json = json_encode($json, JSON_PRETTY_PRINT);
// // Optional - echo the JSON data to the page
// // echo "<pre>";
// // echo $json;
// // echo "</pre>";

// // Write output to file for easy import into ACF.
// // The file must be writable by the server process. In this case, the file is located in
// // the current theme directory.
// $file = get_template_directory() . '/bin/json/acf-import.json';
// file_put_contents($file, $json );

?>