<?php
Class Gidd_Pf2cr{
	public function gidd_content( $gl ) {
	
		___do( 'before_content', ___name() );
		echo ( '<div class="clearBoth"></div>' );		
		echo ( '<div class="gidd-content">' );		
		echo ( '<div class="col1">' );
		___do( 'before_col1', ___name() );
		___do( 'col1', ___name() );
		___do( 'after_col1', ___name() );
		echo ( '</div>' );
		echo ( '<div class="col2">' );
		___do( 'before_col2', ___name() );
		___do( 'col2', ___name() );
		___do( 'after_col2', ___name() );
		echo ( '</div></div>');
		___do( 'after_content', ___name() );
		
	}
}
/* End of gidd_pf2cr.php */