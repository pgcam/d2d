<?php

$role = ___subpage( 'Gidd Role Editor', ___registry( 'gidd_admin' ), "", "Role_Editor" );

___add('head', '__5fio4');
function ___head___5fio4(){

	wp_enqueue_style( 'gidd-role-style', CHILDAPPURL . 'gidd_role_editor/style.css', '', '1.0.0');

}

class Gidd_Role_Editor extends Gidd_WP_Admin{

	function gidd_get_roles() {
		global $wp_roles;

		if (!isset($wp_roles)) {
			$wp_roles = new WP_Roles();
		} 
		  
		$gre_roles = $wp_roles->roles;
		if (is_array($gre_roles)) {
			asort($gre_roles);
		}
		
		return $gre_roles;
	}

	function admin_header(){
		echo '<h2>Gidd Role Editor</h2>';
	}
	
	function admin_content(){
		$role_name = ___text('Role name', 'type a role name here.');
		$form = Gidd_WP_Form::get_instance();
	?>
	
		<form method="post" action="">
		
			<?php
			echo ___field( $role_name );
			
			$roles = $this->gidd_get_roles();
			$arrCap = array();
			foreach( $roles as $key => $role  ){			
				
				if (isset($role['capabilities']) && is_array($role['capabilities'])) {
					foreach ( $role['capabilities'] as $cap => $value ){
						if ( !isset( $arrCap["$cap"] ) )
							$arrCap["$cap"] = $cap;
					}
				}
			}
			
			asort( $arrCap );
			echo '<div class="cap_list" >';
			echo '<h4>Select capabilities for this role:</h4>';
			foreach ( $arrCap as $cap ){
				echo '<p>';
				echo '<label for="">';
				echo '<input name="'. $cap .'" type="checkbox" value="'. $cap .'" /> ';
				echo $cap;
				echo '</label>';
				echo '</p>';
			}
			echo '<div class="clear"></div><br />';
			echo '<p> <input type="submit" name="role_submit" class="button-primary" value="Add role" /> </p>';
			?>
			</div>
		</form>
	
	<?php		
	}
		
	function admin_footer(){}

}

/** end of gidd_load.php */