<?php
$limit = array( 'criteria'	=> 30,
				'symbol'	=> '...',
				'context'	=> '',
				'content'	=> '',
				'image'	=> true,
				'shortcode'=> true,
		);
				
___registry( 'word_limit', ___data( $limit ) );
unset( $limit );

/* End of data.php */