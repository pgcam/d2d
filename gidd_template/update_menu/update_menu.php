<?php

if ( isset( $_POST['updatefood'] ) ):

	$fid = $_POST['food_id'];
	$rid = $_POST['restoo_id'];
	$food = $_POST['__CcRCk'];

	//photo
	$food_photo = $food['__uqhuk'];
	
	//food id
	$food_id = $food['__DkTGi'];

	//food title
	$food_title = $food['__wgbEy'];

	//food description
	$desc = $food['__Dpbym'];

	//food price
	$price = $food['__Fq4HA'];

	//food price 2
	$price2 = $food['__BV8x6'];

	//food price 3
	$price3 = $food['__MpHeq'];

	//submenu
	$submenu = $food['__jQggc'];

	
	//update meta data
	update_post_meta( $fid, 'food_id', $food_id );
	update_post_meta( $fid, 'food_price', $price );
	update_post_meta( $fid, 'food_price2', $price2 );
	update_post_meta( $fid, 'food_price3', $price3 );
	update_post_meta( $fid, 'food_photo', $food_photo );
	
	
	$post['ID'] = $fid;
	$post['post_title'] = $food_title;
	$post['post_content'] = $desc;
	
	//update post data
	wp_update_post( $post );
	
	//update post term
	wp_set_object_terms( $fid, "", 'submenu' );
	wp_set_post_terms( $fid, $submenu, 'submenu', true );
	
	//redirect
	wp_redirect( site_url('edit_menu?id=' . $rid ) );
	exit;



endif;
/** end of update_menu.php */