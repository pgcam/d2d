<?php

if ( is_user_logged_in() ) {
	___add( 'col1', 'update_profile' );	
	add_action( '___head_update_profile', '___head_update_profile' );
}

function ___head_update_profile(){

	wp_enqueue_script( 'imagearea', CHILDTPURL . 'update_profile/jquery.imgareaselect.pack.js' );
	wp_enqueue_style( 'imageareacss1', CHILDTPURL . 'update_profile/css/imgareaselect-default.css' );
	wp_enqueue_script( 'bpopup', CHILDTPURL . 'default/jquery.bpopup-0.7.0.min.js', '', '0.7.0' );
	
}
	
function ___col1_update_profile(){
	
	if ( isset( $_GET['msg'] ) && $_GET['msg'] == "success" ){
		echo '<h2 id="profile-sucess">Your profile has been updated successfully.</h2>';
	}
	
	echo '<h2>Update your profile information</h2>';
	update_profile_form();
	
}

function update_profile_form(){
	$id = get_current_user_id();
	$edit = wp_get_current_user();
?>

	<form method="post" action="<?php echo site_url('/change_profile/' ) ?>">
	
		<?php
			//photo
			echo '<div id="user-photo">';
			echo ( '<span class="food_photo">Photo</span>' );
			//___editor( 'user_photo', $id, array(), get_post_meta( $id, 'user_photo', true ) );
			
			$args[ 'textarea_name' ] = 'user_photo';
			wp_editor( htmlspecialchars_decode( stripslashes( get_usermeta( $id, 'user_photo', true ) ) ), 'user_photo', $args );
			
			echo '</div>';
			echo ___clearBoth();
			echo ___space(20);
			?>
		
		<p>
			<label for="">First name</label>
			<input type="text" name="fname" value="<?php echo get_user_meta( $id, 'first_name', true ); ?>" />
		</p>
		<div class="clearBoth"></div>
		
		<p>
			<label for="">Last name</label>
			<input type="text" name="lname" value="<?php echo get_user_meta( $id, 'last_name', true ); ?>" />
		</p>
		<div class="clearBoth"></div>
	
		<p>
			<label for="">Telephone</label>
			<input type="text" name="tel" value="<?php echo get_user_meta( $id, 'phone1', true ); ?>" />
		</p>
		<div class="clearBoth"></div>
		
		<p>
			<label for="">Address1</label>
			<input type="text" name="address1" value="<?php echo get_user_meta( $id, 'address1', true ); ?>" /> 
			<a class="map_loc" id="map1" href="#">Map</a>
		</p>
		
		<!-- -->
		<div class="clearBoth"></div>
		<p>
		<label for="city1">City 1</label>
		<input type="text" name="city1" id="city1" value="<?php echo get_user_meta( $id, 'city1', true); ?>" />
		</p>
		<!-- -->
		
		<div class="clearBoth"></div>
		
		<p>
			<label for="">Address2</label>
			<input type="text" name="address2" value="<?php echo get_user_meta( $id, 'address2', true ); ?>" /> 
			<a class="map_loc" id="map2" href="#">Map</a>
		</p>
		
		<!-- -->
		<div class="clearBoth"></div>
		<p>
		<label for="city2">City 2</label>
		<input type="text" name="city2" id="city2" value="<?php echo get_user_meta( $id, 'city2', true); ?>" />
		</p>
		<!-- -->
		
		<div class="clearBoth"></div>
	
		<p>
			<label for="">Email</label>
			<input type="text" name="email" value="<?php echo get_the_author_meta( 'user_email', $id); ?>" />
		</p>
		<div class="clearBoth"></div>
		
		<!-- -->
		<p>
			<label for="company">Company Name</label>
			<input type="text" name="company" id="company" value="<?php echo get_user_meta( $id,'company', true); ?>" />
		</p>
		<div class="clearBoth"></div>
		
		<p>
			<label for="direction">Direction</label>
			<textarea name="direction" id="direction" rows="4" cols="77"><?php echo get_user_meta( $id, 'direction', true ); ?></textarea>
		</p>
		<div class="clearBoth"></div>
		
		<p>
			<label for="sp_dietry_need">Special dietry need</label>
			<input type="text" name="sp_dietry_need" id="sp_dietry_need" value="<?php echo get_user_meta( $id, 'sp_dietry_need', true); ?>" />
		</p>
		<div class="clearBoth"></div>
		
		<p>
			<label for="user_comment">Comment</label>
			<textarea name="user_comment" id="user_comment" rows="4" cols="77"><?php echo get_user_meta( $id,'user_comment', true); ?></textarea>
		</p>
		<div class="clearBoth"></div>
		<!-- -->
	
		<br />
		<h4>Change Your Password</h4>
		<div id="password">
			<input type="hidden" id="user_login" value="<?php echo $edit->user_login; ?>" />
			<label for="pass1"><?php _e('New Password'); ?></label>
			
			<div class="passwordfields">
				<input type="password" name="pass1" id="pass1" size="16" value="" autocomplete="off" /> <span class="description"><?php _e("If you would like to change the password type a new one. Otherwise leave this blank."); ?></span><br />
				<input type="password" name="pass2" id="pass2" size="16" value="" autocomplete="off" /> <span class="description"><?php _e("Type your new password again."); ?></span><br />
				<!--<div id="pass-strength-result"><?php //_e('Strength indicator'); ?></div> -->
				<p class="description indicator-hint"><?php _e('Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).'); ?></p>
			</div>
			<div class="clearBoth"></div>
		</div>
		
		<input type="hidden" name="mloc1" class="mloc1" value="" />
		<input type="hidden" name="mloc2" class="mloc2" value="" />
				
		<p>
			<input type="submit" name="profile_submit" value="Save" id="submit" />
		</p>
				
	</form>
	
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
		<input type="button" value="Save Map" name="upload_thumbnail" class="save_thumb" id="save_thumb" />
	
	</div>
	
<?php
}

/** end of update_profile.php */