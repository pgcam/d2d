<?php

___add( 'col1', 'archive' );
function ___col1_archive(){

	$loop = ___loop();
	___render( ___object('Archive_Loop'), $loop );

}


/** End of search.php */