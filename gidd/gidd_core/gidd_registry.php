<?php
//registry and singleton to get and store objects 
class Gidd_Registry{
	
	private $objects = array();
	private static $_instance;
	
	private function __construct(){}
	private function __clone(){}
	
	public static function get_instance(){
		if ( ! ( self::$_instance instanceof self ) )
			self::$_instance = new self();
		
		return self::$_instance;
	}
	
	public function get( $key ){
		$object = self::get_instance()->objects[$key];
		if ( isset( $object ) )
			return $object;
			
		return NULL;
	}
	
	public function set( $key, $instance ){
		self::get_instance()->objects["$key"] = $instance;
	}
	
	public function clear( $key = "" ){
		
		if ( !empty ( $key ) )
			unset ( self::get_instance()->objects["$key"] );			
		else
			self::get_instance()->objects = array();	
			
	}
}

/* End of registry.php */