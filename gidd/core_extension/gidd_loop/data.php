<?php

$loop = array(	'read_more' => array( 'text' => 'Read more &raquo;', 'class' => '' ),
				'header'	=> array( 'title' => '', 'author' => 'by: ',
									  'comment' => array( "No Comments", "1 Comment", "% Comments", "", "Comments off" ) ),
				'footer' 	=> array( 'date' => array('text' => '', 'format' => 'F jS, Y') ),
				'clear'		=> "",
				'method'	=> "the_excerpt",
				'thumb'		=> array( 'position' => 'after-title', 
									  'dimension' => array( 'width' => 80, 'height' => 80 ), 
									  'link' => "show-link" ),
				'paged'		=> "show-paged",
				"context"	=> "",
				"page_name"	=> "",
				"args"		=> "",
		);
		
___registry( 'gidd_loop', ___data( $loop ) );

unset ( $loop );

/* End of gidd-loop.php */