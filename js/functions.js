
	// get total by given arrays and selected length of different array that less than 2 given ones
	// eg: selected food array & qty array, price arr
	// params: quanlity, price unit, custom length
	// return total by formular sum of (qty * price)
	function gettotal(length, _qty_arr, _price_arr) {
	  	var total = 0;
	  	for(var i = 0; i < length; i++){
	  		total += _price_arr[i] * _qty_arr[i];
	  	}
	  	return total;
	}

    // search all index of arrays by given value
    // param: array, value to detect
    // return: array[]
	function findIndexesByVal(arr, eleVal) {
		var ret = [];
		for(var i = 0; i < arr.length; i++){
			if(eleVal == arr[i])
				ret.push(i);
		}
		return ret
	}
	
	// detect credit card type
	// param: card number
	// return: card type or false
	function detectCardType(number) {
	    var l = {
	        visa: /^4[0-9]{12}(?:[0-9]{3})?$/,
	        mastercard: /^5[1-5][0-9]{14}$/,
	        amex: /^3[47][0-9]{13}$/,
	        discover: /^6(?:011|5[0-9]{2})[0-9]{12}$/
	    };

		if (l.visa.test(number)) 
	        return 'VISA';
	    if (l.mastercard.test(number)) 
	        return 'MASTERCARD';
	    if (l.amex.test(number)) 
	        return 'AMEX';
	    if (l.discover.test(number)) 
	        return 'DISCOVER';

	    return false;
	}
	
	// field validation
	// param: maxlength, selected input, class's name
	// return: boolean (true/false)
	function inputValidation (_length, _targetid, hiddenclass){
		// initialize input
		_length = _length || 1;
		_targetid = _targetid || '#blank';
		hiddenclass = hiddenclass || 'hidden';
		
		var isValid = true;
		var errorid = _targetid + '_err';
		var _targetVal = $(_targetid).val() || '';
		if(_targetVal.length < _length) {
			if($(errorid).hasClass(hiddenclass))
				$(errorid).removeClass(hiddenclass);
			isValid	= false;
		}else
			$(errorid).addClass(hiddenclass);
		return isValid;
	}
