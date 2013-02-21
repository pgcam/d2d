<?php
class Gidd_Archive_Loop extends Gidd_WP_Loop {
	protected function loop() {		
		
		$loop_counter = 0;
		while ( have_posts() ) {
			the_post();
			global $post;
			
			$this->show_post_div( $loop_counter );
			$this->show_thumbnail();
			
			echo ( '<div class="postcontent">' );
			
			//SHOW HEADER
			$lf = Gidd_WP_Loop_Format::get_instance();
			$lf->get( $this->header );
			
			$this->show_thumbnail( 'after_title' );
			
			echo ( '<div class="postcontent">' );			
			
			$this->loop_method( $this->method );
			
			$lf->get( $this->footer );
			echo ('<div class="clearBoth"></div>');
			echo ( '</div></div>' );
			___do( 'archive_loop_footer', ___name() );
			echo '</div>';
			
			$this->add_clear_div( $loop_counter );
			$loop_counter++;
		}
				
		/* RESET QUERY */
		wp_reset_query();
		
	}
}

/* End of loop.php */