<?php

function gidd_block_content( $post_id ){
	$post 		 = get_post( $post_id );
	$content 	 = '<div class="block-content block-'. $post_id .'">';
	$content	.= wpautop ( do_shortcode ( $post->post_content ) );
	$content	.= '</div>';
	
	return $content;
}


	
//BLOCKS
add_action('init', 'gidd_block_post_type', 1);
function gidd_block_post_type(){	
	//gidd_register_post_type("gd_blocks", "Block", "Blocks", "block", array("title", "editor", "thumbnail", "custom-fields"), array());
	
	register_post_type( "gd_block",
	array(
		'labels' => array(
			'name' => __( "Blocks" ),
			'singular_name' => __( 'Block' ),
			'add_new' => __( "Add Bloks" ),
			'add_new_item' => __( "Add Block" ),
			'edit_item' => __( "Edit Block" ),
			'view_item' => __( "Read Block" )
		),
		'public' => true,
		'show_ui' => true,
		'exclude_from_search' => true,
		'rewrite' => array('slug' => "block", 'with_front' => false),
		'capability_type' => 'post',
		'show_in_nav_menus' => true,
		'has_archive' => false,
		'taxonomies' => array(),
		'supports' => array("title", "editor", "thumbnail", "custom-fields") )
	);
	
	
}


//BLOCKS COLUMN
add_action('manage_posts_custom_column', 'manage_blocks_columns');
function manage_blocks_columns($column) {
	global $post;	
	if ("blockcode" == $column) echo htmlspecialchars("<?php echo gidd_block_content($post->ID); ?>");
}

add_filter( 'manage_edit-gd_block_columns', 'gd_edit_block_columns' );
function gd_edit_block_columns( $columns ) {

	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Block Title' ),
		'blockcode' => __( 'Template Code' ),
	);
	return $columns;
	
}


/* End of gidd_load.php */