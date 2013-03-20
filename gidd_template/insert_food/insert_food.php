<?php
if( isset( $_POST['foodgroup'] ) ){

	$food = $_POST['__yqPRo'];
	
	//food photo
	$food_photo = $food['__uqhuk'];
	
	//food id
	$food_id = $food['__DkTGi'];
	
	//food title
	$title = $food['__wgbEy'];
	
	//food desc
	$desc = $food['__Dpbym'];
	
	//restaurant
	$restoo = $food['__TMlka'];
	
	//sub menu
	$submenu = $food['__jQggc'];
	
	//price
	$price = $food['__Fq4HA'];
	
	//price 2
	$price2 = $food['__BV8x6'];
	
	//price 3
	$price3 = $food['__MpHeq'];
	
	$uid = get_current_user_id();
	$post = array( 	'post_title' 	=> $title,
					'post_content'	=> $desc,
					'post_type'		=> 'gd_food',
					'post_date'		=> date('Y-m-d H:i:s'),
					'post_status'	=> "Publish",
					'post_author'	=> $uid
			);

	//if ( !get_page_by_title( $post['post_title'], 'OBJECT', 'gd_food' ) ){
		
		if( current_user_can('edit_posts') ) {

			//insert post
			$postid = wp_insert_post( $post );		
			
			//update post meta
			if ( $restoo != "" )
				update_post_meta( $postid, "food_restoo", $restoo );
			
			if ( $price != "" )
				update_post_meta( $postid, "food_price", $price );
			
			if ( $price2 != "" )
				update_post_meta( $postid, "food_price2", $price2 );
			
			if ( $price3 != "" )
				update_post_meta( $postid, "food_price3", $price3 );
			
			if ( $food_id != "" )
				update_post_meta( $postid, "food_id", $food_id );
				
			if ( $food_photo != "" )
				update_post_meta( $postid, 'food_photo', $food_photo );
				
			//set sub menu for this food
			if ( $submenu != "" )
				wp_set_post_terms( $postid, $submenu, 'submenu', true );
			
			
			
			/** addon section **/
			
			//title1 & price1
			$aTitle1 = $food['__MrIPM'];
			$aPrice1 = $food['__46yoW'];
			
			//title2 & price2
			$aTitle2 = $food['__dTjgI'];
			$aPrice2 = $food['__bjFd4'];
			
			//title3 & price3
			$aTitle3 = $food['__vWk7q'];
			$aPrice3 = $food['__sU7Im'];
			
			//title4 & price4
			$aTitle4 = $food['__RdDD2'];
			$aPrice4 = $food['__4zgay'];
			
			//title5 & price5
			$aTitle5 = $food['__FdPgu'];
			$aPrice5 = $food['__kOAlW'];
			
			
			//insert addon food 1
			if ( ( $aTitle1 != "" ) && ( $aPrice1 != "" ) ):
			
				$addon1 = array(
				
								'post_title' 	=> $aTitle1,
								'post_content'	=> "",
								'post_type'		=> 'gd_extra_food',
								'post_date'		=> date('Y-m-d H:i:s'),
								'post_status'	=> "Publish",
								'post_author'	=> $uid
								
							);
							
				$pid = wp_insert_post( $addon1 );			
				update_post_meta( $pid, "addon_price", $aPrice1 );
				update_post_meta( $pid, "addon_parent", $postid );
				
			
			endif;
			
			
			//insert addon food 2
			if ( ( $aTitle2 != "" ) && ( $aPrice2 != "" ) ):
			
				$addon2 = array(
				
								'post_title' 	=> $aTitle2,
								'post_content'	=> "",
								'post_type'		=> 'gd_extra_food',
								'post_date'		=> date('Y-m-d H:i:s'),
								'post_status'	=> "Publish",
								'post_author'	=> $uid
							);
							
				$pid = wp_insert_post( $addon2 );			
				update_post_meta( $pid, "addon_price", $aPrice2 );
				update_post_meta( $pid, "addon_parent", $postid );
				
			
			endif;
			
			
			//insert addon food 3
			if ( ( $aTitle3 != "" ) && ( $aPrice3 != "" ) ):
			
				$addon3 = array(
				
								'post_title' 	=> $aTitle3,
								'post_content'	=> "",
								'post_type'		=> 'gd_extra_food',
								'post_date'		=> date('Y-m-d H:i:s'),
								'post_status'	=> "Publish",
								'post_author'	=> $uid
							);
							
				$pid = wp_insert_post( $addon3 );			
				update_post_meta( $pid, "addon_price", $aPrice3 );
				update_post_meta( $pid, "addon_parent", $postid );
				
			
			endif;
			
			
			//insert addon food 4
			if ( ( $aTitle4 != "" ) && ( $aPrice4 != "" ) ):
			
				$addon4 = array(
				
								'post_title' 	=> $aTitle4,
								'post_content'	=> "",
								'post_type'		=> 'gd_extra_food',
								'post_date'		=> date('Y-m-d H:i:s'),
								'post_status'	=> "Publish",
								'post_author'	=> $uid
							);
							
				$pid = wp_insert_post( $addon4 );			
				update_post_meta( $pid, "addon_price", $aPrice4 );
				update_post_meta( $pid, "addon_parent", $postid );
				
			
			endif;
			
			//insert addon food 5
			if ( ( $aTitle5 != "" ) && ( $aPrice5 != "" ) ):
			
				$addon5 = array(
				
								'post_title' 	=> $aTitle5,
								'post_content'	=> "",
								'post_type'		=> 'gd_extra_food',
								'post_date'		=> date('Y-m-d H:i:s'),
								'post_status'	=> "Publish",
								'post_author'	=> $uid
							);
							
				$pid = wp_insert_post( $addon5 );			
				update_post_meta( $pid, "addon_price", $aPrice5 );
				update_post_meta( $pid, "addon_parent", $postid );
				
			
			endif;
		
			
			wp_redirect( site_url( '/add_food?success="'. $title .'"&restoo=' . $restoo . '&submenu=' . $submenu ) );
			exit();
		
		} //end of current_user_can('edit_posts')
		
	//}
	

}



/** end of add_food.php */