<?php
//strategy 2
class Word_Limit_RegEx{

	public function get_content( $wl ){
		
		$criteria = $wl->criteria;
		
		if ( $criteria == "full" ) {
			$criteria = "/(.*?)/is";			
		}
		
		$output = $wl->content;
		$content = "";
		
		if ( is_string ( $criteria ) && ! empty( $criteria ) ){
			preg_match_all ($criteria, $output, $matches );
			$content = implode ( "", $matches[0] );
		}

		return $wl->balance_tags( $content );
	}
}

/* End of wordlimit.php */