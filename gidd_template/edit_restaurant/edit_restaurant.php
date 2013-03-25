<?php

___add( 'col1', 'edit_restaurant' );

function ___col1_edit_restaurant(){

	echo '<h2>Edit a restaurant</h2>';
	echo '<form id="thumbnail_upload" method="post" action="'. site_url('/update_restaurant/') .'" enctype="multipart/form-data">';
	
	$category = get_categories( array( 'hide_empty' => 0 ) );
	$cusine_type = array();
	foreach ( $category as $cat )
		$cusine_type[ $cat->cat_ID ] = $cat->name;
	
	unset( $cusine_type[1] ); //remove uncategorized from the list
	
	$name	= ___text('Restaurant name', 'Put the restaurant name here');
	//$desc	= ___textarea( 'Description', 'Information for visitors such as delivery method, telephone, address etc ' );
	$web	= ___text( 'Web address', 'Put the web address here.' );
	$cusine	= ___list('Cusine Type', $cusine_type, 'Select cusine types for this restaurant.' );
	$phone	= ___text('Phone', 'Put your restaurant telephones here.');
	$email	= ___text( 'Email', 'Put an email for your restaurant here.' );
	$addr 	= ___textarea( 'Address', 'Put your restaurant address here.' );
	
	$time	= ___text( 'Delivery Time', '' );
	$map	= ___text( 'Map Reference', '' );
	$charge = ___text( 'Delivery Charge', '' );
	$method = ___text( 'Method', '' );
	$waiting= ___text( 'AVG Waiting Time', '' );
	
	$sms	= ___text( 'SMS Phone', 'Put one number for SMS (cannot be 023)' );
	$tid	= ___text( 'Terminal ID', 'Put one terminal ID from Wing.' );
	$sub	= ___submit( 'restooEdit', 'Update restaurant' );
	$group  = ___id( 'new_restaurant' );	
	
	$id = $_GET['id'];
	
	//set value
	$name->value = get_the_title( $id );
	$phone->value = get_post_meta( $id, 'restoo_phone', true );
	$email->value = get_post_meta( $id, 'restoo_email', true );
	$addr->value = get_post_meta( $id, 'restoo_address', true );
	$time->value = get_post_meta( $id, 'restoo_time', true );
	$map->value = get_post_meta( $id, 'restoo_map', true );
	$charge->value = get_post_meta( $id, 'restoo_charge', true );
	$method->value = get_post_meta( $id, 'restoo_method', true );
	$waiting->value = get_post_meta( $id, 'restoo_waiting', true );
	$web->value = get_post_meta( $id, 'restoo_web_url', true );
	
	
	echo ___space( 20 );
	
	$post = get_post( $id );
	
	echo '<div id="res-logo">';
	echo "<span style='display: block; float: left; width: 150px; padding-top: 5px;'>Upload a logo here</span>";
	___editor( 'logo', $group, array(), $post->post_content );
	echo '</div>';
	echo ___clearBoth();
	echo ___space( 20 );
	
	echo ___field( $name, $group );
	echo ___clearBoth();
	echo ___space( 20 );
	
	echo ___field( $phone, $group );
	echo ___clearBoth();
	echo ___space( 20 );
	
	echo ___field( $addr, $group );
	echo ___clearBoth();
	echo ___space( 20 );
	
	echo ___clearBoth();
	echo ___space( 20 );
	
	echo ___field( $time, $group );
	echo ___clearBoth();
	echo ___space( 20 );
	
	echo ___field( $map, $group );
	echo ___clearBoth();
	echo ___space( 20 );
	
	echo ___field( $charge, $group );
	echo ___clearBoth();
	echo ___space( 20 );
	
	echo ___field( $method, $group );
	echo ___clearBoth();
	echo ___space( 20 );
	
	echo ___field( $waiting, $group );
	echo ___clearBoth();
	echo ___space( 20 );
		
	echo ___field( $web, $group );
	echo ___clearBoth();
	echo ___space( 20 );
	
	echo ___field( $email, $group );
	echo ___clearBoth();
	echo ___space( 20 );
		
	echo ___field( $tid, $group );
	echo ___clearBoth();
	echo ___space( 20 );
		
	echo ___field( $sms, $group );
	echo ___clearBoth();
	echo ___space( 20 );	
	
	
	echo ___field( $cusine, $group );
	
	echo "<span style='display: block; float: left; width: 150px; padding-top: 5px;'>Description</span>";
	___editor( 'description', $group, array(), get_post_meta( $id, 'restoo_desc', true ) );
	echo ___clearBoth();
	echo ___space( 20 );

	
	echo ___clearBoth();
	echo ___space( 10 );
	echo ___field( $sub );
	
	
	echo '<input type="hidden" name="restoo_id" value="'. $id .'" />';
	echo '</form>';	
	
}




/** end of edit_restaurant.php */