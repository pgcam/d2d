<?php
//add class to nav menu
add_filter( 'nav_menu_css_class', 'ct_cpt_active', 10, 2 );
function ct_cpt_active( $classes, $item )
{	
	//news
	if ($item->title == "News"){
		if (is_post_type_archive('ns_news')){
			$classes[] = "current_page_item";
		}
		if (is_singular('ns_news')){
			$classes[] = "current_page_item";
		}
	}	

	//jobs
	if ($item->title == "Jobs"){
		if (is_post_type_archive('ns_jobs')){
			$classes[] = "current_page_item";
		}
		if (is_singular('ns_jobs')){
			$classes[] = "current_page_item";
		}
	}
	
	//event
	if ($item->title == "Events"){
		if (is_post_type_archive('ns_events')){
			$classes[] = "current_page_item";
		}
		if (is_singular('ns_events')){
			$classes[] = "current_page_item";
		}
	}
	
	//classifieds
	if ($item->title == "Classifieds"){
		if (is_post_type_archive('ns_classifieds')){
			$classes[] = "current_page_item";
		}
		if (is_singular('ns_classifieds')){
			$classes[] = "current_page_item";
		}
	}
	
	//directory
	if ($item->title == "Directory"){
		if (is_post_type_archive('ns_directories')){
			$classes[] = "current_page_item";
		}
		if (is_singular('ns_directories')){
			$classes[] = "current_page_item";
		}
	}
	
	//directory
	if ($item->title == "Media"){
		if (is_post_type_archive('ns_media')){
			$classes[] = "current_page_item";
		}
		if (is_singular('ns_media')){
			$classes[] = "current_page_item";
		}
	}
	
	//Forum
	if ($item->title == "Forum"){
		
		//get last segment from the url
		$url = trailingslashit( get_current_url() );
		$parts = explode('/', "$url");		
		$last = $parts[ sizeof($parts)-2 ];
		
		//compare it
		if ( $last == "forums" ){		
			$classes[] = "current_page_item";		
		}
		
	}
	
	//Article
	if ($item->title == "Articles"){
		global $autopage;
		
		if ( $autopage == "article" ){
			$classes[] = "current_page_item";			
		}		
	}
	

	return $classes;
}


// Change howdy text in WordPress 3.3
add_action( 'admin_bar_menu', 'wp_admin_bar_my_custom_account_menu', 11 );
function wp_admin_bar_my_custom_account_menu( $wp_admin_bar ) {
	$user_id = get_current_user_id();
	$current_user = wp_get_current_user();
	$profile_url = get_edit_profile_url( $user_id );

	if ( 0 != $user_id ) {
		/* Add the "My Account" menu */
		$avatar = get_avatar( $user_id, 28 );
		$howdy = sprintf( __('Welcome Back, %1$s'), $current_user->display_name );
		$class = empty( $avatar ) ? '' : 'with-avatar';

		$wp_admin_bar->add_menu( array(
		'id' => 'my-account',
		'parent' => 'top-secondary',
		'title' => $howdy . $avatar,
		'href' => $profile_url,
		'meta' => array(
		'class' => $class,
		),
		) );
	}
}

/*** LOGIN / REGISTER / LOST PASSWORD ***/
add_filter( 'login_form_middle', 'ct_login_form' );
function ct_login_form(){	
	$pwd  = '<p class="login-password-clear">';
	$pwd .= '<input type="text" tabindex="20" size="20" value="Password" class="input" id="user_pass_clear" name="pwd_clear" />';
	$pwd .= '</p>';
	return $pwd;
}

add_action( 'login_enqueue_scripts', 'b2b_login_script' );
function b2b_login_script() { ?>
    <link rel="stylesheet" id="custom_wp_admin_css" href="<?php echo get_stylesheet_directory_uri() . '/login.css'; ?>" type="text/css" media="all" />	 
	 <script type="text/javascript">
	 
		/* Get query string from current url - Method 1
		var urlParams = {};
		(function () {
			 var e,
				  a = /\+/g,  // Regex for replacing addition symbol with a space
				  r = /([^&=]+)=?([^&]*)/g,
				  d = function (s) { return decodeURIComponent(s.replace(a, " ")); },
				  q = window.location.search.substring(1);

			 while (e = r.exec(q))
				 urlParams[d(e[1])] = d(e[2]);
		})();*/

		// get query string from current url - Method 2
		function getParameterByName(name)
		{
		  name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
		  var regexS = "[\\?&]" + name + "=([^&#]*)";
		  var regex = new RegExp(regexS);
		  var results = regex.exec(window.location.search);
		  if(results == null)
			 return "";
		  else
			 return decodeURIComponent(results[1].replace(/\+/g, " "));
		}
		
		var reg = getParameterByName('checkemail');
		if ( reg == "registered" ){
			
			var head = document.getElementsByTagName('head')[0],
				 style = document.createElement('style'),
				 rules = document.createTextNode('div#login p#backtoblog { display: block; margin-top: 280px; }');

			style.type = 'text/css';
			if(style.styleSheet)
				 style.styleSheet.cssText = rules.nodeValue;
			else style.appendChild(rules);
			head.appendChild(style);
		}

	 </script>
<?php }

// changing the login page URL
add_filter('login_headerurl', 'put_my_url');
function put_my_url(){
	return home_url(); // putting my URL in place of the WordPress one
}


// changing the login page URL hover text
add_filter('login_headertitle', 'put_my_title');
function put_my_title(){
	return ('PocketGuide B2B'); // changing the title from "Powered by WordPress" to whatever you wish
}

//hide admin bar when viewing site
show_admin_bar(false);

//hide welcome panel
add_action( 'load-index.php', 'hide_welcome_panel' );
function hide_welcome_panel() {
    $user_id = get_current_user_id();

    if ( 1 == get_user_meta( $user_id, 'show_welcome_panel', true ) )
        update_user_meta( $user_id, 'show_welcome_panel', 0 );
}

//remove toolbar option from profile
add_action( 'admin_print_scripts-profile.php', 'hide_admin_bar_prefs' );
function hide_admin_bar_prefs() {
?>
<style type="text/css">
    .show-admin-bar { display: none; }
</style>
<?php
}

/*
	//except admin
	if (!current_user_can('manage_options')) {
		add_action('admin_menu', 'disable_default_dashboard_widgets');
}*/

// disable default dashboard widgets
add_action('admin_menu', 'disable_default_dashboard_widgets');
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

//set the default dashboard layout to 1
add_action('wp_dashboard_setup', 'one_column_default' );
function one_column_default() {
global $user_ID;
$options = get_user_option("screen_layout_dashboard", $user_ID);

	if ($options != 1){
		update_user_option($user_ID, "screen_layout_dashboard", 1, true);
		?>
		<script type="text/javascript">
		<!--
		window.location = ""
		//-->
		</script>
		<?php
	}
}


//remove and add profile fields
add_filter('user_contactmethods','edit_contactfields',10,1); 
function edit_contactfields( $contact ) {  	
	
	//remove
	unset( $contact['yim'] );
	unset( $contact['aim'] );
	unset( $contact['jabber'] );
	
	//add
	$contact['phone'] = 'Phone';
	$contact['location'] = 'Location';
	$contact['linkedin'] = 'Linkedin';
	$contact['facebook'] = 'Facebook';
	$contact['skype'] = 'Skype';
	
	return $contact;
	
}


//change the register url to custom one
//default register form cannot handle the user requirement
add_filter('register', 'ct_custom_signup_url');
function ct_custom_signup_url( $url ){
	return site_url( '/register/' );
}

//redirect to the new register url when users visit the default url
add_action( 'login_form_register', 'ct_register_form_redirect' );
function ct_register_form_redirect(){
    wp_redirect( site_url( '/register/' ) );
    exit(); // always call 'exit()' after 'wp_redirect'
}


//change login url to a custom one
/*add_filter('login_url', 'ct_login_url');
function ct_login_url(){
	return site_url('/login/');
}

add_filter('login_form_defaults', 'ct_login_redirect');
function ct_login_redirect( $defaults ){
	$defaults['redirect'] = site_url('/app/');
	return $defaults;
}*/

//change logout url to homepage
add_filter('logout_url', 'ct_logout_url', 0, 2);
function ct_logout_url( $logout_url, $redirect ){
	$redirect = home_url();
	$args = array( 'action' => 'logout' );
	if ( !empty($redirect) ) {
		$args['redirect_to'] = urlencode( $redirect );
	}
	
	$logout_url = add_query_arg($args, site_url('wp-login.php', 'login'));
	$logout_url = wp_nonce_url( $logout_url, 'log-out' );	
	return $logout_url;
}


//remove some widgets
add_action('widgets_init', 'remove_some_wp_widgets', 1);
function remove_some_wp_widgets(){
  unregister_widget('WP_Widget_Calendar');
  unregister_widget('WP_Widget_Search');
  unregister_widget('WP_Widget_Pages');
  unregister_widget('WP_Widget_Recent_Comments');
  unregister_widget('WP_Widget_Recent_Posts');
  unregister_widget('WP_Widget_RSS');
  unregister_widget('WP_Widget_Meta');
  unregister_widget('WP_Widget_Archives');
  unregister_widget('WP_Widget_Categories');
  unregister_widget('WP_Widget_Tag_Cloud');
}


//remove editor menu
add_action('_admin_menu', 'remove_editor_menu', 1);
function remove_editor_menu() {
  remove_action('admin_menu', '_add_themes_utility_last', 101);
}

//change admin footer
add_filter('admin_footer_text', 'modify_footer_admin');
function modify_footer_admin () {
  echo 'Developed by <a href="http://www.pixelscambodia.com">Pixels</a>.';  
}

//remove admin color scheme
add_action('admin_head', 'admin_color_scheme');
function admin_color_scheme() {
   global $_wp_admin_css_colors;
   $_wp_admin_css_colors = 0;
}


//remove admin bar items
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );
function remove_admin_bar_links() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');          // Remove the WordPress logo
    $wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
    $wp_admin_bar->remove_menu('wporg');            // Remove the WordPress.org link
    $wp_admin_bar->remove_menu('documentation');    // Remove the WordPress documentation link
    $wp_admin_bar->remove_menu('support-forums');   // Remove the support forums link
    $wp_admin_bar->remove_menu('feedback');         // Remove the feedback link
    //$wp_admin_bar->remove_menu('site-name');        // Remove the site name menu
    $wp_admin_bar->remove_menu('view-site');        // Remove the view site link
    $wp_admin_bar->remove_menu('updates');          // Remove the updates link
    //$wp_admin_bar->remove_menu('comments');         // Remove the comments link
    //$wp_admin_bar->remove_menu('new-content');      // Remove the content link
    $wp_admin_bar->remove_menu('w3tc');             // If you use w3 total cache remove the performance link
    //$wp_admin_bar->remove_menu('my-account');       // Remove the user details tab
}


// Hides all upgrade notices
function hide_admin_notices() {
    remove_action( 'admin_notices', 'update_nag', 3 );
}
add_action('admin_menu','hide_admin_notices');

// Remove the 'Updates' menu item from the admin interface
function remove_menus() {
	global $submenu;
	remove_submenu_page ( 'index.php', 'update-core.php' );
}
add_action('admin_menu', 'remove_menus', 102);

// Disable core updates
remove_action( 'load-update-core.php', 'wp_update_core' );
add_filter( 'pre_site_transient_update_core', create_function( "$a", "return null;" ) );

// Disable theme updates
remove_action( 'load-update-core.php', 'wp_update_themes' );
add_filter( 'pre_site_transient_update_themes', create_function( "$a", "return null;" ) );

// Disable plugin updates
remove_action( 'load-update-core.php', 'wp_update_plugins' );
add_filter( 'pre_site_transient_update_plugins', create_function( "$a", "return null;" ) );

	/*add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
	add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );

	# 2.8 to 3.0:
	remove_action( 'wp_version_check', 'wp_version_check' );
	remove_action( 'admin_init', '_maybe_update_core' );
	add_filter( 'pre_transient_update_core', create_function( '$a', "return null;" ) );

	# 3.0:
	add_filter( 'pre_site_transient_update_core', create_function( '$a', "return null;" ) );*/



/*function remove_submenus() {
  global $submenu;
  unset($submenu['index.php'][10]); // Removes 'Updates'.
  unset($submenu['themes.php'][5]); // Removes 'Themes'.
  unset($submenu['options-general.php'][15]); // Removes 'Writing'.
  unset($submenu['options-general.php'][25]); // Removes 'Discussion'.
  unset($submenu['edit.php'][16]); // Removes 'Tags'.  
}

add_action('admin_menu', 'remove_submenus');*/

/*function custom_favorite_actions($actions) {
  unset($actions['user-edit.php']);
  return $actions;
}
add_filter('favorite_actions', 'custom_favorite_actions');*/


//remove profile item from admin if user type is company
add_action('admin_menu', 'remove_menu_items');
function remove_menu_items() {
	
	if (!current_user_can('manage_options')){
	
	  global $menu;
	  $restricted = array(__('Tools'));
	  
	  //user type is a custom user meta
	  $current_uid = get_current_user_id();
	  $utype = get_user_meta( $current_uid, "user_type", true );
	  if ( $utype == "business" ){
			$restricted[] = _('Profile');
	  }
	  
	  end ($menu);
	  while (prev($menu)){
		 $value = explode(' ',$menu[key($menu)][0]);
		 if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){
			unset($menu[key($menu)]);
		 }
	  }
	
	}
  
}


add_action( 'admin_menu', 'remove_admin_page' );
function remove_admin_page(){
	if (!current_user_can('manage_options')){
		remove_menu_page( 'edit.php' );
		remove_menu_page( 'edit-comments.php' );
	}
}

?>