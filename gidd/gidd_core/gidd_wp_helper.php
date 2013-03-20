<?php
/*** REGISTER HOOK HELPER ***/
function ___do( $hook, $page = "" ) {
	
	$hook = "___".$hook;	
	$func = empty( $page ) ? $hook : $hook . "_" . $page;
	
	if ( function_exists( $func ) ){
		if ( has_action( $func ) )
			do_action( $func );
		else
			do_action( $hook );
	}else{
		do_action( $hook );
	}
	
}

function ___add( $hook, $page = "" ) {

	$hook = "___" . $hook;
	$hook = empty ( $page ) ? $hook : $hook . "_" . $page;
	add_action( $hook, $hook );
		
}

/*** APPLY FILTERS HELPER ***/
function ___apply( $filter_name, $var, $page = "" ){
	$name = ( $page == "" ) ? $filter_name : $filter_name . "_" . $page;
	return apply_filters( $name, $var );
}

//not yet implemented
function ___filter(){}

/*** SHOW LOGO ***/
function ___brand() {
	echo ( '<div class="brand">' );
	if( is_single() || is_page() ){
		echo ( '<h2><a href="' ); echo home_url(); echo ( '" title="' ); bloginfo( "name" ); echo ( '"><span>' );
		echo get_bloginfo( 'name' ); echo ( '</span></a></h2>' );
	}else {
		echo ( '<h1><a href="' ); echo home_url(); echo ( '" title="' ); bloginfo( "name" ); echo ( '"><span>' );
		echo get_bloginfo( 'name' ); echo ( '</span></a></h1>' );
	}
	echo ( '</div>' );
	echo ( '<div id="site-description">' ); bloginfo( 'description' ); echo ( '</div>' );
}

/*** SHOW PRIMARY MENU ***/
function ___menu( $location = "primary" ) {
	if ( get_option('ns_menu_subtitle') ) {		
		wp_nav_menu( array(
			'container' => false,
			'theme_location' => $location,
			'menu_class' => 'menu',
			'walker' => new My_Walker(),
		));
	} else {
		wp_nav_menu( array(
			'container' => false,
			'theme_location' => $location,
			'menu_class' => 'menu',
		));
	}
	echo ( '<div class="clearBoth"></div>' );
}

function ___space( $num ){
	return '<div class="space" style="width: 1px; height: '. $num .'px;"></div>';
}

function ___clearBoth(){
	return '<br class="clearBoth" />';
}

//auto load style & script for each page name
function ___script(){
	
	$name = ___name();
	
	if ( is_multisite() ){
	
		$id = get_current_blog_id();
		
		//load sitewide style & script
		wp_enqueue_style('style-'. $id, CHILDTPURL . $id . '/' . 'default_' . $id . '/default_'. $id .'.css', "", "$id", 'screen, projection' );
		wp_enqueue_script( 'script-' . $id, CHILDTPURL . $id . '/' . 'default_' . $id . '/default'. $id .'.js', "", "$id", false );
		
		//load pagewide style & script
		wp_enqueue_style( $name.'-style', CHILDTPURL . $id . '/' . $name . '/'. ___name() .'.css', "", "$id", 'screen, projection' );
		wp_enqueue_script( $name.'-script', CHILDTPURL . $id . '/' . $name . '/'. ___name() .'.js', "", "$id", false );
		
	}else{
	
		wp_enqueue_style( $name.'-style', CHILDTPURL . $name . '/'. ___name() .'.css', "", "1", "screen, projection" );
		wp_enqueue_script( $name.'-script', CHILDTPURL . $name . '/'. ___name() .'.js', "", "1", false );
		
	}
	
}

/* End of template helper.php */