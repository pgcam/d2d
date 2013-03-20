<?php
class Gidd_Home_Loop extends Gidd_WP_Loop {
	protected function loop() {		
		
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				
				//HOOK BEFORE POST	
				___do( "before_post", ___name() );
				
				echo ( '<div ' ); post_class(); echo ( '>' );
				
				//HOOK BEFORE POST CONTENT
				___do( "before_post_content", ___name() );
				
				$this->show_thumbnail();
				echo ( '<div class="postcontent">' );
				
				//HOOK BEFORE LOOP TITLE
				___do( "before_loop_title", ___name() );
				
				$lf = Gidd_WP_Loop_Format::get_instance();
				$lf->get( $this->header );
				
				$this->show_thumbnail( 'after-title' );
				
				//HOOK AFTER LOOP TITLE
				___do( "after_loop_title", ___name() );
							
				echo ( '<div class="entry">' );			
				$this->loop_method( $this->method );				
				
				echo ('<div class="clearBoth"></div>');
				wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'gidd' ), 'after' => '</div>', 'pagelink' => 'Page %' ) );						
				echo ('<div class="clearBoth"></div>');						
				echo ( '</div>' ); //end of entry
				
				//HOOK BEFORE LOOP FOOTER
				___do( "before_loop_footer", ___name() );
				
				$lf->get( $this->footer );			
				
				//HOOK AFTER LOOP FOOTER
				___do( "after_loop_footer", ___name() );
				
				echo ( '<div class="clearBoth"></div>' );
				
				//HOOK AFTER POST CONTENT			
				___do( "after_post_content", ___name() );			
				
				echo ( '</div></div>' );
				
				//HOOK AFTER POST
				___do( "after_post", ___name() );
				
			}
		}
	}
}

/* End of loop.php */