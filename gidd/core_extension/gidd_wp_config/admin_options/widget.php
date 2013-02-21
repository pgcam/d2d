<?php

$widget		= ___subpage( 'Widget' );

//field
$calandar   	= ___checkbox( 'Widget Calandar', 'Remove widget calandar from widget.' );
$search   		= ___checkbox( 'Widget Search', 'Remove widget search from widget.' );
$pages  		= ___checkbox( 'Widget Pages', 'Remove widget pages from widget.' );
$recent_comment = ___checkbox( 'Widget Recent Comment', 'Remove widget recent comment from widget.' );
$recent_post	= ___checkbox( 'Widget Recent Post', 'Remove widget recent post from widget.' );
$rss		 	= ___checkbox( 'Widget RSS', 'Remove widget rss from widget.' );
$meta		 	= ___checkbox( 'Widget Meta', 'Remove widget meta from widget.' );
$achieves		= ___checkbox( 'Widget Achieves', 'Remove widget achieves from widget.' );
$categories		= ___checkbox( 'Widget Categories', 'Remove widget categories from widget.' );
$tag_cloud		= ___checkbox( 'Widget Tag Cloud', 'Remove widget tag cloud from widget.' );
	


//array of fields
$arr_widget	= array( $calandar, $search, $pages, $recent_comment, $recent_post, $rss, $meta, $achieves, $categories, $tag_cloud );
___section( array ( 'WP Config', '__30QNC' ), $widget, $arr_widget, "<b>Remove built-in widgets.</b>" );
unset( $arr_widget );








/** End of dashboard.php */