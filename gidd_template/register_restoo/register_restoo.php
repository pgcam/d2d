<?php
___add( 'init', 'register_restoo' );

function ___init_register_restoo(){

	$name = trim ( $_POST['rr_name'] );
	$desc = trim ( $_POST['rr_desc'] );
	$address = trim ( $_POST['rr_address'] );
	$phone = trim ( $_POST['rr_phone'] );
	$email = trim ( $_POST['rr_email']  );
	$restoo = trim ( $_POST['rr_restoo'] );
	
	$error = false;
	$msg = "";
	
	if ( $name == "" ):
		$msg .= '<h4>Name is required.</h4>';
		$error = true;
	endif;
	
	if ( $restoo == "" ):
		$msg .= '<h4>Restaurant name is required.</h4>';
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
	
	if ( !is_email( $email ) ):
		$msg .= '<h4>Email address is not valid.</h4>';
		$error = true;
	endif;
	
	
	if ( !$error ):
	
		//$admin_email = get_option('admin_email');
		$admin_email = "support@d2d-cambodia.com";
		$subject = "D2D - Request for Registering a New Restaurant";
		$body = "Name: $name \n\nRestaurant name: $restoo \n\nPhone: $phone \n\nAddress: $address \n\nEmail: $email \n\nComment: $desc";
		$header = 'From: '. $name . ' <'. $admin_email .'>';
		
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