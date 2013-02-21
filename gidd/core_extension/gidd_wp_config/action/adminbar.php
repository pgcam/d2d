<?php
//get login options
$adminbar = get_option('__1VnjM');


//disable wp admin bar
if ( $adminbar['__GppfW'] ):
	
	show_admin_bar( false );
	add_action( 'admin_print_scripts-profile.php', 'hide_admin_bar_prefs' );
	add_action( 'admin_head', 'gidd_hide_admin_bar' );
	
	wp_deregister_script('admin-bar');
	wp_deregister_style('admin-bar');
	remove_action('wp_footer','wp_admin_bar_render',1000);
	
endif;


//remove toolbar option from profile
function hide_admin_bar_prefs() {
?>
<style type="text/css">
    .show-admin-bar { display: none; }
</style>
<?php
}


function gidd_hide_admin_bar(){
?>
<style type="text/css">
	#wpadminbar{ display: none; visiblity: hidden; }
	html.wp-toolbar{ padding-top: 0; }
</style>
<?php
}


add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );
function remove_admin_bar_links() {
    global $wp_admin_bar;
	$adminbar = get_option('__1VnjM');
	
	if ( $adminbar['__DyQlM'] )
		$wp_admin_bar->remove_menu('wp-logo');          // Remove the WordPress logo
    
	if ( $adminbar['__d7A5W'] )
		$wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
    
	if ( $adminbar['__rz6K8'] )
		$wp_admin_bar->remove_menu('wporg');            // Remove the WordPress.org link
    
	if ( $adminbar['__vDHVW'] )
		$wp_admin_bar->remove_menu('documentation');    // Remove the WordPress documentation link
    
	if ( $adminbar['__6oNqa'] )
		$wp_admin_bar->remove_menu('support-forums');   // Remove the support forums link
    
	if ( $adminbar['__tPTnO'] )
		$wp_admin_bar->remove_menu('feedback');         // Remove the feedback link
    
	if ( $adminbar['__ndX2Q'] )
		$wp_admin_bar->remove_menu('site-name');        // Remove the site name menu
    
	if ( $adminbar['__WLGEq'] )
		$wp_admin_bar->remove_menu('view-site');        // Remove the view site link
    
	if ( $adminbar['__cZ60u'] )
		$wp_admin_bar->remove_menu('updates');          // Remove the updates link
    
	if ( $adminbar['__g6SGa'] )
		$wp_admin_bar->remove_menu('comments');         // Remove the comments link
    
	if ( $adminbar['__CoeVo'] )
		$wp_admin_bar->remove_menu('new-content');      // Remove the content link
    
	if ( $adminbar['__lltWc'] )
		$wp_admin_bar->remove_menu('w3tc');             // If you use w3 total cache remove the performance link
    
	if ( $adminbar['__bD1ai'] )
		$wp_admin_bar->remove_menu('my-account');       // Remove the user details tab
}




/** End of login.php */