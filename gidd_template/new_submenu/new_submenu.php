<?php

if ( isset( $_POST['foodgroup'] ) ):

	//$submenu = $_POST['__pgf24'];
	$submenu = $_POST['__b8iXe'];
	
	//sub_title 1
	if ( $submenu['__7pAbI'] != "" ){
	
		if ( !term_exists( $submenu['__7pAbI'], 'submenu' ) ){
			wp_insert_term(
			  $submenu['__7pAbI'], // the term 
			  'submenu', // the taxonomy
			  array( 'description' => $submenu['__Pm0yQ'] )
			);	
		}
	}
	
	//sub_title 2
	if ( $submenu['__axKta'] != "" ){
		if ( !term_exists( $submenu['__axKta'], 'submenu' ) ){
			wp_insert_term(
			  $submenu['__axKta'], // the term 
			  'submenu', // the taxonomy
			  array( 'description' => $submenu['__7RZeA'] )
			);
		}
	}
	
	//sub_title 3
	if ( $submenu['__1Ucdq'] != "" ){
		if ( !term_exists( $submenu['__1Ucdq'], 'submenu' ) ){
			wp_insert_term(
			  $submenu['__1Ucdq'], // the term 
			  'submenu', // the taxonomy
			  array( 'description' => $submenu['__drVLg'] )
			);
		}
	}
	
	//sub_title 4
	if ( $submenu['__FwrK8'] != "" ){
		if ( !term_exists( $submenu['__FwrK8'], 'submenu' ) ){
			wp_insert_term(
			  $submenu['__FwrK8'], // the term 
			  'submenu', // the taxonomy
			  array( 'description' => $submenu['__DLn4k'] )
			);
		}
	}
	
	//sub_title 5
	if ( $submenu['__KQ2Ki'] != "" ){
		if ( !term_exists( $submenu['__KQ2Ki'], 'submenu' ) ){
			wp_insert_term(
			  $submenu['__KQ2Ki'], // the term 
			  'submenu', // the taxonomy
			  array( 'description' => $submenu['__ypalu'] )
			);
		}
	}
	
	//sub_title 6
	if ( $submenu['__W7URY'] != "" ){
		if ( !term_exists( $submenu['__W7URY'], 'submenu' ) ){
			wp_insert_term(
			  $submenu['__W7URY'], // the term 
			  'submenu', // the taxonomy
			  array( 'description' => $submenu['__9Iktg'] )
			);
		}
	}
	
	//sub_title 7
	if ( $submenu['__neuoO'] != "" ){
		if ( !term_exists( $submenu['__neuoO'], 'submenu' ) ){
			wp_insert_term(
			  $submenu['__neuoO'], // the term 
			  'submenu', // the taxonomy
			  array( 'description' => $submenu['__2prP2'] )
			);
		}
	}
	
	//sub_title 8
	if ( $submenu['__OpMYW'] != "" ){
		if ( !term_exists( $submenu['__OpMYW'], 'submenu' ) ){
			wp_insert_term(
			  $submenu['__OpMYW'], // the term 
			  'submenu', // the taxonomy
			  array( 'description' => $submenu['__Ix5zy'] )
			);
		}
	}
	
	//sub_title 9
	if ( $submenu['__e5RrE'] != "" ){
		if ( !term_exists( $submenu['__e5RrE'], 'submenu' ) ){
			wp_insert_term(
			  $submenu['__e5RrE'], // the term 
			  'submenu', // the taxonomy
			  array( 'description' => $submenu['__Ll0Wy'] )
			);	
		}
	}
	
	//sub_title 10
	if ( $submenu['__bUTSW'] != "" ){
		if ( !term_exists( $submenu['__bUTSW'], 'submenu' ) ){
			wp_insert_term(
			  $submenu['__bUTSW'], // the term 
			  'submenu', // the taxonomy
			  array( 'description' => $submenu['__e0sFE'] )
			);
		}
	}
	
	wp_redirect( site_url('/add_food/') );
	exit;

endif;


/** end of new_submenu.php */