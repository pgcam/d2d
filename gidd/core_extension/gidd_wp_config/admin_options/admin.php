<?php
//add a company theme page
include_once( get_stylesheet_directory() . '/extension/company_profile.php' );

//Register your profile widget to the dashboard
add_action('wp_dashboard_setup', 'profile_dashboard_widgets');
function profile_dashboard_widgets() {
	global $wp_meta_boxes;
	wp_add_dashboard_widget('your_profile_widget', 'Your Profile', 'custom_profile_widget');
}

function custom_profile_widget() {
?>
	<h4 id="head_profile_dashboard">Welcome to B2BCambodia</h4>
	<p>Your profile might be of interest to your readers. We encourage that you provide as much information as possible.
		<a href="<?php echo admin_url(); ?>profile.php" id="profile_icon_dashboard"><em>Click here to update your profile.</em></a>
	</p>
	
	
<?php
}

//Register submit article widget
add_action('wp_dashboard_setup', 'submit_article_dashboard_widgets');
function submit_article_dashboard_widgets() {
	global $wp_meta_boxes;
	wp_add_dashboard_widget('submit_article_widget', 'Submit Article', 'custom_submit_article_widget');
}

function custom_submit_article_widget() {
?>
	<p>You can submit the following types of information. Your articles will be live on the website after admin approval.</p>
	<ul id="submit-article-box">
	<?php if(get_option('ns_ext_news')){ ?>
		<li id="sab-news"><a href="<?php echo admin_url(); ?>post-new.php?post_type=ns_news">News</a></li>
	<?php }
		if(get_option('ns_ext_article')){
	?>	
		<li id="sab-article"><a href="<?php echo admin_url(); ?>post-new.php?post_type=ns_articles">Articles</a></li>
	<?php }
		if(get_option('ns_ext_event')){
	?>	
		<li id="sab-event"><a href="<?php echo admin_url(); ?>post-new.php?post_type=ns_events">Events</a></li>
	<?php }
		if(get_option('ns_ext_job')){
	?>		
		<li id="sab-job"><a href="<?php echo admin_url(); ?>post-new.php?post_type=ns_jobs">Jobs</a></li>
	<?php }
		if(get_option('ns_ext_classified')){
	?>		
		<li id="sab-classified"><a href="<?php echo admin_url(); ?>post-new.php?post_type=ns_classifieds">Classifieds</a></li>
	<?php }
		if(get_option('ns_ext_directory')){
	?>		
		<li id="sab-directory"><a href="<?php echo admin_url(); ?>post-new.php?post_type=ns_directories">Directory</a></li>
		<?php }	?>		
	</ul>
	<div class="clear"></div>
<?php
}

?>