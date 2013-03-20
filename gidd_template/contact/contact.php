<?php

___add( 'init', 'contact' );
//___add( 'col1', 'contact' );

function gidd_send_contact(){

	if ( isset( $_POST['contactSubmit'] ) ){
	
		$name 		= trim( $_POST['contactName'] );
		$email 		= trim( $_POST['email'] );
		$message 	= trim( $_POST['message'] );
		
		if ( $name === '' ){
			echo 'Name is required.';
			exit;
		}
		
		if ( $email === '' ){
			echo 'Email is required!';
			exit;		
		}
		
		if ( !gidd_check_mail( $email ) ){
			echo 'Email is invalid.';
			exit;		
		}
		
		if ( $message === '' ){
			echo 'Please enter a message';
			exit;
		}
		
		$admin_email = get_option('admin_email');
		$subject = "You have a message from " . $name;
		$body = "Name: $name \n\nEmail: $email \n\nMessage: $message";
		$header = 'From: '. $name.' <'. $email .'>' . '\r\n' . 'Reply-To: ' . $email;
		
		wp_mail( $admin_email, $subject, $body, $header );
		
		
	}


}

function ___init_contact(){
	gidd_send_contact();
	wp_redirect( home_url() );
	exit;
}









/** end of contact.php */