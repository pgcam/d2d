<?php

___add( 'init', 'redirect' );
function ___init_redirect(){

	if ( $_GET['page'] == "d2d" ){
	
			wp_redirect( home_url() );
			exit();
	
	}
	
	
	if ( $_GET['page'] == "ucare" ){
	
			wp_redirect( 'http://ucarepharma.com/' );
			exit();
	
	}

	wp_redirect( site_url( '/restaurant/' . $_GET['page'] . '/' ) );
	exit;

}



/** end of redirect.php */