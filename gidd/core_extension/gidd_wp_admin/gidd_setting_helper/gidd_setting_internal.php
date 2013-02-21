<?php
function gidd_add_menu_page( $page ){
	
	$id = $page->slug;	
	
	//get page object to registry
	___registry( 'gidd_menu_page' . $id, $page );
	
	$menu = "gidd_add_menu_page_callback( '$id' );";
	$func = create_function( null, $menu );
	
	add_action( 'admin_menu', $func );	
	return array ( $page->title, $id );
}

function gidd_add_menu_page_callback( $id ){
	
	//$id is the page slug
	
	//get $page object from registry
	$page = ___registry( 'gidd_menu_page'. $id );
	
	//menu page data
	$title 				= $page->title;
	$menu_title 		= empty ( $page->menu_title ) ? $title : $this->menu_title;	
	$capability 		= empty ( $page->capability ) ? 'manage_options' : $page->capability;	
	$slug 				= $page->slug;
	$icon 				= $page->icon;
	$position 			= $page->position;
	$theme				= $page->theme;
	
	
	
	$callback = "gidd_menu_page( '$id', '$theme' );";
	$func = create_function( null, $callback );
	
	//register parent menu
	if( !empty( $position ) )
		$setting_page = add_menu_page( "$title", "$menu_title", "$capability", "$slug", "$func", "$icon", "$position" );
	else
		$setting_page = add_menu_page( "$title ","$menu_title","$capability", "$slug", "$func", "$icon" );
		
	//set page info to registry	
	//___registry( 'gidd_hook_suffix', $setting_page ) ;
	//___registry( 'gidd_enqueue_script_page', $page );
	
	
	
	//$enqueue = "gidd_admin_enqueue_scripts( '$id' );";
	//$func_enqueue = create_function( null, $enqueue );
	
	$head = "gidd_admin_head_scripts( '$id' );";
	$func_head = create_function( null, $head );
	
	//add scripts to to head
	//add_action( 'admin_enqueue_scripts', $func_enqueue );
	add_action( "admin_head-{$setting_page}", $func_head );
	
	//clear the page object
	___clear( 'gidd_menu_page' . $id );
	
}


function gidd_add_submenu_page( $page ){

	$id = $page->slug;	
	
	//get page object to registry
	___registry( 'gidd_submenu_page'.$id, $page );

	$menu = "gidd_add_submenu_page_callback( '$id' );";
	$func = create_function( null, $menu );
	
	add_action( 'admin_menu', $func );
	return array ( $page->title, $id );	
}

function gidd_add_submenu_page_callback( $id ){

	//get $page object from registry
	$page = ___registry( 'gidd_submenu_page' . $id );
	
	//menu data
	$parent_slug	= $page->parent_slug;
	$page_title		= $page->title;
	$menu_title		= empty ( $page->menu_title ) ? $page_title : $page->menu_title;
	$capability		= empty ( $page->capability ) ? "manage_options" : $page->capability;
	$slug			= $page->slug;
	$theme			= $page->theme;
	
	$callback = "gidd_submenu_page( '$id', '$theme' );";
	$func = create_function( null, $callback );
	
	//register sub menu
	$setting_page = add_submenu_page( "$parent_slug", "$page_title", "$menu_title", "$capability", "$slug", "$func" );
	
	
	$head = "gidd_subadmin_head_scripts( '$id' );";
	$func_head = create_function( null, $head );
	
	//add scripts to head
	//add_action( 'admin_enqueue_scripts', 'gidd_subadmin_enqueue_scripts' );
	add_action( "admin_head-{$setting_page}", $func_head );
	
	//clear the page object
	___clear( 'gidd_submenu_page'.$id );

}

function gidd_add_option( $option ){
	if( false == get_option( "$option" ) ){
		add_option( "$option" );
		return $option;
	}	
	return null;		
}

//require section and field data objects
function gidd_add_settings_section( $section, $fields ){
	
	//section data
	$id = $section->id;
	$title = $section->title;

	$parent_page = $section->parent_page; //array ( $title, $slug ) from gidd_admin_page
	$page = $section->page; //array ( $title, $slug ) from gidd_admin_subpage
	$page_slug = $page[1];
	
	$section_callback = $section->callback;
	
	//save section id & title to registry
	$tab = ___registry( "gidd_section" );
	$tab["$id"] = array( $parent_page[1], "$title" );
	___registry( "gidd_section", $tab );
		
	
	//add_option
	$section  = "gidd_add_option('$id');";
	
	//add_section
	$section .= "add_settings_section( '$id', '$title', 'gidd_section_$id', '$page_slug' );";
	$section .= "function gidd_section_$id(){ gidd_admin_section( '$id', '$section_callback' ); }";
	
	//add fields
	if ( is_array( $fields ) ){
		
		foreach ($fields as $field ){
			
			$fid 				= $field->id;
			$label 			= $field->label;
			$callback 		= $field->callback;
			$description 	= $field->description;
			$validate 		= $field->validate;
			$class			= $field->_class;
					
			
			//set options to registry for select box
			if ( count ( $field->options ) > 0 )
				___registry( "$fid", $field->options );
			
			
			//save validation info to registry
			if ( isset( $validate ) && !empty ( $validate ) ){
			
				$validation = ___registry( 'gidd_validate_setting' );
				$validation[ "$fid" ] = $field->validate;
				___registry( 'gidd_validate_setting', $validation );
				
			}
			
			$section .= "add_settings_field('$fid', '$label', 'gidd_admin_field', '$page_slug', '$id', array('$callback', '$fid', '$id', '$description', '$class'));";
		}
	}
			
	//register_setting
	$section .= "register_setting('$id', '$id', 'gidd_sanitize_option' );";
	
	$func = create_function( null, $section );
	add_action( 'admin_init', "$func" );
	return $id;	
}



/*** Default Callbacks ***/

function gidd_admin_head_scripts( $id ){

	___do( 'head', $id );
	
}

/*function gidd_admin_enqueue_scripts( $hook_suffix ){
	
	$setting_page = ___registry( 'gidd_hook_suffix' );
	
	if ( $setting_page == $hook_suffix ){
	
			//get the page object
			$page = ___registry( 'gidd_enqueue_script_page' );			
			___do( 'gidd_admin_enqueue_scripts', $page->slug );
			
	}
	
	//clear registry
	___clear( 'gidd_hook_suffix' );
	___clear( 'gidd_enqueue_script_page' );
}*/


function gidd_subadmin_head_scripts( $id ){

	___do( 'head', $id );
	
}


function gidd_admin_set_page( $slug ){
	
	$data = ___data();
	$arr_title = "";
	$section = ___registry( 'gidd_section' );
	
	if ( is_array( $section ) ){
		foreach( $section as $id => $name ){
			if ($slug == $name[0]){
				
				$data->parent_page = $name[0];
				$arr_title["$id"] = $name[1];
				$data->title = $arr_title;
				
			}		
		}
	}
	
	return $data;	
}

function gidd_menu_page( $slug, $theme ){
			
	//set page data
	$data = gidd_admin_set_page( $slug );	
	$data->page_name = "$slug";
	
	if ( $theme != "" )
		___render( ___object( $theme ), $data );	
	else
		___render( ___object( 'Admin_Theme' ), $data );	
	
	
	//clear registry
	___clear( "gidd_section" );
	//___clear( "gidd_setting_page" . $slug );
	
}

function gidd_submenu_page( $slug, $theme ){
	
	//set page data
	$data = gidd_admin_set_page( $slug );	
	$data->page_name = "$slug";
	
	if ( $theme != "" )
		___render( ___object( $theme ), $data );	
	else
		___render( ___object('Admin_Theme'), $data );	
	
	//clear registry
	___clear( "gidd_section" );
	
}

function gidd_admin_section( $id, $callback ){
	echo ___apply( 'gidd_setting_section', $callback, $id );
}

function gidd_admin_field( $args ){
	$form = Gidd_WP_Form::get_instance();
	$option = get_option( $args[2] );
	$val = $option[$args[1]]; //get the saved setting from database
	
	$type = $args[0];
		
	$field = ___data();	
	$field->id = $args[1];	
	$field->name = $args[2].'['. $field->id . ']'; //section[ field_id ]
	$field->value = $val;
	$field->description = $args[3];
	$field->_class = $args[4];
			
	//call the form
	if ($type == "MultiSelect"){
		$field->multiple = "multiple";
		$element = $form->select( $field );
		echo ___apply( 'gidd_field', $element, $field->id );
	}
	else{
		$element = $form->$type( $field );
		echo ___apply( 'gidd_field', $element, $field->id );
	}
		
}

function gidd_sanitize_option( $input ){
	
	$output = array();
	if ( is_array( $input ) ):
		foreach ( $input as $key => $val ){
			
			//general validation
			if ( isset( $input["$key"] ) ){
				if ( !is_array( $input["$key"] ) )
					$output["$key"] = wp_filter_nohtml_kses( wp_kses_stripslashes ( $input["$key"] ) );
				else
					$output["$key"] = $input["$key"];
			}
			
		}
	endif;
		
	
	//add validation error flags to the output array
	$validation = ___registry( 'gidd_validate_setting' );			
	if ( is_array( $validation ) && count( $validation ) > 0 ){
	
		foreach ( $output as $key => $val ){
						
			$func = trim ( $validation[ "$key" ] );					
			if (! empty ( $func ) ){
				
				//check if the $func has param
				if ( strpos( $func, ':' ) ){
					$func = explode( ':', $func );
				}
				
				//map the $func to function
				if ( is_array( $func ) ){
				
					if ( $func[0] == "min_length" ){
					
						$output[ "$key" ] = gidd_setting_validate_min_length( $val, $func[1] );
						
					}else if ( $func[0] == "max_length" ){
						
						$output[ "$key" ] = gidd_setting_validate_max_length( $val, $func[1] );
						
					}else if ( $func[0] == "exact_length" ){
					
						$output[ "$key" ] = gidd_setting_validate_exact_length( $val, $func[1] );
					
					}else if ( $func[0] == "greater_than" ){
						
						$output[ "$key" ] = gidd_setting_validate_greater_than( $val, $func[1] );
						
					}else if ( $func[0] == "less_than" ){
					
						$output[ "$key" ] = gidd_setting_validate_less_than( $val, $func[1] );
					
					}else if ( $func[0] == "greater_than_equal" ){
						
						$output[ "$key" ] = gidd_setting_validate_greater_than_equal( $val, $func[1] );
						
					}else if ( $func[0] == "less_than_equal" ){
					
						$output[ "$key" ] = gidd_setting_validate_less_than_equal( $val, $func[1] );
					
					}					
					
				
				}else{
				
					if ( $func == "email" ){
						
						$output[ "$key" ] = gidd_setting_validate_email( $val );
						
					}else if ( $func == "numeric" ) {						
						
						$output[ "$key" ] = gidd_setting_validate_numeric( $val );
						
					}else if ( $func == "alpha" ) {
						
						$output[ "$key" ] = gidd_setting_validate_alpha( $val );
						
					}else if ( $func == "alpha_numeric" ) {
						
						$output[ "$key" ] = gidd_setting_validate_alpha_numeric( $val );
						
					}else{
						
						//call custom function
						$output[ "$key" ] = $func( $val );

					}					
				
				}				
				
			}			
		}		
	}
	
	
	//Process the validation flags
	$accept = array();
	
	foreach ( $output as $key => $val ){
	
		if ( $val == "INVALID_EMAIL" ){
		
			$val = "";
			add_settings_error( "$key", "INVALID_EMAIL", "Invalid email for field ID: $key" );
			
		}else if ( $val == "MIN_LENGTH" ){
		
			$val = "";
			add_settings_error( "$key", "MIN_LENGTH", "Field ID: $key is too short." );
			
		}else if ( $val == "MAX_LENGTH" ){
		
			$val = "";
			add_settings_error( "$key", "MAX_LENGTH", "Field ID: $key is too long." );
			
		}else if ( $val == "EXACT_LENGTH" ){
		
			$val = "";
			add_settings_error( "$key", "EXACT_LENGTH", "Field ID: $key does not meet the require length." );
		
		}else if ( $val == "NUMERIC" ){
		
			$val = "";
			add_settings_error( "$key", "NUMERIC", "Field ID: $key is not numeric." );
			
		}else if ( $val == "GREATER_THAN" ){
		
			$val = "";
			add_settings_error( "$key", "GREATER_THAN", "Field ID: $key is smaller than the minimum value." );
		
		}else if ( $val == "LESS_THAN" ){
		
			$val = "";
			add_settings_error( "$key", "LESS_THAN", "Field ID: $key is bigger than the maximum value." );
		
		}else if ( $val == "GREATER_THAN_EQUAL" ){
		
			$val = "";
			add_settings_error( "$key", "GREATER_THAN_EQUAL", "Field ID: $key is smaller than or not equal to the minimum value." );
		
		}else if ( $val == "LESS_THAN_EQUAL" ){
		
			$val = "";
			add_settings_error( "$key", "LESS_THAN_EQUAL", "Field ID: $key is bigger than or not equal to the maximum value." );
		
		}else if ( $val == "ALPHA" ){
		
			$val = "";
			add_settings_error( "$key", "ALPHA", "Field ID: $key can contain alphabetical characters only." );
		
		}else if ( $val == "ALPHA_NUMERIC" ){
		
			$val = "";
			add_settings_error( "$key", "ALPHA_NUMERIC", "Field ID: $key can contain alphabetical or numerical characters only." );
		
		}else{
		
			if ( strpos( $val, '^^' ) ){
				
				$msg = explode ( '^^', $val, 3 );
				$msg_key =  esc_attr ( strip_tags ( $msg[0] ) );
				$msg_text = stripslashes ( wp_filter_nohtml_kses( $msg[1] ) );
				$msg_type = esc_attr ( strip_tags ( ( !empty ( $msg[2] ) ) ? $msg[2] : "error" ) );
				
				$val = "";				
				add_settings_error( "$key", "$msg_key", "$msg_text", "$msg_type" );
			}
		
		}
	
		//reasign the value to the accept array
		$accept["$key"] = $val;
	
	}
		
	//return the result after validation
	return $accept;
	
}

/* End of helper.php */