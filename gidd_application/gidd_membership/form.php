<?php

function show_terms_conditions( $page_id ){

	$agree = get_page( $page_id );
	
	echo '<div id="agreement_page">';
	echo '<h2>' . $agree->post_title . '</h2>';
	echo wpautop ( $agree->post_content );	
	echo '</div>';
	
	//agree form
	echo '<div id="agreeform">';
	echo '<form method="post" action="'. gidd_current_url() .'">';
	echo '<p id="agree">';
	echo '<label id="lbl_agree"><input type="checkbox" value="agree" id="chk_agree" name="chk_agree" />Agree with the terms and conditions above.</label>';
	echo '<small>You must agree with these terms and conditions before you can proceed.</small>';
	echo '</p>';
	echo '<p id="agree-submit">';
	echo '<input type="submit" name="agreesubmit" value="Agree" />';
	echo '</p>';
	echo '</form>';
	echo '</div>';			

}
	
function show_register_form(){

	echo '<div class="register-form">';
	echo '<h2>Create a new account</h2>';
	echo '<form class="signup_form" method="post" action="'. site_url('/signup/') .'">';
	
	echo '<p>';
	echo '<label for="username">Username</label>';
	echo '<input type="text" name="username" id="username" value="" />';			
	echo '</p>';
	
	echo ___clearBoth();
	
	echo '<p>';
	echo '<label for="password">Password</label>';
	echo '<input type="password" name="password" id="password" value="" />';
	echo '</p>';
	
	echo ___clearBoth();
	
	
	echo '<p>';
	echo '<label for="repassword">Repassword</label>';
	echo '<input type="password" name="repassword" id="repassword" />';
	echo '</p>';

	echo ___clearBoth();
		
	echo '<p>';
	echo '<label for="firstname">First name</label>';
	echo '<input type="text" name="firstname" id="firstname" />';
	echo '</p>';

	echo ___clearBoth();
		
	echo '<p>';
	echo '<label for="lastname">Last name</label>';
	echo '<input type="text" name="lastname" id="lastname" />';
	echo '</p>';
	
	echo ___clearBoth();
	
	echo '<p>';
	echo '<label for="address1">Address 1</label>';
	echo '<input type="text" name="address1" id="address1" />';
	echo '<a class="map_loc" id="map1" href="#">Map</a>';
	echo '</p>';
	
	echo ___clearBoth();
		
	echo '<p>';
	echo '<label for="address2">Address 2</label>';
	echo '<input type="text" name="address2" id="address2" />';
	echo '<a class="map_loc" id="map2" href="#">Map</a>';
	echo '</p>';

	echo ___clearBoth();
		
	echo '<p>';
	echo '<label for="telephone">Telephone</label>';
	echo '<input type="text" name="telephone" id="telephone" />';
	echo '</p>';
	
	echo ___clearBoth();
		
	echo '<p>';
	echo '<label for="email">Email</label>';
	echo '<input type="text" name="email" id="email" />';
	echo '</p>';
	
	echo ___clearBoth();
		
	echo '<input type="hidden" name="mloc1" class="mloc1" value="" />';
	echo '<input type="hidden" name="mloc2" class="mloc2" value="" />';
	
	echo '<p>';
	echo '<input type="submit" name="regsubmit" id="regsubmit" value="Submit" />';
	echo '</p>';
	
?>
	
	<div id="map-ref">
		<img id="map" src="<?php echo PARENTURL; ?>images/d2d_map.jpg" alt="" />
		
		<input type="hidden" name="x1" value="" id="x1" />
		<input type="hidden" name="y1" value="" id="y1" />
		<input type="hidden" name="x2" value="" id="x2" />
		<input type="hidden" name="y2" value="" id="y2" />
		<input type="hidden" name="w" value="" id="w" />
		<input type="hidden" name="h" value="" id="h" />
		<input type="hidden" name="addr" value="" id="addr" />
		
		<div class="clearBoth"></div>
		<input type="button" value="Save Map" name="upload_thumbnail" id="save_thumb" class="save_thumb" />
	</div>	
	
	
<?php	
	echo '</form>';	
	echo '</div>';
		

}
	
/** end of form.php */
