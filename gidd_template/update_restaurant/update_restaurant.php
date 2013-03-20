<?php

___add( 'init', 'update_restaurant' );

function ___init_update_restaurant(){

	if ( isset( $_POST['restooEdit'] ) ){
		
		$edit = $_POST['__laVsY'];
		$id = $_POST['restoo_id'];
		
		$post['ID'] = $id;
		$post['post_content'] = $edit['__6ZPyg'];
		$post['post_title'] = $edit['__Qu32O'];
		
		//phone
		$phone = $edit['__X48rS'];
		
		//email
		$email = $edit['__uhL1C'];		
		if ( !is_email( $email ) )
			$email = "";
			
		//address
		//$address = $edit['__JGjKY'];
		$address = $edit['__4imq8'];
		
		//time
		$time = $edit['__qATw6'];
		
		//map
		$map = $edit['__THd2W'];
		
		//charge
		$charge = $edit['__Jqo9g'];
		
		//method
		$method = $edit['__dVkQo'];
		
		//wait
		$wait = $edit['__k1Dm2'];
		
		//desc
		$desc = $edit['__YSVaC'];
		
		//web url
		$web = $edit['__VWxM8'];
		
		
		update_post_meta( $id, 'restoo_phone', $phone );
		update_post_meta( $id, 'restoo_address', $address );
		update_post_meta( $id, 'restoo_email', $email );		
		update_post_meta( $id, 'restoo_time', $time );
		update_post_meta( $id, 'restoo_map', $map );
		update_post_meta( $id, 'restoo_charge', $charge );
		update_post_meta( $id, 'restoo_method', $method );
		update_post_meta( $id, 'restoo_waiting', $wait );
		update_post_meta( $id, 'restoo_desc', $desc );
		update_post_meta( $id, 'restoo_web_url', $web );
		
		//update the data
		wp_update_post( $post );
		
		wp_redirect( site_url('/list_restaurant/') );
		exit;
			
	
	}

}


/** end of edit_restaurant.php */