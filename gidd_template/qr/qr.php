<?php

___add( 'col1', 'qr' );
function ___col1_qr(){
	
	
	for( $i=8; $i<=15; $i++ ){
	
		echo '<h1>'. $i .'</h1>';
		echo '<h2>'. basename(get_permalink($i)) .'</h2>';
		echo do_shortcode( '[qr-code id="'. $i .'" size="350"]' );
		echo '<br /><br /><br />';
	
	
	}
	
	
	//echo do_shortcode( '[qr-code id="4" size="350"]' );
	
	
	

}



/*** end of qr */