<?php

if ( isset( $_POST['addr'] ) ){
	___add('col1', 'order_summary');
}else{
	wp_redirect( site_url('/checkout/?msg=addr') );
	exit;
}

function generate_invoice_id(){

	$id = "INV-";
	
	$count = 0;
	$day = date('d');
	$month = date('m');
	$year = date('Y');
	
	$today = $year . '-' . $month . '-' . $day;
	$qry = new WP_Query();
	
	$qry->query( array( 'post_type' => 'gd_invoice', 'meta_compare' => '=', 'meta_key' => 'created_date', 'meta_value' => $today ) );
	$found = intval( $qry->found_posts );
	
	if ( $found > 0 )
		$count = $found;
		
	$count++;
	$id .= $day . $month . $year . $count;	
	
	return $id;
}

function ___col1_order_summary(){

	$uid = get_current_user_id();
	$delivery = get_user_meta( $uid, $_POST['addr'], true );
	
	$fname = get_user_meta( $uid, 'first_name', true );
	$lname = get_user_meta( $uid, 'last_name', true );
	
	$phone1 = get_user_meta( $uid, 'phone1', true );
	$phone2 = get_user_meta( $uid, 'phone2', true );
	
	$name = $lname . ' ' . $fname;
	$phone = ( $phone2 == "" ) ? $phone1 : $phone1 . ', ' . $phone2;
	$note = trim( $_POST['note'] );
	$email = get_user_meta($uid, 'email', true);
		
	echo '<h2 id="confirm_order">Please confirm your order</h2>';	
	echo '<h2 style="font-weight: bold; font-size: 14px;"><span style="font-weight: normal;">Restaurant name: </span>' . get_the_title( $_SESSION['restoo'] ) . '</h2>';
	echo '<p>';
	echo '<span>Name: </span>';
	echo '<span><strong>'. $name .'</strong></span>';
	echo '</p>';
	
	echo '<p>';
	echo '<span>Phone: </span>';
	echo '<span>'. $phone .'</span>';
	echo '</p>';
	
	echo '<p>';
	echo '<span>Email: </span>';
	echo '<span>'. $email .'</span>';
	echo '</p>';
	
	echo '<p>';
	echo '<span>Delivery address: </span>';
	echo '<span>'. $delivery .'</span>';
	echo '</p>';
		
	echo ___space(10);
	echo '<table id="tbl_items" border=0 width="500px" cellpadding=0 cellspacing=0>';
	echo '<thead>';
	echo '<tr><th>No.</th><th>Food Name</th><th>Quantity</th><th colspan=2>Amount</th></tr>';
	echo '</thead>';
	
	echo '<tbody>';
	
	$count = 1;
	//show the cart items from session
	foreach ( $_SESSION['order'] as $key => $val ){
	
		echo '<tr>';
		
		echo '<td>';
		echo $count;
		echo '</td>';
		
		echo '<td>';
		echo get_the_title( $key );
		echo '</td>';
		
		echo '<td>';
		echo $val;
		echo '</td>';
		
		echo '<td>';
		
		$price = get_post_meta( $key, 'food_price', true );
		echo '$' . number_format( ($price * $val), 2 );
					
		echo '</td>';
											
		echo '</tr>';
		
		$count++;
	}
	
	foreach ( $_SESSION['morder'] as $ind => $mval ){
	
		$ord = explode( ":", $mval[1] );
		
		echo '<tr>';
		
		echo '<td>';
		echo $count;
		echo '</td>';
		
		echo '<td>';
		echo get_the_title( $mval[0] );
		echo '</td>';
		
		echo '<td>';
		echo $ord[0];
		echo '</td>';
		
		echo '<td>';
		
		$price = get_post_meta( $mval[0], $ord[1], true );
		preg_match_all('!\d+(?:\.\d+)?!', $price, $matches);			
		$price = floatval( $matches[0][0] );
		echo '$' . number_format( ($ord[0] * $price), 2 );
		
		echo '</td>';	
		
		echo '<td>';
		echo '<a href="'. site_url('/del_cart_item/?id=' . $mval[0] ) .'&ord=morder&ind='. $ind .'" class="del_item">delete</a>';
		echo '</td>';
					
		echo '</tr>';			
		$count++;
	}
	
	echo '</tbody>';		
	echo '</table>';
		
	$total = number_format( $_SESSION['total'][$_SESSION['restoo']], 2 );
	
	echo ___space(10);
	if ( $_SESSION['total'][$_SESSION['restoo']] == "" )
		echo '<h4 style="font-weight: bold; font-size: 14px;">Total: $0.00</h4>';
	else
		echo '<h4 style="font-weight: bold; font-size: 14px; margin-bottom: 5px;">Total: $'. $total .'</h4>';
				
	if ( $note !="" ){
		echo '<p class="note"><span>Note: </span>'. $note .'</p>';
		echo ___space(10);
	}
		
	echo '<form method="post" action="'. site_url('/confirm_order/') .'">';	
	$addrnum = ( $_POST['addr'] == 'address1' ) ? 1 : 2;	
	
	/*//hidden data
	echo '<input type="hidden" name="delivery" value="'. $delivery .'" />';
	echo '<input type="hidden" name="delivery_no" value="'. $addrnum .'" />';
	echo '<input type="hidden" name="note" value="'. $note .'" />';
	echo '<input type="hidden" name="total" value="'. $total .'" />';*/
	
	echo '<input type="submit" class="confirm_order" value="Confirm your order" name="confirm_order" />';	
	echo '</form>';
	
	
	//build data for confirm_order and save to session
	$map = "uid_" . $uid . "_map" . $addrnum . '_bw.jpg';
	$arr = array( 	'restoo' => get_the_title( $_SESSION['restoo'] ), 'name' => $name, 
					'phone' => $phone, 'invoice' => generate_invoice_id(), 
					'delivery' => $delivery, 'total' => $total, 
					'note' => $note, 'map' => $map, 'user_email' => $email );
	
	$_SESSION['invoice_confirm'] = $arr;
	unset( $arr );
	
	$_SESSION['sms'] = get_post_meta( $_SESSION['restoo'], 'restoo_sms', true );
	$_SESSION['terminal'] = get_post_meta( $_SESSION['restoo'], 'restoo_terminal', true );
	
	//$_SESSION['sms'] = '000000003';
	//$_SESSION['terminal'] = '012123412';
	
	//generate md5 for user & pass
	$user = md5('dddev');
	$pass = md5('d2d$2013');
	
	$_SESSION['wing_user'] = $user;
	$_SESSION['wing_pass'] = $pass;
		
}


/** order_summary.php */