<?php

//load the core feature
gidd_include_file( GIDDCORE . 'gidd_registry.php' );
gidd_include_file( GIDDCORE . 'gidd_data.php' );
gidd_include_file( GIDDCORE . 'gidd_dynamic_page.php' );


//load core template
gidd_include_file( GIDDCORE . 'gidd_wp_helper.php' );
gidd_include_file( GIDDCORE . 'gidd_wp_filter.php' );
gidd_include_file( GIDDPATH . '___gidd.php' );


//load core extension
gidd_include_file( GIDDPATH . 'core_extension/gidd_widget/gidd_load.php' );
gidd_include_file( GIDDPATH . 'core_extension/gidd_layout/gidd_load.php' );

gidd_include_file( GIDDPATH . 'core_extension/gidd_word_limit/gidd_load.php' );
gidd_include_file( GIDDPATH . 'core_extension/gidd_word_limit/gidd_wp/gidd_load.php' );

gidd_include_file( GIDDPATH . 'core_extension/gidd_loop/gidd_load.php' );
gidd_include_file( GIDDPATH . 'core_extension/gidd_block/gidd_load.php' );
gidd_include_file( GIDDPATH . 'core_extension/gidd_wp_admin/gidd_load.php' );
gidd_include_file( GIDDPATH . 'core_extension/gidd_type/gidd_load.php' );
gidd_include_file( GIDDPATH . 'core_extension/gidd_comment/gidd_load.php' );
gidd_include_file( GIDDPATH . 'core_extension/gidd_wp_config/gidd_load.php' );


//custom load from child theme
if ( file_exists( CHILDPATH . 'load.php' ) )
	gidd_include_file( CHILDPATH . 'load.php' );

	
//load template
gidd_include_file( GIDDCORE . 'gidd_admin.php' );
gidd_include_file( GIDDCORE . 'gidd_login.php' );
gidd_include_file( PARENTTP . 'default/default.php' );
gidd_include_file( GIDDPATH . 'gidd_master/action.php' );
gidd_include_file( GIDDPATH . 'gidd_master/config.php' );
gidd_include_file( GIDDCORE . 'gidd_wp_template.php' );

/* End of Gidd_WP gidd_load.php */