<?php
//get login options
$general = get_option('__jlimG');


//change login redirect url to a custom one after successfully logged in
if ( isset( $general['__C63RE'] ) && ( trim ( $general['__C63RE'] ) != "" ) ){
	add_action( 'login_redirect', 'gidd_login_redirect_url' );
}

function gidd_login_redirect_url(){
	$general = get_option('__jlimG');
	return site_url('/'. trim( $general['__C63RE'] ) .'/');
}


//change login url to a custom one
if ( isset( $general['__TPi0m'] ) && ( trim ( $general['__TPi0m'] ) != "" ) ){
	add_action( 'login_url', 'gidd_login_url' );
	add_action( 'login_head', 'gidd_login_redirect' );	
}

function gidd_login_url(){
	$general = get_option('__jlimG');
	return site_url('/'. trim( $general['__TPi0m'] ) .'/');
}

function gidd_login_redirect(){
	$general = get_option('__jlimG');
	if ( !is_user_logged_in() ){
		wp_redirect( site_url('/'. trim( $general['__TPi0m'] ) .'/') );
		exit;
	}
}

//change logout url to homepage
if ( $general['__HXc4C'] == true ){
	add_filter('logout_url', 'gidd_logout_url', 0, 2);
}

function gidd_logout_url( $logout_url, $redirect ){
	$redirect = home_url();
	$args = array( 'action' => 'logout' );
	if ( !empty( $redirect ) ) {
		$args['redirect_to'] = urlencode( $redirect );
	}
	
	$logout_url = add_query_arg($args, site_url('wp-login.php', 'login'));
	$logout_url = wp_nonce_url( $logout_url, 'log-out' );	
	return $logout_url;
}


//redirect to the new register url when users visit the default url
if ( isset( $general['__A7btM'] ) && ( trim ( $general['__A7btM'] ) != "" ) ){
	add_action( 'login_form_register', 'gidd_register_form_redirect' );
}

function gidd_register_form_redirect(){
	$general = get_option('__jlimG');	
    wp_redirect( site_url( '/'. $general['__A7btM'] .'/' ) );
    exit; // always call 'exit()' after 'wp_redirect'
}

//Enhance password box in login form with jQeury.
if( $general['__RE3lg'] == true ){
	add_action( 'wp_head', 'enhance_pwd_head' );
	add_filter( 'login_form_middle', 'gidd_login_form' );
}

function enhance_pwd_head(){
	wp_enqueue_script( 'enhance_password', ( GIDDURL. 'core_extension/gidd_wp_config/action/enhance_password.js' ),'', '1.0'  );
}


function gidd_login_form(){	
	$pwd  = '<p class="login-password-clear">';
	$pwd .= '<input type="text" tabindex="20" size="20" value="Password" class="input" id="user_pass_clear" name="pwd_clear" />';
	$pwd .= '</p>';
	return $pwd;
}

// changing the login page URL hover text
if( isset( $general['__RzEgq'] ) && ( $general['__RzEgq'] != '' ) ){
	add_filter('login_headertitle', 'gidd_put_title');
}

function gidd_put_title(){
	$general = get_option('__jlimG');
	return $general['__RzEgq']; // changing the title from "Powered by WordPress" to whatever you wish
}


//redirect to the new register url when users visit the default url
if ( isset( $general['__QifOK'] ) && ( $general['__QifOK'] != '' ) ) {
	add_action( 'login_form_register', 'gidd_redirect_register_form' );
}

function gidd_redirect_register_form(){
	$general = get_option( '__jlimG' );
    wp_redirect( site_url( '/'. $general['__QifOK'] .'/' ) );
    exit(); // always call 'exit()' after 'wp_redirect'
}


/** End of login.php */