<?php
//get login options
$dashboard = get_option('__Dpbym');

//remove all default metaboxes
if ( $dashboard['__r1RWy'] ):
	add_action('admin_menu', 'disable_default_dashboard_widgets');
endif;

function disable_default_dashboard_widgets() {
	remove_meta_box('dashboard_right_now', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');

	remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
	remove_meta_box('dashboard_primary', 'dashboard', 'core');
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');
	remove_meta_box('feedwordpress_dashboard', 'dashboard', 'core');
}


//remove dashboard widgets one by one
add_action('admin_menu', 'gidd_remove_dashboard_widgets');
function gidd_remove_dashboard_widgets() {
	
	$dashboard = get_option('__Dpbym');
	
	if ( $dashboard['__6eYgk'] )
		remove_meta_box('dashboard_right_now', 'dashboard', 'core');
	
	if ( $dashboard['__Kqq6y'] )	
		remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
		
	if ( $dashboard['__D7pa6'] )	
		remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
	
	if ( $dashboard['__cTyHw'] )
		remove_meta_box('dashboard_plugins', 'dashboard', 'core');

	if ( $dashboard['__GzU76'] )	
		remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
	
	if ( $dashboard['__nKu56'] )
		remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
	
	if ( $dashboard['__u28T6'] )
		remove_meta_box('dashboard_primary', 'dashboard', 'core');
	
	if ( $dashboard['__WJsSs'] )
		remove_meta_box('dashboard_secondary', 'dashboard', 'core');
	
	if ( $dashboard['__O2SQs'] )
		remove_meta_box('feedwordpress_dashboard', 'dashboard', 'core');
}

/** End of left_menu.php */