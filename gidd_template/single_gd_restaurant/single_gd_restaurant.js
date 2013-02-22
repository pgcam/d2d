var $ = jQuery.noConflict();

$( document ).ready(function(){

	$('#pmap').click(function(event){
		
		event.preventDefault();
		$('#pmap_d2d').bPopup({ closeClass: 'close_popup' });
		
	});
		
	
	$('a.add_to_cart').click(function(event){
	
		event.preventDefault();
		
		var item = $(this).parent().find('h4 span').html();
		item = '<h4>' + item + '</h4>';
		
		var fid = $(this).parent().parent().find('.fid').val();
		
		var addon = $(this).parent().parent().find('.addon-food').html();
		if ( addon != null )
			addon = '<p><input type="checkbox" value="true" name="faddon" /> ' + addon + '</p>';
			
		var addon_price = $(this).parent().find('.addon_price').html();
		//addon_price = addon_price.match(/\d+\.\d+/);
	
	
		var price2 = $(this).parent().find('.food-price-2').html();
		var price3 = $(this).parent().find('.food-price-3').html();
		var price  = $(this).parent().find('.food-price').html();

		
		$('#add-to-cart').find('.cart-item-info').html('');
		$('#add-to-cart').find('.addon').html('');
				
		$('#add-to-cart').find('.cart-item-info').append( item );
		$('#add-to-cart').find('.pfid').val(fid);
		$('#add-to-cart').find('.addon').append( addon );
		$('#add-to-cart').find('.aprice').val( addon_price );
				
		if ( price2 != '' ){
		
			//price = '<span class="price"><input type="radio" name="fprice" value="'+ price.match(/\d+\.\d+/) +'" /> ' + price + '</span>';
			//price2 = '<span class="price2"><input type="radio" name="fprice" value="'+ price2.match(/\d+\.\d+/) +'" /> ' + price2 + '</span>';
		
			price = '<span class="price"><input type="radio" name="fprice" value="food_price" /> ' + price + '</span>';
			price2 = '<span class="price2"><input type="radio" name="fprice" value="food_price2" /> ' + price2 + '</span>';
					
			$('#add-to-cart').find('.multi').append( price );
			$('#add-to-cart').find('.multi').append( price2 );	
		
		}
		
		if ( price3 != '' ){		
			price3 = '<span class="price3"><input type="radio" name="fprice" value="food_price3" />' + price3 + '</span>';
			$('#add-to-cart').find('.multi').append( price3 );
		}
		
		
		$('#single_price').html(price);
		
		$('#add-to-cart').bPopup({ closeClass: 'close_popup' });
		
	});
	
	
	$('.food_photo').click( function(event){	
		event.preventDefault();
				
		var item = $(this).parent().parent().parent().find('.menu-items').html();
		
		$(this).parent().parent().parent().find('.item-content').html('');
		$(this).parent().parent().parent().find('.item-content').append( item );
		
		//$(this).parent().parent().parent().find('.food-pcontent').bPopup();
				
		var id = $(this).attr('rel');
		$('#' + id).bPopup({ closeClass: 'close_popup' });
		
		//adjust the width of box head to display properly
		var w = $('#' + id).find('.popup-head').width();		
		var phmiddle = w - 11;
		$('#' + id).find('.ph-middle').css('width', phmiddle + 'px' );
		
		
	} );
	
	
	//make div always at the bottom of another div while scrolling
	$('#pmap_d2d').scroll(function(){
		
		var bottom = $(this).scrollTop();
		$('#num_overlay').css({ bottom: -bottom + 'px' });
		
	});
	
	
});