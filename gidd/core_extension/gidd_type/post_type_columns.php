<?php

/** Post type columns **/
//register metabox
___metabox( 'gidd_type', 'Post Type Columns', 'gidd_type_custom_column', 'gd_posttype' );
function gidd_type_custom_column( $mb ){

	$chk		=	___checkbox( 'Checkbox column', 'Control wheather the checkbox column is shown or not.' );
	$title		=	___checkbox( 'Title column', 'Control wheather the title column is shown or not.' );
	$category	=	___checkbox( 'Category column', 'Control wheather the category column is shown or not.' );
	$author		=	___checkbox( 'Auhor column', 'Control wheather the author column is shown or not.' );
	$date		=	___checkbox( 'Date column', 'Control wheather the date column is shown or not.' );
	$custom1	=	___text( 'Custom column1', 'Enter the title of your custom column' );
	$custom2	=	___text( 'Custom column2', 'Enter the title of your custom column' );
	$custom3	=	___text( 'Custom column3', 'Enter the title of your custom column' );
	$custom4	=	___text( 'Custom column4', 'Enter the title of your custom column' );
	$custom5	=	___text( 'Custom column5', 'Enter the title of your custom column' );
	
	echo '<div class="gmb-content">';
	___space(20);
	echo '<div class="single-field">';
	echo ___field( $chk, $mb );
	echo '</div>';
	echo '<div class="clear"></div>';
	
	echo '<div class="single-field">';
	echo ___field( $title, $mb );
	echo '</div>';
	echo '<div class="clear"></div>';
	
	echo '<div class="single-field">';
	echo ___field( $category, $mb );
	echo '</div>';
	echo '<div class="clear"></div>';
	
	echo '<div class="single-field">';
	echo ___field( $author, $mb );
	echo '</div>';
	echo '<div class="clear"></div>';
	
	echo '<div class="single-field">';
	echo ___field( $date, $mb );
	echo '</div>';
	echo '<div class="clear"></div>';
	
	echo '<div class="single-field">';
	echo ___field( $custom1, $mb );
	echo '</div>';
	echo '<div class="clear"></div>';
	
	echo '<div class="single-field">';
	echo ___field( $custom2, $mb );
	echo '</div>';
	echo '<div class="clear"></div>';
	
	echo '<div class="single-field">';
	echo ___field( $custom3, $mb );
	echo '</div>';
	echo '<div class="clear"></div>';
	
	echo '<div class="single-field">';
	echo ___field( $custom4, $mb );
	echo '</div>';
	echo '<div class="clear"></div>';
	
	echo '<div class="single-field">';
	echo ___field( $custom5, $mb );
	echo '</div>';
	echo '<div class="clear"></div>';
	
	
	
	
	echo '</div>';
	
}


/* End of function post_type_columns.php */