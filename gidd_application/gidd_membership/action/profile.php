<?php

//remove personal options from profile from http://wordpress.stackexchange.com/questions/49643/remove-personal-options-in-profile-page
$profile = get_option('__pjbIG');

if ( $profile['__EFre4'] ){
	remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );
	add_action( 'admin_head-profile.php', 'core_profile_subject_start' );
	add_action( 'admin_footer-profile.php', 'core_profile_subject_end' );
}

if ( ! function_exists( 'core_remove_personal_options' ) ) {  
  function core_remove_personal_options( $subject ) {
    $subject = preg_replace( '#<h3>Personal Options</h3>.+?/table>#s', '', $subject, 1 );
    return $subject;
  }

  function core_profile_subject_start() {
    ob_start( 'core_remove_personal_options' );
  }

  function core_profile_subject_end() {
    ob_end_flush();
  }
}



//remove and add profile fields
add_filter('user_contactmethods','edit_contactfields',10,1); 
function edit_contactfields( $contact ) {  	
	//get profile options
	$profile = get_option('__pjbIG');
	//remove
	if ( $profile['__fJY8w'] )
		unset( $contact['yim'] );
	if ( $profile['__K1RzQ'] )
		unset( $contact['aim'] );
	if ( $profile['__Nx2Am'] )
		unset( $contact['jabber'] );
		
	//add
	if ( $profile['__niasu'] )
		$contact['phone1'] 		= 'Phone 1';
	
	if ( $profile['__DRICQ'] )
		$contact['phone2'] 		= 'Phone 2';
	
	if ( $profile['__EElQ8'] )
		$contact['phone3'] 		= 'Phone 3';
	
	
	if ( $profile['__yT1B8'] )
		$contact['address1'] 	= 'Address 1';
	
	if ( $profile['__yT1B8'] )
		$contact['address2'] 	= 'Address 2';
	
	if ( $profile['__1E0R2'] )
		$contact['address3'] 	= 'Address 3';
	


	if ( $profile['__K40qu'] )
		$contact['linkedin'] 	= 'Linkedin';
	
	if ( $profile['__h3wLU'] )
		$contact['facebook'] 	= 'Facebook';
	
	if ( $profile['__0lujU'] )
		$contact['twitter']		= 'Twitter';
	
	if ( $profile['__dFgKy'] )
		$contact['skype'] 		= 'Skype';
	
	
	return $contact;
	
}


/** End of profile.php */