<?php
session_start();

$ord = $_GET['ord'];
$id = $_GET['id'];
$rid = $_SESSION['restoo'];

if ( isset( $_GET['ind'] ) )
	$ind = $_GET['ind'];

if ( $ord == "order" )
	unset( $_SESSION["$ord"]["$id"] );
else
	unset( $_SESSION["$ord"][$ind] );
	
$_SESSION['total'][$rid] = 0;
$_SESSION['mtotal'][$rid] = 0;


/*** RE-CALCULATE THE PRICE ***/	
foreach( $_SESSION['order'] as $food_id => $num ){
	//for food with single price
	$price = get_post_meta( $food_id, 'food_price', true );
	$total = $price * $num;
	$_SESSION['total'][$rid] += $total;	
}

//calculate add-on price
foreach ( $_SESSION['order_addon'] as $add ):				
	$addAmount = $add[0] * $add[1];
	$_SESSION['total'][$rid] += $addAmount;
endforeach;		

//calculate multiple price
foreach( $_SESSION['morder'] as $order ){
		
	$food_id = $order[0];
	$num = $order[1];
	
	$kPrice = explode(":", $num);			
	$price = get_post_meta( $food_id, $kPrice[1], true );
	
	preg_match_all('!\d+(?:\.\d+)?!', $price, $matches);			
	$price = floatval( $matches[0][0] );
	
	$total = $kPrice[0] * $price;
				
	$_SESSION['mtotal'][$rid] += $total;			
	
}

//sum up single-price & muti-price total
if ( isset($_SESSION['mtotal']) && ($_SESSION['mtotal'][$rid] != "") )
	$_SESSION['total'][$rid] += $_SESSION['mtotal'][$rid];
	
if ( $_SESSION['total'][$rid] == 0 )
	$_SESSION['total'] = "";
	
//sum the total item in the cart
$_SESSION['numItem'] = count( $_SESSION['order'] ) + count( $_SESSION['morder'] );
	
wp_redirect( site_url( '/cart_items/' ) );
exit;

/** del_cart_item.php */