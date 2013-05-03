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
	
	//attribute
	$attra = $_POST['attribute_a'];
	$attrb = $_POST['attribute_b'];
	$attrc = $_POST['attribute_c'];
	$attrd = $_POST['attribute_d'];
	
	//group title
	$gtitle_a = $_POST['groupATitle'];
	$gtitle_b = $_POST['groupBTitle'];
	$gtitle_c = $_POST['groupCTitle'];
	$gtitle_d = $_POST['groupDTitle'];
	
		
	//mix group & title
	$atta = array( "$gtitle_a" => $attra );
	$attb = array( "$gtitle_b" => $attrb );
	$attc = array( "$gtitle_c" => $attrc );
	$attd = array( "$gtitle_d" => $attrd );
	
	//control type for attributes
	$groupAControl = $_POST['groupAControl'];
	$groupBControl = $_POST['groupBControl'];
	$groupCControl = $_POST['groupCControl'];
	$groupDControl = $_POST['groupDControl'];
	
	
	//recreate group array
	$attr = array();
	
	if ( is_array( $attra ) && count( $attra ) > 0 && ( $attra[0] != "" ) )
		$attr[] = array("$groupAControl" => $atta);

	if ( is_array( $attrb ) && count( $attrb ) > 0 && ( $attrb[0] != "" ) )
		$attr[] = array("$groupBControl" => $attb);

	if ( is_array( $attrc ) && count( $attrc ) > 0 && ( $attrc[0] != "" ) )
		$attr[] = array("$groupCControl" => $attc);

	if ( is_array( $attrd ) && ( count( $attrd ) > 0 ) && ( $attrd[0] != "" ) )
		$attr[] = array("$groupDControl" => $attd);
		
	
	//update meta data
	update_post_meta( $fid, 'food_id', $food_id );
	update_post_meta( $fid, 'food_price', $price );
	update_post_meta( $fid, 'food_price2', $price2 );
	update_post_meta( $fid, 'food_price3', $price3 );
	update_post_meta( $fid, 'food_photo', $food_photo );
	update_post_meta( $fid, 'food_attribute', $attr );
	
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