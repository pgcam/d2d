<?php
//strategy 1
class Word_Limit_Length{

	public function get_content( $wl ){
		$output = $wl->content;
		$content = "";
		$length = intval( $wl->criteria );
		
		if ( is_int( $length ) ) {
			$limit = $length + 1;
			$content = explode( ' ', $output, $limit );
			
			if ( count( $content ) >= $limit ){
				array_pop( $content );
				array_push( $content, $wl->symbol );
			}
			
			$content = implode( ' ', $content );
		}
		
		return $wl->balance_tags( $content );	
	}
}

/* End of wordlimit.php */