<?php

/*** WP CONFIG ***/		
/* This theme uses post thumbnails */
 if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
}

 /* This theme supports WordPress 3 menu */
 if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'menus' );
}

/* Add default posts and comments RSS feed links to head */
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'automatic-feed-links' );
}

/* Add editor style */
add_editor_style();

//remove the generator
add_filter('the_generator', 'gidd_remove_version');
function gidd_remove_version() {
	return '';
}

add_filter( 'update_footer', 'gidd_footer_version', 11 );
function gidd_footer_version() {
    return '<a href="http://www.gidd.org" target="_blank">Gidd</a> version 1.0.0';
}

//register menu
add_action( 'init', 'gidd_register_menus' );	
function gidd_register_menus() {
	$menu = array(
		'primary' => __( 'Primary Menu', 'nisaiy' ),
		'secondary' => __( 'Secondary Menu', 'nisaiy' ),
	);
	
	$menu = apply_filters( 'gidd_nav_menu', $menu );		
	register_nav_menus( $menu );
}

/*** REMOVE THE ROLE TAG IN SEARCH ***/
add_filter( 'get_search_form', 'gidd_search_form' );
function gidd_search_form( $search ) {
	return str_replace( 'role="search"', '', $search );
}


/*** ADD HOME LINK TO THE NAV ***/
function set_home_item_default() {

	$home = "Home";
	if ( $home == "" ) { 
		$home = get_option( 'ns_menu_subtitle' ) ? "<strong>Home</strong><span>visit homepage</span>" : "Home";
	}
	
	if ( ( $home == "Home" ) && ( get_option( 'ns_menu_subtitle' ) ) ) {
		$home = "<strong>Home</strong><span>visit homepage</span>";
		$home = apply_filters('nisaiy_menu_home_link', $home);
	}
	return $home;
}

function add_home_link( $menuItems, $args ) { 
	$home = set_home_item_default();
	if( 'primary' == $args->theme_location ) {
		if ( is_front_page() )
			$class = 'class="current_page_item"';
		else
			$class = '';
 
		$homeMenuItem = '<li ' . $class . '>' .
						$args->before .
						'<a href="' . home_url( '/' ) . '" title="'. $home .'">' .
							$args->link_before .
							$home .
							$args->link_after .
						'</a>' .
						$args->after .
						'</li>';
 
		$menuItems = $homeMenuItem . $menuItems;
		return $menuItems;
	}else{
		return $menuItems;
	}
}

//add_filter( 'wp_nav_menu_items', 'add_home_link', 10, 2 );


function gidd_page_menu_args( $args ) {
	$home = set_home_item_default();
	$args['show_home'] = $home;
	return $args;
}

if ( get_option( 'ns_show_home_link' ) ) {
	add_filter( 'wp_page_menu_args', 'gidd_page_menu_args' );
}








/* End of config */