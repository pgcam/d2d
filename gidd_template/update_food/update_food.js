jQuery(document).ready(function($){

	$('.newattr').click(function(event){
		event.preventDefault();
		 
		 var group = $(this).attr('id');
		 var input = '<input type="text" name="attribute_'+ group +'[]" value="" /><a class="trash" href="#"></a><div class="clearBoth"></div>';
		 input = '<p class="attribute">' + input + '</p>';
		 $(this).parent().append(input);
	});
	
	$('a.trash').click(function(event){
		event.preventDefault();
		$(this).parent().remove();
	
	});

});