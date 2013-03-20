<?php

/*//update options
update_option('home', 'http://localhost/git/d2d/');
update_option('siteurl', 'http://localhost/git/d2d/');*/

add_action('init', 'd2d_init');
function d2d_init(){
	session_start();
}

//include gidd
locate_template( array( 'gidd/gidd.php' ), true );

//add_filter( 'get_search_form', 'change_search' );
function change_search( $search ) {
	return str_replace( 'value="Search"', 'value=""', $search );
}

add_filter( 'gidd_fav_icon', 'd2d_fav_icon' );
function d2d_fav_icon(){
	return PARENTURL . 'fav.png';
}

add_filter( 'gidd_html_title', 'd2d_html_title' );
function d2d_html_title( $title ){
	return 'Door2Door - Online Food Delivery Guide in Phnom Penh, Cambodia';
}

add_filter( 'gidd_html_description', 'd2d_html_description' );
function d2d_html_description( $desc ){

	$desc  = 'DOOR-2-DOOR is an online food delivery guide in Phnom Penh, ';
	$desc .= 'Cambodia featuring menus of restaurants. Customers can order food from over 50 outlets serving more than 2000 separate dishes';

	$meta = '<meta name="description" content="'. $desc .'" />';
	return $meta;

}

add_filter( 'gidd_html_keywords', 'd2d_html_keywords' );
function d2d_html_keywords( $keyword ){
	
	$keyword = 'food, deliver, delivery, Phnom Penh, restaurant, order, hungry';
	$meta = '<meta name="keywords" content="'. $keyword .'" />';
	return $meta;

}


/*
add_filter( 'layout_home_2', 'theme_home_2' );
function theme_home_2( $layout ){
	return 'Col1f';
}
add_filter( 'layout_home_10', 'theme_home_10' );
function theme_home_10( $layout ){
	return 'Col1f';
}




___sidebar( "testing", 'testing widget', 1 );



*/



add_filter('pre_get_posts',  'restrict_media');

//$arg is the WP_Query object
function restrict_media($arg) {
	global $user_ID;
	if ($arg->query['post_type'] == 'attachment' && is_admin()) {
		$arg->query['author'] = $user_ID;
		$arg->query_vars['author'] = $user_ID;
	}
	return $arg;

}


	









/** functions.php */