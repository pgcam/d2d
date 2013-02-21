<?php
//implemented with template and strategy patterns
abstract class Gidd_Word_Limit extends Gidd_Data{
	private $_context = NULL;
	
	function __construct( $context ){
		$this->_context = $context;
	}
	
	public function remove_image(){
		$content = preg_replace( '/<img[^>]+./','', $this->content );
		$this->content = $content;
		return $content;
	}
	
	public function remove_shortcode(){
		$content = preg_replace( '/\[.+\]/', '', $this->content );
		$this->content = $content;
		return $content;
	}
				
	public final function render( $data ){
		
		$this->set_data( $data );
		
		//get the initial content
		$this->get_html();
		
		//call additional functionality
		if(! $this->image )
			$this->remove_image();
			
		if(! $this->shortcode )
			$this->remove_shortcode();
		
		//cut it and return the result
		$content = $this->_context->get_content( $this );
		$this->content = $content;
		return $content;
	}
	
	abstract protected function get_html();
	abstract protected function balance_tags( $html );
	
	
}

/* End of gidd_word_limit.php */