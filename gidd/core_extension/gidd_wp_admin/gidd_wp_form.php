<?php
class Gidd_WP_Form extends Gidd_Data{

	private static $_instance;
	
	private function __construct(){}
	private function __clone(){}
	
	public static function get_instance(){
		if ( ! ( self::$_instance instanceof self ) )
			self::$_instance = new self();
		
		return self::$_instance;
	}
	
	//param: id, name, label, _class
	function label( $field ){
		$label = '<label class="gd-label '. $field->_class .'" id="label'. $field->id .'" for="'. $field->name .'">'. $field->label .'</label>';
		return ___apply( "gidd_field", $label, __FUNCTION__ . $field->id );		
	}
	
	//params: id, name, value, description
	function text( $field ){
		$text  = '<div class="field-wrap field-wrap-text">';
		$text .= '<input type="text" id="'. esc_attr ( $field->id ) .'" name="'. esc_attr ( $field->name ) .'" value="'. esc_html ( $field->value ) .'" class="'. esc_attr( "regular-text " . $field->_class ) .'" />';
		$text .= '<span class="'. esc_attr( 'description' ) .'"> '. esc_html ( $field->description ) .'</span>';	
		$text .= '</div>';
		return ___apply( 'gidd_field', $text, __FUNCTION__ . $field->id );
	}
	
	//params: id, name, value, description
	function password( $field ){
		$password  = '<div class="field-wrap field-wrap-password">';
		$password .= '<input type="password" id="'. esc_attr ( $field->id ) .'" name="'. esc_attr ( $field->name ) .'" value="'. esc_html ( $field->value ) .'" class="'. esc_attr( $field->_class ) .'" autocomplete="'. esc_attr( "off" ) .'" />';
		$password .= '<span class="description"> '. esc_html ( $field->descripiton ) .'</span>';
		$password .= '</div>';
		return ___apply( 'gidd_field', $password, __FUNCTION__ . $field->id );
	}
	
	//params: id, name, value, description
	function textarea( $field ){
		$textarea  = '<div class="field-wrap field-wrap-textarea">';
		$textarea .= '<textarea class="'. esc_attr( $field->_class ) .'" id="'. esc_attr ( $field->id ) .'" name="'. esc_attr ( $field->name ) .'" rows="'. esc_attr( '5' ) .'" cols="'. esc_attr( '90' ) .'">' . esc_textarea ( $field->value ) . '</textarea>';
		$textarea .= '<br /><span class="description"> '. esc_html ( $field->description ) .'</span>';
		$textarea .= '</div>';
		return ___apply( 'gidd_field', $textarea, __FUNCTION__ . $field->id );
	}
	
	//params: id, name, value, description
	function checkbox( $field ){
		
		$checked = checked( $field->value, 1, false );
		$chk  = '<div class="field-wrap field-wrap-checkbox">';
		$chk .= '<label class="chk-label" for="'. esc_attr ( $field->id ) . '">';
		$chk .= '<input class="'. esc_attr( $field->_class ) .'" type="checkbox" id="'. esc_attr ( $field->id ) .'" name="'. esc_attr ( $field->name ) .'" value="'. esc_attr( '1' ) .'" '. $checked .' /> ';
		$chk .= '<span>' . esc_html ( $field->description ) . '</span>';
		$chk .= '</label>';
		$chk .= '</div>';
		return ___apply( 'gidd_field', $chk, __FUNCTION__ . $field->id );
		
	}
	
	//params: id, name, value, description
	function radio( $field ){
	
		$items = ___registry( $field->id );
		
		$radio = "";
		foreach ($items as $key => $val){
			
			$checked = checked( $field->value, $key, false );
			
			$radio .= '<div class="field-wrap field-wrap-radio">';
			$radio .= '<label class="rd-label '. esc_attr ( $field->id ) . '">';
			$radio .= '<input '. $checked .' type="radio" class="'. esc_attr ( $field->id . " " . $field->_class ) .'" name="'. esc_attr ( $field->name ) .'" value="'. esc_html ( $key ) .'" /> ';
			$radio .= '<span>' . esc_html ( $val ) . '</span>';
			$radio .= '</label>';
			$radio .= '</div>';
			
		}
		$radio .= '<span class="description">'. esc_html ( $field->description ) .'</span>';
			
		return ___apply( 'gidd_field', $radio, __FUNCTION__ . $field->id );
		
		___clear( $field->id );		
	}
	
	//params: id, name, value, description, multiple
	function select( $field ){
		
		$items = ___registry( $field->id );
		
		// handle multiple select options
		if ( $field->multiple == "multiple" ){			
			
			$select  = '<div class="field-wrap field-wrap-multiple">';
			$select .= '<select '. esc_attr ( $field->multiple ) .' id="'. esc_attr ( $field->id ) .'" name="'. esc_attr ( $field->name ) .'[]" class="multiselect '. esc_attr( $field->_class ) .'" >';
			$arr_options = $field->value;
			
			foreach ( $items as $key => $val ){
				$selected = "";
				if ( is_array ( $arr_options ) ){
					if ( in_array( "$key", $arr_options ) ){
						$ind = array_search( $key, $arr_options );
						$selected = selected ( $arr_options[ $ind ], $key, false );
					}
				}
				
				$select .= '<option '. esc_attr ( $selected ) .' value="'. esc_html ( $key ) .'">'. esc_html ( $val ) .'</option>';
			}
		}else{
		
			$select  = '<div class="field-wrap field-wrap-select">';
			$select .= '<select id="'. esc_attr ( $field->id ) .'" name="'. esc_attr ( $field->name ) .'" class="'. esc_attr( $field->_class ) .'" >';
			$select .= '<option value=""></option>';
			
			foreach ($items as $key => $val){
				if ( $field->value == $key ):
					$select .= '<option '. esc_attr ( 'selected="selected"' ) .' value="'. esc_html ( $key ) .'">'. esc_html ( $val ) .'</option>';
				else:
					$selected = selected ( $field->value, $key, false );
					$select .= '<option '. esc_attr ( $selected ) .' value="'. esc_html ( $key ) .'">'. esc_html ( $val ) .'</option>';
				endif;			
			}
		}
			
		$select .= '</select>';
		$select .= '<span class="ml-description description"> '. esc_html ( $field->description ) .'</span>';
		$select .= '</div>';
		
		return ___apply( 'gidd_field', $select, __FUNCTION__ . $field->id );
		
		
		//clear options from registry
		___clear( $field->id );
	}
	
	function submit( $field ){
		
		if ( $field->value == "" )
			$field->value = "Submit";
			
		if ( $field->_class == "" )
			$field->_class = "button-primary";
		
		$submit = '<input type="submit" id="'. esc_attr( $field->id ) .'" name="'.esc_attr ( $field->name ) .'" class="'. esc_attr( $field->_class ) .'" value="'. esc_html( $field->value ) .'" '. $field->attribute .' />';		
		return ___apply( 'gidd_field', $submit, __FUNCTION__ . $field->id );
	
	}

}

/* End of gidd_wp_form.php */