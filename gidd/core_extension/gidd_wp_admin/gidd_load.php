<?php

//FORM
gidd_include_file ( GIDDPATH . 'core_extension/gidd_wp_admin/gidd_wp_form.php' );


//SETTING API
gidd_include_file ( GIDDPATH . 'core_extension/gidd_wp_admin/gidd_setting_helper/pseudocrypt.php' );
gidd_include_file ( GIDDPATH . 'core_extension/gidd_wp_admin/gidd_setting_helper/gidd_setting_internal.php' );
gidd_include_file ( GIDDPATH . 'core_extension/gidd_wp_admin/gidd_setting_helper/gidd_setting_external.php' );
gidd_include_file ( GIDDPATH . 'core_extension/gidd_wp_admin/gidd_setting_helper/gidd_wp_admin.php' );
gidd_include_file ( GIDDPATH . 'core_extension/gidd_wp_admin/gidd_setting_helper/gidd_admin_theme.php' );


//METABOXES
gidd_include_file ( GIDDPATH . 'core_extension/gidd_wp_admin/gidd_metabox_helper/gidd_metabox_helper.php' );


//REGISTER GIDD ADMIN MENU
$ga = ___page( 'Gidd Admin' );
___registry( 'gidd_admin', $ga );


/* End of gidd_load.php */