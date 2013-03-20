<?php

$leftmenu	= ___subpage( 'Menu' );

//field
$arr_menu['index.php'] = "Dashboard";
$arr_menu['edit.php'] = "Post";
$arr_menu['edit.php?post_type=page'] = "Page";
$arr_menu['upload.php'] = "Media";
$arr_menu['link-manager.php'] = "Links";
$arr_menu['themes.php'] = "Appearance";
$arr_menu['plugins.php'] = "Plugins";
$arr_menu['users.php'] = "Users";
$arr_menu['tools.php'] = "Tools";
$arr_menu['edit-comments.php'] = "Comments";
$arr_menu['options-general.php'] = "Setting";





$menu 		= ___list( 'Left Menu', $arr_menu, 'Disable top-level menu.' );
$remove_all = ___checkbox( 'Remove menu items', 'Remove all the items in admin left menu, footer, screen options and help tab.' );

//class
$menu->_class = "gd-chosen";


//add javascript to head for custom registered page
___add( 'head', '__30QNC' );
function ___head___30QNC(){
	___chosen();
}

//array of fields
$arr_opt = array( $remove_all, $menu );
___section( array ( 'WP Config', '__30QNC' ), $leftmenu, $arr_opt, "<b>Remove default dashboard metaboxes.</b>" );
unset( $arr_opt );


/** End of dashboard.php */