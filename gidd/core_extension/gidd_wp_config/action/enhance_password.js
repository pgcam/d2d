var $ = jQuery.noConflict();
$(document).ready(function(){

//focus and blur to change default value
	$('#user_login').each(function() {
		 var default_value = this.value;
		 $(this).css('color', '#666'); // this could be in the style sheet instead
		 $(this).focus(function() {
			  if(this.value == default_value) {
					this.value = '';
					$(this).css('color', '#666');
			  }
		 });
		 $(this).blur(function() {
			  if(this.value == '') {
					$(this).css('color', '#666');
					this.value = default_value;
			  }
		 });
	});
	
	
	//focus and blur for password field
	$('#user_pass_clear').parent().show();
	 $('#user_pass_clear').css('color', '#666');
	$('#user_pass').parent().hide();

	$('#user_pass_clear').focus(function() {
		 $('#user_pass_clear').parent().hide();
		 $('#user_pass').parent().show();
		 $('#user_pass').focus();
		 $(this).css('color', '#666');
	});
	$('#user_pass').blur(function() {
		 if($('#user_pass').val() == '') {
			  $('#user_pass_clear').parent().show();
			  $('#user_pass').parent().hide();
			  $(this).css('color', '#666');
		 }
	});

});
