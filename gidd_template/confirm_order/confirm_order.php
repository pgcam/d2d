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
	$inv_content .= "<p class='inv-email'><span>Email: </span>". $_SESSION['invoice_confirm']['user_email'] ."</p>";
	$inv_content .= "<p class='inv-delivery'>Delivery: <span>" . $_SESSION['invoice_confirm']['delivery'] . '</span></p>';
	$inv_content .= "<p class='inv-charge'>Delivery charge: <span>" . $_SESSION['del_charge'] . '</span></p>';
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


function generate_invoice_image( $postid ){
	$_SESSION['invoice_confirm']['post'] = $postid;
	$query = http_build_query( $_SESSION['invoice_confirm'] );
	?>
		<script type="text/javascript">
			jQuery(document).ready( function($){
				
				$('img.dyn_invoice').hide().load( function(){
				
					$.post('<?php echo site_url('/get_invoice_status/'); ?>', {pid: <?php echo $postid; ?>}, function html( data ){					
						
						if ( data == "ok" )
							$('#result').html( '<h2 style="font-size:22px; font-weight: bold;">Thank you. Your order has been submitted successfully.</h2>' );	
						else
							$('#result').html( '<h2 style="font-size:22px; font-weight: bold; color: red;">Sorry. There is a problem while processing your order.</h2>' );
					});
				
				});
				
				$('img.dyn_invoice').ajaxStop(function(){
					$(this).show();					
				});
			});
		</script>
		<div id="result" style="height: 30px;"></div>
		<img class="dyn_invoice" src='<?php echo site_url('/get_img/?') . $query; ?>' alt='' />	
	<?php
}


___add('col1', 'confirm_order');
function ___col1_confirm_order(){

	if ( isset( $_SESSION['invoice_confirm'] ) && $_SESSION['invoice_confirm'] != "" ){
		
		//1. Save invoice into WP
		$postid = save_invoice();
		
		//2. generate invoice img
		generate_invoice_image( $postid );
			
	}else{
		echo '<h2>Your order is already submitted.</h2>';
	}
	
}	

/*** confirm_order.php */