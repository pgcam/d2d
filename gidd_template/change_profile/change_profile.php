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


function crop_image( $mloc ){
	
	$max_file = "3"; 						// Maximum file size in MB
	$max_width = 500;						// Max width allowed for the large image
	$thumb_width = 300;						// Width of thumbnail image
	$thumb_height = 328;					// Height of thumbnail image
	
	$x1 = intval( $mloc[0] );
	$y1 = intval( $mloc[1] );
	$x2 = intval( $mloc[2] );
	$y2 = intval( $mloc[3] );
	$w = intval( $mloc[4] );
	$h = intval( $mloc[5] );
	$addr = $mloc[6];
		
	$x1 += 60; // add 60 to find pin point location
	$y1 += 60; // add 60 to find pin point location

	//Scale the image to the thumb_width set above
	$x1 -= 150;
	$y1 -= 164;
	
	$w = 300;
	$h = 328;
	
	/*echo $x1 . '<br />';
	echo $y1;
	
	exit;*/
	
	//re-calculate the box
	$x1a = 0;
	$y1a = 0;
	
	$x2a = 0;
	$y2a = 0;
	$pinx = 126;
	$piny = 122;
	
	if ( $x1 < 0 ){
		$x1a = abs($x1);
		$x1 = 0;
		$pinx -= $x1a;
	}
	
	if ( $y1 > 1363 ){
		$y1a = $y1 - 1363;
		$y1 = 1363;
		$piny += $y1a;
	
	}
	
	if ( $x1 > 1000 ){
	
		$x1a = $x1 - 1000;
		$x1 = 1000;
		$pinx += $x1a;
	
	}
	
	if ( $y1 < 0 ){
	
		$y1a = abs($y1);
		$y1 = 0;
		$piny -= $y1a;
	
	}
	
	
		
	//if ( $x1 > 1000 ){ $x1 = 1000; }		
	//if ( $x2 < 300 ){ $x2a = 300 - $x2a; $x2 = 300; }
		
	//if ( $y1 > 1363 ){ $y1a = $y1 - 1363; $y1 = 1363; }
	//if ( $y2 < 328 ){ $y2a = 328 - $y2; $y2 = 328; }
	
	
	
	$scale = $thumb_width/$w;

	$uid = get_current_user_id();
	$map_name = 'uid_' . $uid . '_' . $addr . '.jpg';  

	$large_image_location = PARENTURL . 'images/d2d_map.jpg';
	$thumb_image_location = 'wp-content/themes/d2d/location/' . $map_name;

	$cropped = resizeThumbnailImage($thumb_image_location, $large_image_location,$w,$h,$x1,$y1,$scale);
	
	//for black & white map
	$map_name_bw = 'uid_' . $uid . '_' . $addr . '_bw.jpg';
	$large_image_location_bw = PARENTURL . 'images/d2d_map_bw.jpg';
	$thumb_image_location_bw = 'wp-content/themes/d2d/location/' . $map_name_bw;
	$cropped_bw = resizeThumbnailImage($thumb_image_location_bw, $large_image_location_bw,$w,$h,$x1,$y1,$scale);
	
	//merge the pin into the cropped map
	$map = imagecreatefromjpeg( $cropped_bw );
	$pin = imagecreatefrompng( get_template_directory() . '/location/pinbw.png' );
	
		
	//exit;
	
	imagecopy( $map, $pin, $pinx, $piny, 0, 0, 48, 48 );
	imagejpeg( $map, $cropped_bw );
	imagedestroy( $map );
	imagedestroy( $pin );
	
}

//Get the new coordinates to crop the image.
$mloc1 = $_POST['mloc1'];
$mloc2 = $_POST['mloc2'];

if ( $mloc1 != "" ){
	$mloc = explode(',', $mloc1);
	crop_image( $mloc );
}

if ( $mloc2 != "" ){
	$mloc = explode(',', $mloc2);
	crop_image( $mloc );
}



$id = get_current_user_id();

$fname = trim ( esc_html ( $_POST['fname'] ) );
$lname = trim ( esc_html ( $_POST['lname'] ) );
$phone = trim ( esc_html ( $_POST['tel'] ) );
$address1 = trim ( esc_html ( $_POST['address1'] ) );
$address2 = trim ( esc_html ( $_POST['address2'] ) );
$email = trim ( esc_html ( $_POST['email'] ) );
$photo = esc_html ( $_POST['user_photo'] );

$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];

$data['ID'] = $id;
$data['user_email'] = $email;
//$data['user_url'] = $user_url;


if ( !empty( $pass1 ) ){
	if ( $pass1 != $pass2 ){
		echo '<div class="error"><p><strong>Error</strong>: Please enter the same passwords in the password boxes.</p></div>';
		exit;
	}else{
		$data['user_pass'] = $pass1;
	}
}		

wp_update_user( $data );

update_usermeta( $id, 'user_photo', $photo );
update_usermeta( $id, 'first_name', $fname );
update_usermeta( $id, 'last_name', $lname );
update_usermeta( $id, 'phone1', $phone );
update_usermeta( $id, 'address1', $address1 );
update_usermeta( $id, 'address2', $address2 );
update_usermeta( $id, 'email', $email );


wp_redirect( site_url( '/update_profile?msg="success"' ) );
exit;

/** end of change_profile.php */