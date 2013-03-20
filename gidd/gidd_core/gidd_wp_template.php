<?php

//base WP template class with some built-in functionality
class Gidd_WP_Template extends Gidd_Data{

	protected function html_head(){
		
		//init hook
		___do( 'init', ___name() );
		
		//Add filter to show html doctype
		echo gidd_doctype( $this->doctype, ___name() ); #filter.php
		language_attributes();
		echo ">";
		
		//Add head profile
		echo gidd_head_profile( $this->doctype ); #filter.php
		
		echo '<title>';
		//echo ___apply( 'gidd_html_title', $title, ___name() ); #seo.ext
		echo apply_filters( 'gidd_html_title', $title );
		echo '</title>';
		
		//Add filter to show html content type
		echo gidd_html_content_type(); #filter.php
				
		//Add filter to show meta description
		echo apply_filters( 'gidd_html_description', $description ); #seo.ext
		
		//Add filter to show meta keywords
		echo apply_filters( 'gidd_html_keywords', $keywords ); #seo.ext
		
		//Add filter to show robot settings
		echo apply_filters( 'gidd_html_robot', $robot ); #seo.ext
				
		//Add filter to show favicon
		echo gidd_fav_icon(); #filter.php
		
		//add link to layout stylesheet
		gidd_add_layout_style( $this->layout, $this->path );
		
		//add link to main stylesheet
		echo ___style();
		
		//Add filter for canonical url
		echo gidd_canonical_url(); #filter.php
		
		//Add feed links
		echo gidd_show_feed(); #filter.php
		
		//Add comment rss link
		echo gidd_show_comments_rss();	#filter.php
		
		//Add pingback url
		echo gidd_show_pingback_url(); #filter.php
				
		//Enable comment threading
		gidd_show_comment_reply(); #filter.php
						
		//Add custom script & style		
		if ( !isset( $this->jquery ) )
			$this->jquery = "wp";
			
		___jquery( $this->jquery ); #helper.php
		___do( 'parent_head', ___name() );		
		___do( 'head', ___name() );
		___script();
		
		wp_print_scripts();
		wp_head();
		echo '</head>';		
	}
	
	protected function close_html(){
		wp_footer();
		echo '</body></html>';
	}
	
	//can be overridden by child class
	protected function html_body(){
		
		___do( 'before_wrapper', ___name() );		
		echo '<div class="gidd-wrapper">';
		___do( 'before_container', ___name() );				
		echo '<div class="gidd-container">';
		___do( 'before_page', ___name() );				
		echo '<div class="gidd-page">';
		
		$layout = ( $this->layout == "" ) ? "Col2r" : $this->layout;
		___render( ___object('WP_Layout', ___object( "$layout" )), ___data() );
		
		echo '</div>';
		___do( 'after_page', ___name() );				
		echo '</div>';
		___do( 'after_container', ___name() );			
		echo '</div>';
		___do( 'after_wrapper', ___name() );		
		
	}
	
	//get the whole wp page
	function render( $data ){
	
		$this->set_data( $data );
		
		//set name
		___name( $this->name );
		
	
		//load action hook
		if ( is_multisite() ){
		
			$id = get_current_blog_id();
			gidd_include_file( CHILDTP . $id . '/default_' . $id .'/default_' . $id .'.php' );
			gidd_include_file( CHILDTP . $id . '/' . ___name() . '/'. ___name() .'.php' );
			
		}
		else{
		
			gidd_include_file( CHILDTP . ___name() . '/'. ___name() .'.php' );
			
		}
		
		
		//layout style hook
		___do( 'layout_style', ___name() );
		
		
		$this->html_head();
		echo ( "<body " ); body_class( array('custom', ___name() ) ); echo ( ">" );
		$this->html_body();  //this generates the body content
		$this->close_html(); //this closes the body content
		
	}
	
}

/* End of gidd_wp_template.php */