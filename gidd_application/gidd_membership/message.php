<?php

$message	= ___subpage( 'Message' );

//field
$success   = ___textarea( 'Success message', 'This message is shown when visitors register successfully.' );



//array of fields
$arr_message = array( $success );
___section( array ( 'Gidd Membership', '__4On5w' ), $message, $arr_message, "<b>Customize messages.</b>" );
unset( $arr_package );


/** end of terms.php **/