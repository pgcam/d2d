<?php
class Gidd_Col3b {

	public function gidd_content( $gl ) {
	
		___do( 'before_content', ___name() );
		echo ( '<div class="clearBoth"></div>' );
		echo ( '<div class="gidd-content">' );
		___do( 'before_colmask', ___name() );
		echo ('<div class="clearBoth"></div>');
		echo ( '<div class="colmask blogstyle ' ); echo 'colmask-' . ___name(); echo ( '">' );
		___do( 'before_cols', ___name() );		
		echo ( '<div class="colmid">' );
		echo ( '<div class="colleft">' );
		echo ( '<div class="col1wrap">' );
		echo ( '<div class="col1">' );
		___do( 'before_col1', ___name() );
		___do( 'col1', ___name() );
		___do( 'after_col1', ___name() );
		echo ( '</div></div>' );
		echo ( '<div class="col2">' );
		echo ( '<div class="col2-content">' );
		___do( 'before_col2', ___name() );
		___do( 'col2', ___name() );
		___do( 'after_col2', ___name() );		
		echo ( '</div></div>' );
		echo ( '<div class="col3">' );
		echo ( '<div class="col3-content">' );
		___do( 'before_col3', ___name() );
		___do( 'col3', ___name() );
		___do( 'after_col3', ___name() );
		echo ( '</div></div></div></div>' );
		___do( 'before_cols', ___name() );
		echo ( '</div></div>' );
		___do( 'after_content', ___name() );
		
	}
}

/* End of gidd_col3b.php */