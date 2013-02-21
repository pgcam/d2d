<?php
//LOAD WP-ADMIN FILES
add_action( 'admin_head', 'gidd_admin_template' );
function gidd_admin_template(){
	
	//enqueue form style
	wp_enqueue_style('gidd-form-style', PARENTURL . 'gidd/gidd_master/form.css', '', '1', 'screen,projection' );
	
	if ( is_multisite() ){
	
		$id = get_current_blog_id();		
		wp_enqueue_style( 'gidd-admin-style', CHILDTPURL . "$id/admin_$id/admin_$id.css", '', "$id", 'screen, projection' );
		wp_enqueue_script( 'gidd-admin-script', CHILDTPURL . "$id/admin_$id/admin_$id.js", '', "$id", true );
	
	}
	
	//alway load files from admin
	wp_enqueue_style( 'gidd-admin-default-style', CHILDTPURL . 'admin/admin.css', '', '1', 'screen, projection' );
	wp_enqueue_script( 'gidd-admin-default-script', CHILDTPURL . 'admin/admin.js', '', '1', true );
	
}

/** end of gidd_admin.php */