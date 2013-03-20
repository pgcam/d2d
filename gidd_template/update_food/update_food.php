<?php
___add( 'col1', 'update_food' );
function ___col1_update_food(){

	echo '<h2>Update food item</h2>';
	echo ___space( 20 );
		
	___form( basename(__FILE__), site_url('/update_menu/'), 'update_food_fields' );

}


function update_food_fields( $id ){


	$fid = $_GET['id'];
	$rid = $_GET['rid'];
	
	

	$food_id    	= ___text("Food ID", "Put the food id.");
	$food_group 	= ___text( 'Food Title', 'Put the food title here.' );
	
	$submenu_items  = get_food_submenu( $rid, 'id' );
	$sub_menu		= ___select( 'Sub menu', $submenu_items, 'Select a sub menu for this food' );
	
	
	$desc			= ___textarea( 'Description', 'Description for the food.' );
	$food_price 	= ___text( 'Food Price', 'put the price here' );
	$food_price2	= ___text( 'Food Price 2', 'put the second price here' );
	$food_price3	= ___text( 'Food Price 3', 'put the thrid price here' );
	$sub			= ___submit( 'updatefood', 'Update' );
	
	//set value	
	$post = get_post( $fid );
	$food_id->value = get_post_meta( $fid, 'food_id', true );
	$food_group->value = $post->post_title;
	$desc->value = $post->post_content;
	$food_price->value = get_post_meta( $fid, 'food_price', true );
	$food_price2->value = get_post_meta( $fid, 'food_price2', true );
	$food_price3->value = get_post_meta( $fid, 'food_price3', true );
	
	
	//photo
	echo '<div id="res-logo">';
	echo ( '<span class="food_photo">Photo</span>' );
	___editor( 'food_photo', $id, array(), get_post_meta( $fid, 'food_photo', true ) );
	echo '</div>';
	echo ___clearBoth();
	echo ___space(20);
	
	
	//get object term id
	$tid = "";
	$sm = wp_get_object_terms( $fid, 'submenu' );
	foreach ( $sm as $term ){
		$tid = $term->term_id;
	}
	
	//set the value so that it display current term in the submenu list
	$sub_menu->value = $tid;
	
	
	echo ___field( $sub_menu, $id );
	echo ___clearBoth();
	echo ___space(20);
	
	echo ___field( $food_id, $id);
	echo ___clearBoth();
	echo ___space(20);
	
	echo ___field( $food_group, $id );	
	echo ___clearBoth();
	echo ___space(20);
	
	echo ___field( $desc, $id );
	echo ___clearBoth();
	echo ___space(20);
	
	echo ___field( $food_price, $id );
	echo ___clearBoth();
	echo ___space(20);
	
	echo ___field( $food_price2, $id );
	echo ___clearBoth();
	echo ___space(20);
	
	echo ___field( $food_price3, $id );
	echo ___clearBoth();
	echo ___space(20);
	
	
	/*echo '<br /><br />';
	echo '<h2>Extra/Add-on food if available</h2>';
	echo ___space( 20 );
	addon_food_fields( $id );*/	
	
	echo '<input type="hidden" name="food_id" value="'. $fid .'" />';
	echo '<input type="hidden" name="restoo_id" value="'. $rid .'" />';
	echo ___field( $sub );
	

}









/** end of update_food.php */ 