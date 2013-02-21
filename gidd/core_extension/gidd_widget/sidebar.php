<?php

//callback for ___sidebar
function gidd_register_sidebar( $name, $desc = "", $tag = "li", $title_wrap = "h3" ){

	register_sidebar( array(
	
		'name' => __( $name, 'gidd' ),
		'id' => ___id( $name ),
		'description' => __( $desc, 'gidd' ),
		'before_widget' => '<' . $tag . ' id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</'. $tag .'>',
		'before_title' => '<'. $title_wrap .' class="widget-title">',
		'after_title' => '</'. $title_wrap .'>',
		
	) );

}

//register sidebar
function ___sidebar( $name, $desc = "", $blog_id = 1, $tag = "li", $title_wrap = "h3" ){
	
	
	if ( is_multisite() ){
	
		if ( $blog_id == "all" ){
			//network wide
			gidd_register_sidebar( $name, $desc, $tag, $title_wrap );
		
		}else{
		
			//site wide
			$id = get_current_blog_id();
			if ( $id == $blog_id )
				gidd_register_sidebar( $name, $desc, $tag, $title_wrap );
		
		}
		
	}else{	
		gidd_register_sidebar( $name, $desc, $tag, $title_wrap );
	}

}


/* End of function helper.php */