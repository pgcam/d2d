<?php
//get login options
$menu = get_option('__zYjxS');

//remove admin menu items
if ( $menu['__uda56'] ):
	add_action('admin_menu', 'gidd_remove_builtin_menu');
	add_action('admin_head', 'gidd_remove_menu_items');
	add_filter('admin_footer_text', 'gidd_admin_footer_text');
	add_filter('screen_options_show_screen', 'gidd_remove_screen_options_tab');
endif;

function gidd_remove_builtin_menu(){
	global $menu;
	foreach ( $menu as $k => $v ){
		unset( $menu[$k] );
	}
}

function gidd_remove_menu_items(){
?>
	<style type="text/css">
		#adminmenuback, #adminmenuwrap, #footer, #contextual-help-link-wrap{ display: none; visibility: hidden; }
		#wpcontent, #footer{ margin-left: 20px; }	
	</style>
<?php
}

// Hide admin 'Screen Options' tab
function gidd_remove_screen_options_tab(){
    return false;
}

add_action( 'admin_menu', 'gidd_remove_admin_page' );
function gidd_remove_admin_page(){
		
	//get login options
	$menu = get_option('__zYjxS');
	
	if ( is_array( $menu['__yUNy0'] ) ){
		foreach ( $menu['__yUNy0'] as $page){
			remove_menu_page( "$page" );
		}
	}
	
}


/** End of left_menu.php */