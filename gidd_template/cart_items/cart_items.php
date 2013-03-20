<?php
	session_start();
	
	___add( 'col1', 'cart_items' );
	function ___col1_cart_items(){
	
		echo '<h2 style="font-weight:bold; border-bottom: 1px #CCC solid;">View Cart Items</h2>';
		echo ___space(10);
		
		echo '<h2 style="font-weight: bold; font-size: 14px;"><span style="font-weight: normal;">Restaurant name: </span>' . get_the_title( $_SESSION['restoo'] ) . '</h2>';
		//get the restaurant info
		echo ___space(5);
		
		
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
			
			echo '<td>';
			echo '<a href="'. site_url('/del_cart_item/?id=' . $key ) .'&ord=order" class="del_item">delete</a>';
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
		
		echo ___space(30);
		if ( $_SESSION['total'][$_SESSION['restoo']] == "" )
			echo '<h2 style="font-weight: bold;">Total: $0.00</h2>';
		else
			echo '<h2 style="font-weight: bold;">Total: $'. number_format( $_SESSION['total'][$_SESSION['restoo']], 2 ) .'</h2>';
		
		echo ___space(30);		
		if ( $_SESSION['total'][$_SESSION['restoo']] > 0 )
			echo '<a class="cart_checkout" href="'. site_url('/checkout/') .'">Checkout</a>';

	}
	

/*** end of cart_items.php */