<?php

___add( 'init', 'insert_restaurant' );

function ___init_insert_restaurant(){
	if ( isset( $_POST['restooSubmit'] ) ){
	
		//array of restaurant submit data
		$restoo = $_POST['__laVsY'];
		
		//restaurant name
		$name = $restoo['__Qu32O'];
		
		//logo
		$logo = $restoo['__6ZPyg'];
		
		//time
		$time = $restoo['__qATw6'];
		
		//map
		$map = $restoo['__THd2W'];
		
		//charge
		$charge = $restoo['__Jqo9g'];
		
		//method
		$method = $restoo['__dVkQo'];
		
		//wiating
		$waiting = $restoo['__k1Dm2'];
		
		//web
		$web = $restoo['__VWxM8'];
		
		//cusine type
		//$cusine = $restoo['__XQiSE']; //array
		$cusine = $restoo['__JuCgA']; //array
		
		//phone
		$phone = $restoo['__X48rS'];
		
		//email
		$email = $restoo['__uhL1C'];
		
		//sms
		$sms = $restoo['__UQfTk'];
		
		//terminal id
		$tid = $restoo['__tuPuS'];
		
		//address
		//$address = $restoo['__JGjKY'];
		$address = $restoo['__4imq8'];
	
		$post = array( 	'post_title' 	=> $name,
						'post_content'	=> $logo,
						'post_type'		=> 'gd_restaurant',
						'post_date'		=> date('Y-m-d H:i:s'),
						'post_status'	=> "Publish",
				);
	
		if ( !get_page_by_title( $post['post_title'], 'OBJECT', 'gd_restaurant' ) ){
			
			//insert post
			$postid = wp_insert_post( $post );		
			
			//update post meta
			if ( $web != "" )
				update_post_meta( $postid, "restoo_web_url", $web );
				
			if ( $address != "" )
				update_post_meta( $postid, "restoo_address", $address );
			
			if ( $phone != "" )
				update_post_meta( $postid, "restoo_phone", $phone );
				
			if ( is_email( $email ) )
				update_post_meta( $postid, "restoo_email", $email );
						
			if ( $time != "" )
				update_post_meta( $postid, "restoo_time", $time );
			
			if ( $map != "" )
				update_post_meta( $postid, "restoo_map", $map );
			
			if ( $charge != "" )
				update_post_meta( $postid, "restoo_charge", $charge );
			
			if ( $method != "" )
				update_post_meta( $postid, "restoo_method", $method );
			
			if ( $waiting != "" )
				update_post_meta( $postid, "restoo_waiting", $waiting );
			
			if ( $sms != "" )
				update_post_meta( $postid, "restoo_sms", $sms );
			
			if ( $tid != "" )
				update_post_meta( $postid, "restoo_terminal", $tid );			
						
			//set category
			wp_set_post_terms( $postid, $cusine, 'category', true );
			
		}
	
	}
	
	wp_redirect( site_url('/create_submenu/') );
	exit;
}








/** end of insert_restaurant.php */