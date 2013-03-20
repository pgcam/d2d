<?php

add_action( '___head_register', '___head_register' );
function ___head_register(){

	wp_enqueue_script( 'imagearea', CHILDTPURL . 'register/jquery.imgareaselect.pack.js' );
	wp_enqueue_style( 'imageareacss1', CHILDTPURL . 'register/css/imgareaselect-default.css' );
	wp_enqueue_script( 'bpopup', CHILDTPURL . 'default/jquery.bpopup-0.7.0.min.js', '', '0.7.0' );
	
}


___add('col1', 'register');
function ___col1_register(){

	if ( !is_user_logged_in() ):
		
		//get term option
		$term = get_option( '__j7VcK' );
		
		
		$show_term = $term['__OpMYW'];
		$page_id = $term['__78OZs'];
		$err = $term['__MBGCG'];
		
		if ( $show_term ):
			if ( isset( $_POST['agreesubmit'] ) ):
				
				if ( $_POST['chk_agree'] == 'agree' ){					
					show_register_form();
				}else{
					echo '<div class="agree_err">'. $err .'</div>';
					show_terms_conditions( $page_id );
				}
				
			else:
								
				$c_url = gidd_current_url();
				$url = htmlspecialchars ( urldecode( $c_url ) );
				$parts = parse_url ( $url );
				$qry = explode ( '=', $parts['query'] );
				$qry_string = $qry[1];
				
				if ( isset( $qry[0] ) && ( $qry[0] == 'err' ) ):
					echo '<div class="reg_err">';
					echo htmlspecialchars_decode( $qry_string );	
					echo '</div>';
					show_register_form();
				endif;
				
				if ( isset( $qry[0] ) && ( $qry[0] == 'reg' ) ):
					
					echo '<div class="reg_success">';
					echo '<h2>Thanks you!</h2>';
					echo '<h4>You have been registered successfully.</h4>';
					echo '</div>';
					
				endif;
														
				if ( !isset( $parts['query'] ) )
					show_terms_conditions( $page_id );
				
			endif;
			
		else:
			show_register_form();
		endif;
	
	else:
	
		echo '<h2 style="margin-left: 350px; font-size: 20px; padding-top: 80px;">You already registered.</h2>';
	
	endif;
		
}



/** End of register.php */