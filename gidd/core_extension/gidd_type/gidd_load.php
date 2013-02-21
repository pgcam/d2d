<?php

//Post Type
add_action('init', 'gidd_cpt_type', 8);
function gidd_cpt_type(){	
	gidd_register_post_type("gd_posttype", "Post Type", "Post Types", "gd-posttype", array( "title" ), array());
}

gidd_include_file( GIDDPATH . 'core_extension/gidd_type/post_type_options.php' );
//gidd_include_file( GIDDPATH . 'core_extension/gidd_type/post_type_columns.php' );


/** End of gidd_load.php */