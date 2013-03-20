<?php
//used to store data objects for config, rendering,...
//this helps reduce to need to store data array in other classes

class Gidd_Data{
	protected $_data = NULL;
	
	final function __get( $key ){
		return $this->_data["$key"]; 
	}
	
	final function __set( $key, $val ){
		$this->_data["$key"] = $val;
	}
	
	final function get_data(){
		return $this->_data;
	}
	
	final function set_data( $data ){
		$this->_data = $data;
	}
	
	final function load( $data = "" ){
		if( is_array( $data ) ){
			foreach( $data as $key => $val ){
				$this->_data["$key"] = $val;
			}
		}
	}
	
	final function unload( $var = "" ){
		
		if ( !empty( $var ) ){
			if( is_array( $var ) ){
				foreach( $var as $key ){
					unset($this->_data["$key"]);
				}
			}else{
				unset( $this->_data["$var"] );
			}
		}else{
			$this->_data = array();
		}
		
	}
	
}

/* End of gidd_data.php */