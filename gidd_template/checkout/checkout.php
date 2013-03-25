<?php
___add('col1', 'checkout');
function ___col1_checkout(){

	if ( !is_user_logged_in() ){
?>	
	<h2 class="action">Please do one of the following actions:</h2>
	
	<br /><br />
	
	<h4>1. If you have an account, please login.</h4>	
	<?php wp_login_form( array( 'redirect' => site_url('/checkout/') ) ); ?>

	<br /><br />
	
	<h4>2. Create a new account</h4>
	<?php echo '<span>Before you can order, please take a moment to register.</span>'; ?>
	<br /><br />
	<a href="<?php echo site_url('/register/'); ?>" class="btn_register">Register</a>
	
<?php		
	}else{
		
		if ( isset( $_GET['msg'] ) && ( $_GET['msg'] == "addr" ) ){
			echo '<p class="addr_req">Please select one delivery address.</p>';
			echo ___space(15);
		}
		echo '<h2>Please select your delivery address.</h2>';
		$uid = get_current_user_id();
		$addr1 = get_user_meta( $uid, 'address1', true );
		$addr2 = get_user_meta( $uid, 'address2', true );			
?>
	<form class="frmcheckout" method="post" action="<?php echo site_url( '/order_summary/' ); ?>">
		
		<p>
			<input type="radio" name="addr" value="address1" checked="checked" />
			<span><?php echo $addr1; ?></span>
		</p>
		
		<p>
			<input type="radio" name="addr" value="address2"  />
			<span><?php echo $addr2; ?></span>
		</p>
		
		<br />
		<h3>additional note</h3>
		<textarea name="note" style="width: 350px; height: 80px;"></textarea>
		
		<br />
		<p>
			<input type="submit" name="addrsubmit" value="next" class="btnnext" />			
		</p>
		
		
	</form>
<?php
	}

}



/** end of checkout.php */