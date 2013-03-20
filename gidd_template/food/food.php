<?php

___add( 'col1', 'food' );
___add( 'col2', 'food' );

function ___col2_food(){

	echo ___space(33);
	get_food_search();
	echo ___space(20);
	
	//show cuisine type
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

function ___col1_food(){
	global $wpdb;
	
	
	//$cat = $_POST['cat'];
	//$restoo = $_POST['restaurant'];
	$name = trim ( $_POST['s'] );
	//$name = trim( $_POST['s'] );
		
	$fid = get_food_byname( $name );
	
	if ( count ( $fid ) > 0 ):	
		echo '<h2 id="search-term-title">Search result for "<span>'. $name .'</span>"</h2>';
		echo '<div style="height: 1px; border-bottom: 1px #CCC solid; padding-top: 5px;"></div>';
		echo ___space(15);
		
		$restoo_search = new D2D_Search_Restaurant();
		$restoo_search->set_postids( $fid );
		$restoo_search->loop();
	else:
	
	
		echo '<h2 id="search-term-title">Search result for "<span>'. $name .'</span>"</h2>';
		echo '<div style="height: 1px; border-bottom: 1px #CCC solid; padding-top: 5px;"></div>';
		echo ___space(15);
		
		$restoo_search = new D2D_Search_Restaurant();
		$restoo_search->loop( true ); //query only by location from the pin on the map
	
	/*	echo ___space(50);
		echo '<div id="search-result">';
		echo '<h2 id="not-found">Sorry! There is no restaurant matching your search term.</h2>';
		get_food_search();
		echo '</div>';
	
	*/
	
	
	
	endif;
	
	
}



function get_food_byname( $name ){

	global $wpdb;
	
	if ( $name != "" ) :
	
		//search by matching whole word within post title and post content
		/*$sql = "SELECT p.ID FROM $wpdb->posts p WHERE p.post_title REGEXP '\[\[\:\<\:\]\]$name\[\[\:\>\:\]\]' OR p.post_content REGEXP '\[\[\:\<\:\]\]$name\[\[\:\>\:\]\]'";*/
		
		//search by matching whole word within post title, post content and submenu
		$sql  = "SELECT p.ID FROM $wpdb->posts p ";
		$sql .= "INNER JOIN $wpdb->term_relationships r ON p.ID = r.object_id ";
		$sql .= "INNER JOIN $wpdb->term_taxonomy x ON r.term_taxonomy_id = x.term_taxonomy_id ";
		$sql .= "INNER JOIN $wpdb->terms t ON t.term_id = x.term_id ";
		$sql .= "WHERE t.name REGEXP '\[\[\:\<\:\]\]$name\[\[\:\>\:\]\]' ";
		$sql .= "OR p.post_title REGEXP '\[\[\:\<\:\]\]$name\[\[\:\>\:\]\]' ";
		$sql .= "OR p.post_content REGEXP '\[\[\:\<\:\]\]$name\[\[\:\>\:\]\]'";
		
		
		$postids = $wpdb->get_col( $sql );
		
			
		//$postids = $wpdb->get_col("select ID from $wpdb->posts where post_title = \"$name\"");
		$arr_restoo = array();	
		
		
		if ( count ( $postids ) > 0 ):
		
			$query = new WP_Query();
			$query->query( array( 'order' => 'asc', 'orderby' => 'food_id', 'post_type' => 'gd_food', 'posts_per_page' => -1, 'post__in' => $postids ) );
			
			while( $query->have_posts() ): $query->the_post();
					
				$id = get_the_ID();
				$food_restoo = get_post_meta( $id, 'food_restoo', true );
				$restoo = get_post( $food_restoo );
							
				if ( !in_array( $restoo->post_title, $arr_restoo ) )	
					$arr_restoo[] = $restoo->ID;
				
			endwhile;
			wp_reset_query();
		
		endif;

	endif;
	
	return $arr_restoo;	

}


class D2D_Search_Restaurant extends Gidd_WP_Loop{

	public $postids;
	
	function get_postids(){
		return $this->postids;
	}
	
	function set_postids( $id ){
		$this->postids = $id;
	}
	
	function loop( $loc_only = false ){
	
		global $wp_query;
		global $post, $paged;
		
		$loop_counter = 0;
		$temp = $wp_query;
		$wp_query = null;
		$wp_query = new WP_Query();
		
		$tag = $_POST['loc'];
		$postids = $this->get_postids();	
		
		//set the query option
		if ( $loc_only )
			$wp_query->query( array( 'posts_per_page' => -1, 'post_type' => 'gd_restaurant', 'order' => 'asc', 'orderby' => 'title', 'tag' => $tag ) );
		else
			$wp_query->query( array( 'posts_per_page' => -1, 'post_type' => 'gd_restaurant', 'order' => 'asc', 'orderby' => 'title', 'post__in' => $postids, 'tag' => $tag ) );
		
		
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
				echo '<a href="'; the_permalink();  echo '">See Menu</a>';
				echo '</div>';
				
				
				
				echo '</div>';
				
				echo '</div>';
			
			}
		}
	
	
	
	
	}

}

/** end of food.php */