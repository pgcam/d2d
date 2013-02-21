<?php

function cpt_label( $singular, $plural ){

	$labels = array(
	
		'name'                          => "$plural",
		'singular_name'                 => $singular,
		'search_items'                  => "Search $plural",
		'popular_items'                 => "Popular $plural",
		'all_items'                     => "All $plural",
		'parent_item'                   => "Parent " . $singular,
		'edit_item'                     => "Edit " . $singular,
		'update_item'                   => "Update " . $singular,
		'add_new_item'                  => "Add " . $singular,
		'new_item_name'                 => "New " . $singular,
		'separate_items_with_commas'    => "Seperate $plural with commas",
		'add_or_remove_items'           => "Add or remove " . $singular,
		'choose_from_most_used'         => "Choose from the most used $plural"
		
	);
	
	return $labels;

}


//register a food post type
add_action( 'init', 'gidd_restaurant_post_type' );
function gidd_restaurant_post_type(){

	//gd_restaurant
	register_post_type( "gd_restaurant",
	array(
		'labels' => array(
			'name' => __( "Restaurants" ),
			'singular_name' => __( "Restaurant" ),
			'add_new' => __( "Add Restaurants" ),
			'add_new_item' => __( "Add Restaurant"  ),
			'edit_item' => __( "Edit Restaurant"  ),
			'view_item' => __( "Read Restaurant" )
		),
		
		'public' => true,
		'show_ui' => true,
		'exclude_from_search' => false,
		'rewrite' => array('slug' => "restaurant", 'with_front' => false),
		'capability_type' => "post",
		'has_archive' => true,
		'show_in_menu' => true,
		'taxonomies' => array('category', 'post_tag'),
		'supports' => array( "title", "editor", "thumbnail", "revision" ) )
	);
	
	
	//gd_food
	register_post_type( "gd_food",
	array(
		'labels' => array(
			'name' => __( "Food" ),
			'singular_name' => __( "Food" ),
			'add_new' => __( "Add Food" ),
			'add_new_item' => __( "Add Food"  ),
			'edit_item' => __( "Edit Food"  ),
			'view_item' => __( "Read Food" )
		),
		
		'public' => true,
		'show_ui' => true,
		'exclude_from_search' => false,
		'rewrite' => array('slug' => "food", 'with_front' => false),
		'capability_type' => "post",
		'has_archive' => true,
		'show_in_menu' => true,
		//'taxonomies' => "",
		'supports' => array( "title", "editor", "thumbnail", "revision" ) )
	);
	
	
	//taxonomy
	$labels = array(
	'name'                          => "Sub menus",
	'singular_name'                 => 'Sub menu',
	'search_items'                  => "Search Sub menus",
	'popular_items'                 => "Popular Sub menus",
	'all_items'                     => "All Sub menus",
	'parent_item'                   => "Parent Sub menu",
	'edit_item'                     => "Edit Sub menu",
	'update_item'                   => "Update Sub menu",
	'add_new_item'                  => "Add Sub menu",
	'new_item_name'                 => "New Sub menu",
	'separate_items_with_commas'    => "Seperate Sub menu with commas",
	'add_or_remove_items'           => "Add or remove Sub menu",
	'choose_from_most_used'         => "Choose from the most used Sub menus"
	);

	$args = array(
		'label'                         => "Sub menus",
		'labels'                        => $labels,
		'public'                        => true,
		'hierarchical'                  => true,
		'show_ui'                       => true,
		'show_in_nav_menus'             => true,
		'args'                          => array( 'orderby' => 'term_order' ),
		'rewrite'                       => array( 'slug' => "sub-menu", 'with_front' => false ),
		'query_var'                     => true
	);

	register_taxonomy( "submenu", 'gd_food', $args );
	
	
	//extra food post type
	register_post_type( "gd_extra_food",
	array(
		'labels' => array(
			'name' => __( "Extra Food" ),
			'singular_name' => __( "Extra Food" ),
			'add_new' => __( "Add Extra Food" ),
			'add_new_item' => __( "Add Extra Food"  ),
			'edit_item' => __( "Edit Extra Food"  ),
			'view_item' => __( "Read Extra Food" )
		),
		
		'public' => true,
		'show_ui' => true,
		'exclude_from_search' => false,
		'rewrite' => array('slug' => "extra-food", 'with_front' => false),
		'capability_type' => "post",
		'has_archive' => true,
		'show_in_menu' => true,
		//'taxonomies' => "",
		'supports' => array( "title", "editor", "revision" ) )
	);
	
	
	//invoice post type
	register_post_type( "gd_invoice",
	array(
		'labels' => array(
			'name' => __( "Invoice" ),
			'singular_name' => __( "Invoice" ),
			'add_new' => __( "Add Invoice" ),
			'add_new_item' => __( "Add Invoice"  ),
			'edit_item' => __( "Edit Invoice"  ),
			'view_item' => __( "Read Invoice" )
		),
		
		'public' => true,
		'show_ui' => true,
		'exclude_from_search' => false,
		'rewrite' => array('slug' => "invoice", 'with_front' => false),
		'capability_type' => "post",
		'has_archive' => true,
		'show_in_menu' => true,
		//'taxonomies' => "",
		'supports' => array( "title", "editor", 'custom-fields' ) )
	);
	
	
		
	
	//gidd_register_post_type( "gd_restaurant", "Restaurant", "Restaurants", "restaurant", array( "title", "editor", "thumbnail", "revision" ), array('category'), false, "post", true );
	//gidd_register_post_type( "gd_food", "Food", "Food", "food", array( "title", "editor", "thumbnail" ), array(), false, "post", true );
	
	
	
	
	//gidd_register_taxonomy( "submenu", "gd_food", "Sub menu", 'Sub menus', 'sub-menu' );	
	//save all restoo to registry
	get_all_restaurants();
	
}


gidd_include_file( CHILDAPP . 'gidd_food/helper.php' );


//register metabox
/*___metabox( 'gidd_food', 'Food Info', 'gidd_food_info_mb', 'gd_food' );
function gidd_food_info_mb( $mb ){

	$address 	= ___textarea('Address', 'Put your restaurant address here.');
	$phone 		= ___text( 'Telephone', 'Put your restaurant telephone here.' );
	
	echo ___field( $phone, $mb );
	echo ___field( $address, $mb );
	
	
}*/







/** end of gidd_load.php */