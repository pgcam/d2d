<?php

___add( 'col1', 'archive_gd_restaurant' );
___add( 'col2', 'archive_gd_restaurant' );

function ___col2_archive_gd_restaurant(){

	echo ___space(33);
	//get_food_search();

	echo ___space(20);
	
	$category = get_categories( array( 'hide_empty' => 0 ) );
	echo '<ul class="cuisine_list">';
	echo '<h3 class="cuisine_title">Cuisine Type</h3>';
	echo '<li><a href="'. site_url('/restaurant/') .'">All Cuisines</a></li>';
	
	foreach( $category as $cat ){
		if ( $cat->name != "Uncategorized" )
			echo '<li><a href="'. site_url('/restaurant?cuisine='. $cat->cat_ID ) .'">'. $cat->name .'</a></li>';
		
	}
	echo '</ul>';

}

function ___col1_archive_gd_restaurant(){
	
	$loop = new D2D_Restaurant_Loop();
	$loop->loop();
	
}


class D2D_Restaurant_Loop extends Gidd_WP_Loop{

	function loop(){
	
		global $wp_query;
		global $post, $paged;
		
		$loop_counter = 0;
		$temp = $wp_query;
		$wp_query = null;
		$wp_query = new WP_Query();
		
		if ( isset( $_GET['cuisine'] ) )				
			$wp_query->query( array( 'posts_per_page' => -1, 'post_type' => 'gd_restaurant', 'order' => 'asc', 'orderby' => 'title', 'cat' => $_GET['cuisine']  ) );
		else
			$wp_query->query( array( 'posts_per_page' => -1, 'post_type' => 'gd_restaurant', 'order' => 'asc', 'orderby' => 'title'  ) );
		
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

}



/** end of archive_gd_restaurant.php */