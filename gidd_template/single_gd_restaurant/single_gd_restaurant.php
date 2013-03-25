<?php
___add( 'col1', 'single_gd_restaurant' );
___add( 'col2', 'single_gd_restaurant' );
___add( 'before_footer', 'single_gd_restaurant' );
___add( 'before_col1', 'single_gd_restaurant' );
___add( 'after_header', 'single_gd_restaurant' );


function ___before_col1_single_gd_restaurant(){
	if( isset( $_GET['has_order'] ) && $_GET['has_order'] ):
		echo '<div id="cart_popup"><div class="popup-head"><div class="ph-left"></div><div class="ph-middle"></div><div class="ph-right"></div></div>';
		
		echo '<div class="popup-content">';
		echo '<div class="closeWrap"><a class="close_popup" href="#"><span class="close_text">Close</span><span class="cross"></span></a></div>';
		echo ___clearBoth();
		echo ___space(20);
		echo '<h2>Sorry. There are items in your cart. <br /> Please complete your order or empty your cart first.</h2>';
		echo ___space(20);
		echo '<ul style="list-style: none; text-align: left;">';
		echo '<li>1. <a href="'. site_url('/cart_items/') .'">Complete your order</a></li>';
		echo '<li>2. <a href="'. site_url('/empty_cart/') .'">Empty your cart</a></li>';
		echo '</ul>';
		echo '</div></div>';
	endif;
?>

	<script type="text/javascript">
		var $ = jQuery.noConflict();
		$(document).ready( function(){
			$('#cart_popup').bPopup({ closeClass: 'close_popup' });
		});
	</script>
	
<?php		
}

function ___col1_single_gd_restaurant(){
	
	date_default_timezone_set('Asia/Phnom_Penh');
	$rid = "";
		
	while( have_posts() ): the_post();
	
		$address 	= get_post_meta( get_the_ID(), 'restoo_address', true );
		$phone 		= get_post_meta( get_the_ID(), 'restoo_phone', true );
		$time		= get_post_meta( get_the_ID(), 'restoo_time', true );
		$map		= get_post_meta( get_the_ID(), 'restoo_map', true );
		$charge		= get_post_meta( get_the_ID(), 'restoo_charge', true );
		$method		= get_post_meta( get_the_ID(), 'restoo_method', true );
		$waiting	= get_post_meta( get_the_ID(), 'restoo_waiting', true );
		$web		= get_post_meta( get_the_ID(), 'restoo_web_url', true );
		$sms		= get_post_meta( get_the_ID(), 'restoo_sms', true );
		$tid		= get_post_meta( get_the_ID(), 'restoo_terminal', true );
		
		if ( $phone == "" )
			$phone = "N/A";
		
		if ( $address == "" )
			$address = "N/A";
		
		echo '<div class="single_restoo">';
	
		echo '<div class="single-restoo-title">';
		echo '<h2>'; the_title(); echo '</h2>&nbsp;&nbsp;&nbsp;';
		echo '<span class="restoo-address" style="text-transform: uppercase; color: #777;">'. $address .'</span>';
		echo '<a id="pmap" href="#"></a>';
		echo '<span class="time">'.date('H:i A').'</span>';
		echo '<div class="restoo-phone"><span style="text-transform: none; font-size: 13px; display: block; padding-bottom: 5px;">Telephone only orders for now</span><span class="phone_num">' . $phone . '</span></div>';
		echo ___clearBoth();		
		
		
		echo '</div>';	
		
		echo '<div class="single-restoo-content">';
		
		echo '<span class="cuisine-type">' . rtrim( $cusines, ', ' ) . '</span>';
		
		echo '<div class="restoo-logo">';
		the_content();
		echo '</div>';
		
		echo '<div class="restoo-info">';
				
		echo '<span class="restoo-time restoo-lbl">Delivery Time: </span>';
		echo '<span class="restoo-sale">'. $time .'</span>';
		echo '<div class="clearBoth"></div>';
		
		echo '<span class="restoo-map restoo-lbl">Map Reference:</span>';
		echo '<span class="restoo-sale">'. $map .'</span>';
		echo '<div class="clearBoth"></div>';
		
		echo '<span class="restoo-charge restoo-lbl">Delivery Charge:</span>';
		echo '<span class="restoo-sale">'. $charge .'</span>';
		echo '<div class="clearBoth"></div>';
						
		echo '<span class="restoo-method restoo-lbl">Delivery Method: </span>';
		echo '<span class="restoo-sale">'. $method .'</span>';
		echo '<div class="clearBoth"></div>';
						
		echo '<span class="restoo-waiting restoo-lbl">AVG Waiting Time: </span>';
		echo '<span class="restoo-sale">'. $waiting .'</span>';
		echo '<div class="clearBoth"></div>';
		
		if ( $web != "" ){
			$web1 = $web;
			if(!strpos($web, "http://"))
				$web = "http://".$web;
			
			echo '<span class="restoo-waiting restoo-lbl">Web address: </span>';					
			echo '<a href="'.$web.'" target="_blank"><span class="restoo-sale">'. $web1 .'</a></span>';
			echo '<div class="clearBoth"></div>';
		}
		
		echo '</div>';
		
		echo ___clearBoth();
		echo '</div>';	
		
		//$title = ___id( get_the_title() );
		$rid = get_the_ID();
		
	endwhile;
	
	//show map popup
	
	echo ___clearBoth();
	
	echo ___space( 10 );
					
	$submenu = get_food_submenu( $rid ); //helper.php of gidd_food
	$order_sm = get_post_meta( $rid, 'submenu_order', true );
	
	if ( is_array( $order_sm ) ){
		asort( $order_sm );
		
		$new_sm = array();
		foreach ( $order_sm as $sm => $order ){
			$new_sm[$sm] = $submenu[$sm]; 
		}
					
		unset( $submenu );
		unset( $order_sm );
		
		
		//fatboy
		if ( $rid == 584 )
			echo gidd_block_content(2472);
			
		//vego salad
		if ( $rid == 2437 )
			echo gidd_block_content(2538);
		
	
		foreach( $new_sm as $slug => $name ){
		
			echo '<div class="food-group">';
						
			echo '<h2>'. $name .'</h2>';
			$term = get_term_by( 'slug', $slug, 'submenu' );
			//echo '<div class="order_notice">'. term_description( $term->term_id, 'submenu' ) .'</div>';
			
			
			
			//t-bone
			if ( ( $rid == 1096 ) && ( $slug == 'imported-beef' ) ):
				echo gidd_block_content(2496);
				echo gidd_block_content(2497);
			endif;
			
			//sharky
			if ( ( $rid == 1519 ) && ( $slug == 'burgers-sandwiches' ) )
				echo gidd_block_content(2495);
			
			//lone-star
			if ( ( $rid == 103 ) && ( $slug == 'house-specialties' ) )
				echo gidd_block_content(2492);
			
			//lone-star
			if ( ( $rid == 103 ) && ( $slug == 'burgers-sandwiches' ) )
				echo gidd_block_content(2491);
			
			//java									
			if ( ( $rid == 1258 ) && ( $slug == 'soups' ) )
				echo gidd_block_content(2484);
			
			if ( ( $rid == 1258 ) && ( $slug == 'salads' ) )
				echo gidd_block_content(2485);
						
			if ( ( $rid == 1258 ) && ( $slug == 'sandwiches' ) )
				echo gidd_block_content(2486);
						
			if ( ( $rid == 1258 ) && ( $slug == 'burgers' ) )
				echo gidd_block_content(2487);
			
			
			if ( ( $rid == 1258 ) && ( $slug == 'fajitas' ) )
				echo gidd_block_content(2488);
			
			
			//fresco
			if ( ( $rid == 867 ) && ( $slug == 'coffees' ) )
				echo gidd_block_content(2480);
			
			if ( ( $rid == 867 ) && ( $slug == 'sandwiches' ) )
				echo gidd_block_content(2479);
			
			
			//fcc
			if ( ( $rid == 805 ) && ( $slug == 'burgers-sandwiches' ) )
				echo gidd_block_content(2478);
			
			if ( ( $rid == 805 ) && ( $slug == 'wood-fired-pizzas' ) )
				echo gidd_block_content(2475);
			
			//fatboy
			if ( ( $rid == 584 ) && ( $slug == 'value-subs' ) )
				echo gidd_block_content(2473);
			
			//eden
			if ( ( $rid == 163 ) && ( $slug == 'fill-em-up' ) )
				echo gidd_block_content(2467);
			
			//cadillac
			if ( ( $rid == 155 ) && ( $slug == 'pastas' ) )
				echo gidd_block_content(2464);
			
			if ( ( $rid == 155 ) && ( $slug == 'main-courses' ) )
				echo gidd_block_content(2463);
			
			if ( ( $rid == 155 ) && ( $slug == 'burgers' ) )
				echo gidd_block_content(2461);
			
			if ( ( $rid == 155 ) && ( $slug == 'sandwich' ) )
				echo gidd_block_content(2460);
				
			if ( ( $rid == 155 ) && ( $slug == 'salads' ) )
				echo gidd_block_content(2921);
			
			
			//the blue pumkin
			if ( ( $rid == 153 ) && ( $slug == 'sandwich' ) )
				echo gidd_block_content(2458);
			
			//the aussie
			if ( ( $rid == 150 ) && ( $slug == 'breads' ) )
				echo gidd_block_content(2455);
			
			if ( ( $rid == 150 ) && ( $slug == 'pies-etc' ) )
				echo gidd_block_content(2454);
			
			if ( ( $rid == 150 ) && ( $slug == 'burgers' ) )
				echo gidd_block_content(2451);
			
			//alley cat
			if ( ( $rid == 148 ) && ( $slug == 'mexican-tex-mex' ) )
				echo gidd_block_content(2918);
				
			if ( ( $rid == 148 ) && ( $slug == 'burgers-salads' ) )
				echo gidd_block_content(2919);
			
			//la patate
			if ( ( $rid == 1641 ) && ( $slug == 'bazooka' ) )
				echo gidd_block_content(2925);
			
			if ( ( $rid == 1641 ) && ( $slug == 'kings-burgers' ) )
				echo gidd_block_content(2924);
			
			
			//the living room
			if ( ( $rid == 1764 ) && ( $slug == 'fresh-salads' ) )
				echo gidd_block_content(2926);
				
			//relax pizza
			if ( ( $rid == 1329 ) && ( $slug == 'pizzas' ) )
				echo gidd_block_content(2928);
			
			if ( ( $rid == 1329 ) && ( $slug == 'burgers-set' ) )
				echo gidd_block_content(2929);
			
			
			/*** FOOD ITEM LIST ***/
			get_food_by_restaurant( $rid, $slug );	
			/******/
			
			//t-bone
			if ( ( $rid == 1096 ) && ( $slug == 'imported-beef' ) )
				echo gidd_block_content(2500);
						
			//karem
			if ( ( $rid == 1477 ) && ( $slug == 'cups' ) )
				echo gidd_block_content(2489);
		
			
			//gloria jean
			if ( ( $rid == 2378 ) && ( $slug == 'cold-drinks' ) )
				echo gidd_block_content(2483);
				
			
			//fresh salad bar
			if ( ( $rid == 972 ) && ( $slug == '' ) )
				echo gidd_block_content(2481);
		
			
			//fatboy
			if ( ( $rid == 584 ) && ( $slug == 'value-subs' ) )
				echo gidd_block_content(2477);
			
			//eden
			if ( ( $rid == 163 ) && ( $slug == 'the-chip-shop' ) )
				echo gidd_block_content(2470);
			
			if ( ( $rid == 163 ) && ( $slug == 'main-meals' ) )
				echo gidd_block_content(2469);
			
			if ( ( $rid == 163 ) && ( $slug == 'burgers-stuff' ) )
				echo gidd_block_content(2468);
				
			if ( ( $rid == 163 ) && ( $slug == 'dessert' ) )
				echo gidd_block_content(2916);
			
			//comma a la maison
			if ( ( $rid == 159 ) && ( $slug == 'pizzas' ) )
				echo gidd_block_content(2465);
			
			//cadillac
			if ( ( $rid == 155 ) && ( $slug == 'burgers' ) )
				echo gidd_block_content(2462);
			
			//the aussie
			if ( ( $rid == 150 ) && ( $slug == 'burgers' ) )
				echo gidd_block_content(2452);
				
			if ( ( $rid == 150 ) && ( $slug == 'wood-fired-pizza' ) )
				echo gidd_block_content(2448);
			
			
			echo '</div>';
			
		}
	}else{
	
		//when not sorting
		foreach( $submenu as $slug => $name ){
		
			echo '<div class="food-group">';
			echo '<h2>'. $name .'</h2>';
			$term = get_term_by( 'slug', $slug, 'submenu' );
			echo '<div class="order_notice">'. term_description( $term->term_id, 'submenu' ) .'</div>';
			get_food_by_restaurant( $rid, $slug );	
			echo '</div>';
			
		}
	
	}
	
	
	while( have_posts() ){
		the_post();
		
		$address 	= get_post_meta( get_the_ID(), 'restoo_address', true );
		$phone 		= get_post_meta( get_the_ID(), 'restoo_phone', true );
		
		echo ___space(20);
		echo '<span class="restoo-phone-bottom"><span style="text-transform: none; font-size: 14px; display: block; padding-bottom: 5px;">Telephone only orders for now</span>' . $phone . '</span>';
	
	}
	wp_reset_query();
	
	echo ___clearBoth();
	echo ___space(20);
		
	echo '</div>'; //end of single restoo
	
}


function ___col2_single_gd_restaurant(){

	echo ___space(33);
	get_food_search();
	while( have_posts() ): the_post();
	
		$id = get_the_ID();
		
		$desc = get_post_meta( $id, 'restoo_desc', true );
		
		
		echo wpautop( $desc );
	
	endwhile;
		
	wp_reset_query();
	
	
	/*//show cuisine type
	$category = get_categories( array( 'hide_empty' => 0 ) );
	echo '<ul class="cuisine_list">';
	echo '<h3 class="cuisine_title">Cuisine Type</h3>';
	echo '<li><a href="'. site_url('/restaurant/') .'">All Cuisines</a></li>';
	foreach( $category as $cat ){
		if ( $cat->name != "Uncategorized" )
			echo '<li><a href="'. site_url('/restaurant?cuisine='. $cat->cat_ID ) .'">'. $cat->name .'</a></li>';
	}
	echo '</ul>';*/
		
	//cart
	echo ___space(10);
	echo '<div id="cart_widget">';
	
	echo '<div class="cart_head">';
		echo '<h4>CART</h4>';
	echo '</div>';
	
	echo '<div class="cart_content">';
	
	if ( !isset( $_SESSION['numItem'] ) && ( $_SESSION['numItem'] == "" ) )
		$_SESSION['numItem'] = 0;
	
	if ( isset ( $_SESSION['total'] ) && is_array( $_SESSION['total'] ) ){
	
		echo '<h5>Item: ' . $_SESSION['numItem'] . '</h5>';
		foreach ( $_SESSION['total'] as $total )
			echo '<h5>Total: $'. number_format( $total, 2 ) .'</h5>';
		
		echo ___space(10);
		echo '<a id="cart-items" href="'. site_url('/cart_items/') .'">View Cart Items</a>';
	
	}else{
		echo ___space(15);
		echo '<p>Your cart is empty.</p>';
	}
	
	echo '</div>';
	
	echo '</div>';
	
	
	if ( $_SESSION['numItem'] > 0 ):
	
		//checkout box
		echo ___space(10);	
		echo '<div class="checkout_widget">';
		
		echo '<h4>You have item(s) in your cart.</h4>';
		echo '<a id="btn_checkout" href="'. site_url('/checkout/') .'">Checkout</a>';
		
		echo '</div>';
		
	endif;
	
}


function ___before_footer_single_gd_restaurant(){
	echo '<div id="pmap_d2d" style="display: none;"><div id="num_overlay"></div><img src="'. PARENTURL .'images/d2d_map.jpg" alt="map" width="1000px" height="1287px" /></div>';
}


function ___after_header_single_gd_restaurant(){
	echo '<div id="order_note"><p>Please note that you can make orders from ONE restaurant ONLY at a time.</p></div>';
}


/** end of single_gd_restaurant.php */