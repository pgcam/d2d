<?php


___add( 'col1', 'single_gd_food' );
function ___col1_single_gd_food(){

	while( have_posts() ): the_post();
	
		echo '<div class="single-food-title">';
		echo '<h2>' . get_the_title() . '</h2>';
		echo '</div>';

		the_content();
		
		echo get_post_meta( get_the_ID(), 'food_price', true );
		
	endwhile;
	
}






/** end of single_gd_restaurant.php */