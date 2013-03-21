var $ = jQuery.noConflict();
$(document).ready(function(){

	function get_preview(img, selection) {
		if (!selection.width || !selection.height)
			return;
		
		var scaleX = 300 / selection.width;
		var scaleY = 328 / selection.height;

		$('#preview img').css({
			width: Math.round(scaleX * 1300),
			height: Math.round(scaleY * 1691),
			marginLeft: -Math.round(scaleX * selection.x1),
			marginTop: -Math.round(scaleY * selection.y1)
		});

		$('#x1').val(selection.x1);
		$('#y1').val(selection.y1);
		$('#x2').val(selection.x2);
		$('#y2').val(selection.y2);
		$('#w').val(selection.width);
		$('#h').val(selection.height);    
	}

	$('img#map').imgAreaSelect({
        			
		handles: false,
		fadeSpeed: 200,
		persistent: true,
		onSelectChange: get_preview,
		//onSelectEnd: get_grid,
		onInit: get_preview,
		resizable: false,
		aspectRatio: '300:328',
		
		x1: 300, y1: 380, x2: 420, y2: 460,
		parent: '#map-ref'
    
	});
	
	$('img#r2map').imgAreaSelect({
        			
		handles: false,
		fadeSpeed: 200,
		persistent: true,
		onSelectChange: get_preview,
		//onSelectEnd: get_grid,
		onInit: get_preview,
		resizable: false,
		aspectRatio: '300:328',
		
		x1: 300, y1: 380, x2: 420, y2: 460,
		parent: '#map-ref2'
    
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
		
		$('#loc').val(grid);
		
		//query restoo based on the grid
		//$.post( 'http://localhost/git/d2d/restoo_tag?tag=' + grid, '', function data( html ){ $('#restoo_by_loc').html( html); } );
		
	}
	
	$('#map1').click(function(event){
		event.preventDefault();
		$('#addr').val('map1');
	});
	
	$('#map2').click(function(event){
		event.preventDefault();
		$('#addr').val('map2');
	});
	
	
	
	$('.map_loc').click(function(event){
		
		event.preventDefault();
		var id = $(this).attr('id');
		
		$('#map-ref').bPopup({ closeClass: 'save_thumb', onClose: function(){
				
			var x1 = $('#map-ref #x1').val();
			var y1 = $('#map-ref #y1').val();
			var x2 = $('#map-ref #x2').val();
			var y2 = $('#map-ref #y2').val();
			var w = $('#map-ref #w').val();
			var h = $('#map-ref #h').val();
			var addr = $('#map-ref #addr').val();
	
			var loc = x1 + ',' + y1 + ',' + x2 + ',' + y2 + ',' + w + ',' + h + ',' + addr;
			
			if ( id == 'map1'){
				$('.mloc1').val( loc );
			}else{
				$('.mloc2').val( loc );
			}
								
		}


		});
		
	});
	


});