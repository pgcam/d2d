<?php

//Add Loop To Gidd Admin
/*add_action('init', 'gidd_cpt_loop', 9);
function gidd_cpt_loop(){	
	gidd_register_post_type("gd_loop", "Loop", "Loops", "gd-loop", array( "title" ), array());
}*/


gidd_include_file( GIDDPATH . 'core_extension/gidd_loop/data.php' );
gidd_include_file( GIDDPATH . 'core_extension/gidd_loop/gidd_wp_loop_helper.php' );
gidd_include_file( GIDDPATH . 'core_extension/gidd_loop/gidd_wp_loop_format.php' );
gidd_include_file( GIDDPATH . 'core_extension/gidd_loop/gidd_wp_loop.php' );

gidd_include_file( GIDDPATH . 'core_extension/gidd_loop/loop_type/gidd_wp_home_loop.php' );
gidd_include_file( GIDDPATH . 'core_extension/gidd_loop/loop_type/gidd_wp_singular_loop.php' );
gidd_include_file( GIDDPATH . 'core_extension/gidd_loop/loop_type/gidd_wp_archive_loop.php' );
gidd_include_file( GIDDPATH . 'core_extension/gidd_loop/loop_type/gidd_wp_content_loop.php' );

/* End of loop gidd_load.php */