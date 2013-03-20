<?php

___add( 'header' );
___add( 'footer' );
___add( 'after_footer' );
___add( 'head' );
___add( 'after_wrapper' );


function ___head(){

//	wp_enqueue_script( 'enhance_password', ( GIDDURL. 'core_extension/gidd_wp_config/action/enhance_password.js' ),'', '1.0'  );
	wp_enqueue_script( 'bpopup', CHILDTPURL . 'default/jquery.bpopup-0.7.0.min.js', '', '0.7.0' );
	wp_enqueue_script( 'default', CHILDTPURL . 'default/default.js', '', '1.0' );

}

function ___header(){

	___brand();
	
	echo '<div id="slogan"></div>';
	
	
	/*//login-logout	
	echo '<div id="member">';
	$arr = get_option('__24K4G');
	if ( is_user_logged_in() ) :
		echo '<a href="' . wp_logout_url() . '">Logout</a>';
	else:
		echo '<a href="' . site_url( '/' . $arr['__TPi0m'] ) . '/' . '">login</a>';
		echo ' <a href="' . site_url( '/register/' ) . '">Register</a>';
	endif;
	echo '</div>';*/
	
	
}



function ___footer(){
	
	___menu('primary');
	___menu( 'secondary' );
	gidd_social();
	echo '<div id="footer-logo"><a target="__blank" href="http://www.cambodiapocketguide.com"></a></div>';
	echo '<div id="master-media"><a target="__blank" href="http://www.cambodiapocketguide.com"></a></div>';
	
	if ( current_user_can( 'manage_options' ) ){
	
		echo '<ul class="admin_menu">';
		
		echo '<li><a href="'. site_url('/new_restaurant/') .'">Add a restaurant</a></li>';
		echo '<li><a href="'. site_url('/create_submenu/') .'">Create sub menu</a></li>';
		echo '<li><a href="'. site_url('/add_food/') .'">Add food</a></li>';
		echo '<li><a href="'. site_url('/list_restaurant/') .'">Update restaurant</a></li>';
		echo '<li><a href="'. site_url('/list_food/') .'">Update food</a></li>';
	
		echo '</ul>';
		
	}
	
}


function ___after_wrapper(){

?>
	
	<script type="text/javascript">
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-35393129-1']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();	
	</script>	
	

<?php
}


function gidd_social(){
?>

	<ul class="social">		
		<li><a href="http://www.twitter.com/D2DCambodia" target="_blank" id="tw"><span>twitter</span></a></li>
		<li><a href="http://www.facebook.com/door2doorcambodia" target="_blank" id="fb"><span>facebook</span></a></li>
	</ul>

<?php
}

function gidd_contact_form(){
?>

	<form method="post" action="<?php gidd_current_url(); ?>">
		
		<p>
			<label for="contactName">Name</label>
			<input class="ctext" type="text" name="contactName" />
		</p>
		
		<div class="clearBoth"></div>
		
		<p>
			<label for="email">Email</label>
			<input class="ctext" type="text" name="email" />
		</p>
		
		<div class="clearBoth"></div>
		
		<p>
			<label for="message">Message</label>
			<textarea class="ctext" name="message"></textarea>
		</p>
		
		<div class="clearBoth"></div>
		
		<p>
			<input id="contactsubmit" type="submit" value="" name="contactSubmit" />
			<input type="hidden" value="true" name="submitted" />
		</p>
		
	</form>

<?php
}


function ___after_footer(){

	//hidden contact form
	echo '<div id="contact_form" style="display:none;">';
	echo '<div class="popup-head">';

	echo '<div class="ph-left"></div>';
	echo '<div class="ph-middle"></div>';
	echo '<div class="ph-right"></div>';
	
	echo '</div>';
	echo '<div class="popup-content">';
	echo '<div class="closeWrap"><a class="close_popup" href="#"><span class="close_text">Close</span><span class="cross"></span></a></div>';
	echo ___clearBoth();
	
	echo ___space(20);
	gidd_contact_form();
	echo '</div>';
	echo '</div>';
	
	//hidden about page
	echo '<div id="about-d2d" style="display:none;">';
	echo '<div class="popup-head">';

	echo '<div class="ph-left"></div>';
	echo '<div class="ph-middle"></div>';
	echo '<div class="ph-right"></div>';
	
	echo '</div>';
	
	echo '<div class="popup-content">';
	echo '<div class="closeWrap"><a class="close_popup" href="#"><span class="close_text">Close</span><span class="cross"></span></a></div>';
	echo ___clearBoth();
	
	$aid = 75;
	$about = get_page( $aid );
	
	echo '<h2><span>'. $about->post_title .'</span></h2>';
	echo '<div class="about-content">'. wpautop ( $about->post_content ) .'</div>';
	
	echo '</div>';
	echo '<div style="height: 20px; background-color: #FECC09;"></div>';
	echo '</div>';
	
	
	//hidden terms & conditions page
	echo '<div id="term-condition" style="display:none;">';
	echo '<div class="popup-head">';

	echo '<div class="ph-left"></div>';
	echo '<div class="ph-middle"></div>';
	echo '<div class="ph-right"></div>';
	
	echo '</div>';
	
	echo '<div class="popup-content">';
	echo '<div class="closeWrap"><a class="close_popup" href="#"><span class="close_text">Close</span><span class="cross"></span></a></div>';
	echo ___clearBoth();
	
	$tid = 77;
	$term = get_page( $tid );
	
	echo '<h2 class="term-title"><span>'. $term->post_title .'</span></h2>';
	echo '<div class="term-content">'. wpautop( $term->post_content ) .'</div>';
	echo '</div>';
	echo '<div style="height: 20px; background-color: #FECC09;"></div>';
	echo '</div>';
	
	
	
	
	//add_restoo popup
	echo '<div id="add-restoo" style="display: none;">';
	echo '<div class="popup-head">';
	
	echo '<div class="ph-left"></div>';
	echo '<div class="ph-middle"></div>';
	echo '<div class="ph-right"></div>';
	
	echo '</div>';
	
	echo '<div class="popup-content">';
	echo '<div class="closeWrap"><a class="close_popup" href="#"><span class="close_text">Close</span><span class="cross"></span></a></div>';
	echo ___clearBoth();
	
	echo ___space(15);
	echo '<form method="post" action="'. site_url('/register_restoo/') .'">';
	
	echo '<p>';
	echo '<label for="rr_name">Name</label>';
	echo '<input class="rr_input" type="text" name="rr_name" />';
	echo ___clearBoth();
	echo '</p>';
		
	echo '<p>';
	echo '<label for="rr_restoo">Restaurant Name</label>';
	echo '<input class="rr_input" type="text" name="rr_restoo" />';
	echo ___clearBoth();
	echo '</p>';

	echo '<p>';
	echo '<label for="rr_address">Address</label>';
	echo '<input class="rr_input" type="text" name="rr_address" />';
	echo '</p>';

	echo '<p>';
	echo '<label for="rr_phone">Phone</label>';
	echo '<input class="rr_input" type="text" name="rr_phone" />';
	echo ___clearBoth();
	echo '</p>';	
	
	echo '<p>';
	echo '<label for="rr_email">Email</label>';
	echo '<input class="rr_input" type="text" name="rr_email" />';
	echo ___clearBoth();
	echo '</p>';	
		
	echo '<p>';
	echo '<label for="rr_desc">Comment</label>';
	echo '<textarea class="rr_desc" name="rr_desc"></textarea>';
	echo '</p>';
	
	echo '<p>';
	echo '<input type="submit" name="rr_submit" id="rr_submit" value="" />';
	echo '</p>';
	
	
	echo '</form>';
	
	echo '</div>';
	echo '</div>';
	
	
}

/** end of default.php */