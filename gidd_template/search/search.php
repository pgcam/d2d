<?php

___add( 'col1', 'search' );
function ___col1_search(){

	$loop = ___loop();
	___render( ___object('Archive_Loop'), $loop );

}


/** End of search.php */