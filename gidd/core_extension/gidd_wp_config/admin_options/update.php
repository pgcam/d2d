<?php

$update		= ___subpage( 'Update' );

//field
$upgrade_notice   			= ___checkbox( 'Upgrade Notice', 'Hides all upgrade notices.' );
$update_menu_item   		= ___checkbox( 'Update Munu Item', 'Remove the &#39;Updates&#39; menu item from the admin interface' );
$core_update   				= ___checkbox( 'Core Update', 'Disable core updates.' );
$themes_update   			= ___checkbox( 'Theme Update', 'Disable theme updates.' );
$plugin_update   			= ___checkbox( 'Plugin Update', 'Disable plugin updates.' );



//array of fields
$arr_update	= array( $upgrade_notice, $update_menu_item, $core_update, $themes_update, $plugin_update );
___section( array ( 'WP Config', '__30QNC' ), $update, $arr_update, "<b>Customize update notices.</b>" );
unset( $arr_update );








/** End of dashboard.php */