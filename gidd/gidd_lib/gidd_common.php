<?php
/*** Generate ID from string ***/
function ___id( $string ){

	//generate number from string
	$num = substr( base_convert( md5( $string ), 16, 10) , -5 );
	return '__' . PseudoCrypt::udihash( $num );

}

function ___ext( $name ){
	if ( ! empty ( $name ) ){
		
		if ( is_multisite() ){
			$id = get_current_blog_id();
			gidd_include_file( CHILDEXT . "$id/$name/gidd_load.php" );
		}else{
			gidd_include_file( CHILDEXT . "$name/gidd_load.php" );
		}
		
	}
}


function ___app( $name ){
	if ( ! empty ( $name ) ){
		
		if ( is_multisite() ){
			$id = get_current_blog_id();
			gidd_include_file( CHILDAPP . "$id/$name/gidd_load.php" );
		}else{
			gidd_include_file( CHILDAPP . "$name/gidd_load.php" );
		}
		
	}
}

//get & set global page name
function ___name( $name = "" ){
	global $page_name;
	
	if( !empty( $name ) )
		$page_name = $name;
	
	return $page_name;
}

//factory method
function ___object( $type, $param = "" ){
	$class = "Gidd_" . $type;
	if ( class_exists( $class ) )
		return ( empty( $param ) ) ? new $class() : new $class( $param );
}

//common render method
function ___render( $object, $data ){
	$object->render( $data->get_data() );
}

//get & set registry
function ___registry( $key = "", $val = "" ){
	$gidd =& Gidd_Registry::get_instance();
	if ( empty( $key ) && empty( $val ) )
		return $gidd;
	else
		return empty( $val ) ? $gidd->get( "$key" ) : $gidd->set( "$key", $val );
}

function ___clear( $key = "" ){
	$gidd =& Gidd_Registry::get_instance();
	$gidd->clear($key );
}

//get & set data
function ___data( $val = "" ){
	$data = ___object( 'data' );
	
	if (! empty( $val ) )
		$data->set_data( $val );
		
	return $data;
}

//word_limit helper
function ___limit( $limit = NULL ){
	
	$wl = NULL;	
	
	if ( ! isset( $limit ) )
		$limit = new Word_Limit_Length;
	
	$wl = ___object( 'WP_Word_Limit', $limit );
	$wl->set_data( ___registry( 'word_limit' )->get_data() );
	
	return $wl;
	
}


//construct template object
function ___html( $data ){
	___render( ___object( 'WP_Template' ), $data );
}

//shorter loop data object
function ___loop(){
	return ___registry( 'gidd_loop' );
}

/* End of function gidd_common.php */