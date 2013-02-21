<?php

#########################################################################################################
# CONSTANTS																								#
# You can alter the options below																		#
#########################################################################################################

// Only one of these image types should be allowed for upload
$allowed_image_types = array('image/pjpeg'=>"jpg",'image/jpeg'=>"jpg",'image/jpg'=>"jpg",'image/png'=>"png",'image/x-png'=>"png",'image/gif'=>"gif");
$allowed_image_ext = array_unique( $allowed_image_types ); // do not change this
$image_ext = "";	// initialise variable, do not change this.
foreach ( $allowed_image_ext as $mime_type => $ext ){
	$image_ext.= strtoupper($ext)." ";
}


##########################################################################################################
# IMAGE FUNCTIONS																						 #
# You do not need to alter these functions																 #
##########################################################################################################

//You do not need to alter these functions
function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale){
	list($imagewidth, $imageheight, $imageType) = getimagesize($image);
	$imageType = image_type_to_mime_type($imageType);
	
	$newImageWidth = ceil($width * $scale);
	$newImageHeight = ceil($height * $scale);
	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
	switch($imageType) {
		case "image/gif":
			$source=imagecreatefromgif($image); 
			break;
	    case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
			$source=imagecreatefromjpeg($image); 
			break;
	    case "image/png":
		case "image/x-png":
			$source=imagecreatefrompng($image); 
			break;
  	}
	imagecopyresampled($newImage,$source,0,0,$start_width,$start_height,$newImageWidth,$newImageHeight,$width,$height);
	switch($imageType) {
		case "image/gif":
	  		imagegif($newImage,$thumb_image_name); 
			break;
      	case "image/pjpeg":
		case "image/jpeg":
		case "image/jpg":
	  		imagejpeg($newImage,$thumb_image_name,90); 
			break;
		case "image/png":
		case "image/x-png":
			imagepng($newImage,$thumb_image_name);  
			break;
    }
	chmod($thumb_image_name, 0777);
	return $thumb_image_name;
}


function crop_image( $mloc, $uid ){
	
	$max_file = "3"; 							// Maximum file size in MB
	$max_width = "500";							// Max width allowed for the large image
	$thumb_width = "120";						// Width of thumbnail image
	$thumb_height = "80";						// Height of thumbnail image
	
	$x1 = intval( $mloc[0] );
	$y1 = intval( $mloc[1] );
	$x2 = intval( $mloc[2] );
	$y2 = intval( $mloc[3] );
	$w = intval( $mloc[4] );
	$h = intval( $mloc[5] );
	$addr = $mloc[6];

	//Scale the image to the thumb_width set above
	$scale = $thumb_width/$w;

	$map_name = 'uid_' . $uid . '_' . $addr . '.jpg';  

	$large_image_location = PARENTURL . 'images/d2d_map.jpg';
	$thumb_image_location = 'wp-content/themes/d2d/location/' . $map_name;

	$cropped = resizeThumbnailImage($thumb_image_location, $large_image_location,$w,$h,$x1,$y1,$scale);

}










$user_id = username_exists( trim( $_POST['username'] ) );
if ( !$user_id ) {

	$user_name = esc_attr ( trim( $_POST['username'] ) );
	$password = esc_attr ( trim( $_POST['password'] ) );
	$repass = esc_attr ( trim( $_POST['repassword'] ) );			
	$user_email = esc_attr ( trim( $_POST['email'] ) );
	$fname = esc_attr ( trim( $_POST['firstname'] ) );
	$lname = esc_attr ( trim( $_POST['lastname'] ) );
	$addr1 = esc_attr( trim( $_POST['address1'] ) );
	$addr2 = esc_attr( trim( $_POST['address2'] ) );
	$phone = esc_attr( trim( $_POST['telephone'] ) );
	$email = esc_attr( trim( $_POST['email'] ) );
	
	
	$reg  = gidd_check_mail( $user_email );

	if ( $password == "" ){
		$reg .= "<p>Password is requirded.</p>";
	}

	$reg .= gidd_compare_password( $password, $repass );	
	
	if( $addr1 == "" ){
		$reg .= "<p>Address is required.</p>";
	}
	
	if ( $phone == "" ){
		$reg .= "<p>Phone is required.</p>";
	}
	
	if ( $fname == "" ){
		$reg .= "<p>First name is required.</p>";
	}
	
	if ( $lname == "" ){
		$reg .= "<p>Last name is required.</p>";
	}
	
	if ( $reg == "" ){
		$user_id = wp_create_user( "$user_name", "$password", "$user_email" );				
		wp_new_user_notification( $user_id  );				
	}else{			
		wp_redirect( site_url('/register?err=' . urlencode( $reg ) ) );
		exit;
	}
	
	if ( is_int( $user_id ) ){	

	
		update_usermeta( $user_id, 'first_name', "$fname" );
		update_usermeta( $user_id, 'last_name', "$lname" );
		update_usermeta( $user_id, 'phone1', "$phone" );
		update_usermeta( $user_id, 'address1', "$addr1" );
		update_usermeta( $user_id, 'address2', "$addr2" );

		/*** SAVE MAP */
		//Get the new coordinates to crop the image.
		$mloc1 = $_POST['mloc1'];
		$mloc2 = $_POST['mloc2'];

		if ( $mloc1 != "" ){
			$mloc = explode(',', $mloc1);
			crop_image( $mloc, $user_id );
		}

		if ( $mloc2 != "" ){
			$mloc = explode(',', $mloc2);
			crop_image( $mloc, $user_id );
		}
		
		/*** END OF SAVE_MAP */
		
		
		$message  = sprintf( "Welcome %s", $fname ) . "\r\n\r\n";
		$message .= sprintf( "Thank you for registering at: %s", get_site_url() );
		$message .= "\r\n\r\nHere is your login detail: \r\n\r\n";
		$message .= sprintf( "Username: %s", $user_name ) . "\r\n";
		$message .= sprintf( "Password: %s", $password );
		
		wp_mail($user_email, sprintf(__('[%s] Your username and password'), get_option( 'blogname' ) ), $message);
		wp_redirect( site_url('/register?reg=registered') );
		exit();
	}
}	

	
	
	function gidd_compare_password( $password, $repass ){
		
		$err = "";		
		if ($password != $repass )
			$err .= "<p>Password doesn't match.</p>";
		
		return $err;
	}

	
	exit;

/** End of register.php */