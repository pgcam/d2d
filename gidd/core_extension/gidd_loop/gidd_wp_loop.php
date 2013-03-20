<?php
/*** Base Loop Class ***/
abstract class Gidd_WP_Loop extends Gidd_Data{
	
	protected function loop_method( $method ) {
	
		switch ( $method ) {
			case "the_excerpt"	:	the_excerpt(); break;
			case "the_content"	:	the_content(); break;
			case "thumb_only"	:	$this->_show_thumb( $this->thumb['link'] ); break;
			default				:	$wl =& $this->method;
									echo $wl->render( $wl->get_data() );
									break;
		}	
	}
	
	protected function _get_thumbnail_with_size( $link ){
		if ( $link == "show-link" ) {
			echo ( '<a href="' ); the_permalink(); echo ( '" rel="bookmark" title="' ); the_title_attribute(); echo ( '">' );
			the_post_thumbnail( array( $this->thumb['dimension']['width'], $this->thumb['dimension']['height'] ), array( 'title'=>'thumbnail','alt'=>'thumbnail', 'class' => 'my_thumb' ) );
			echo ( '</a>' );
		} else {
			the_post_thumbnail( array( $this->thumb['dimension']['width'], $this->thumb['dimension']['height'] ), array( 'title'=>'thumbnail','alt'=>'thumbnail', 'class' => 'my_thumb' ) );
		}
	}
	
	protected function _get_thumbnail_default( $link ){
		if ( $link == "show-link" ) {
			echo ( '<a href="' ); the_permalink(); echo ( '" rel="bookmark" title="' ); the_title_attribute(); echo ( '">' );
			the_post_thumbnail( 'thumbnail', array( 'title' => 'thumbnail', 'alt' => 'thumbnail' ) );
			echo ("</a>");
		} else {
			the_post_thumbnail( 'thumbnail', array( 'title' => 'thumbnail', 'alt' => 'thumbnail' ) );
		}
	}
	
	protected function _show_thumb( $link = "" ) {
		echo ( '<div class="thumb-img">' );
		
		if ( count( $this->thumb['dimension'] ) > 0 )
			$this->_get_thumbnail_with_size( $link );
		else
			$this->_get_thumbnail_default( $link );
		
		echo ( '</div>' );
	}
	
	protected function show_thumbnail( $position = "before-title" ) {
	
		if ( is_array( $this->thumb ) ) {
			if( $this->thumb['position'] == $position ) {
				$this->_show_thumb( $this->thumb['link'] );				
			}
		}
		
	}
	
	protected function add_clear_div( $counter ){
		
		if ($this->clear == "odd"){
			if ( gidd_is_odd( $counter ) ) echo ( '<div class="clearBoth"></div>' );
		}
		
		if ($this->clear == "even"){
			if ( gidd_is_even( $counter ) ) echo ( '<div class="clearBoth"></div>' );
		}
		
		if ($this->clear == "all"){
			echo ( '<div class="clearBoth"></div>' );
		}
		
		if ( is_array( $this->clear ) ) {
				
			foreach ( $this->clear as $key => $value ) {
				if ( $value == $counter ) {
					echo ( '<div class="' ); 
					echo $key; 
					echo ( '"></div>' );
				}
			}				
		}	
	}
	
	protected function show_post_div( $counter ){
		echo ( '<div ' );			
		$class = gidd_is_odd( $counter ) ? "odd-post" : "even-post";		
		if( $counter == 0 ) {
			post_class( array ( 'first-post', $class ) );				
		} else {
			post_class( $class );
		}
		echo ( '>' );
	}
	
	protected function showReadMore( $readMore = array() ) {
				
		echo ( '<p class="readmore"><a href="' ); the_permalink(); 		
		echo ( '" title="continue reading this post" class="'.  $this->read_more['class'] .'">'. '<span>' .  $this->read_more['text'] ."</span></a></p>" );
			
	}
	
	abstract protected function loop();
	
	final function render( $data ){
		$this->set_data( $data );
		$this->loop();
	}
}

/* End of gidd_wpdata.php */