<?php
/*** HOOKING THE COMMENTS ***/
___add( "comments_title" );
___add( 'after_comments_list' );

function gidd_add_layout_comments () {
	comments_template( '', true );
}

function ___comments_title() {
	echo ( "<h3>Comments</h3>" );
}

function ___after_comments_list() {
	if ( get_comment_pages_count() > 1 && get_option('page_comments') ) : ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link(__('<span class="meta-nav">&larr;</span> Previous Comments', 'gidd'));?></div>
				<div class="nav-next"><?php next_comments_link(__('Next Comments <span class="meta-nav">&rarr;</span>', 'gidd'));?></div>
			</div>
<?php
	endif;
}


/*** FILTERING THE COMMENTS ***/
add_filter( 'comment_form_defaults', 'gidd_comment_form_defaults' );
function gidd_comment_form_defaults( $fields ) {
	$fields['title_reply'] = "Leave a comment";
	$fields['label_submit'] = "Submit a comment";	
	return $fields;
}

function gidd_comments_intro() {
	$intro = '<span class="says">says:</span>';
	echo apply_filters( 'gidd_comments_intro', $intro );
}

function gidd_comment_off(){
	$comment = '<p class="nocomments">Comments are closed.</p>';
	echo ( apply_filters( 'gidd_comment_off', $comment ) );
}


/** end of comment_hooks.php */