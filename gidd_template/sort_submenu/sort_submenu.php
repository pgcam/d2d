<?php
if ( current_user_can('manage_options') )
	___add( 'col1', 'sort_submenu' );

function ___col1_sort_submenu(){
	$loop = new D2D_Submenu_Restaurant();
	$loop->loop();
}


class D2D_Submenu_Restaurant extends Gidd_WP_Loop{

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
				the_content();
				
				echo '<div class="restoo-info">';
				
				echo '<span class="restoo-time">Delivery Time: </span>';
				echo '<span>'. $time .'</span>';
				echo '<div class="clearBoth"></div>';
				
				echo '<span class="restoo-map">Delivery Map:</span>';
				echo '<span>'. $map .'</span>';
				echo '<div class="clearBoth"></div>';
				
				echo '<span class="restoo-charge">Delivery Charge:</span>';
				echo '<span>'. $charge .'</span>';
				echo '<div class="clearBoth"></div>';
								
				echo '<span class="restoo-method">Delivery Method: </span>';
				echo '<span>'. $method .'</span>';
				echo '<div class="clearBoth"></div>';
								
				echo '<span class="restoo-waiting">AVG Waiting Time: </span>';
				echo '<span>'. $waiting .'</span>';
				echo '<div class="clearBoth"></div>';
				
				
				echo '</div>';
				
				echo ___clearBoth();				
				
				echo '<div class="view-menu">';
				echo '<a href="'; echo site_url('/edit_submenu?id=' . get_the_ID() );  echo '">Edit Submenu</a>';
				echo '</div>';
				
				
				
				echo '</div>';
				
				echo '</div>';
			
			}
		}
	
	}

}




/** end of sort_submenu.php **/