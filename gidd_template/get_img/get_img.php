<?php
header("Content-type: image/png");

$restaurant = $_GET['restoo'];
$restaurant = "Restaurant name: " . $restaurant;

$name = $_GET['name'];
$name = "Name: " . $name;

$phone = $_GET['phone'];
$phone = "Phone: " . $phone;

$delivery = $_GET['delivery'];
$delivery = "Delivery address: " . $delivery;

$total = $_GET['total'];
$total = "Total: " . $total;

$note = $_GET['note'];
$note = "Note: " . $note;

$invoice = $_GET['invoice'];
$invoice = "Invoice number: " . $invoice;


$no = "No.";
$food = "Food name";
$qty = "Qty";
$amount = "Amount";
$location = "Location: ";

$line = "------------------------------------------------------";

$map = imagecreatefromjpeg( get_template_directory() . '/location/'. $_GET['map'] );
$logo = imagecreatefrompng( get_template_directory() . '/location/logo.png' );
$pin = imagecreatefrompng( get_template_directory() . '/location/pin.png' );

$font  = 2;
//$width  = imagefontwidth($font) * strlen($string);
$width = 360;
$height = 450;

$count_items = count( $_SESSION['order'] ) + count( $_SESSION['morder'] );

if ( $count_items > 1 )
	$height = $height + ( $count_items * 20 );

$image = imagecreatetruecolor ($width, $height);
$white = imagecolorallocate ($image,255,255,255);
$black = imagecolorallocate ($image,0,0,0);

imagefill($image,0,0,$white);

//invoice header
imagestring ($image,$font,20,90,$invoice,$black);
imagestring ($image,$font,20,110,$restaurant,$black);
imagestring ($image,$font,20,130,$name,$black);
imagestring ($image,$font,20,150,$phone,$black);
imagestring ($image,$font,20,170,$delivery,$black);


//generate food list header
imagestring ($image,$font,20,190,$line,$black);
imagestring ($image,3,20,205,$no,$black);
imagestring ($image,3,50,205,$food,$black);
imagestring ($image,3,270,205,$qty,$black);
imagestring ($image,3,300,205,$amount,$black);
imagestring ($image,$font,20,220,$line,$black);


//food item here
$count = 1;
$position = 235;
foreach ( $_SESSION['order'] as $key => $val ){
	
	$price = get_post_meta( $key, 'food_price', true );
	$price = '$' . number_format( ($price * $val), 2 );
	
	imagestring ($image,$font,20,$position,$count,$black);
	imagestring ($image,$font,50,$position,get_the_title( $key ),$black);
	imagestring ($image,$font,270,$position,$val,$black);
	imagestring ($image,$font,300,$position,$price,$black);
	
	$count++;
	$position += 20;
}

foreach ( $_SESSION['morder'] as $ind => $mval ){
	
	$ord = explode( ":", $mval[1] );
	
	$price = get_post_meta( $mval[0], $ord[1], true );
	preg_match_all('!\d+(?:\.\d+)?!', $price, $matches);			
	$price = floatval( $matches[0][0] );
	$price = '$' . number_format( ($ord[0] * $price), 2 );
	
	imagestring ($image,$font,20,$position,$count,$black);
	imagestring ($image,$font,50,$position,get_the_title( $mval[0] ),$black);
	imagestring ($image,$font,270,$position,$ord[0],$black);
	imagestring ($image,$font,300,$position,$price,$black);
	
	$count++;
	$position += 20;
	
}

//invoice footer
$total_height = 350;
$note_height = 370;
$map_height = 250;
$loc_height = 275;
if ( $count_items > 0 ){
	$total_height += ( $count_items * 20 );
	$note_height += ( $count_items * 20 );
	$map_height += ( $count_items * 20 );
	$loc_height += ( $count_items * 20 );
	
}

imagestring($image,5,20,$total_height,$total,$black);
imagestring($image,$font,20,$note_height,$note,$black);
imagestring($image,$font,20,$loc_height,$location,$black);

//http://www.lateralcode.com/manipulating-images-using-the-php-gd-library/
imagecopy( $image, $map, 150, $map_height, 0, 0, 120, 80 );
imagecopy( $image, $logo, 50, 20, 0, 0, 250, 56 );
imagecopy( $image, $pin, 185, ($map_height+16), 0, 0, 48, 48 );

imagepng ($image);
imagedestroy($image);
imagedestroy($map);
imagedestroy($pin);
imagedestroy($logo);

exit;

/** get_img.php */