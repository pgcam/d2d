<?php
session_start();
$rid = $_GET['rid'];

function add_item_to_cart( $rid ){
	
	$_SESSION['restoo'] = $rid;
	$fid = $_POST['fid'];
	$qty = intval( trim( $_POST['qty'] ) ); 
	$addon = $_POST['faddon'];
	$fprice = $_POST['fprice'];
	
	if ( !is_array( $_SESSION['order'] ) ) //store order for single price food
		$_SESSION['order'] = array();

	if ( !is_array( $_SESSION['order_addon'] ) ) //store order for addon food
		$_SESSION['order_addon'] = array();
	
	if ( !is_array( $_SESSION['morder'] ) ) //store qty for food with multi price
		$_SESSION['morder'] = array();

	//price calculation
	if ( $fprice == "" ){
		
		$_SESSION['total'][$rid] = 0;
		
		if ( isset( $fid ) && isset( $qty ) ){
						
			if ( array_key_exists( $fid, $_SESSION['order'] ) )	
				$_SESSION['order'][$fid] += $qty;
			else
				$_SESSION['order'][$fid] = $qty;
		}

		
		foreach( $_SESSION['order'] as $food_id => $num ){

			//for food with single price
			$price = get_post_meta( $food_id, 'food_price', true );
			
			$total = $price * $num;	
			$_SESSION['total'][$rid] += $total;	
				
		}
		
		//add amount for addon food
		if ( $addon ){
		
			$aprice = $_POST['aprice'];		
			$aprice = str_replace( '$', '', $aprice );
			
			if ( array_key_exists( $fid, $_SESSION['order_addon'] ) )
				$_SESSION['order_addon'][$fid][0] += $qty;
			else
				$_SESSION['order_addon'][$fid] = array( "$qty", "$aprice" );
					
		}
		
		//calculate add on price
		foreach ( $_SESSION['order_addon'] as $add ):				
			$addAmount = $add[0] * $add[1];
			$_SESSION['total'][$rid] += $addAmount;
		endforeach;		
			
	}else{
		
		$_SESSION['mtotal'][$rid] = 0;

		//for food with multi price
		if ( isset( $fid ) && isset( $qty ) ){
					
			//embed price key in qty
			$qty .= ":$fprice";
			array_push( $_SESSION['morder'], array( $fid, $qty ) );
			
		}
										
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
	}
		
	//sum up single-price & muti-price total
	if ( isset($_SESSION['mtotal']) && ( $_SESSION['mtotal'][$rid] != "" ) )
		$_SESSION['total'][$rid] += $_SESSION['mtotal'][$rid];	
		
	//sum the total item in the cart
	$_SESSION['numItem'] = count( $_SESSION['order'] ) + count( $_SESSION['morder'] );
			
	
	$prev = $_POST['prev_url'];
	wp_redirect( $prev );
	exit;

}

if ( isset( $_SESSION['total'] ) && is_array( $_SESSION['total'] ) ){

	foreach( $_SESSION['total'] as $key => $val ){	
		
		if ( $key == $rid ):
			add_item_to_cart( $rid );		
		else:
		
			//this happens when users have items in their cart from another restaurant that they didn't complete the order yet.
			$prev  = $_POST['prev_url'];
			$prev .= '?has_order=true';
			wp_redirect( $prev );
			exit;
					
		endif;
	
	}
	
}else{
	add_item_to_cart( $rid );
}


exit;
/** end of add_item.php */