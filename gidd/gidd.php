<?php

/** DEFINE NECESSARY CONSTANTS */

//gidd
define ( 'GIDDPATH', realpath ( dirname(__FILE__) ).'/' );
define ( 'GIDDURL', trailingslashit ( get_template_directory_uri() ) . 'gidd/' );

//parent
define ( 'PARENTPATH', dirname( GIDDPATH ).'/' );
define ( 'PARENTURL', trailingslashit ( get_template_directory_uri() ) );

//child
define ( 'CHILDPATH', trailingslashit( get_stylesheet_directory() ) );
define ( 'CHILDURL', trailingslashit( get_stylesheet_directory_uri() ) );


//LOAD MORE CONSTANTS
include_once( GIDDPATH . 'constant.php' );


//GLOBAL PAGE NAME
$page_name = "";

//LOAD CORE FILES
include_once( GIDDLIB . 'gidd_helper.php' );
include_once( GIDDLIB . 'gidd_common.php' );
include_once( GIDDCORE . 'gidd_load.php' );


/* End of functions.php */