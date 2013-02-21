<?php
class Gidd_WP_Loop_Format{

	//singleton
	private static $_instance;
	
	private function __construct(){}
	private function __clone(){}
	
	public static function get_instance(){
		if ( ! ( self::$_instance instanceof self ) ){
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	
	function show_loop_title( $value = "" ) {
	
		if( $value == "no-link" ) {
			echo ( '<div class="posttitle"><h2 id="post-' ); the_ID(); echo ( '">' );
			esc_html ( the_title() ); echo ( '</h2>' );
		} else {
			if( is_singular() ) {
				if ( $value == 'h2' ){
					//force the title to show h2				
					echo ( '<div class="posttitle"><h2 id="post-' ); the_ID(); echo ( '">' );
					echo ( '<a href="' ); the_permalink(); echo ( '" rel="bookmark" title="' ); the_title_attribute(); echo ( '">' );
					esc_html ( the_title() ); echo ( '</a></h2>' );
					
				}else{
					//default to h1 if not specified
					echo ( '<div class="posttitle"><h1 id="post-' ); the_ID(); echo ( '">' );
					esc_html ( the_title() ); echo ( '</h1>' );
				}
			}
			else {
				echo ( '<div class="posttitle"><h2 id="post-' ); the_ID(); echo ( '">' );
				echo ( '<a href="' ); the_permalink(); echo ( '" rel="bookmark" title="' ); the_title_attribute(); echo ( '">' );
				esc_html ( the_title() ); echo ( '</a></h2>' );
			}
		}	
		echo ( '</div>' );
		
	}
	
	function show_author( $data = "" ) {
		echo ( '<span class="title-author">' );		
		$prefix = ( $data == "" ) ? '<em>by: </em>' : '<em>'. $data .'</em>';
		echo $prefix;
		the_author_posts_link();
		echo ( '</span>' );
	}
	
	function show_comment( $format = array() ) {
		if ( is_array( $format ) ){
			echo ( '<span class="title-comment">' ); comments_popup_link( $format[0], $format[1], $format[2], $format[3], $format[4] ); echo ( '</span>' );
		}
	}
		
	function show_category( $data = "" ) {
		echo ( '<span class="title-cat">' );
		$prefix = ( $data == "" ) ? '<em>category: </em>' : '<em>'. $data .'</em>';
		echo $prefix;
		the_category( ', ' ); echo ( '</span>' );
	}

	function show_date( $format="F j, Y", $data = "" ) {
		echo ( '<div class="posttime">' );
		$prefix = ( $data == "" ) ? '' : '<span class="post-on">' . $data . '</span>';		
		echo $prefix;		
		the_time( $format ); echo ( '</div>' );
	}
	
	function show_tags( $data = "" ){
		echo ( '<div class="posttags">' );
		$prefix = ( $data == "" ) ? '' : '<span class="posttags-prefix">' . $data . '</span>';	
		echo $prefix;
		the_tags();
		echo ( '</div>' );
	}
	
	function get( &$config ){
		if ( is_array( $config ) ) {
			foreach ( $config as $key => $value ) {
				if ( $key == "title" ) {
					$this->show_loop_title( $value );
				}
				
				if ( $key == "author" )	{
					$this->show_author( $value );
				}
				
				if ( $key == "category" ) {
					$this->show_category( $value );
				}
				
				if ( $key == "comment" ) {
					$this->show_comment( $value );
				}
				
				if ( $key == "date" ) {
					
					if( is_array( $value ) ){
						$this->show_date( $value['format'], $value['text'] );
					}
				}
				
				if ( $key == "tag" ) {				
					$this->show_tags( $value );				
				}
			}
		}
	}

}

/* End of gidd_wp_loop_format.php */