<?php
//implemented as strategy
class Gidd_WP_Layout extends Gidd_Data {
	private $_context = NULL;
	
	function __construct( $layout ){
		$this->_context = $layout;
	}
	
	protected function html_header() {			
		echo ( '<div class="clearBoth"></div>' );
		___do( "before_header", ___name() );
		echo ( '<div class="clearBoth"></div>' );
		
		echo ( '<div id="header">' );		
		___do( "header", ___name() );
		echo ( '</div>' );
		
		echo ( '<div class="clearBoth"></div>' );		
		___do( "after_header", ___name() );
		echo ( '<div class="clearBoth"></div>' );
	}
	
	protected function html_footer() {	
		echo ( '<div class="clearBoth"></div>' );
		___do( "before_footer", ___name() );
		echo ( '<div class="clearBoth"></div>' );
		
		echo ( '<div id="footer">' );
		___do( 'footer', ___name() );
		echo ( '</div>' );
		
		echo ( '<div class="clearBoth"></div>' );		
		___do( 'after_footer', ___name() );
		echo ( '<div class="clearBoth"></div>' );
	}

	public final function render( $data ){
	
		$this->set_data( $data );
		$this->html_header();
		$this->_context->gidd_content( $this );		
		$this->html_footer();
		
	}
		
}

/* End of Gidd_Layout */