<?php
	$restaurant = $_GET['rn'];
	$restaurant = empty($restaurant) ? '' : $restaurant;
	$url = './db/data.json';
	$str = file_get_contents($url);
	// decode json
	$data = json_decode($str, false);
	$resinfo = $data->restaurant;
	
	$resnameck = $_COOKIE['resname'];
?>
<!DOCTYPE html> 
<html> 
<head> 
	<meta charset="UTF-8">
	<title>Restaurant Picker</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="jquery.mobile.structure-1.0.1.css" />
	<link rel="apple-touch-icon" href="images/launch_icon_57.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="images/launch_icon_72.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="images/launch_icon_114.png" />
	<link rel="stylesheet" href="jquery.mobile-1.0.1.css" />
	<link rel="stylesheet" href="custom.css" />
	<script src="js/jquery-1.7.1.min.js"></script>
	<script src="js/jquery.mobile-1.0.1.min.js"></script>
</head> 
<body> 

<div id="restau" data-role="page" data-add-back-btn="false">
<?php if (rawurldecode($resnameck) == $restaurant) { ?>		
	<div data-role="header"> 
		<a class="btnBack" href="javascript:(history.length > 1) ? history.back() : window.location = 'index.php';" data-transition="slideup"></a>
		<h1> Restaurant Picker</h1>
	</div> 

	<div data-role="content">
	<div class="ui-grid-a" id="restau_infos">	
		<div class="ui-block-a add-bx">	
		
		</div>
		
		<div class="ui-block-b map-nx">

		</div>

	</div><!-- /grid-a -->
	<!--<hr/>-->
	
	<div class="ui-grid-a" id="contact_infos">	
		
	</div><!-- /grid-a -->

	<h2 class="title-lg">Payment Information</h2>
	<input class="ipRestau" id="fullname" type="text" value="" placeholder="Full name"/>
	<span class="textError hidden" id="fullname_err">Required field!</span>
	
	<input class="ipRestau" id="address" type="text" value="" placeholder="Address"/>
	<span class="textError hidden" id="address_err">Required field!</span>
	
	<input class="ipRestau" id="phoneno" type="text" value="" maxlength="12" placeholder="Phone number"/>
	<span class="textError hidden" id="phoneno_err">Required field!</span>
	
	<input class="ipRestau" id="ccard" type="text" value="" maxlength="16" placeholder="Credit card number"/>
	<span class="textError hidden" id="ccard_err">CardNo is invalid. Visa, Mastercard, Discovery, Amex are allowed.<br/>eg: 4111111111111111 or 5555555555554444</span>
	
	<div class="logoPayment clbt">
		<span id="isVisa" class="icoPayment"><img src="img/visa-visa.jpg"></img></span>
		<span id="isAmex" class="icoPayment"><img src="img/visa-america.jpg"></img></span>
		<span id="isMaster" class="icoPayment"><img src="img/visa-master.jpg"></img></span>
		<span id="isDisc" class="icoPayment"><img src="img/visa-discover.jpg"></img></span>
	</div>
	
	<input class="ipRestau" id="ccv" type="text" value="" size="3" maxlength="3" placeholder="CCV"/>
	<span class="textError hidden" id="ccv_err">16 digits in length!</span>
	
	<p class="clDark"> Expiry date (mm/yy):</p> 
	<input class="ipRestau" id="cmonth" type="text" value="" size="2" maxlength="2" placeholder="mm"/>
	<input class="ipRestau" id="cyear" type="text" value="" size="2" maxlength="2" placeholder="yy"/>
	<span class="textError hidden" id="expdate_err">Date is invalid! eg: 09/11</span>
	
	<p class="clDark">Delivery to the same address?</p>
	<label for="sameadd" class="clDark checkRestau">Yes</label>
	<input class="hide-opacity" type="checkbox" name="delivery" value="sameadd" id="sameadd">
	<div id="dlvinfo">
	<hr/>
	<h2 class="title-lg">Delivery Information</h2>
	<input class="ipRestau" id="dfullname" type="text" value="" placeholder="Full name"/>
	<input class="ipRestau" id="daddress" type="text" value="" placeholder="Address"/>
	<input class="ipRestau" id="dphoneno" type="text" value="" maxlength="12" placeholder="Phone number"/>
	</div>
	
	<div class="clbt">
		<a class="fr btnSubmit" href="#"  id="submitPayment"data-transition="slidedown">Submit</a>
		<a class="fr btnReset" href="#"  id="resetPayment">Reset</a>
	</div>

	</div> <!-- /content -->


<script src="js/jquery.cookie.min.js"></script>
<script src="js/functions.js"></script>
<!-- client script -->
<script type="text/javascript">
var restaurantname = "<?php echo rawurlencode(strtolower($restaurant)); ?>";
</script>
<script src="js/payment.js"></script>
<!-- end client script -->
<?php } else { ?>
	<div data-role="header"> 
		<a class="btn-home" href="index.php" data-transition="slideup"></a>
		<a class="btn-order" href="showfoodlist.php?rn=<?php echo rawurlencode(strtolower($restaurant));?>" data-transition="slideup"></a>
		<h1> Restaurant Picker</h1>
	</div> 
	<h2 class="clDark titleSorry">Sorry, no food selected</h2>
<?php } ?>
</div><!-- /page -->
</body>
</html>