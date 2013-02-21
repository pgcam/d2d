<?php

/*** SETTING FORM HELPERS ***/
function ___form( $name, $action, $callback, $attr = "" ){
	
	$id = ___id( $name );
	echo '<form method="post" action="'. $action .'" '. $attr .'>';

	if ( function_exists( "$callback" ) )
		$callback( $id );
	
	echo '</form>';
	
}

function ___submit( $name, $value = "", $class = ""  ){

	$submit = ___data();
	$submit->id = ___id( $name );
	$submit->callback = "submit";
	$submit->name = $name;
	$submit->_class = $class;
	$submit->value = $value;
	
	return $submit;

}

function ___editor( $label, $metabox_id, $args = array(), $value = "" ){

	$option = get_post_meta( get_the_ID(), $metabox_id, true );	
	$id = ___id( $label );	
	$args['textarea_name'] = $metabox_id . '[' . $id . ']';
	
	if ( $value == "" )
		$value = $option["$id"];
	
	wp_editor( $value, $id, $args );

	return $id;	
}

function ___text( $label, $desc = "" ){

	$text				= ___data();
	$text->id			= ___id( $label );
	$text->label		= $label;
	$text->callback		= "text";
	$text->description 	= $desc;

	return $text;
}

function ___textarea( $label, $desc = "" ){
	
	$textarea 				= ___data();
	$textarea->id 			= ___id( $label );
	$textarea->label 		= $label;
	$textarea->callback 	= "textarea";
	$textarea->description  = $desc;
	
	return $textarea;
	
}

function ___checkbox( $label, $desc = "" ){
	
	$checkbox				= ___data();
	$checkbox->id			= ___id( $label );
	$checkbox->label		= $label;
	$checkbox->callback		= "checkbox";
	$checkbox->description	= $desc;
	
	return $checkbox;
	
}


function ___password( $label, $desc = "" ){
	
	$password 				= ___data();
	$password->id 			= ___id( $label );
	$password->label 		= $label;
	$password->callback 	= "password";
	$password->description  = $desc;
	
	return $password;

}


function ___radio( $label, $options = array(), $desc = "" ){
	
	$radio	 				= ___data();
	$radio->id 				= ___id( $label );
	$radio->label 			= $label;
	$radio->callback 		= "radio";
	$radio->options			= $options;
	$radio->description  	= $desc;
	
	return $radio;
	
}


function ___select( $label, $options = array(), $desc = "" ){
	
	$select	 				= ___data();
	$select->id 			= ___id( $label );
	$select->label 			= $label;
	$select->callback 		= "select";
	$select->options		= $options;
	$select->description  	= $desc;
	
	return $select;
	
}

function ___list( $label, $options = array(), $desc = "" ){
	
	$select	 				= ___data();
	$select->id 			= ___id( $label );
	$select->label 			= $label;
	$select->callback 		= "MultiSelect";
	$select->options		= $options;
	$select->description  	= $desc;
	
	return $select;
	
}



/*** ADMIN PAGE HELPERS ***/

function ___page( $title, $cap = "", $theme = "" ){
		
	$page = ___data();
	$page->title = "$title";
	$page->capability = "$cap";
	$page->slug = ___id( $title );
	$page->theme = $theme;
	
	return gidd_add_menu_page( $page );
}

function ___subpage( $title, $parent = "", $cap = "", $theme = "" ){
		
	$page = ___data();
	$page->parent_slug = $parent[1];
	$page->title = "$title";
	$page->capability = "$cap";
	$page->slug = ___id( $title );
	$page->theme = $theme;
			
	return gidd_add_submenu_page( $page );
	
}

function ___section( $parent_page, $section_page, $fields = "", $callback = "" ){

	$title = $section_page[0]; //page title	
	$id = ___id( $title );
	$k = ___k( 'id', 'title', 'parent_page', 'page', 'callback' );
	$v = ___v( $k, $id, "$title", $parent_page, $section_page, "$callback" );
	
	return gidd_add_settings_section( $v, $fields );
}


/*** BUILT-IN SETTING VALIDATION ***/
function gidd_setting_validate_email( $email ){
		
	$email = is_email( $email ) ? $email : "INVALID_EMAIL";
	return $email;
		
}

function gidd_setting_validate_min_length( $value, $number ){
	
	$value = ( strlen( $value ) >= $number ) ? $value : "MIN_LENGTH";
	return $value;
}


function gidd_setting_validate_max_length( $value, $number ){
	
	$value =  ( strlen( $value ) <= $number ) ? $value : "MAX_LENGTH";
	return $value;
}

function gidd_setting_validate_exact_length( $value, $number ){
	
	$value =  ( strlen( $value ) == $number ) ? $value : "EXACT_LENGTH";
	return $value;
}

function gidd_setting_validate_numeric( $value ){
		
	$value = ( is_numeric( $value ) ) ? $value : "NUMERIC";
	return $value;	
}

function gidd_setting_validate_greater_than( $value, $number ){
	
	$value = gidd_setting_validate_numeric ( $value );
	$value = ( $value > $number ) ? $value : "GREATER_THAN";
	return $value;	
}

function gidd_setting_validate_less_than( $value, $number ){
	
	$value = gidd_setting_validate_numeric ( $value );
	$value = ( $value < $number ) ? $value : "LESS_THAN";
	return $value;	
}

function gidd_setting_validate_greater_than_equal( $value, $number ){
	
	$value = gidd_setting_validate_numeric ( $value );
	$value = ( $value >= $number ) ? $value : "GREATER_THAN_EQUAL";
	return $value;	
}

function gidd_setting_validate_less_than_equal( $value, $number ){
	
	$value = gidd_setting_validate_numeric ( $value );
	$value = ( $value <= $number ) ? $value : "LESS_THAN_EQUAL";
	return $value;	
}

function gidd_setting_validate_alpha( $value ){
	
	$value = ctype_alpha( $value ) ? $value : "ALPHA";
	return $value;
}

function gidd_setting_validate_alpha_numeric( $value ){
	
	$value = ctype_alnum( $value ) ? $value : "ALPHA_NUMERIC";
	return $value;
}

/* End of gidd_setting_external helper.php */