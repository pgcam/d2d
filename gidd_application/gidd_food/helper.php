<?php

function get_all_restaurants(){

	$arr_restaurant = array();
	
	$query = new WP_Query();
	$query->query( array( 'post_type' => 'gd_restaurant', 'posts_per_page' => -1 ) );
	while( $query->have_posts() ): $query->the_post();
	
	//$id = ___id( get_the_title() );
	
	$id = get_the_ID();
	$arr_restaurant["$id"] = get_the_title();
	
	endwhile;
	
	//reset query
	wp_reset_query();
	
	return $arr_restaurant;
	
}


function get_food_search(){
?>

	<div id="food_search">	
		<form name="thumbnail" method="post" id="searchform" action="<?php echo site_url( '/food/' ); ?>">
			<?php echo ___space(8); ?>
			<input type="text" name="s" id="s" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" value="Search by Food Item" />
			
			
			<!--<select name="cat" id="scat">
				<option value="">All Cuisines</option>
				<?php /*/$categ = get_categories();
					foreach ( $categ as $cat )					
						echo '<option value="'.  $cat->cat_ID .'">'. $cat->cat_name .'</option>';*/
				?>		
			</select>
			<br />
			<?php
			/*
			echo '<select id="restoo" name="restaurant">';
			echo '<option value="">All restaturants</option>';
			$restoo = get_all_restaurants();
			foreach ( $restoo as $key => $rest )
				echo '<option value="'. $key .'">'. $rest .'</option>';
			
			echo '</select>';*/
			?>
			-->
					
			<!--<input type="hidden" name="post_type[]" value="gd_restaurant" />
			<input type="hidden" name="post_type[]" value="gd_food" />-->
			
			
			<!-- user map location -->
			<input type="hidden" name="x1" value="" id="x1" />
			<input type="hidden" name="y1" value="" id="y1" />
			<input type="hidden" name="x2" value="" id="x2" />
			<input type="hidden" name="y2" value="" id="y2" />
			<input type="hidden" name="w" value="" id="w" />
			<input type="hidden" name="h" value="" id="h" />
			<input type="hidden" name="loc" value="" id="loc" />
			
			
			
			
			<input type="submit" id="foodsubmit" value="" />
		</form>
	</div>

<?php
}


function request_copy(){
?>

	<div id="requestcopy">
	
		<form method="post" action="<?php echo site_url('/send_request/') ?>" id="frmreqest">
			
			<p>
				<label for="fullname">Full Name:</label>
				<input type="text" name="fullname" id="fullname" />
				<?php echo ___clearBoth(); ?>
			</p>
			
			<p>
				<label for="">Business/Organization:</label>
				<input type="text" name="busorg" id="busorg" />
				<?php echo ___clearBoth(); ?>
			</p>
			
			<p>
				<label for="">Address:</label>
				<input type="text" name="address" id="address" />
				<?php echo ___clearBoth(); ?>
			</p>
			
			<p>
				<label for="">Telephone:</label>
				<input type="text" name="phone" id="phone" />
				<?php echo ___clearBoth(); ?>
			</p>
			
			<p>
				<label for="">Message:</label>
				<textarea id="message" name="message"></textarea>
				<?php echo ___clearBoth(); ?>
			</p>
			
			<p>
				<input type="submit" name="reqcopy" value="" id="reqcopy" />
			</p>
			
		</form>
	
	</div>

<?php
}


function get_food_submenu( $restoo, $key = 'slug' ){

	$query = new WP_Query();
	$query->query( array( 'post_type' => 'gd_food', 'posts_per_page' => -1, 'meta_compare' => '=', 'meta_key' => 'food_restoo', 'meta_value' => $restoo ) );
	
	
	$arr_submenu = array();
	while( $query->have_posts() ) : $query->the_post();
		
		//get term id & name
		$terms = wp_get_post_terms( get_the_ID(), "submenu" );
		if ( !array_key_exists( $terms[0]->term_id, $arr_submenu ) )
			if ( $key == "id" )
				$arr_submenu[ $terms[0]->term_id ] = $terms[0]->name;
			else
				$arr_submenu[ $terms[0]->slug ] = $terms[0]->name;
			
	endwhile;
	wp_reset_query();
	return $arr_submenu;
	
}


function get_food_addon( $parent ){

	$query = new WP_Query();
	$query->query( array( 'post_type' => 'gd_extra_food', 'posts_per_page' => -1, 'meta_compare' => '=', 'meta_key' => 'addon_parent', 'meta_value' => $parent ) );
	
	$addon = '';
	while( $query->have_posts() ): $query->the_post();
	
		$price = get_post_meta( get_the_ID(), 'addon_price', true );
		
		$addon .= '<p class="addon-food">';
		$addon .= '<span class="addon_title">'; 
		$addon .= get_the_title(); 
		$addon .= '</span>';
		
		if ( $price != "" )
			$addon .= '<span class="addon_price">$'. $price .'</span>';
		$addon .= '</p>';
	
	endwhile;
	
	return $addon;
}


function get_food_addon_price( $parent ){

	$query = new WP_Query();
	$query->query( array( 'post_type' => 'gd_extra_food', 'posts_per_page' => -1, 'meta_compare' => '=', 'meta_key' => 'addon_parent', 'meta_value' => $parent ) );
	
	$addon = '';
	while( $query->have_posts() ): $query->the_post();
	
		$price = get_post_meta( get_the_ID(), 'addon_price', true );
				
		if ( $price != "" )
			$addon .= $price;

	endwhile;
	
	wp_reset_query();
	return $addon;

}




function get_food_by_restaurant( $restoo, $term_slug, $show_edit = false ){

	$query = new WP_Query();
	$query->query( array( 'post_type' => 'gd_food', 'posts_per_page' => -1, 'meta_compare' => '=', 'meta_key' => 'food_restoo', 'meta_value' => $restoo, 'taxonomy' => 'submenu', 'term' => $term_slug ) );
	
	$arr_fid = array();		
	while( $query->have_posts() ): $query->the_post();

	$pid = get_the_ID();
	
	$fid = get_post_meta( $pid, 'food_id', true );
	$li = "";
		
	if ( is_singular( 'gd_restaurant' ) )
		$photo = get_post_meta( $pid, 'food_photo', true );
	
	$li .= '<li>';

	$li .= '<div class="food-pcontent" id="p'. $pid .'" style="display: none;">';
	
	$li .= '<div class="popup-head">';
	
	$li .= '<div class="ph-left"></div>';
	$li .= '<div class="ph-middle"></div>';
	$li .= '<div class="ph-right"></div>';
	
	$li .= '</div>';
	
	$li .= '<div class="popup-content">';
	$li .= '<div class="closeWrap"><a class="close_popup" href="#"><span class="close_text">Close</span><span class="cross"></span></a></div>';
	$li .= ___clearBoth();
	$li .= ___space(35);
	
	$li .= '<p class="fphoto">'. $photo .'</p>';
	$li .= '<div class="item-content"></div>';
	$li .= '</div></div>';
	
	$li .= '<div class="menu-items">';
			
	$li .= '<span class="foodnum">'. trim($fid) .'</span>';
	
	if ( $show_edit ):
		$li .= '<h4><a href="'; 
		$li .=  site_url( '/update_food?id=' . $pid . '&rid=' . $_GET['id'] ); 
		$li .=  '">'; 
		$li .= get_the_title(); 
		$li .=  '&nbsp;</a></h4>';
	else:
		$li .=  '<h4><span>'; $li .= get_the_title(); $li .=  '</span>';
		if ( $photo != "" )
			$li .=  '<a class="food_photo" rel="p'. $pid .'" href="#"></a>';
		$li .=  '</h4>';
	endif;
	
	$li .=  '<span class="food-desc">';
	$li .= get_the_content();
	$li .=  '</span>';
	
	if ( $show_edit )
	$li .=  '<a class="del_food" href="'. site_url( '/delete_food?id=' . $pid . '&rid=' . $_GET['id']  ) . '">Delete</a>';
	
	$li .=  '<a class="add_to_cart" href="#"></a>';
	$li .=  '<span class="food-price-3">';
	$price3 = get_post_meta( $pid, 'food_price3', true );
	if ( $price3 != "" )
		$li .=  '$' . $price3;
	$li .=  '</span>';
		
	$li .=  '<span class="food-price-2">';
	$price2 = get_post_meta( $pid, 'food_price2', true );
	if ( $price2 != "" )
		$li .=  '$' . $price2;
	$li .=  '</span>';
	
	$li .=  '<span class="food-price">';
	$price = get_post_meta( $pid, 'food_price', true );
	if ( $price != "" )
		$li .=  '$' . $price;	
	$li .=  '</span>';
	
	//show addon food if available
	$li .=  '<div class="clearBoth"></div>';
	$li .= get_food_addon( $pid );
	
	$li .=  '</div>';
		
	$li .=  '<input class="fid" type="hidden" value="'. $pid .'" />';
	
	$li .=  '<div class="clearBoth"></div>';
	$li .=  '</li>';

	
	$arr_fid[$fid] = $li;
	
	endwhile;
	wp_reset_query();
	
	
	
	echo '<ul class="food-list">';
	
		
	ksort( $arr_fid );
	foreach ( $arr_fid as $food )
		echo $food;
	
	echo '</ul>';
	
	//add-to-cart popup form
	echo '<div id="add-to-cart" style="display:none;">';
	echo '<div class="popup-head">';
	
	echo '<div class="ph-left"></div>';
	echo '<div class="ph-middle"></div>';
	echo '<div class="ph-right"></div>';
	
	echo '</div>';
	
	echo '<div class="popup-content">';
	echo '<div class="closeWrap"><a class="close_popup" href="#"><span class="close_text">Close</span><span class="cross"></span></a></div>';
	
	echo '<div class="cart-item-info"></div>';
	echo '<form method="post" action="'. site_url('/add_item/?rid=' . $restoo ) .'">';
	
	echo '<p>';
	
	echo '<label for="qty">Quantity</label>';
	echo '<div>
			<input type="text" name="qty" id="qty" value="1" style="float:left; margin-right:20px;" />
			<h4 id="single_price"></h4>
		</div>';

	echo '<input type="hidden" class="pfid" name="fid" value="" />';
	
	echo '<div class="addon"></div>';
	echo '<div class="multi"></div>';
	
	echo '<input class="aprice" type="hidden" name="aprice" value="" />';
	echo '<input type="hidden" name="prev_url" value="'. gidd_current_url() .'" />';
	echo '<input type="submit" name="foodsub" id="foodsub" value="Add to Cart" />';
		
	echo '</p>';
	
	echo '</form>';
	
	echo '</div>';
	echo '</div>';
}

/** helper.php */