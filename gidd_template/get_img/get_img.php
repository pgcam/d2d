<?php
session_start();
header("Content-type: image/png");

$restaurant = $_GET['restoo'];
//$restaurant = "Restaurant name: " . $restaurant;

$name = $_GET['name'];
$name = "Name: " . $name;

$phone = $_GET['phone'];
$phone = "Phone: " . $phone;

$delivery = $_GET['delivery'];
$delivery = "Delivery: " . $delivery;
$delivery = explode( '|', wordwrap($delivery, 40, "|", true) );

$total = $_GET['total'];
$total = "Total: $" . $total;

$note = $_GET['note'];
$note = "Note: " . $note;
$note = explode( '|', wordwrap( $note, 40, '|', true ) );

$invoice_no = $_GET['invoice'];
$invoice = "Invoice #: ";

$user_email = $_GET['user_email'];
$user_email = "Email: " . $user_email;


$no = "No.";
$food = "Food name";
$qty = "Qty";
$amount = "Amount";
//$location = "Location: ";

$line = "__________________________________________";

$map = imagecreatefromjpeg( get_template_directory() . '/location/'. $_GET['map'] );

$logo = imagecreatefrompng( get_template_directory() . '/location/logo.png' );
//$pin = imagecreatefrompng( get_template_directory() . '/location/pinbw.png' );

$font  = 16;
$width = 384;
$height = 850;

function get_total_height( $height, $note ){

	if ( count( $note ) > 1 ){
		$height = $height + ( count( $note ) * 25 ) - 25;
	}
	
	foreach( $_SESSION['order'] as $key => $val ){
	
		$food_name = get_the_title( $key );
		$food_name = explode( '|', wordwrap( $food_name, 20, '|', true ) );
		
		$height += 25;
		if ( count ( $food_name ) > 0 )
			$height += ( count ( $food_name ) * 25 ) - 25;
	
	}
	
	foreach( $_SESSION['morder'] as $ind => $mval ){
		
		$food_name = get_the_title( $mval[0] );
		$food_name = explode( '|', wordwrap( $food_name, 20, '|', true ) );
		
		$height += 25;
		if ( count ( $food_name ) > 0 )
			$height += ( count ( $food_name ) * 25 ) - 25;

	}
	
	return $height;

}

//calculate total height
$height = get_total_height( $height, $note );

$image = imagecreatetruecolor ($width, $height);
$white = imagecolorallocate ($image,255,255,255);
$black = imagecolorallocate ($image,0,0,0);

imagefill( $image, 0, 0, $white );

imagecopy( $image, $logo, 184, 20, 0, 0, 200, 45 );
imagettftext( $image, 20, 0, 0, 95, $black, 'arialbd.ttf', $restaurant );

//invoice header
imagettftext( $image, $font, 0, 0, 120, $black, 'arial.ttf', $invoice );
imagettftext( $image, $font, 0, 100, 120, $black, 'arialbd.ttf', $invoice_no );
imagettftext( $image, $font, 0, 0, 145, $black, 'arial.ttf', $name );
imagettftext( $image, $font, 0, 0, 170, $black, 'arial.ttf', $phone );
imagettftext( $image, $font, 0, 0, 195, $black, 'arial.ttf', $user_email );

$delY = 220;
foreach( $delivery as $del ){
	if ( $del != "" ){
		imagettftext( $image, $font, 0, 0, $delY, $black, 'arial.ttf', $del);
		$delY += 25;
	}
}

$fh_height = $delY - 15;
//generate food list header
imagettftext( $image, $font, 0, 0, $fh_height, $black, 'arial.ttf', $line );
imagettftext( $image, $font, 0, 0, ( $fh_height + 30 ), $black, 'arial.ttf', $no );
imagettftext( $image, $font, 0, 40, ( $fh_height + 30 ), $black, 'arial.ttf', $food );
imagettftext( $image, $font, 0, 254, ( $fh_height + 30 ), $black, 'arial.ttf', $qty );
imagettftext( $image, $font, 0, 304, ( $fh_height + 30 ), $black, 'arial.ttf', $amount );
imagettftext( $image, $font, 0, 0, ( $fh_height + 40 ), $black, 'arial.ttf', $line );


//food item here
$count = 1;
$position = $fh_height + 75;
foreach ( $_SESSION['order'] as $key => $val ){
	
	$price = get_post_meta( $key, 'food_price', true );
	$price = '$' . number_format( ($price * $val), 2 );
	
	$food_name = get_the_title( $key );
	$food_name = explode( '|', wordwrap( $food_name, 19, '|', true ) );
	
	imagettftext ( $image, $font, 0, 0, $position, $black, 'arial.ttf', $count );
	imagettftext ( $image, $font, 0, 254, $position, $black, 'arial.ttf', $val );
	imagettftext ( $image, $font, 0, 304, $position, $black, 'arial.ttf', $price );
	
	$cfn = count ( $food_name );
	if ( $cfn > 0 ){
		$ln = 0;
		$fn_position = $position;
		foreach( $food_name as $fn ){
			imagettftext ( $image, $font, 0, 40, $fn_position, $black, 'arial.ttf', $fn );
			if ( $ln < $cfn ){
				$fn_position += 25;
			}
			$ln++;
		}
	}else{
		imagettftext( $image, $font, 0, 40, $position, $black, 'arial.ttf', $food_name[0] );
	}
	
	$count++;
	$position += 25;
	
	if ( $cfn > 0 )
		$position += ( $cfn * 25 ) - 25;
}

foreach( $_SESSION['morder'] as $ind => $mval ){
	
	$ord = explode( ":", $mval[1] );
	
	$price = get_post_meta( $mval[0], $ord[1], true );
	preg_match_all('!\d+(?:\.\d+)?!', $price, $matches);			
	$price = floatval( $matches[0][0] );
	$price = '$' . number_format( ($ord[0] * $price), 2 );
	
	$food_name = get_the_title( $mval[0] );
	$food_name = explode( '|', wordwrap( $food_name, 19, '|', true ) );
		
	imagettftext ( $image, $font, 0, 0, $position, $black, 'arial.ttf', $count );
	imagettftext ( $image, $font, 0, 254, $position, $black, 'arial.ttf', $ord[0] );
	imagettftext ( $image, $font, 0, 304, $position, $black, 'arial.ttf', $price );


	$cfn = count ( $food_name );
	if ( $cfn > 0 ){
		$ln = 0;
		$fn_position = $position;
		foreach( $food_name as $fn ){
			imagettftext ( $image, $font, 0, 40, $fn_position, $black, 'arial.ttf', $fn );
			if ( $ln < $cfn ){
				$fn_position += 25;
			}
			$ln++;
		}
	}else{
		imagettftext( $image, $font, 0, 40, $position, $black, 'arial.ttf', $food_name[0] );
	}
	
	$count++;
	$position += 25;
	
	if ( $cfn > 0 )
		$position += ( $cfn * 25 ) - 25;
	
}

//invoice footer
$map_height = $position;
$total_height = $map_height + 460;
$note_height = $total_height + 25;

imagettftext( $image, $font, 0, 0, $total_height, $black, 'arialbd.ttf', $total );

foreach( $note as $nt ){
	if ( $nt != "" ){
		imagettftext( $image, $font, 0, 0, $note_height, $black, 'arial.ttf', $nt );
		$note_height += 25;
	}
}

//http://www.lateralcode.com/manipulating-images-using-the-php-gd-library/
imagecopyresampled( $image, $map, 0, $map_height, 0, 0, 384, 420, 300, 328 );

//pin location calculation ( find location of the point of the pin )
//$pinw = ( 384 / 2 ) - ( 48 / 2 ); //find the center for x coordinate
//$pinh = ( $map_height + ( 420 / 2 ) ) - ( 48 - 6 ); //find the middel for y coordinate

//imagecopy( $image, $pin, $pinw, $pinh, 0, 0, 48, 48 );

imagepng( $image );

//save image to invoice directory
$upload = wp_upload_dir();
imagepng ($image, $upload['basedir'] . '/invoice/' . $_GET['invoice'] . '.png' );

imagedestroy($image);
imagedestroy($map);
//imagedestroy($pin);
imagedestroy($logo);




/**** SEND TO WING AFTER GENERATE IMAGE ***/
$_SESSION['IMG_GEN'] = 1;
function send_to_wing( $postid = "" ){

	// Initialize session and set URL.
	$url = "119.82.248.100:3135?";
	
	$url .= 'USER=' . $_SESSION['wing_user'] . '&';
	$url .= 'PASS=' . $_SESSION['wing_pass'] . '&';
	$url .= 'INVOICE_NO=' . str_replace( "INV-", "", $_SESSION['invoice_confirm']['invoice'] ) . '&';
	$url .= 'RES_NAME=' . urlencode( $_SESSION['invoice_confirm']['restoo'] ) . '&';
	$url .= 'BUY_NAME=' . urlencode( $_SESSION['invoice_confirm']['name'] ) . '&';
	$url .= 'PHONE=' . urlencode( $_SESSION['invoice_confirm']['phone'] ) . '&';
	$url .= 'ADDRESS=' . urlencode( str_replace ( "#", "", $_SESSION['invoice_confirm']['delivery'] ) ) . '&';
	$url .= 'TOTAL=' . urlencode( $_SESSION['invoice_confirm']['total'] ) . '&';
	$url .= 'NOTE=' . urlencode( $_SESSION['invoice_confirm']['note'] ) . '&';
	$url .= 'TID='. $_SESSION['terminal'] .'&';
	$url .= 'RES_NUMBER='. $_SESSION['sms'] .'&';
	$url .= 'USER_EMAIL=' . $_SESSION['invoice_confirm']['user_email'] . '&';
	$url .= 'inv=' . $_SESSION['invoice_confirm']['invoice'] . '.png&';
			
	foreach ( $_SESSION['order'] as $key => $val ){
				
		$price = get_post_meta( $key, 'food_price', true );
		$amount = number_format( ($price * $val), 2 );
		
		$url .= 'FOOD_CODE[]=' . $key . '&';
		$url .= 'FOOD_NAME[]=' . urlencode( get_the_title( $key ) ) . '&';
		$url .= 'QTY[]='. $val . '&';
		$url .= 'PRICE[]=' . $price . '&';
		$url .= 'AMOUNT[]=' . $amount . '&';		
	}
	
	foreach( $_SESSION['morder'] as $ind => $mval ){
	
		$ord = explode( ":", $mval[1] );
	
		$price = get_post_meta( $mval[0], $ord[1], true );
		preg_match_all('!\d+(?:\.\d+)?!', $price, $matches);			
		$price = floatval( $matches[0][0] );
		$amount = number_format( ($ord[0] * $price), 2 );
		
		$url .= 'FOOD_CODE[]=' . $ind . '&';
		$url .= 'FOOD_NAME[]=' . urlencode( get_the_title( $mval[0] ) ) . '&';
		$url .= 'QTY[]=' . $ord[0] . '&';
		$url .= 'PRICE[]=' . $price . '&';
		$url .= 'AMOUNT[]=' . $amount . '&';
	
	}
		
	$url = rtrim( $url, '&' );
		
	if ( $url != "" ) :	
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		//curl_setopt($ch, CURLOPT_PORT, 3135);
		curl_setopt ($ch, CURLOPT_TIMEOUT , 300);

		// Set so curl_exec returns the result instead of outputting it.
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_CAINFO, getcwd() . "/records.refresh-mobile.com.kh.crt");
			
		// Get the response and close the channel.
		$content = curl_exec($ch);
		//echo curl_error( $ch );
		curl_close($ch);
		
		
		//send to wing successful, clear the session
		if ( $content == "OK" ):
			//update the invoice for wing status
			update_post_meta( $postid, 'wing_status', 'ok' );
		else:
			update_post_meta( $postid, 'wing_status', 'fail' );
		endif;
		
	endif;

}

	// Send to Wing
	if ( $_SESSION['IMG_GEN'] == 1 ){
		$pid = $_GET['post'];
		send_to_wing( $pid );
	}


//clear the session data
$_SESSION['order'] = "";
$_SESSION['morder'] = "";
$_SESSION['order_addon'] = "";
$_SESSION['total'] = "";
$_SESSION['mtotal'] = "";
$_SESSION['numItem'] = "";
$_SESSION['restoo'] = "";
$_SESSION['sms'] = "";
$_SESSION['terminal'] = "";
$_SESSION['invoice_confirm'] = "";
$_SESSION['IMG_GEN'] = "";

exit;

/** get_img.php */