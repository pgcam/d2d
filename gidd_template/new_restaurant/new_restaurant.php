<?php

if ( current_user_can('edit_posts') )
	___add( 'col1', 'new_restaurant' );

function ___col1_new_restaurant(){

	echo '<h2>Add a restaurant</h2>';
	echo '<form id="thumbnail_upload" method="post" action="'. site_url('/insert_restaurant/') .'" enctype="multipart/form-data">';
	
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
	$email	= ___text('Email', 'Put an email for your restaurant.');
	$addr 	= ___textarea( 'Address', 'Put your restaurant address here.' );
	
	$time	= ___text( 'Delivery Time', '' );
	$map	= ___text( 'Map Reference', '' );
	$charge = ___text( 'Delivery Charge', '' );
	$method = ___text( 'Method', '' );
	$waiting= ___text( 'AVG Waiting Time', '' );
	
	$sms	= ___text( 'SMS Phone', 'Put one number for SMS (cannot be 023)' );
	$tid	= ___text( 'Terminal ID', 'Put one terminal ID from Wing.' );	
	$sub	= ___submit( 'restooSubmit', 'Add restaurant' );
	
	$group  = ___id( 'new_restaurant' );
	
	
	
	echo ___space( 20 );
	
	echo "<span style='display: block; float: left; width: 120px; padding-top: 5px;'>Upload a logo here</span>";
	___editor( 'logo', $group );
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

	echo ___clearBoth();
	echo ___space( 10 );
	echo ___field( $sub );
	
	echo '</form>';	
	
	

}



/** end of new_restaurant.php */