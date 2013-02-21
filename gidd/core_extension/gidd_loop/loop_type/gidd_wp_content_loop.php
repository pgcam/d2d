<?php
class Gidd_Content_Loop extends Gidd_WP_Loop {
	protected function loop() {
		
		global $wp_query;
		global $paged;
		
		$loop_counter = 0;
		$temp = $wp_query;
		$wp_query = null;
		$wp_query = new WP_Query();
		
		
		$args['paged'] = $paged;
		if ( $this->_loop['args']['paged'] == "" ){
			$args['paged'] = "";
		}
		
		$wp_query->query( $this->args );
		
		if( $wp_query->have_posts() ){
		
			echo '<div class="postgroup postgroup-first">';
			
			___do( "before_content_loop", ___name() );		
			while ( $wp_query->have_posts() ) {
				global $post;
				$wp_query->the_post();
							
				$this->show_post_div( $loop_counter );						
				
				___do( 'before_loop_header', ___name() );
				$this->loop_header();
				___do( 'after_loop_header', ___name() );
				$this->loop_content();
				___do( 'before_loop_footer', ___name() );
				$this->loop_footer();
				___do( 'after_loop_footer', ___name() );
				
				echo '</div>'; //end of show_post_div
				
				
				
				$this->add_clear_div( $loop_counter );
				$loop_counter++;
				
				
				if ( is_int( $this->items_per_group ) ){
					$current_position = $wp_query->current_post + 1;
					if ( ( $current_position < $wp_query->found_posts ) && ( $current_position % $this->items_per_group == 0 ) ){
						echo '</div><div class="postgroup">';
						$loop_counter = 0; //reset the loop counter for each group
					}
				}
			
			}
			
			___do( "after_content_loop", ___name() );	

			echo '</div>';
			
			if ( $this->paged != "" ){
				if ( function_exists( "gidd_pagination" ) )
					gidd_pagination( $wp_query->max_num_pages );
				
			}
		
		}
		
		$wp_query = null;
		$wp_query = $temp;
		
		/* RESET QUERY */
		wp_reset_query();	
		
	}
	
	public function loop_header() {
		if ( $this->method != "thumbs-only" ) {
			$this->show_thumbnail();
			echo ( '<div class="postcontent">' );
			
			$lf = Gidd_WP_Loop_Format::get_instance();
			$lf->get( $this->header );
			
			$this->show_thumbnail( 'after-title' );
		}
	}
	
	public function loop_content() {
		$this->loop_method( $this->method );
	}
	
	public function loop_footer() {
		if ( $this->method != "thumbs-only" ) {
			$lf = Gidd_WP_Loop_Format::get_instance();
			$lf->get( $this->footer );
			echo ( '<div class="clearBoth"></div>' );
			echo ( '</div>' ); //end of postcontent
		}
	}
}

/* End of gidd_wp_content_loop.php */