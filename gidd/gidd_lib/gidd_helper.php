<?php
//include file
function gidd_include_file( $file = "" ){
	if ( file_exists( $file ) )
		include_once( $file );
}

/*** Include files from a directory ***/
function gidd_include_files( $path_filter = "" ){
	foreach ( glob( $path_filter ) as $filename ){
		include_once "$filename";
	}
}

//directory exists
function gidd_dir_exists($dir_name = false, $path = './') {
    if(!$dir_name) return false;
   
    if(is_dir($path.$dir_name)) return true;
   
    $tree = glob($path.'*', GLOB_ONLYDIR);
    if($tree && count($tree)>0) {
        foreach($tree as $dir)
            if(gidd_dir_exists($dir_name, $dir.'/'))
                return true;
    }
   
    return false;
}

function gidd_is_odd( $num ){
  return ( boolean ) ( $num % 2 );
}

function gidd_is_even( $num ){
  if( is_odd( $num ) )
	return FALSE;
  return TRUE;
}

//Get the current url
function gidd_strleft($s1, $s2) { return substr($s1, 0, strpos($s1, $s2)); }
function gidd_current_url(){ 
	
	if(!isset($_SERVER['REQUEST_URI'])){
		$serverrequri = $_SERVER['PHP_SELF'];
	}else{
		$serverrequri = $_SERVER['REQUEST_URI'];
	}
	$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
	$protocol = gidd_strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s;
	$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
	return $protocol."://".$_SERVER['SERVER_NAME'].$port.$serverrequri;
	
}

/*** close all open xhtml tags at the end of the string ***/		
function gidd_close_tags( $html ) {		
	preg_match_all( '#<([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result );
	$openedtags = $result[1]; #put all open tags into an array
	
	preg_match_all( '#</([a-z]+)>#iU', $html, $result );
	$closedtags = $result[1];
	$len_opened = count( $openedtags );

	//all tags are closed
	if ( count( $closedtags ) == $len_opened ) {
		return $html;
	}
	
	$arr_single_tags = array( 'meta','img','br','link','area', 'input', 'hr' );
	$openedtags = array_reverse( $openedtags );
	
	//close tags
	for ($i=0; $i < $len_opened; $i++) {
		if ( !in_array( $openedtags[$i], $arr_single_tags ) ) {
			if (!in_array($openedtags[$i], $closedtags)){
			  $html .= '</'.$openedtags[$i].'>';
			} else {
				unset($closedtags[array_search($openedtags[$i], $closedtags)]);
			}
		}
	}
			
	return $html;
}

//add jQuery
function ___jquery( $jquery = "wp" ){
	
	if( $jquery == "wp" )
		wp_enqueue_script( 'jquery' );
}

//load harvesthq chosen
function ___chosen(){	
	
	$style = PARENTURL . 'gidd/core_extension/harvesthq_chosen/chosen/chosen.css';
	$js = PARENTURL . 'gidd/core_extension/harvesthq_chosen/chosen/chosen.jquery.min.js';
	$chosen = PARENTURL . 'gidd/core_extension/harvesthq_chosen/chosen/chosen.js';
	wp_enqueue_style( 'harvesthq-chosen-style', "$style", '', '1', 'screen, projection' );
	wp_enqueue_script( 'harvesthq-chosen-js', "$js", '', '1', true );
	wp_enqueue_script( 'gd-chosen-js', "$chosen", '', '1', true );
	
}

function ___datepicker(){
	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-datepicker' );	
	wp_enqueue_style(  'jquery-ui-style', PARENTURL . 'gidd/core_extension/jquery_ui_style/overcast/jquery-ui.custom.css' );
?>
	<script type="text/javascript">		
		jQuery(document).ready(function( $ ){
			var tpurl = "<?php echo get_stylesheet_directory_uri(); ?>";			
			$('.gd-datepicker').datepicker({
				dateFormat: 'yy-mm-dd',
				//altField: '.gd-datepicker',
				//altFormat: 'MM dd, yy',
				showOn: "button",
				buttonImage: tpurl + "/gidd/core_extension/jquery_ui_datepicker/overcast/images/calendar.png",
				buttonImageOnly: true,
				buttonText: "Pick a date",
				changeMonth: true,
				changeYear: true,
			});
			
			$('.gd-datepicker').prop( 'readonly', true );
		});
	</script>
<?php	
}

function ___tab( $mb ){
	wp_enqueue_script( 'tab-' . $mb, PARENTURL . 'gidd/gidd_master/js/tab.js', '', '1', false );
	wp_enqueue_style( 'tab-' . $mb, PARENTURL . 'gidd/gidd_master/tab.css', '', '1', 'screen, projection' );
}

function ___multiselect(){
	
	wp_enqueue_script( 'jq-multiselect-script', PARENTURL . 'gidd/core_extension/jquery_multiselect/jquery.multiselect.min.js', '', '1', true );
	wp_enqueue_script( 'jq-multiselect-filter-script', PARENTURL . 'gidd/core_extension/jquery_multiselect/jquery.multiselect.filter.min.js', '', '1', true );
	wp_enqueue_script( 'gd-multiselect-script', PARENTURL . 'gidd/core_extension/jquery_multiselect/gd.multiselect.js', '', '1', true );
	
	wp_enqueue_style( 'jq-multiselect-style', PARENTURL . 'gidd/core_extension/jquery_multiselect/jquery.multiselect.css', '', '1', 'screen, protection' );
	wp_enqueue_style( 'jq-multiselect-filter-style', PARENTURL . 'gidd/core_extension/jquery_multiselect/jquery.multiselect.filter.css', '', '1', 'screen, protection' );
	wp_enqueue_style( 'jq-multiselect-ui-style', PARENTURL . 'gidd/core_extension/jquery_ui_style/overcast/jquery-ui.custom.css', '', '1', 'screen, protection' );
	
}

//this function sets unlimited data field dynamically
function ___k(){
	
	$data = ___data();
	for( $i=0; $i < func_num_args(); $i++ ){
		$arg = func_get_arg( $i );
		$data->$arg = "";
	}
	return $data;
}

//this function set the value to __k() dynamically
function ___v( $data ){
	$i = 1;
	$dt = ___data ( $data->get_data() );
	foreach( $dt->get_data() as $k => $v ){
		$dt->$k = func_get_arg( $i );
		$i++;
		
		if ( $i >= func_num_args() )
			break;
	}
	
	//this removes null values from array and always returns new data object
	$arr = array_filter( $dt->get_data(), create_function('$a', 'return $a!="";') );
	$dt->set_data( $arr );
	return $dt;
}

//get last segment from url
function get_last_segment( $url ) {
        
		  $path = parse_url( $url, PHP_URL_PATH ); // to get the path from a whole URL
        $pathTrimmed = trim($path, '/'); // normalise with no leading or trailing slash
        $pathTokens = explode('/', $pathTrimmed); // get segments delimited by a slash

        if (substr($path, -1) !== '/')
            array_pop($pathTokens);

        return end($pathTokens); // get the last segment
}


/**

	Register post type & taxonomy

*/	

function gidd_register_post_type( $name, $singular, $plural, $slug, $support = array( 'title', 'editor', 'thumbnail' ), $tax = array("post_tag"), $search = false, $cap = "post", $ui = true ){	
				
	register_post_type( "$name",
	array(
		'labels' => array(
			'name' => __( "$plural" ),
			'singular_name' => __( $singular ),
			'add_new' => __( "Add $plural" ),
			'add_new_item' => __( "Add " . $singular ),
			'edit_item' => __( "Edit " . $singular ),
			'view_item' => __( "Read " . $singular )
		),
		'public' => true,
		'show_ui' => $ui,
		'exclude_from_search' => $search,
		'rewrite' => array('slug' => "$slug", 'with_front' => false),
		'capability_type' => $cap,
		'show_in_nav_menus' => false,
		'show_in_menu' => '__3QOUS', //add the post type to Gidd Admin page
		'has_archive' => true,
		'taxonomies' => $tax,
		'supports' => $support )
	);
		
}

function gidd_register_taxonomy( $name, $type, $singular, $plural, $slug ){
				
	$labels = array(
	'name'                          => "$plural",
	'singular_name'                 => $singular,
	'search_items'                  => "Search $plural",
	'popular_items'                 => "Popular $plural",
	'all_items'                     => "All $plural",
	'parent_item'                   => "Parent " . $singular,
	'edit_item'                     => "Edit " . $singular,
	'update_item'                   => "Update " . $singular,
	'add_new_item'                  => "Add " . $singular,
	'new_item_name'                 => "New " . $singular,
	'separate_items_with_commas'    => "Seperate $plural with commas",
	'add_or_remove_items'           => "Add or remove " . $singular,
	'choose_from_most_used'         => "Choose from the most used $plural"
	);

	$args = array(
		'label'                         => "$plural",
		'labels'                        => $labels,
		'public'                        => true,
		'hierarchical'                  => true,
		'show_ui'                       => true,
		'show_in_nav_menus'             => true,
		'args'                          => array( 'orderby' => 'term_order' ),
		'rewrite'                       => array( 'slug' => "$slug", 'with_front' => false ),
		'query_var'                     => true
	);

	register_taxonomy( "$name", $type, $args );
	
}


function gidd_check_mail( $user_email ){
		
	$err = "";
	if ( $user_email == '' ) {
		$err .= '<p>Email is required.</p>';
	} elseif ( ! is_email( $user_email ) ) {						
		$err .= '<p>This email is not valid.</p>';
	} elseif ( email_exists( $user_email ) ) {
		$err .= '<p>This email already exists.</p>';
	}
	
	return $err;
}


//list specific terms, support 3 types of outputs: option, array and li
function ___list_terms( $name, $output = "li", $hide_empty = 0 ){
	
	$terms = get_terms( "$name", 'hide_empty=' . $hide_empty );
	$count = count($terms);
	if ( $count > 0 ):
	
		//option
		if ( $output == "option" ):
			foreach ( $terms as $term )
				return '<option '. $term->term_id .'>'. $term->name .'</option>';
		
		//array
		elseif ( $output == "array" ):
		
			$arr_terms = array();
			foreach ( $terms as $term ):
				$arr_terms[ $term->term_id ] = $term->name;
				
			endforeach;
			return $arr_terms;
		
		//li
		else:
			foreach ( $terms as $term )
				return '<li><a href="'. get_term_link( $term ) .'" >' . $term->name . '</a></li>';
		endif;
	endif;
	
}

/* End of function helper.php */