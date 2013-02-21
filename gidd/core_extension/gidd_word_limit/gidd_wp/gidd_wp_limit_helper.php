<?php
//get WP content
function gidd_wp_content(){
	//get the full content
	$content  = '<div class="limit-content">';
	$content .= wpautop( get_the_content() );
	$content .= '</div>';	
	return $content;
}

//balance tags
function gidd_wp_balance_tags( $content ){
	$content = strip_tags( $content, '<p><a><address><a><abbr><acronym><b><big><blockquote><br><caption><cite><class><code><col><del><dd><div><dl><dt><em><font><h1><h2><h3><h4><h5><h6><hr><i><img><ins><kbd><li><ol><p><pre><q><s><span><strike><strong><sub><sup><table><tbody><td><tfoot><tr><tt><ul><var>' );
	$content = apply_filters( 'the_content', $content );
	$content = str_replace(']]>', ']]&gt;', $content);
	return balanceTags( gidd_close_tags( $content ), true );
}

/* End of loop helper.php */