<?php
$general	= ___subpage( 'General' );


//field
$show_capcha   		= ___checkbox( 'Show capcha', 'Show capcha form inside the registration form.' );
$login_url			= ___text( 'Login url', 'Change login url to custom one. This gives you the most flexible way to customize its appearance.' );
$register_url		= ___text( 'Register url', 'Change register url to custom one. This gives you the most flexible way to customize its appearance and functionality.' );
$login_redirect		= ___text( 'Login redirect', 'Change login redirect url to custom one after successfully logged in.' );
$logout_url   		= ___checkbox( 'Logout URL', 'Change logout url to homepage.' );
$enhanced_pwd_box	= ___checkbox( 'Enhance password box', 'Enhance password box in login form with jQeury.' );
$login_logo_link	= ___checkbox( 'Login Logo Link', 'Change login logo link to homepage.' );
$login_logo_hover	= ___text( 'Login Logo Hover Text', 'Change login logo hover text.' );
$register_redirect	= ___text( 'Register redirect', 'Change the register url in WP register form to custom one.' );


//array of fields
$arr_general = array(
						$show_capcha, 
						$login_url, 
						$register_url, 
						$login_redirect, 
						$logout_url, 
						$enhanced_pwd_box, 
						$login_logo_link, 
						$login_logo_hover, 
						$register_redirect 
					);
					
___section( array ( 'Gidd Membership', '__4On5w' ), $general, $arr_general, "<b>General settings for login, logout and registration.</b>" );
unset( $arr_general );


/** end of general.php **/