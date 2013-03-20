<?php
/*** No Direct Access to this file ***/
if ( 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']) ) {
	header('HTTP/1.1 403 Forbidden');	
	die ( 'This page cannot be loaded directly!' );
}

//call gidd comment
gidd_comments();
	
/** End of comments.php */