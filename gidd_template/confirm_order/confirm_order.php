<?php

function generate_invoice_id(){

	$id = "INV-";
	
	$count = 0;
	$day = date('d');
	$month = date('m');
	$year = date('Y');
	
	$today = $year . '-' . $month . '-' . $day;
	$qry = new WP_Query();
	
	$qry->query( array( 'post_type' => 'gd_invoice', 'meta_compare' => '=', 'meta_key' => 'created_date', 'meta_value' => $today ) );
	$found = intval( $qry->found_posts );
	
	if ( $found > 0 )
		$count = $found;
		
	$count++;
	$id .= $day . $month . $year . $count;	
	
	return $id;

}

___add('col1', 'confirm_order');
function ___col1_confirm_order(){

$uid = get_current_user_id();
$fname = get_user_meta( $uid, 'first_name', true );
$lname = get_user_meta( $uid, 'last_name', true );
$name = $lname . ' ' . $fname;

$phone1 = get_user_meta( $uid, 'phone1', true );
$phone2 = get_user_meta( $uid, 'phone2', true );
$phone = ( $phone2 == "" ) ? $phone1 : $phone1 . ', ' . $phone2;

$addrnum = $_POST['delivery_no'];
$map = "uid_" . $uid . "_map" . $addrnum . '.jpg';

$arr = array( 	'restoo' => get_the_title( $_SESSION['restoo'] ), 'name' => $name, 
				'phone' => $phone, 'invoice' => generate_invoice_id(), 
				'delivery' => $_POST['delivery'], 'total' => '$' . $_POST['total'], 
				'note' => $_POST['note'], 'map' => $map );

		
		
$query = http_build_query($arr);

?>
	<img src='<?php echo site_url('/get_img/?') . $query; ?>' alt='' />
<?php
}


/*** confirm_order.php */