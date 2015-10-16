    var total = 0;
	$( '#restau' ).live( 'pageinit',function(event){
        
		// Increase
		$( '#foodlist .parent-foodlist li ul li .ctn-order-foodlist .add-order' ).click (function () {
		  	var fid = $(this).attr('id').substring(6);
		  	var curVal = $('#qty_' + fid).text();
		  	var newVal = (curVal < 9999) ? parseInt(curVal) + 1 : 9999;
		  	// update quantity
		  	$('#qty_' + fid).text(newVal);
		  	
		  	// get price
		  	var price_arr = [];
		  	$('div[id^="price_"]').each(function(i, el){
		  		price_arr.push(el.textContent.substring(8));
			});	
		  	
		  	// get quantity
  		  	var qty_arr = [];
  		  	$('div[id^="qty_"]').each(function(i, el){
		  		qty_arr.push(el.textContent);
			});	
		  	console.log(foodnamelength);
			// recalculate total & update total 
		  	total = gettotal(foodnamelength, qty_arr, price_arr);
			$('.totalval').text(total);
		  });

		  // Decrease
		$( '#foodlist .parent-foodlist li ul li .ctn-order-foodlist .minus-order' ).click (function () {
		  	var fid = $(this).attr('id').substring(6);
		  	var curVal = $('#qty_' + fid).text();
		  	var newVal = (curVal > 0) ? parseInt(curVal) - 1 : 0;	  	
			$('#qty_' + fid).text(newVal); 
			
			// get price
		  	var price_arr = [];
		  	$('div[id^="price_"]').each(function(i, el){
		  		price_arr.push(el.textContent.substring(8));
			});	
		  	
		  	// get quantity
  		  	var qty_arr = [];
  		  	$('div[id^="qty_"]').each(function(i, el){
		  		qty_arr.push(el.textContent);
			});	
		  	
			// recalculate total & update total 
		  	total = gettotal(foodnamelength, qty_arr, price_arr);
			$('.totalval').text(total); 
		  });

	});
	
	// Reset
	$('#resetOrder').click(function(){
		$('*[id^="qty_"]').text(0); // reset quanlity
		$('.totalval').text(0); // reset total
	});

	// Submit
	$('#submitOrder').click(function(){		
		$.removeCookie('qty');
		$.removeCookie('resname');
		var qty_arr = [];
		var countzero = 0;
	  	$('div[id^="qty_"]').each(function(i, el){
	  		qty_arr.push(el.textContent);
	  		if(el.textContent == 0)
	  			countzero++;
		});
		if(countzero < qty_arr.length) {
			if(!$('#foodsel_err').hasClass('hidden'))
				$('#foodsel_err').addClass('hidden');
			var qty = qty_arr.join(','); // convert array to string
		  	// save qty cookie
		  	$.cookie('qty', qty + ',' + total);// set total at the last of string
		  	$.cookie('resname', restaurantname);// set restaurant name to prevent exploit by GET method
		  	$.mobile.changePage('payment.php?rn=' + restaurantname, { transition: 'slideup', reverse: true });
		}else
			$('#foodsel_err').removeClass('hidden');
	});

