<?php

if ( !is_user_logged_in() ){
	wp_redirect( admin_url() );
	exit;
}


___add('col1', 'myadmin');
function ___col1_myadmin(){

	if ( current_user_can ('manage_options') ){
	
		echo '<a href="'. site_url('/new_restaurant/') .'">Click here to add a restaurant</a><br />';
		echo '<a href="'. site_url('/create_submenu/') .'">Create sub menu</a><br />';
		echo '<a href="'. site_url('/add_food/') .'">Add food</a><br />';
		echo '<a href="'. site_url('/list_restaurant/') .'">Update restaurant</a><br />';
		echo '<a href="'. site_url('/list_food/') .'">Update food</a><br />';
		echo '<a href="'. site_url('/sort_submenu/') .'">Sort submenu</a><br />';
		
	}
	
	
	echo '<a href="'. site_url('/update_profile/') .'">Update Profile</a><br />';
	echo '<a href="' . wp_logout_url() . '">Logout</a>';
	
	
}

/** end of myadmin.php */