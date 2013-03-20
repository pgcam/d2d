<?php

//$reg = array ( 'Gidd Membership', '__4On5w' )
$reg 		= ___subpage( 'Gidd Membership', ___registry( 'gidd_admin' ) );
$reg_form 	= ___page( 'Register Form' );

gidd_include_file( CHILDAPP . 'gidd_membership/general.php' );
gidd_include_file( CHILDAPP . 'gidd_membership/terms.php' );
gidd_include_file( CHILDAPP . 'gidd_membership/profile.php' );
gidd_include_file( CHILDAPP . 'gidd_membership/message.php' );

//action files
gidd_include_file( CHILDAPP . 'gidd_membership/action/general.php' );
gidd_include_file( CHILDAPP . 'gidd_membership/action/profile.php' );

//editable file by user
gidd_include_file( CHILDAPP . 'gidd_membership/form.php' );


/** End of gidd_load.php */