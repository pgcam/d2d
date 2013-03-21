<?php

// 1. Save invoice into WP using WP API
// 2. Send to Wing using cURL
// 3. Generate invoice image with GD Library
// 4. Send Email
// 5. Send SMS

function save_invoice(){

	date_default_timezone_set('Asia/Phnom__Penh');
	$today = date('Y-m-d');
	$postid = "";
	
	$inv_title = $_SESSION['invoice_confirm']['invoice'];
	$inv_content  = "<p class='restoo'>Restaurant: <span>" . $_SESSION['invoice_confirm']['restoo'] . '</span></p>';
	$inv_content .= "<p class='inv-name'>Name: <span>" . $_SESSION['invoice_confirm']['name'] . '</span></p>';
	$inv_content .= "<p class='inv-phone'>Phone: <span>" . $_SESSION['invoice_confirm']['phone'] . '</span></p>';
	$inv_content .= "<p class='inv-delivery'>Delivery: <span>" . $_SESSION['invoice_confirm']['delivery'] . '</span></p>';
	$inv_content .= "<p class='inv-total'>Total: <span>" . $_SESSION['invoice_confirm']['total'] . '</span></p>';
	$inv_content .= "<p class='inv-note'>Note: <span>" . $_SESSION['invoice_confirm']['note'] . '</span></p>';
		
	$inv_content .= "<h4>Food Items</h4>";
	
	foreach ( $_SESSION['order'] as $key => $val ){
				
		$price = get_post_meta( $key, 'food_price', true );
		$amount = number_format( ($price * $val), 2 );
		
		$inv_content .= "<p class='food-item'>";
		$inv_content .= "<span class='fid'>". $key ."</span> ";
		$inv_content .= "<span class='food_name'>". get_the_title( $key ) ."</span> ";
		$inv_content .= "<span class='qty'>". $val ."</span> ";
		$inv_content .= "<span class='price'>". $price ."</span>";
		$inv_content .= "<span class='amount'>". $amount ."</span>";
		$inv_content .= "</p>";
	}
		
	$invoice = array( 'post_title' 	=> $inv_title,
					'post_content' 	=> $inv_content,
					'post_type'		=> 'gd_invoice',
					'post_date'		=> "$today",
					'post_status'	=> "Publish",
					//'tax_input'		=> array( "category" => array( $term_id ) ),										
				);
					
	if ( !get_page_by_title( $invoice['post_title'], 'OBJECT', 'gd_invoice' ) ){
		$postid = wp_insert_post( $invoice );
		if ( $postid > 0 )
			update_post_meta( $postid, "created_date", $today );
	}
	
	return $postid;
}

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
		/*$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		//curl_setopt($ch, CURLOPT_PORT, 3135);
		curl_setopt ($ch, CURLOPT_TIMEOUT , 500);

		// Set so curl_exec returns the result instead of outputting it.
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_CAINFO, getcwd() . "/records.refresh-mobile.com.kh.crt");
			
		// Get the response and close the channel.
		$content = curl_exec($ch);
		//echo curl_error( $ch );
		curl_close($ch);*/
		
		//generate invoice img
		generate_invoice_image();
		
		/*//send to wing successful, clear the session
		if ( $content == "OK" ):
		
		//update the invoice for wing status
		update_post_meta( $postid, 'wing_status', 'ok' );
		
		?>

		<div id="result">
			<h2>Thank you. Your order has been submitted successfully.</h2>
		</div>
		
	<?php
	
		//clear the data
		$_SESSION['invoice_confirm'] = "";
		
		else:
			update_post_meta( $postid, 'wing_status', 'fail' );
			echo '<h2>Sorry! There is a problem while processing your order. Please try again.</h2>';
			echo $content;
		endif;*/
	endif;

}

function generate_invoice_image(){
	$query = http_build_query( $_SESSION['invoice_confirm'] );
	?>
		<img src='<?php echo site_url('/get_img/?') . $query; ?>' alt='' />		
	<?php
}


___add('col1', 'confirm_order');
function ___col1_confirm_order(){

	if ( isset( $_SESSION['invoice_confirm'] ) && $_SESSION['invoice_confirm'] != "" ){
		
		//1. Save invoice into WP
		$postid = save_invoice();
		
		//2. Send to Wing
		if ( intval( $postid ) > 0 ){
			send_to_wing( $postid );
		}
			
	}else{
		echo '<h2>Your order is already submitted.</h2>';
	}
	
}	

/*** confirm_order.php */