<?php

$form = ___subpage( 'Form Settings' );

//fields
$ft = ___textarea('Form template', '');


add_filter('gidd_field___szVg8', '___szVg8');
function ___szVg8( $field ){
	
	$ft_desc  = 'Write your form template here. To add form fields, use the following placeholders: ';
	$ft_desc .= '<br /><ul><li>{subject} : Subject field</li>';
	$ft_desc .= '<li>{email} : Email field</li>';
	$ft_desc .= '<li>{description}: description field</li>';
	$ft_desc .= '</ul>';
	$field .= $ft_desc;
	return $field;
}



$arr_form = array( $ft );
___section( array ( 'WP Contact Form', '__L17X6' ), $form, $arr_form, "<b>General Form Settings</b>" );
unset( $arr_form );


/** End of form.php */