var $ = jQuery.noConflict();
$(document).ready(function(){
	
	//show the first item by default
	$( '.gidd-tab > .gd-tabitem' ).eq(0).find('a').addClass( 'tab-active' );
	$( '.gidd-tab-wrap .tabitem-content' ).hide();
	$( '.gidd-tab-wrap .tabitem-content' ).eq(0).show();
		
	
	//add click event for tab item
	$('.gidd-tab > .gd-tabitem a').click(function( event ){
		event.preventDefault();
		
		$( '.gidd-tab .gd-tabitem a' ).removeClass( 'tab-active' );
		$( '.gidd-tab .gd-tabitem a' ).removeClass( 'gd-tabitem-first' );
		$(this).addClass( 'tab-active' );
		
		var ind = $(this).parent().index();
		$( '.gidd-tab-wrap .tabitem-content' ).hide();
		$( '.gidd-tab-wrap .tabitem-content' ).eq(ind).show();
		
	});
	
});