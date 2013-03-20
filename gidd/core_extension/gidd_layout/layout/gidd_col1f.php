<?php
class Gidd_Col1f {	

	public function gidd_content( $gl ) {	
	
		___do( 'before_content', ___name() );
		echo ( '<div class="clearBoth"></div>' );	
		echo ( '<div class="ns-content">' );
		___do( 'before_colmask', ___name() );
		echo ('<div class="clearBoth"></div>');
		echo ( '<div class="colmask fullpage '); echo 'colmask-' . ___name(); echo ( '">' );
		___do( 'before_cols', ___name() );
		echo ( '<div class="col1">' );
		___do( 'before_col1', ___name() );
		___do( 'col1', ___name() );
		___do( 'after_col1', ___name() );
		echo ( '</div>' );
		___do( 'after_cols', ___name() );
		echo ( '</div></div>' );
		___do( 'after_content', ___name() );
		
	}
	
}

/* End of gidd_col1f.php */
