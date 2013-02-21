<?php

/**
*	Here is how the comment work in WP:
*	1. The theme file such as single.php calls comment_template() function
*	2. The comment_template() function locate the comment file, default is comments.php
*	3. The comments.php calls wp_list_comments & comment_form()
*	4. The wp_list_comments() has a callback to another function to display the comments
**/

/*** COMMENT LIST DISPLAY ***/
function gidd_show_comments(  $comment, $args, $depth  ) {
	$GLOBALS['comment'] = $comment;
	switch (  $comment->comment_type  ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar(  $comment, 40  ); ?>
			<?php printf(  __( '%s', 'gidd'  ), sprintf(  '<cite class="fn">%s</cite>', get_comment_author_link()  )  ); gidd_comments_intro(); ?>
		</div><!-- .comment-author .vcard -->
		<?php if (  $comment->comment_approved == '0'  ) : ?>
			<em><?php _e(  'Your comment is awaiting moderation.', 'gidd'  ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url(  get_comment_link(  $comment->comment_ID  )  ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf(  __(  '%1$s at %2$s', 'gidd'  ), get_comment_date(),  get_comment_time()  ); ?></a><?php edit_comment_link(  __(  '( Edit )', 'gidd'  ), ' '  );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-content"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link(  array_merge(  $args, array(  'depth' => $depth, 'max_depth' => $args['max_depth']  )  )  ); ?>
		</div><!-- .reply -->
		<!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e(  'Pingback:', 'gidd'  ); ?> <?php comment_author_link(); ?><?php edit_comment_link(  __( '( Edit )', 'gidd' ), ' '  ); ?></p>
	<?php
			break;
	endswitch;
}



function gidd_comments(){
	if ( post_password_required() ):
?>
<p class="nopassword"><?php _e('This post is password protected. Enter the password to view any comments.', 'gidd');?></p>
<?php
	endif;
	
	if (have_comments()) {
		___do( "before_comments", ___name() );
		echo ( '<div class="clearBoth"></div>' );
		echo ('<div id="comments">');
		
		/*** COMMENT TITLE ***/
		___do( "before_comments_title", ___name() );
		___do("comments_title", ___name() );
		___do("after_comments_title", ___name() );				
		
		/*** COMMENT LIST ***/
		___do("before_comments_list");
		echo ('<ol class="comment-list">');
		wp_list_comments( array( 'callback' => 'gidd_show_comments' ) );
		echo ("</ol>");
		___do( "after_comments_list", ___name() );
		
		echo ('</div>');
		___do( "after_comments", ___name() );
	}else{
		___do( "comments_status", ___name() );
	}
	
	
	/*** COMMENT RESPOND ***/	
	echo ( '<div class="clearBoth"></div>' );
	
	if ( ! comments_open() )
		gidd_comment_off(); #comment-hooks.php
		
	comment_form();

}


//$seperate ( boolean ) : Whether to separate the comments by comment type.
function ___comment( $seperate = false ){
	
	comments_template( '/gidd/core_extension/gidd_comment/comments.php', $seperate );
	
}

/** End of comments.php */


