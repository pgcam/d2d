<?php

$adminbar	= ___subpage( 'Admin Bar' );

//field
$view		   	= ___checkbox( 'Hide admin bar', 'Hide admin bar when viewing sites.' );
$wplogo		   	= ___checkbox( 'WP Logo', 'Remove the WordPress logo from admin bar.' );
$about		   	= ___checkbox( 'About', 'Remove the about WordPress link from admin bar.' );
$wporg			= ___checkbox( 'WordPress.org', 'Remove the WordPress.org link from admin bar.' );
$documentation	= ___checkbox( 'Documentation', 'Remove the WordPress documentation link from admin bar.' );
$forum			= ___checkbox( 'Support Forums', 'Remove the support forums link from admin bar.' );
$feedback		= ___checkbox( 'Feedback', 'Remove the feedback link from admin bar.' );
$sitename		= ___checkbox( 'Site name', 'Remove the site name menu.' );
$viewsite		= ___checkbox( 'View site', 'Remove the view site link.' );
$update			= ___checkbox( 'Update', 'Remove the updates link.' );
$comment		= ___checkbox( 'Comment', 'Remove the comments link.' );
$new_content	= ___checkbox( 'New Content', 'Remove the content link.' );
$w3tc			= ___checkbox( 'W3 Total Cache', 'If you use w3 total cache remove the performance link.' );
$user_detail	= ___checkbox( 'User Detail', 'Remove the user details tab.' );



//array of fields
$arr_ab	= array( $view, $wplogo, $about, $wporg, $documentation, $forum, $feedback, $sitename, $viewsite, $update, $comment, $new_content, $w3tc, $user_detail );
___section( array ( 'WP Config', '__30QNC' ), $adminbar, $arr_ab, "<b>Remove default admin bar items.</b>" );
unset( $arr_ab );








/** End of dashboard.php */