<?php


if ( current_user_can( 'manage_options' ) )
	___add( 'col1', 'edit_submenu' );

function ___col1_edit_submenu(){

	$id = $_GET['id'];
	$restoo = get_post( $id );
	echo '<h2>'. $restoo->post_title .'</h2>';

	$submenu = get_food_submenu( $id );
	
	echo '<h4>Sort this restaurant submenu by entering the order number.</h4>';
	
	echo '<form method="post" action="'. site_url('/update_submenu_order/') .'">';
	
		foreach ( $submenu as $key => $val ){
		
			echo '<p>';
			echo '<label for="'. $key .'">'. $val .'</label>';
			echo '<input type="text" name="submenu_order['. $key .']" />';
			echo ___clearBoth();
			echo '</p>';
		}
	
	echo '<input type="hidden" name="rid" value="'. $id .'" />';
	echo '<input type="submit" name="suborder" value="Save" />';
	
	echo '</form>';

}






/** end of edit_submenu.php */