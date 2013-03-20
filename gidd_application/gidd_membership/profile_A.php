<?php
/*** ADD EXTRA FIELDS IN PROFILE PAGE ***/
add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) { ?>

	<h3>Extra profile information</h3>
	<table class="form-table">
		<tr>
			<th><label for="specialities">Specialties</label></th>
			<td>
				<textarea name="specialties" id="specialties" class="regular-text"><?php echo esc_attr( get_the_author_meta( 'specialties', $user->ID ) ); ?></textarea><br />
				<span class="description">Please enter your specialties.</span>
			</td>
		</tr>
	</table>
	
<?php }

add_action( 'personal_options_update', 'ns_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'ns_save_extra_profile_fields' );

function ns_save_extra_profile_fields( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;
	
	update_usermeta( $user_id, 'specialties', $_POST['specialties'] );
}


/*** ADD EXTRA FIELDS IN REGISTER FORM ***/
add_action('register_form','show_more_fields');
add_action('register_post','check_fields',10,3);
add_action('user_register', 'register_extra_fields');

function show_more_fields()
{
?>
	<p>
		<label for="first_name">First Name</label>
		<input type="text" name="first_name" id="first_name" class="input" value="" size="20" />
	</p>
	
	<p>
		<label for="last_name">Last Name</label>
		<input type="text" name="last_name" id="last_name" class="input" value="" size="20" />
	</p>	
	<div class="clear"></div>
	
<?php
}

function check_fields ( $login, $email, $errors )
{
	global $first_name, $last_name;
			
	if ( $_POST['first_name'] == '' ) {
		$errors->add( 'empty_realname', "<strong>ERROR</strong>: Please enter your first name." );
	}
	else {
		$first_name = $_POST['first_name'];
	}
	
	if ( $_POST['last_name'] == '' ) {
		$errors->add( 'empty_realname', "<strong>ERROR</strong>: Please enter your last name." );
	}
	else {
		$first_name = $_POST['last_name'];
	}
}

function register_extra_fields ( $user_id, $password = "", $meta = array() ){
	update_usermeta( $user_id, 'first_name', $_POST['first_name'] );
	update_usermeta( $user_id, 'last_name', $_POST['last_name'] );	
}

/** end of profile.php **/