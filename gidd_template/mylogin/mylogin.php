<?php
if ( is_user_logged_in() ){
	$general = get_option( '__jlimG' );
	wp_redirect( site_url( '/'. trim( $general['__C63RE'] ) . '/' ) );
	exit;
}

___add( 'col1', 'mylogin' );
function ___col1_mylogin(){
	$args = array(
				'redirect' => site_url('/myadmin/'), 
				'form_id' => 'loginform',
				'label_username' => __( '' ),
				'label_password' => __( '' ),
				'label_remember' => __( 'Remember Me' ),
				'label_log_in' => __( 'Log In' ),
				'id_username' => 'user_login',
				'id_password' => 'user_pass',
				'id_remember' => 'rememberme',
				'id_submit' => 'wp-submit',
				'remember' => false,
				'value_username' => 'Username',
				'value_remember' => false,
				);
				
	wp_login_form( $args );
	
	
	/*echo '<br /><br />';
	//login-logout	
	echo '<div id="member">';
	$arr = get_option('__24K4G');
	if ( is_user_logged_in() ) :
		echo '<a href="' . wp_logout_url() . '">Logout</a>';
	else:
		echo '<a href="' . site_url( '/' . $arr['__TPi0m'] ) . '/' . '">Login</a>';
		echo '<a href="' . site_url( '/register/' ) . '">Register</a>';
	endif;
	echo '</div>';*/
}



?>