<?php

___add( 'col1', 'edit_menu' );
function ___col1_edit_menu(){

	$id = $_GET['id'];
	$post = get_post( $id );
	
	echo '<h2 class="restoo_title">'. $post->post_title .'</h2>';
	
	echo ___space( 15 );
			
	$submenu = get_food_submenu( $id ); //helper.php of gidd_food
	$order_sm = get_post_meta( $id, 'submenu_order', true );
	asort( $order_sm );
	
	$new_sm = array();
	foreach ( $order_sm as $sm => $order ){
		$new_sm[$sm] = $submenu[$sm]; 
	}
	
	unset( $submenu );
	unset( $order_sm );
	
	
	foreach( $new_sm as $slug => $name ){
	
		echo '<div class="food-group">';
		echo '<h2>'. $name .'</h2>';
		
		$term = get_term_by( 'slug', $slug, 'submenu' );
		echo '<div class="order_notice">'. term_description( $term->term_id, 'submenu' ) .'</div>';
		
		get_food_by_restaurant( $id, $slug, true );	
		
		echo '</div>';
		
	}



}





/** end of edit_menu.php */