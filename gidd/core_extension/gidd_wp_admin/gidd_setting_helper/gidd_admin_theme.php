<?php

//have problem when the title is not array
//also need to add more filters and hooks

Class Gidd_Admin_Theme extends Gidd_WP_Admin{
	protected function admin_content(){
		
		$tab = $_GET['tab'];
		$titles = $this->title;
				
		if ( isset( $tab ) )
			___do('before_setting_form', $tab);

		___do('before_setting_form', $this->page_name);
		
		//no need to use gidd_wp_form
		echo '<form method="post" action="options.php" class="wp-setting-form '. $tab . '">';
		
		if ( isset( $tab ) ){			
			if ( is_array( $titles ) ){
				foreach( $titles as $slug => $title ){
					
					if ( $tab == $slug ){						
						settings_fields( "$slug" ); //require option group ( get from section name )
						do_settings_sections( "$tab" ); //require page ( get from page name )						
					}					
				}
			}				
		}else{
		
			if ( is_array( $titles ) ){
				$count = 0;
				foreach( $titles as $slug => $title ){
					
					if ( $count == 0 ){
						
						/** Note: Each section is mapped to a sub page. Thus, section name = sub page name */						
						settings_fields( "$slug" ); //require option group ( get from section name )
						do_settings_sections( "$slug" ); //require page ( get from page name )
						break;
						
					}
					
				}
				
			}
			
		}
		
		
		submit_button();
		echo '</form>';
		
		if ( isset( $tab ) )
			___do('after_setting_form', $tab);
			
		___do('after_setting_form', $this->page_name);
		
	}	
}

/* gidd_admin_theme.php */