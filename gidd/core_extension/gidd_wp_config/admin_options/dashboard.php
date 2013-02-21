<?php

$dashboard	= ___subpage( 'Dashboard' );

//field
$all_metaboxes 	= ___checkbox( 'All Metaboxes', 'Remove all default metaboxes from dashboard.' );
$rightnow   	= ___checkbox( 'Right now', 'Remove the right now metabox from dashboard.' );
$recent_comment = ___checkbox( 'Recent Comments', 'Remove the recent comment metabox from dashboard.' );
$incoming_links = ___checkbox( 'Incomming Links', 'Remove the incomming links metabox from dashboard.' );
$plugins		= ___checkbox( 'Plugins', 'Remove the plugins metabox from dashboard.' );
$quick_press	= ___checkbox( 'Quick Press', 'Remove the quick press metabox from dashboard.' );
$recent_draft	= ___checkbox( 'Recent Draft', 'Remove the recent draft metabox from dashboard.' );
$primary		= ___checkbox( 'Primary', 'Remove the primary feed widget.' );
$secondary		= ___checkbox( 'Secondary', 'Remove the secondary feed widget.' );

$feed_wordpress	= ___checkbox( 'Feed WordPress', 'Remove dashboard Feed WordPress.' );


//array of fields
$arr_db	= array( $all_metaboxes, $rightnow, $recent_comment, $incoming_links, $plugins, $quick_press, $recent_draft, $primary, $secondary, $feed_wordpress );
___section( array ( 'WP Config', '__30QNC' ), $dashboard, $arr_db, "<b>Remove default dashboard metaboxes.</b>" );
unset( $arr_db );








/** End of dashboard.php */