<?php

//$wpc is array ( 'WP Config', '__30QNC' )
$wpc = ___subpage( 'WP Config', ___registry( 'gidd_admin' ) );


gidd_include_file( GIDDPATH . 'core_extension/gidd_wp_config/admin_options/dashboard.php' );
gidd_include_file( GIDDPATH . 'core_extension/gidd_wp_config/admin_options/left_menu.php' );
gidd_include_file( GIDDPATH . 'core_extension/gidd_wp_config/admin_options/adminbar.php' );
gidd_include_file( GIDDPATH . 'core_extension/gidd_wp_config/admin_options/widget.php' );
gidd_include_file( GIDDPATH . 'core_extension/gidd_wp_config/admin_options/update.php' );


gidd_include_file( GIDDPATH . 'core_extension/gidd_wp_config/action/adminbar.php' );
gidd_include_file( GIDDPATH . 'core_extension/gidd_wp_config/action/left_menu.php' );
gidd_include_file( GIDDPATH . 'core_extension/gidd_wp_config/action/dashboard.php' );
gidd_include_file( GIDDPATH . 'core_extension/gidd_wp_config/action/widgets.php' );
gidd_include_file( GIDDPATH . 'core_extension/gidd_wp_config/action/update.php' );

/** end of gidd_load.php */