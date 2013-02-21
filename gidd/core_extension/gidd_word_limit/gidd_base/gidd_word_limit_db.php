<?php
//strategy 3
class Word_Limit_DB{

	public function get_content( $wl ){
		$pattern =  stripslashes ( get_option( "gidd_limit_pattern" ) );		
		$output = $wl->content;
		$content = "";
		
		if ( is_string ( $pattern ) && ! empty( $pattern ) ){
			preg_match_all ($pattern, $output, $matches );
			$content = implode ( "", $matches[0] );
		}
		
		return $wl->balance_tags( $content );
	}
}

/* End of wordlimit.php */