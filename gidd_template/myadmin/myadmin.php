<?php

if ( !is_user_logged_in() ){
	wp_redirect( admin_url() );
	exit;
}


___add('col1', 'myadmin');
function ___col1_myadmin(){

	echo '<div class="admin-menu">';
	
	if ( current_user_can ('manage_options') ){
		echo '<a href="'. site_url('/new_restaurant/') .'">Add new restaurant</a>';
		echo '<a href="'. site_url('/create_submenu/') .'">Create sub menu</a>';
		echo '<a href="'. site_url('/add_food/') .'">Add food</a>';
		echo '<a href="'. site_url('/list_restaurant/') .'">Update restaurant</a>';
		echo '<a href="'. site_url('/list_food/') .'">Update food</a>';
		echo '<a href="'. site_url('/sort_submenu/') .'">Sort submenu</a>';
	}
	
	
	echo '<a href="'. site_url('/update_profile/') .'">Update Profile</a>';
	echo '<a href="' . wp_logout_url() . '">Logout</a>';
	
	
	echo '</div>';
	
	
	
	
	
}

/** end of myadmin.php */