var $ = jQuery.noConflict();
$(document).ready(function(){
		
	$( '.feedback_item a' ).click( function(event){
	
		event.preventDefault();
		$('#contact_form').bPopup({ closeClass: 'close_popup' });
					
	});
	
	$('.aboutmenu').click(function(event){
	
		event.preventDefault();
		$('#about-d2d').bPopup({ closeClass: 'close_popup' });
	
	});
	
	$('.termmenu').click(function(event){
	
		event.preventDefault();
		$('#term-condition').bPopup({ closeClass: 'close_popup' });
	
	});
		
	$('.add_restoo_footer a').click( function(event){
	
		event.preventDefault();
		$('#add-restoo').bPopup({ closeClass: 'close_popup' });
	
	});
	
	
	$('.close_popup').click(function(event){
		event.preventDefault();	
	});

});