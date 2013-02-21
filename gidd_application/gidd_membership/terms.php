<?php

$terms	= ___subpage( 'Terms' );


//field
$show_term   	= ___checkbox( 'Show terms', 'Ask visitors to agree with terms & conditions before they register.' );
$term_page		= ___text( 'Term page', 'Put the page ID of term text.' );
$term_error		= ___textarea( 'Error message', 'Set error message to display when users do not agree with the terms & conditions.' );


//array of fields
$arr_terms = array( $show_term, $term_page, $term_error );
___section( array ( 'Gidd Membership', '__4On5w' ), $terms, $arr_terms, "<b>Customize terms & conditions page.</b>" );
unset( $arr_terms );


/** end of terms.php **/