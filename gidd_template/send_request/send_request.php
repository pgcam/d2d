<?php

___add( 'init', 'send_request' );

function ___init_send_request(){

	$fullname = $_POST['fullname'];
	$busorg = $_POST['busorg'];
	$address = $_POST['address'];
	$phone = $_POST['phone'];
	$message = $_POST['message'];
	
	$error = false;
	$msg = "";
	
	if ( $fullname == "" ):
		$msg .= '<h4>Name is required.</h4>';
		$error = true;
	endif;
	
	if ( $address == "" ):
		$msg .= '<h4>Address is required.</h4>';
		$error = true;
	endif;
	
	if ( $phone == "" ):
		$msg .= '<h4>Telephone is required.</h4>';
		$error = true;
	endif;
	
	
	if ( !$error ):
	
		//$admin_email = get_option('admin_email');
		$admin_email = "support@d2d-cambodia.com";
		$subject = "Request for a copy of D2D";
		$body = "Name: $fullname \n\nBusiness: $busorg \n\nPhone: $phone \n\nAddress: $address \n\nMessage: $message";
		
		$header[] = 'From: '. $fullname . ' <'. $admin_email .'>';
		$header[] = 'Cc: ' . $fullname . ' <admin@cambodiapocketguide.com>';
		$header[] = 'Cc: ' . $fullname . '<bunthy@cambodiapocketguide.com>';
		
		$sent = wp_mail( $admin_email, $subject, $body, $header );
	
	
		if ( $sent ){			
			wp_redirect( home_url() . '?sent=success' );
			exit;
		}else{
		
			wp_redirect( home_url() . '?sent=error' );
			exit;
		
		}
	
	else:
	
		wp_redirect( home_url() . '?sent=invalid&msg=' . urlencode( $msg ) );
		exit;
	
	endif;

	exit;
}






/** end of send_request.php */