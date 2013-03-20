var $ = jQuery.noConflict();
$(document).ready(function(){

	$( '#view-all-restoo' ).click( function(event){
		event.preventDefault();
		$('#all-restoo').bPopup({ closeClass: 'close_popup' });
	});
	
	
	$( '#view-all-cuisines' ).click( function(event){
	
		event.preventDefault();
		$('#all-cuisines').bPopup({ closeClass: 'close_popup' });
	
	});
	
			
	$('#add_restoo').click( function(event){
	
		event.preventDefault();
		$('#add-restoo').bPopup({ closeClass: 'close_popup' });
	
	});
	
	
	
	// get query string from current url - Method 2
	function getParameterByName(name)
	{
	  name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
	  var regexS = "[\\?&]" + name + "=([^&#]*)";
	  var regex = new RegExp(regexS);
	  var results = regex.exec(window.location.search);
	  if(results == null)
		 return "";
	  else
		 return decodeURIComponent(results[1].replace(/\+/g, " "));
	}
	
	var sent = getParameterByName('sent');
	
	
	if ( sent != '' )
		$( '#req-book' ).bPopup({ closeClass: 'close_popup' });

		
				
	$('img#map').imgAreaSelect({
        
		/*handles: false,
		fadeSpeed: 200,
		persistent: true,
		resize: false,
		minWidth: 200,
		minHeight: 120,
		maxWidth: 200,
		maxHeight: 120,
		onSelectChange: get_preview,
		onInit: get_preview,*/
		
		handles: false,
		fadeSpeed: 200,
		persistent: true,
		//onSelectChange: get_preview,
		onSelectEnd: get_grid,
		//onInit: get_preview,
		resizable: false,
		aspectRatio: '120:80',
		
		x1: 300, y1: 380, x2: 420, y2: 460,
		parent: '#map-ref'
    
	});
	
	
	function get_grid(img, selection){
	
		var x = selection.x1;
		var y = selection.y1;
		
		x = x + 60; //add 60 to make it calculate from the pin
		y = y + 40; // add 40 to make it calculate from the pin
		
		//find the grid number based on selection
		x = 1 + Math.floor(x/120);
		y = 1 + Math.floor(y/60);
		
		switch( y ){
		
			case 1 : y = 'A'; break;
			case 2 : y = 'B'; break;
			case 3 : y = 'C'; break;
			case 4 : y = 'D'; break;
			case 5 : y = 'E'; break;
			case 6 : y = 'F'; break;
			case 7 : y = 'G'; break;
			case 8 : y = 'H'; break;
			case 9 : y = 'I'; break;
			case 10 : y = 'J'; break;
			case 11 : y = 'K'; break;
			case 12 : y = 'L'; break;
			case 13 : y = 'M'; break;
			case 14 : y = 'N'; break;
			case 15 : y = 'O'; break;
			case 16 : y = 'P'; break;
			case 17 : y = 'Q'; break;
			case 18 : y = 'R'; break;
			case 19 : y = 'S'; break;
			case 12 : y = 'T'; break;
			default : y = 'T';
									
		}
		
		var grid = y + x;
		
		
		//alert( grid );
		
		$('#loc').val(grid);
		
		//query restoo based on the grid
		//$.post( 'http://localhost/git/d2d/restoo_tag?tag=' + grid, '', function data( html ){ $('#restoo_by_loc').html( html); } );
		
	}
	
	$('#home_loc').click(function(event){

		event.preventDefault();
		$('#map-ref').bPopup({ closeClass: 'close_popup' });
		
	});
		

	/*$('#featured').smoothDivScroll({
		
	});*/
		

});