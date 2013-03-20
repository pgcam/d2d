<?php

if ( current_user_can('edit_posts') )
	___add( 'col1', 'add_food' );

function ___col1_add_food(){

	if ( isset( $_GET['success'] ) && $_GET['success'] != "" )
		echo '<span class="success_info">You have added a new food item: <span class="food_add_success">'. $_GET['success'] .'.</span></span>';


	echo '<h2>Add food to restaurants</h2>';
	echo ___space( 20 );
		
	___form( basename(__FILE__), site_url('/insert_food/'), 'add_food_fields' );
		
}

function add_food_fields( $id ){

	$arr_restoo 	= get_all_restaurants();
		
	if ( isset( $_GET['restoo'] ) )
		$rid = $_GET['restoo'];
		
	if ( isset( $_GET['submenu'] ) )
		$smid = $_GET['submenu'];


	$restoo			= ___select( 'Restaurant', $arr_restoo, 'Select a restaurant' );
	$food_id    	= ___text("Food ID", "Put the food id.");
	$food_group 	= ___text( 'Food Title', 'Put the food title here.' );
	$sub_menu		= ___select( 'Sub menu', ___list_terms('submenu', 'array'), 'Select a sub menu for this food' );
	$desc			= ___textarea( 'Description', 'Description for the food.' );
	$food_price 	= ___text( 'Food Price', 'put the price here' );
	$food_price2	= ___text( 'Food Price 2', 'put the second price here' );
	$food_price3	= ___text( 'Food Price 3', 'put the thrid price here' );
	$sub			= ___submit( 'foodgroup', 'Submit' );
	
	$restoo->value = $rid;
	$sub_menu->value = $smid;
	
	//photo
	echo '<div id="res-logo">';
	echo ( '<span class="food_photo">Photo</span>' );
	___editor( 'food_photo', $id, array(), "" );
	echo '</div>';
	echo ___clearBoth();
	echo ___space(20);
	
	echo ___field( $restoo, $id );
	echo ___clearBoth();
	echo ___space(20);
	
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
	
	
	echo '<br /><br />';
	echo '<h2>Extra/Add-on food if available</h2>';
	echo ___space( 20 );
	addon_food_fields( $id );
	
	
		
	echo ___field( $sub );
	

}


function addon_food_fields( $id ){

	$title1 = ___text( 'Food title1', 'Put addon/Extra food title here.' );
	$price1 = ___text( 'Price1', 'Put the price for addon food here' );

	$title2 = ___text( 'Food title2', 'Put addon/Extra food title here.' );
	$price2 = ___text( 'Price2', 'Put the price for addon food here' );

	$title3 = ___text( 'Food title3', 'Put addon/Extra food title here.' );
	$price3 = ___text( 'Price3', 'Put the price for addon food here' );

	$title4 = ___text( 'Food title4', 'Put addon/Extra food title here.' );
	$price4 = ___text( 'Price4', 'Put the price for addon food here' );

	$title5 = ___text( 'Food title5', 'Put addon/Extra food title here.' );
	$price5 = ___text( 'Price5', 'Put the price for addon food here' );
	
	
	echo ___field( $title1, $id );
	echo ___field( $price1, $id );
	echo ___clearBoth();
	echo ___space( 20 );
	
	echo ___field( $title2, $id );
	echo ___field( $price2, $id );
	echo ___clearBoth();
	echo ___space( 20 );
	
	echo ___field( $title3, $id );
	echo ___field( $price3, $id );
	echo ___clearBoth();
	echo ___space( 20 );
	
	echo ___field( $title4, $id );
	echo ___field( $price4, $id );
	echo ___clearBoth();
	echo ___space( 20 );
	
	echo ___field( $title5, $id );
	echo ___field( $price5, $id );
	echo ___clearBoth();
	echo ___space( 20 );
	
	
	

}


/** end of add_food.php */