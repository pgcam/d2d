<?php

$smtp = ___subpage( 'SMTP Settings' );


//fields
$from_email = ___text('From email :', 'You can specify the email address that emails should be sent from. If you leave this blank, the default email will be used.');
$from_name  = ___text('From name :', 'You can specify the name that emails should be sent from. If you leave this blank, the emails will be sent from WordPress.');
$smtp_host  = ___text('SMTP Host :', '');
$smtp_port  = ___text('SMTP Port :', '');
$encription = ___radio('Encription :', array('No encryption.', 'Use SSL encryption.', 'Use TLS encryption. This is not the same as STARTTLS. For most servers SSL is the recommended option.'));
$authentication = ___radio('Authentication :', array('No: Do not use SMTP authentication.', 'Yes: Use SMTP authentication.', 'If this is set to no, the values below are ignored.'));
$user_name  = ___text('Username :', '');
$password   = ___text('Password :', '');


add_filter('gidd_field___LKg06', '___LKg06');
function ___LKg06( $field ){
	$field .= "If this is set to no, the values below are ignored.";
	return $field;
}

___add('after_admin_content', '__lSiSK');
function ___after_admin_content___lSiSK(){
	?>
		<form>
			<table>
				<tr>
					<td colspan='2'>Send a Test mail</td>
				</tr>
				<tr>
					<td width="225px"><b>To:</b></td>
					<td>
						<input type='text' name='send_mail' value="" class="regular-text" style="margin-bottom: 5px;"><br />
						<span>Type an email address here and then click Send Test to generat a test mail.</span>
					</td>
				</tr>
				<tr>
					<td colspan='2'>
						<input type='submit' name='submit_mail' value="Send" class='button-primary'>
					</td>
				</tr>
			</table>
		</form>
	<?php
}


$arr_smtp = array( $from_email, $from_name, $smtp_host, $smtp_port, $encription, $authentication, $user_name, $password  );

___section( array ( 'WP Contact Form', '__L17X6' ), $smtp, $arr_smtp, "<b>Sending mails by SMTP</b>" );
unset( $arr_smtp );


/** End of smtp.php */