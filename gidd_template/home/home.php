<?php

___add( 'col1', 'home' );
___add( 'after_header', 'home' );
___add( 'before_page', 'home' );
___add( 'before_col1', 'home' );
___add( 'after_container', 'home' );
___add( 'head', 'home' );

function ___head_home(){
	
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-widget' );
	wp_enqueue_script( 'kinetics', CHILDTPURL . 'home/jquery.kinetic.js' );
	wp_enqueue_script( 'smoothdivscroll', CHILDTPURL . 'home/jquery.smoothdivscroll-1.3-min.js' );
	wp_enqueue_script( 'mousewheel', CHILDTPURL . 'home/jquery.mousewheel.min.js' );
	wp_enqueue_script( 'imagearea', CHILDTPURL . 'register/jquery.imgareaselect.pack.js' );
	wp_enqueue_style( 'imageareacss1', CHILDTPURL . 'home/css/imgareaselect-default.css' );
	wp_enqueue_script( 'bpopup', CHILDTPURL . 'default/jquery.bpopup-0.7.0.min.js', '', '0.7.0' );
	wp_enqueue_style( 'smoothdiv', CHILDTPURL . 'home/css/smoothDivScroll.css' );
	
}
	

function ___col1_home(){
		
	//echo '<a href="'. site_url( '/request_copy/' ) .'">Request a copy of D2D</a>';
	
	echo '<div class="home-left">';
	
	echo '<div id="home-advert">';
	
	echo '<ul>';
	
	echo '<li>';
	echo '<a href="http://www.ezecom.com.kh" target="_blank" rel="nofollow"><img src="'. PARENTURL .'images/eze.jpg" width="161px" height="106px" alt="ezecom" /></a>';
	echo '</li>';
	
	echo '<li>';
	echo '<a href="http://www.smart.com.kh" target="_blank" rel="nofollow"><img src="'. PARENTURL .'images/smart.jpg" width="162px" height="107px" alt="smart" /></a>';
	echo '</li>';
	
	echo '<li>';
	echo '<a href="http://www.cocacolasabco.com" target="_blank" rel="nofollow"><img src="'. PARENTURL .'images/coke.jpg" width="161px" height="107px" alt="ezecom" /></a>';
	echo '</li>';
	
	echo '<li class="last-advert">';
	echo '<a href="http://www.anzroyal.com" target="_blank" rel="nofollow"><img src="'. PARENTURL .'images/anz.jpg" width="162px" height="107px" alt="ezecom" /></a>';
	echo '</li>';
	
	
	echo '</ul>';
	
	echo '</div>';	
	echo '</div>';
	
	echo '<div class="home-right">';
	
	echo ___space(15);
	echo '<h2></h2>';
	echo ___space(20);
	echo ___space( 10 );
	request_copy();
	
	echo '</div>';
	
	echo ___clearBoth();
	
}


function ___after_header_home(){

	/*echo '<div id="featured">';
	echo '</div>';
	*/
	
	get_food_search();
	
	echo '<a href="#" id="home_loc"></a>';
	echo '<div class="start_info"></div>';
	echo '<div id="search_info"></div>';
	
	//echo '<a href="'. site_url('/restaurant/') .'" id="view-all-restoo"></a>';
	echo '<a href="#" id="view-all-cuisines"></a>';
	//echo '<a href="#" id="slash"></a>';
	
	/**
	<form method="post" action="<?php echo site_url( '/restaurant_location/' ); ?>" name="thumbnail">
			
			<input type="hidden" name="x1" value="" id="x1" />
			<input type="hidden" name="y1" value="" id="y1" />
			<input type="hidden" name="x2" value="" id="x2" />
			<input type="hidden" name="y2" value="" id="y2" />
			<input type="hidden" name="w" value="" id="w" />
			<input type="hidden" name="h" value="" id="h" />
			<input type="hidden" name="loc" value="" id="loc" />
			<!--<input type="submit" value="Ok" name="mylocation" id="save_thumb" />-->
		
		</form>
	*/


	echo '<a href="#" id="add_restoo"></a>';
		
	echo ___space(445);
	
	echo '<div id="easy123"></div>';
	echo ___space( 20 );
	
}


function ___before_page_home(){
	echo '<div id="bg_content"></div>';
}


function ___after_container_home(){

	echo '<div id="all-restoo" style="display:none;">';
	echo '<div class="popup-head">';
	
	echo '<div class="ph-left"></div>';
	echo '<div class="ph-middle"></div>';
	echo '<div class="ph-right"></div>';
	
	echo '</div>';
	
	echo '<div class="popup-content">';
	echo '<div class="closeWrap"><a class="close_popup" href="#"><span class="close_text">Close</span><span class="cross"></span></a></div>';
	echo ___clearBoth();
		
	$loop = new D2D_All_Restaurant();
	$loop->loop();
	
	echo ___clearBoth();
	echo '</div>';
	
	echo '</div>';
	
	
	//all-cuisine popup
	echo '<div id="all-cuisines" style="display: none;">';
	echo '<div class="popup-head">';
	
	echo '<div class="ph-left"></div>';
	echo '<div class="ph-middle"></div>';
	echo '<div class="ph-right"></div>';
	
	echo '</div>';
	
	echo '<div class="popup-content">';

	echo '<div class="closeWrap"><a class="close_popup" href="#"><span class="close_text">Close</span><span class="cross"></span></a></div>';
	echo ___clearBoth();
	
	$category = get_categories( array( 'hide_empty' => 0 ) );
	$cusine_type = array();
	
	echo '<ul id="cuisine-type-list">';
	
	foreach ( $category as $cat ) :
		//$cusine_type[ $cat->cat_ID ] = $cat->name;
		if ( $cat->name != "Uncategorized" )
			echo '<li><a href="'. get_category_link( $cat->cat_ID ) .'">'. $cat->name .'</a></li>';
	endforeach;
	
	echo '</ul>';
	echo ___clearBoth();
	echo '</div>';
	echo '</div>';
	
	
	//request book popup
	echo '<div id="req-book" style="display: none;">';
	echo '<div class="popup-head">';
	
	echo '<div class="ph-left"></div>';
	echo '<div class="ph-middle"></div>';
	echo '<div class="ph-right"></div>';
	
	echo '</div>';
	
	echo '<div class="popup-content">';
	echo '<div class="closeWrap"><a class="close_popup" href="#"><span class="close_text">Close</span><span class="cross"></span></a></div>';
	echo ___clearBoth();
		
	
	if ( isset( $_GET['sent'] ) && $_GET['sent'] != "" ){
	
		$sent = $_GET['sent'];
		
		if ( $sent == 'success' ){		
			echo '<h2>Thank you. Your request has been submitted.</h2>';
		}else if( $sent == 'invalid' ){
			$msg = $_GET['msg'];
			
			echo '<h2 id="invalid_sent_title">The following fields are invalid: </h2>';
			echo urldecode( $msg );
		
		}		
		else{		
			echo '<h2>Sorry! Your request has not been sent.</h2>';
		}
	
	}
	
	echo '</div>';
	echo '</div>';
	
?>

	<!-- map location -->
	<div id="map-ref">	

		<div class="popup-head">	
			<div class="ph-left"></div>
			<div class="ph-middle"></div>
			<div class="ph-right"></div>
		</div>

		<div class="popup-content">
		<div class="closeWrap"><a class="close_popup" href="#">		
			<span>Ok, I am here.</span>					
		</a></div>
		<?php echo ___space( 50 ); ?>
		
		<img id="map" src="<?php echo PARENTURL; ?>images/d2d_map.jpg" alt="" />
		
		<?php echo ___space( 20 ); ?>
		
		<div class="closeWrap closeWrapBottom"><a class="close_popup" href="#">		
			<span>Ok, I am here.</span>					
		</a></div>
		
		</div>	
	</div>
	
	
<?php	
}


/*class D2D_All_Restaurant extends Gidd_WP_Loop{

	function list_category(){
	
		$category = get_the_category( get_the_ID() );
		$cusines = "";
		foreach( $category as $cat )
			$cusines .= $cat->name . ', ';
				
		echo '<span class="cuisine-type">' . rtrim( $cusines, ', ' ) . '</span>';
	
	}

	function loop(){
	
		global $wp_query;
		global $post, $paged;
		
		$loop_counter = 0;
		$temp = $wp_query;
		$wp_query = null;
		$wp_query = new WP_Query();
		
				
		$wp_query->query( array( 'posts_per_page' => -1, 'post_type' => 'gd_restaurant', 'order' => 'asc', 'orderby' => 'title' ) );
		
		if( $wp_query->have_posts() ){
		
			while( $wp_query->have_posts() ){
				the_post();
				
				$address 	= get_post_meta( get_the_ID(), 'restoo_address', true );
				$phone 		= get_post_meta( get_the_ID(), 'restoo_phone', true );
				$time		= get_post_meta( get_the_ID(), 'restoo_time', true );
				$map		= get_post_meta( get_the_ID(), 'restoo_map', true );
				$charge		= get_post_meta( get_the_ID(), 'restoo_charge', true );
				$method		= get_post_meta( get_the_ID(), 'restoo_method', true );
				$waiting	= get_post_meta( get_the_ID(), 'restoo_waiting', true );
				
				if ( $phone == "" )
					$phone = "N/A";
				
				if ( $address == "" )
					$address = "N/A";
				
				echo '<div class="restoo">';
								
				echo '<div class="restoo-header">';
				echo '<h2 class="restoo-title">'; the_title(); echo '</h2>';
				
				echo '<span class="restoo-address">'. $address . '</span>';
				echo '<span class="restoo-phone"><span>Telephone: </span>' . $phone . '</span>';
								
				echo ___clearBoth();
				echo '</div>';
				
				echo '<div class="restoo-content">';
				//the_post_thumbnail('thumbnail');
				//$this->list_category();				
				the_content();
				
				echo '<div class="restoo-info">';
				
				echo '<span class="restoo-time">Delivery Time: </span>';
				echo '<span class="restoo-sale">'. $time .'</span>';
				echo '<div class="clearBoth"></div>';
				
				echo '<span class="restoo-map">Map Reference:</span>';
				echo '<span class="restoo-sale">'. $map .'</span>';
				echo '<div class="clearBoth"></div>';
				
				echo '<span class="restoo-charge">Delivery Charge:</span>';
				echo '<span class="restoo-sale">'. $charge .'</span>';
				echo '<div class="clearBoth"></div>';
								
				echo '<span class="restoo-method">Delivery Method: </span>';
				echo '<span class="restoo-sale">'. $method .'</span>';
				echo '<div class="clearBoth"></div>';
								
				echo '<span class="restoo-waiting">AVG Waiting Time: </span>';
				echo '<span class="restoo-sale">'. $waiting .'</span>';
				echo '<div class="clearBoth"></div>';
				
				
				echo '</div>';
				
				echo ___clearBoth();				
				
				echo '<div class="view-menu">';
				echo '<a href="'; the_permalink();  echo '">See Menu</a>';
				echo '</div>';
				
				
				
				echo '</div>';
				
				echo '</div>';
			
			}
		}
	
	
	
	
	}

}*/


class D2D_All_Restaurant extends Gidd_WP_Loop{
	
	function loop(){
	
		global $wp_query;
		global $post, $paged;
		
		$loop_counter = 0;
		$temp = $wp_query;
		$wp_query = null;
		$wp_query = new WP_Query();
		
				
		$wp_query->query( array( 'posts_per_page' => -1, 'post_type' => 'gd_restaurant', 'order' => 'asc', 'orderby' => 'title' ) );
		
		if( $wp_query->have_posts() ){
		
			echo '<ul class ="restoo-list">';
			while( $wp_query->have_posts() ){
				the_post();
								
				echo '<li>';
				echo '<a href="'; the_permalink();  echo '">'; the_title(); echo '</a>';
				echo '</li>';
								
			}
			
			echo '</ul>';
		}
	
	}

}



/** end of home.php */