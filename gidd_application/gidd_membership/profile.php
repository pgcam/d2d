<?php

$profile	= ___subpage( 'Profile' );

//field
$personal  	= ___checkbox( 'Personal Options', 'Remove personal options from profile.' );
$yim   		= ___checkbox( 'Yahoo IM', 'Remove Yahoo IM from profile.' );
$aim   		= ___checkbox( 'AIM', 'Remove AIM from profile.' );
$jabber   	= ___checkbox( 'Gabber / Google Talk', 'Remove jabber / google talk from profile.' );

$phone1      = ___checkbox( 'Add Phone 1', 'Add phone 1 option to profile.' );
$phone2      = ___checkbox( 'Add Phone 2', 'Add phone 2 option to profile.' );
$phone3      = ___checkbox( 'Add Phone 3', 'Add phone 3 option to profile.' );

$address1   = ___checkbox( 'Add Address 1', 'Add address 1 option to profile.' );
$address2   = ___checkbox( 'Add Address 2', 'Add address 2 option to profile.' );
$address3   = ___checkbox( 'Add Address 3', 'Add address 3 option to profile.' );

$linkedin   = ___checkbox( 'Add Linkedin', 'Add linkedin option to profile.' );
$facebook   = ___checkbox( 'Add Facebook', 'Add facebook option to profile.' );
$twitter 	= ___checkbox( 'Add Twitter', 'Add twitter option to profile' );
$skype    	= ___checkbox( 'Add Skype', 'Add skype option to profile.' );


//array of fields
$arr_profile	= array( $personal, $yim, $aim, $jabber, $phone1, $phone2, $phone3, $address1, $address2, $address3, $linkedin, $facebook, $twitter, $skype );
___section( array ( 'Gidd Membership', '__4On5w' ), $profile, $arr_profile, "<b>Customize the profile page.</b>" );
unset( $arr_profile );








/** End of dashboard.php */