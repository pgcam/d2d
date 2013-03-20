<?php

abstract class Gidd_WP_Admin extends Gidd_Data{
	
	protected function admin_header(){
		echo '<div class="wrap '. $this->page_name .'">';
		___do( 'gidd_wp_admin_before_title', $this->page_name );
		echo '<br class = "clearBoth" />';
		screen_icon();
		
		$active = "nav-tab-active";
		
		if(is_array( $this->title ) && count( $this->title ) > 1){
			echo '<h2 id="gidd-screen-title" class="nav-tab-wrapper" >';
			$i = 0;
			foreach( $this->title as $slug => $title ){
				$page  = admin_url() . 'admin.php?page=' . $_GET['page'];
				$page .= '&tab=' . $slug;
				
				
				if ( !isset( $_GET['tab'] ) ){
					if ( $i == 0 )
						echo '<a href="'. $page .'" class="nav-tab '. $active .'">';
					else
						echo '<a href="'. $page .'" class="nav-tab">';
				}else{
				
					if ( $slug == $_GET['tab'] )
						echo '<a href="'. $page .'" class="nav-tab '. $active .'">';
					else
						echo '<a href="'. $page .'" class="nav-tab">';
				
				}
				
				
				echo esc_html( $title );
				echo '</a>';
				$i++;
			}
			echo '</h2>';
			
		}
		else{
		
			if ( is_array( $this->title ) ){
				foreach( $this->title as $title )
					echo '<h2 id="gidd-screen-title">'. esc_html ( $title ) .'</h2>';
			}else{
				echo '<h2 id="gidd-screen-title">'. esc_html ( $this->title ) .'</h2>';
			}
		}
		settings_errors();
		echo '<br class = "clearBoth" />';
		___do( 'gidd_wp_admin_after_title', $this->page_name );
		echo '<br class = "clearBoth" />';
		
	}
	
	protected function admin_footer(){
		echo '<br class = "clearBoth" />';
		___do( 'gidd_wp_admin_footer', $this->page_name );
		echo '<br class = "clearBoth" />';		
		echo '</div>';
	}
		
	abstract protected function admin_content();	
	
	final function render( $data ){
		$this->set_data( $data );
				
		$this->admin_header();
		$this->admin_content();
		$this->admin_footer();		
		
	}
}


/* End of gidd_wp_admin.php */