<?php
function gidd_wp_template( $t ) {
    global $wp_query;
    if ( $wp_query->is_404 ) {
        $wp_query->is_404 = false;
        //$wp_query->is_archive = true;
    }
    header("HTTP/1.1 200 OK");
    return $t;
}

add_filter( 'template_include', 'gidd_template_include', 1, 1 ); 
// @param $template - Full path to the normal template file. 
function gidd_template_include( $template ) {
 
  $url = gidd_current_url();
  
  //support for query string
  $url = trailingslashit( preg_replace('/\?.*/', '', $url) );	
  $last = get_last_segment( $url ); //assume that the $last is the template folder name
   
 //GET CUSTOM PAGE
 if ( gidd_dir_exists( $last, CHILDTP ) ){
		$name = str_replace( "-", "_", $last );    
		___name( $name ); //set the page name
		return gidd_wp_template ( GIDDPATH . "core_extension/gidd_layout/gidd_php.php" );
  }	
	
  return $template; 
  
}

//Prevent WordPress from Auto-Redirect Custom URL
add_filter( 'redirect_canonical', 'gidd_redirect_canonical', 1, 2 );
function gidd_redirect_canonical( $redirect_url, $requested_url ){
	
	//GET THE CUSTOM URLS
	$url = gidd_current_url();
  
   //support for query string
   $url = trailingslashit( preg_replace('/\?.*/', '', $url) );	   
	$req = preg_replace('/\?.*/', '', $requested_url);
	
	if ( trailingslashit( $req ) == $url )
		return false;
	
	return $redirect_url;
}

/* End of gidd_dynamic_page */