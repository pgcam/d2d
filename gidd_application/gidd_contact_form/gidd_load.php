<?php

$contact = ___subpage('WP Contact Form', ___registry('gidd_admin') );

___add('head', '__L17X6');
function ___head___L17X6(){

	wp_enqueue_style('contact-form-style', CHILDAPPURL . 'gidd_contact_form/style.css', '', '1.0');

}


/** End of gidd_load.php */