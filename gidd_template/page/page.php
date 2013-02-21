<?php
___add('col1', 'page');


function ___col1_page(){

	$loop = ___loop();
	$loop->header = array( 'title' => '');
	$loop->footer = '';
	___render( ___object( 'Singular_Loop' ), $loop );

}




/** end of page.php */