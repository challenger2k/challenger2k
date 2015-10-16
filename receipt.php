<?php
	$restaurant = $_GET['rn'];
	$restaurant = empty($restaurant) ? '' : $restaurant;
	$url = './db/data.json';
	$str = file_get_contents($url);
	// decode json
	$data = json_decode($str, false);
	$resinfo = $data->restaurant;

	// food db
	$url = './db/foods.json';
	$str = file_get_contents($url);
	// decode json
	$data = json_decode($str, false);
	$foodinfo = $data->foods;
	
	// get cookie
	$qty = !empty($_COOKIE['qty']) ? $_COOKIE['qty'] : '';
	$deliverinfo = !empty($_COOKIE['deliveryinfo']) ? $_COOKIE['deliveryinfo'] : 'N/A@@N/A@@N/A';// set N/A as default if info is empty
	$resnameck = $_COOKIE['resname'];
	// get quantity and total process
	$qty_arr = explode(',', $qty);
	$total = $qty_arr[sizeOf($qty_arr) - 1 ];
	array_pop($qty_arr); // remove total element in qty array

	// get delivery info
	$deliverinfo_arr = explode('@@', $deliverinfo);

	// get foodname and price list
	$foodname_arr = array();
	$price_arr = array();
	foreach ($resinfo as $info) { 
		if(strtolower($info->name) == $restaurant) {
			foreach($info->food as $f) { 
				$foodselect = 'Burger'; // set default value
	 			// Sushi
		 		if($f->name === 'Sushi') 
		 			$foodselect = 'Sushi'; 
		 		if($f->name === 'Pho') 
		 			$foodselect = 'Pho';
		 		if($f->name === 'Pizza') 
		 			$foodselect = 'Pizza'; 
		 		
	 			foreach ($foodinfo->$foodselect->details as $finfo) {
					array_push($foodname_arr, $finfo->name);						 					
					array_push($price_arr, $finfo->price);	
 				}
			}
		}
	}
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
<div id="restau" class="receipt" data-role="page" data-add-back-btn="false">
<?php if (rawurldecode($resnameck) == $restaurant) { ?>			
	<div data-role="header"> 
		<!--<a class="btnBack" href="javascript:(history.length > 1) ? history.back() : window.location = 'index.php';" data-transition="slideup"></a>-->
		<a class="btn-home" href="index.php" data-transition="slideup"></a>
		<a class="btn-order" href="showfoodlist.php?rn=<?php echo rawurlencode(strtolower($restaurant));?>" data-transition="slideup"></a>
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

	<h2 class="titleNormal">Receipt</h2>

	<?php 	
		for($i = 0; $i < sizeOf($foodname_arr); $i++) {
			if($qty_arr[$i] != 0) { ?>
			<div class="full-col">
				<h4 class="titleSm"><?php echo $foodname_arr[$i];?></h4>
			</div>
			<ul class="lstNormal">
				<li class="clbt">
					<!--<div class="half-col">qty: </div>-->
					<div class="full-col text-right">
						<span class="priceReceipt">$<?php echo $price_arr[$i];?></span> 
						x 
						<span class="qtyReceipt"><?php echo $qty_arr[$i];?> </span>
					</div>
				</li>
				<!--<li class="clbt">
					<div class="half-col">price: </div>
					<div class="half-col"></div>
				</li>-->
				<li class="clbt">
					<div class="full-col text-right">
						<span class="priceReceipt">subtotal:</span>
						<span class="fntBold qtyReceipt">$<?php echo $price_arr[$i] * $qty_arr[$i];?></span>
					</div>
				</li>
			</ul>
		<?php } 
	}?>
	<h3 class="colorRed sumTotal text-right">total: <span class="inner-total">$<?php echo $total; ?></span></h3>
	<hr/>
	<h2 class="titleNormal">Delivery to</h2>
	<ul class="lstNormal">
		<li class="clbt">
			<div class="half-col">Full name: </div>
			<div class="half-col"><?php echo $deliverinfo_arr[0]; ?></div>
		</li>
		<li class="clbt">
			<div class="half-col">Address: </div>
			<div class="half-col"><?php echo $deliverinfo_arr[1]; ?></div>
		</li>
		<li class="clbt">
			<div class="half-col">PhoneNo:</div> 
			<div class="half-col"><?php echo $deliverinfo_arr[2]; ?></div>
		</li>
	</ul>
	<h3 class="mg-topbottom">Thank you, We will ring you asap!</h3>
	<!--<a class="btnBackHome clGrey" href="index.php">Make another order</a>-->
	</div> <!-- /content -->

<?php } else { ?>
	<div data-role="header"> 
		<a class="btn-home" href="index.php" data-transition="slideup"></a>
		<a class="btn-order" href="showfoodlist.php?rn=<?php echo rawurlencode(strtolower($restaurant));?>" data-transition="slideup"></a>
		<h1> Restaurant Picker</h1>
	</div> 
	<h2 class="titleSorry">Sorry, no food selected</h2>
<?php } ?>
</div><!-- /page -->
</body>
</html>