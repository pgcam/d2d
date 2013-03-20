<?php

function ___field( $field, $metabox_id = "" ){
	
	$form = Gidd_WP_Form::get_instance();	
	
	$fid = $field->id;
	$func = $field->callback;
	$label = "";
	
	if ( $func != "submit" )
		$field->name = $metabox_id . "[" . $fid  . "]";
		
	//get the option from database for metabox
	if ( $field->value == "" ){
		if ( $metabox_id != "" ){
			$post_id = get_the_ID();
			$option = get_post_meta ( $post_id, $metabox_id, true ); //true is needed to return deserialized array as single value	
			$field->value = $option[ "$fid" ];
		}
	}
		
	//set options to registry for select box
	if ( count ( $field->options ) > 0 )
		___registry( "$fid", $field->options );
	
	//get the label first
	if ($field->label != "")				
		$label = $form->label( $field );
	
	
	//call the form
	if ($func == "MultiSelect"){
	
		$field->multiple = "multiple";
		$element = $form->select( $field );				
		
		//join the label
		$element = $label . $element;
		echo ___apply ( "gidd_field", $element, $fid );
		
	}else{

		$element = $form->$func( $field );
		
		//join the label
		$element = $label. $element;
		echo ___apply ( "gidd_field", $element, $fid );		
		
	}	
	
}

function ___metabox( $appname, $title, $callback, $post_type = "", $context = "", $priority = "" ){
	
	$meta = ___data();
	$meta->id = ___id( $title );
	
	$meta->appname = $appname;
	$meta->title = "$title";
	$meta->callback = "$callback";
	
	$meta->post_type = empty ( $post_type ) ? "post" : $post_type;
	$meta->context = empty( $context ) ? "advanced" : $context;
	$meta->priority = empty( $priority ) ? "default" : $priority;
	
	return gidd_create_metabox( $meta );	
}

function gidd_create_metabox( $meta ){
	
	$id = $meta->id;
	$title = $meta->title;
	$post_type = $meta->post_type;
	$context = $meta->context;
	$priority = $meta->priority;
	$callback = $meta->callback;
	$appname = $meta->appname;
	
	$metabox  = "";	
	if ( is_array( $post_type ) ){
	
		foreach ( $post_type as $type ){
			$metabox .= 'add_meta_box("'. $id .'", "' . $title . '", "gidd_metabox_content", "' . $type . '", "' . $context . '", "' . $priority . '", array( "' . $id . '", "' . $callback . '" ));';
			$metabox .= 'global $hook_suffix; add_action( "admin_print_scripts-{$hook_suffix}", create_function(null, "gidd_metabox_script(\''. $id .'\', \''. $type .'\', \''. $appname .'\');") );';
		}
	}else{	
		$metabox .= 'add_meta_box("'. $id .'", "' . $title . '", "gidd_metabox_content", "' . $post_type . '", "' . $context . '", "' . $priority . '", array( "' . $id . '", "' . $callback . '" ));';
		$metabox .= 'global $hook_suffix; add_action( "admin_print_scripts-{$hook_suffix}", create_function(null, "gidd_metabox_script(\''. $id .'\', \''. $post_type .'\', \''. $appname .'\');") );';
	}
	
	
	$func = create_function( null, $metabox );
	add_action( 'add_meta_boxes', $func );
	
	//save action
	$save_post = "gidd_save_post( '$id' );";
	$save = create_function( null, $save_post );
	add_action( 'save_post', $save );	
	
	return $id;
}


//autoload script & stype for metabox
function gidd_metabox_script( $mid, $posttype, $appname ){
	global $post_type;
	
	if ( $posttype == $post_type ){
	
		//add action hook
		___do( 'head', $mid );
		//wp_enqueue_style( 'gidd-form-style', PARENTURL . 'gidd/gidd_master/form.css' );
	
		if ( is_multisite() ){
		
			//add multisite script here
			$id = get_current_blog_id();
			wp_enqueue_style( "script-$mid", CHILDAPPURL . "$id/$appname/$appname.css", "", "$id", 'screen, projection' );
			wp_enqueue_script( "script-$mid", CHILDAPPURL . "$id/$appname/$appname.js", "", "$id", false );
			
		
		}else{
		
			wp_enqueue_style( "script-$mid", CHILDAPPURL . "$appname/$appname.css", "", "1", 'screen, projection' );
			wp_enqueue_script( "script-$mid", CHILDAPPURL . "$appname/$appname.js", "", "1", false );
			
		}
		
	}

}


function gidd_save_post( $mid ){
	
	//post id
	$post_id = get_the_ID();
	
	//verify naunce
	$nid = 'naunce' . $mid;
	if ( !isset( $_POST[ "$nid" ] ) 
		 || !wp_verify_nonce( $_POST[ "$nid" ], $mid ) ){
		
		return;
		
	}
	
	/*** additonal verification ***/
	global $post_type;
	$post_type_object = get_post_type_object( $post_type );
	
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		return;

	if ( ! isset( $post_id ) )
		return;
		
	if ( ! current_user_can( $post_type_object->cap->edit_post, $post_id ) )
		return $post_id;
		
		
	/*** ok, authenticated ***/
	//get metabox id
	$meta = $_POST[ "$mid" ];
	
	if ( is_array( $meta ) ){
		
		//true is needed to return deserialized array as single value
		$meta_value = get_post_meta( $post_id, $mid, true );
		
		//add new value
		if ( $meta && '' == $meta_value )
			 add_post_meta( $post_id, $mid, $meta );
		
		//update value
		else if ( $meta && $meta != $meta_value )
			update_post_meta( $post_id, $mid, $meta ); //don't put true if the  value is array

		//delete value
		else if ( '' == $meta && $meta_value )
			delete_post_meta( $post_id, $mid, $meta );
		
	}
	
}

/*** Default Metabox Callback ***/
//$post is the wordpress default
function gidd_metabox_content( $post, $meta ){
	
	//get the metabox id from callback
	$post_id = get_the_ID();
	$id = $meta['args'][0];
	$func = $meta['args'][1];
	
	//create naunce for vertification
	wp_nonce_field( $id,  'naunce' . $id );
		
	//action hook before metabox
	___do( 'before_metabox', $id );
	
	$form = Gidd_WP_Form::get_instance();	
	if ( function_exists( $func ) )		
		$func( $id );
		
	
	//action hook after metabox
	___do( 'after_metabox', $id );
	
	___clear( "$id" );
}

/* End of gidd_metabox_helper.php */