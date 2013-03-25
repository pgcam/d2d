<?php
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
$height = 830;

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

$delY = 195;
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

exit;

/** get_img.php */