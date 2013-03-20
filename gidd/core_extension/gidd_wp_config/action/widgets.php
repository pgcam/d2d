<?php
//remove some widgets
add_action('widgets_init', 'remove_some_wp_widgets', 1);
function remove_some_wp_widgets(){
	$widget = get_option('__DAPQg');
	
	if($widget['__ScQUQ'])
		unregister_widget('WP_Widget_Calendar');
	
	if($widget['__zaU92'])	
		unregister_widget('WP_Widget_Search');
	
	if($widget['__bjFd4'])	
		unregister_widget('WP_Widget_Pages');
	
	if($widget['__2mN1s'])	
		unregister_widget('WP_Widget_Recent_Comments');
	
	if($widget['__uqhuk'])	
		unregister_widget('WP_Widget_Recent_Posts');
	
	if($widget['__p3Z5A'])	
		unregister_widget('WP_Widget_RSS');
	
	if($widget['__cGkbc'])	
		unregister_widget('WP_Widget_Meta');
	
	if($widget['__h1MUu'])	
		unregister_widget('WP_Widget_Archives');
	
	if($widget['__dkG2Q'])	
		unregister_widget('WP_Widget_Categories');
	
	if($widget['__cdKCO'])	
		unregister_widget('WP_Widget_Tag_Cloud');
}