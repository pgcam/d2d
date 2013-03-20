<?php

$messages = ___subpage( 'Message Settings' );


//fields
$mail_error   = ___text('Email error message :', '');
$mail_success = ___textarea('Success message :', '');




$arr_messages = array( $mail_error, $mail_success );
___section( array ( 'WP Contact Form', '__L17X6' ), $messages, $arr_messages, "<b>General Message Settings</b>" );
unset( $arr_messages );


/** End of messages.php */