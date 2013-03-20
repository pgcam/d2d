<?php
/*** HTML DOCTYPE ***/
function gidd_doctype( $doctype = "", $page = "" ) {
	$doc = "";
	switch ( $doctype ) {
		case "XHTML 1.0 Strict" :
			$doc  = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
			$doc .= '<html xmlns="http://www.w3.org/1999/xhtml" ';
			break;

		case "HTML 4.01 Strict" :
			$doc  = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">';
			$doc .= '<html';
			break;

		case "HTML 4.01 Transitional" :
			$doc  = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
			$doc .= '<html';
			break;

		default :
			$doc  = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
			$doc .= '<html xmlns="http://www.w3.org/1999/xhtml" ';
	}
	
	return ___apply( 'gidd_doctype', $doc, $page );
	
}

/*** ADD HEAD PROFILE ***/
function gidd_head_profile( $doctype = "" ) {
    $profile = '';	
	switch ( $doctype ) {
		case "XHTML 1.0 Strict" : $profile = '<head profile="http://gmpg.org/xfn/11">'; break;
		case "HTML 4.01 Strict" : $profile = '<head>'; break;
		case "HTML 4.01 Transitional" : $profile = '<head>'; break;
		default : $profile = '<head profile="http://gmpg.org/xfn/11">';
	}
    return ___apply( 'gidd_head_profile', $profile );
}

/*** ADD HTML CONTENT TYPE TO HEAD ***/
function gidd_html_content_type() {
	$content  = '<meta http-equiv="Content-Type" content="';
	$content .= get_bloginfo( 'html_type' );
	$content .= '; charset='. get_bloginfo( 'charset' ) .'"/>';	
	return ___apply( "gidd_html_content_type", $content );
}

/*** ADD FAV ICON URL TO THE HEAD ***/
function gidd_fav_icon() {
	$fav = '<link rel="shortcut icon" href="'. esc_url( apply_filters('gidd_fav_icon', $url) ) .'" />';
	return $fav;
}

/*** ADD CANONICAL URL TO THE HEAD ***/
function gidd_canonical_url() {
	if ( is_singular() ) {
		$canonical = '<link rel="canonical" href="'. get_permalink() .'" />';
		return apply_filters( 'gidd_canonical_url', $canonical );
	}
}

/*** ADD FEED URL TO HEAD ***/
function gidd_show_feed() {
	$feed  = '<link rel="alternate" type="application/rss+xml" title="';
	$feed .= esc_html( get_bloginfo( 'name' ) ) . " RSS Feed";
	$feed .= '" href="' . esc_url ( get_bloginfo( 'rss2_url' ) ) . '" />';
	return apply_filters('gidd_show_feed', $feed);
}

/*** ADD COMMENTS RSS TO HEAD ***/
function gidd_show_comments_rss() {
	$rss  = '<link rel="alternate" type="application/rss+xml" title="';
	$rss .= esc_html( get_bloginfo( 'name' ) ) . " Comments RSS Feed";
	$rss .= '" href="' . get_bloginfo( 'comments_rss2_url' ) . '" />';
	return apply_filters('gidd_show_feed', $rss);
}

/*** ADD PINGBACK URL TO HEAD ***/
function gidd_show_pingback_url() {
	$pingback = '<link rel="pingback" href="'. get_bloginfo( 'pingback_url' ) .'" />';
	return apply_filters( 'gidd_show_pingback_url', $pingback );
}

/*** ADD SUPPORT FOR THREADED COMMENTS ***/
function gidd_show_comment_reply() {
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

/*** ADD STYLE TO HEAD ***/
function ___style(){
	$master = '<link rel="stylesheet" type="text/css" media="screen, projection" href="'. PARENTURL . 'gidd/gidd_master/master.css' .'" />';
	$style  = '<link rel="stylesheet" type="text/css" media="screen, projection" href="'. get_bloginfo( 'stylesheet_url' ) .'" />';
	
	$master = ___apply( 'master', $master, ___name() );
	$style  = ___apply( 'style', $style, ___name() );
	
	$link = $master . $style;
	return $link;
}

/* End of template filter.php */