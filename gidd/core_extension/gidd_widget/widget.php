<?php

//show widget
function ___widget( $id, $default = true, $class = "", $wrapper = "ul" ){

	if ( $default ) {
		if ( !function_exists('dynamic_sidebar') || ! dynamic_sidebar( $id ) ) {
			/*** Default Category Widget ***/
			echo ('<li class="widget-container widget_categories">');
			echo ('<h3 class="widget-title">Categories</h3>');
			echo ("<ul>");
			wp_list_categories("title_li=");
			echo ("</ul>");
			echo ("</li>");
			
			/*** Default Archive Widget ***/
			echo ('<li class="widget-container widget_archive">');
			echo ('<h3 class="widget-title">Monthly Archives</h3>');			
			echo '<'.$wrapper.' class="'.$class.'">';
			wp_get_archives( 'type=monthly' );			
			echo '</'.$wrapper.'>';
			echo ('</li>');
			
			/*** Default Meta Widget ***/
			echo ('<li class="widget-container" id="meta">');
			echo ('<h3 class="widget-title">'); _e( 'Meta', 'gidd' ); echo('</h3>');			
			
			echo ('<ul>');
			wp_register();
			echo ('<li>'); wp_loginout(); echo ('</li>');
			wp_meta();
			echo ('</ul>');				
			echo ('</li>');
		}
	} else {		
		if ( is_active_sidebar( $id ) ) {
			$wrapper = '<'. $wrapper . ' class="'. $class .'">' ;
			$close_wrapper = '</'. $wrapper .'>';
			echo $wrapper;
			dynamic_sidebar( $id );
			echo $close_wrapper;
		}		
	}		

}

/* End of function widget.php */