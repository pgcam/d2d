<?php
class Gidd_WP_Word_Limit extends Gidd_Word_Limit{
		
	//get the initial content from db
	function get_html(){
		$theContent = gidd_wp_content();
		
		//change the url to [embed]url[/embed] if the url is not an attribute
		$theContent = preg_replace ( "/(?!(?:[^<]+>|[^>]+<\/a>))(http:\/\/|www|[a-zA-Z0-9-]+\.|[a-zA-Z0-9\.-]+@)(([a-zA-Z0-9-][a-zA-Z0-9-]+\.)+[a-zA-Z0-9-\.\/\_\?\%\#\&\=\;\~\!\(\)]+)/is", 
		"[embed]\\1\\2[/embed]", $theContent );
		
		$this->content = $theContent;
	}
	
	function balance_tags( $content ){
		return gidd_wp_balance_tags( $content );
	}
}

/* End of gidd_wp_word_limit.php */