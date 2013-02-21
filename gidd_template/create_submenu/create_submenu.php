<?php

if ( current_user_can('edit_posts') )
	___add('col1', 'create_submenu');

function ___col1_create_submenu(){


	if ( isset( $_GET['success'] ) && $_GET['success'] != "" )
		echo '<span class="success_info">'. $_GET['success'] .'</span>';

	echo '<h2>Add Submenu to restaurants</h2>';
	echo ___space( 20 );
	
	$arr_restoo = get_all_restaurants();
	$group = ___id( basename(__FILE__) );
	
	
	//$restoo = ___select( 'Restaurant', $arr_restoo, 'Select a restaurant' );
	
	$fg1 	= ___text( 'Submenu Title 1', 'Put submenu title here.' );
	$fg2 	= ___text( 'Submenu Title 2', 'Put submenu title here.' );
	$fg3 	= ___text( 'Submenu Title 3', 'Put submenu title here.' );
	$fg4 	= ___text( 'Submenu Title 4', 'Put submenu title here.' );
	$fg5 	= ___text( 'Submenu Title 5', 'Put submenu title here.' );
	$fg6 	= ___text( 'Submenu Title 6', 'Put submenu title here.' );
	$fg7 	= ___text( 'Submenu Title 7', 'Put submenu title here.' );
	$fg8 	= ___text( 'Submenu Title 8', 'Put submenu title here.' );
	$fg9 	= ___text( 'Submenu Title 9', 'Put submenu title here.' );
	$fg10	= ___text( 'Submenu Title 10', 'Put submenu title here.' );
	
	$sm1	= ___textarea( 'Description 1', '' );
	$sm2	= ___textarea( 'Description 2', '' );
	$sm3	= ___textarea( 'Description 3', '' );
	$sm4	= ___textarea( 'Description 4', '' );
	$sm5	= ___textarea( 'Description 5', '' );
	$sm6	= ___textarea( 'Description 6', '' );
	$sm7	= ___textarea( 'Description 7', '' );
	$sm8	= ___textarea( 'Description 8', '' );
	$sm9	= ___textarea( 'Description 9', '' );
	$sm10	= ___textarea( 'Description 10', '' );
		
	$sub	= ___submit( 'foodgroup', 'Submit' );
	
	
	echo '<form id="frm_submenu" method="post" action="'. site_url('/new_submenu/') .'">';
	
	//echo ___field( $restoo, $group );
	//echo ___clearBoth();
	//echo ___space( 20 );
	
	echo ___field( $fg1, $group );
	echo ___field( $sm1, $group );
	echo ___clearBoth();
	echo ___space( 20 );
	
	echo ___field( $fg2, $group );
	echo ___field( $sm2, $group );
	echo ___clearBoth();
	echo ___space( 20 );
	
	echo ___field( $fg3, $group );
	echo ___field( $sm3, $group );
	echo ___clearBoth();
	echo ___space( 20 );
	
	echo ___field( $fg4, $group );
	echo ___field( $sm4, $group );
	echo ___clearBoth();
	echo ___space( 20 );
	
	echo ___field( $fg5, $group );
	echo ___field( $sm5, $group );
	echo ___clearBoth();
	echo ___space( 20 );
	
	echo ___field( $fg6, $group );
	echo ___field( $sm6, $group );
	echo ___clearBoth();
	echo ___space( 20 );
	
	echo ___field( $fg7, $group );
	echo ___field( $sm7, $group );
	echo ___clearBoth();
	echo ___space( 20 );
	
	echo ___field( $fg8, $group );
	echo ___field( $sm8, $group );
	echo ___clearBoth();
	echo ___space( 20 );
	
	echo ___field( $fg9, $group );
	echo ___field( $sm9, $group );
	echo ___clearBoth();
	echo ___space( 20 );
	
	echo ___field( $fg10, $group );
	echo ___field( $sm10, $group );
	echo ___clearBoth();
	echo ___space( 10 );
	
	echo ___field( $sub );	
	
	echo '</form>';
}



/** end of add_food.php */