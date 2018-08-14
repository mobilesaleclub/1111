<?php

add_action('init', 'simple_slider_register', 1);


function simple_slider_register() 

{



	$labels = array(

		'name' => __('Slides post type general name', 'the-simple'),

		'all_items'	=> __('Slides','the-simple' ),

		'singular_name' => __('Slide post type singular name', 'the-simple'),

		'menu_name'	=> __('Simple Slider','the-simple' ),

		'add_new' => __('Add New Slide slide', 'the-simple'),

		'add_new_item' => __('Add New Slide', 'the-simple'),

		'edit_item' => __('Edit Slide', 'the-simple'),

		'new_item' => __('New Slide', 'the-simple'),

		'view_item' => __('View Slide', 'the-simple'),

		'search_items' => __('Search Slides', 'the-simple'),

		'not_found' =>  __('No Slides found', 'the-simple'),

		'not_found_in_trash' => __('No Slides found in Trash', 'the-simple'), 

		'parent_item_colon' => ''

	);



	$args = array(

		'labels' => $labels,

		'public' => true,

		'show_ui' => true,

		'capability_type' => 'post',

		'hierarchical' => false,

		'rewrite' => array('slug'=>'slides','with_front'=>true),

		'query_var' => true,

		'show_in_nav_menus'=> false,

		'supports' => array('title')

	);

	

	

	

	

	

	$labels = array(
			
			'menu_name' => __( 'Sliders','the-simple' ),

			'name' => __( 'Sliders taxonomy general name', 'the-simple' ),

			'singular_name' => __( 'Slider taxonomy singular name', 'the-simple' ),

			'all_items' => __( 'All Sliders','the-simple' ),

			'search_items' =>  __( 'Search Sliders','the-simple' ),

			'parent_item' => __( 'Parent Slider','the-simple' ),

			'parent_item_colon' => __( 'Parent Slider:','the-simple' ),

			'update_item' => __( 'Update Slider','the-simple' ),

			'add_new_item' => __( 'Add New Slider','the-simple' ),

			'edit_item' => __( 'Edit Slider','the-simple' ), 

			'new_item_name' => __( 'New Slider Name','the-simple' )

			
	 );     

	 

}



add_filter("manage_edit-slide_columns", "slide_edit_columns");

add_action("manage_posts_custom_column",  "slide_custom_columns");



function slide_edit_columns($columns)

{

	$newcolumns = array(

		"cb" => "<input type=\"checkbox\" />",

		

		"title" => "Title",

		"slides" => "Sliders"

	);

	

	$columns= array_merge($newcolumns, $columns);

	

	return $columns;

}



/**

 * prod_custom_columns()

 * 

 * @param mixed $column

 * @return

 */

function slide_custom_columns($column)

{

	global $post;

	switch ($column)

	{

	

		case "description":

		

		break;

		case "price":

		

		break;

		case "slider":

		echo get_the_term_list($post->ID, 'slider', '', ', ','');

		break;

	}

}

?>