$( document ).live( 'pageinit','body', function(event){
	$('#reset').click(function() { refreshPage(); });
	function refreshPage() {
	  $.mobile.changePage(
	    window.location.href,
	    {
	      allowSamePageTransition : true,
	      transition              : 'none',
	      showLoadMsg             : false,
	      reloadPage              : true
	    }
	  );
	}
	// check the same as delivery address or different address
	$('#sameadd').click( function(){
		if($('#sameadd').is(':checked')) 
			$('#dlvinfo').addClass('hidden');
		else
			$('#dlvinfo').removeClass('hidden');
	});

	// check credit card realtime
	$('#ccard').on('keyup', function() {
		var val = $('#ccard').val();
		var cardtype = detectCardType(val);
		$('#isAmex, #isVisa, #isMaster, #isDisc').attr('class', 'icoPayment');
		if(cardtype === 'VISA') {
			$('#isAmex, #isMaster, #isDisc').addClass('low-opacity');
		}
		if(cardtype === 'MASTERCARD') {
			$('#isAmex, #isVisa, #isDisc').addClass('low-opacity');
		}
		if(cardtype === 'AMEX') {
			$('#isVisa, #isMaster, #isDisc').addClass('low-opacity');
		}
		if(cardtype === 'DISCOVER') {
			$('#isAmex, #isMaster, #isVisa').addClass('low-opacity');
		}
	});

	// Reset
	$('#resetPayment').click(function(){
		$('input').val('');
	});

	// Submit
	$('#submitPayment').click(function(){		
		$.removeCookie('Daddress');

		var fullname = $('#fullname').val();
		var address = $('#address').val();
		var phoneno = $('#phoneno').val();
		var ccard = $('#ccard').val();
		var cmonth = $('#cmonth').val();
		var cyear = $('#cyear').val();
		
		var deliveryinfo = '';

		if(!$('#sameadd').is(':checked')) {
			fullname = $('#dfullname').val() ? $('#dfullname').val() : fullname;
			address = $('#daddress').val() ? $('#daddress').val() : address;
			phoneno = $('#dphoneno').val() ? $('#dphoneno').val() : phoneno;
		}
		
		// validator
		var fullnamevalid = inputValidation(3, '#fullname', 'hidden');
		var addressvalid = inputValidation(3, '#address', 'hidden');
		var phonenovalid = inputValidation(6, '#phoneno', 'hidden');
		var ccardvalid = inputValidation(16, '#ccard', 'hidden');
		var ccvvalid = inputValidation(3, '#ccv', 'hidden');
		var cardtypevalid = detectCardType(ccard);
		
		// check credit card info
		// check card type
		if(ccardvalid)
			if(!cardtypevalid)
				$('#ccard_err').removeClass('hidden');
			else
				$('#ccard_err').addClass('hidden');
		
		var cmonthvalid = (cmonth > 0 && cmonth <= 12 && cmonth.length == 2) ? true : false;
		var cyearvalid = (cyear > 0 && cyear.length == 2) ? true : false;
		
		if(!cmonthvalid || !cyearvalid){
			if($('#expdate_err').hasClass('hidden'))
				$('#expdate_err').removeClass('hidden');
		}else
			$('#expdate_err').addClass('hidden');
		
		// get deliveryinfo
		deliveryinfo = fullname + '@@'  + address + '@@' + phoneno;

	  	// save delivery address cookie
	  	$.cookie('deliveryinfo', deliveryinfo, { expires: 1, path: '/' });// set total at the last of string
	  	
	  	if(fullnamevalid && addressvalid && phonenovalid && ccardvalid && ccvvalid && cardtypevalid && cmonthvalid && cyearvalid)	
		 	$.mobile.changePage('receipt.php?rn=' + restaurantname, { transition: 'slidedown', reverse: true });
	});
	
	// limit number input in cardno, phoneno, ccv, expiry date input
	$('#phoneno, #ccard, #ccv, #cmonth, #cyear, #dphoneno').on('keypress keyup blur',function (event) {    
		var valwExp = $(this).val().replace(/[^\d].+/, '');
        $(this).val(valwExp);
        if ((event.which < 48 || event.which > 57)) {
           event.preventDefault();
        }
    });
});