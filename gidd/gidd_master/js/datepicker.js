jQuery(document).ready(function( $ ){
	$('.gd-datepicker').datepicker({
		dateFormat: 'yy-mm-dd',
		//altField: '.gd-datepicker',
		//altFormat: 'MM dd, yy',
		showOn: "focus",
		buttonText: "",
		changeMonth: true,
		changeYear: true,
	});
	
	$('.gd-datepicker').prop( 'readonly', true );
});