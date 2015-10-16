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
	
	<div data-role="header"> 
		<!--<h1> Restaurant Picker</h1>-->
		<a class="btnBack" href="javascript:(history.length > 1) ? history.back() : window.location = 'index.php';" data-transition="slideup"></a>
		<h2 class="text-title">Menu</h2>
	</div> 
	
	<div data-role="content">
	<div class="ui-grid-a" id="restau_infos">	
		<div class="ui-block-a add-bx">	
		<!-- food and location -->
		<?php	
			foreach ($resinfo as $info) {
				if(strtolower($info->name) == $restaurant) {
					$rating = '';
						if($info->rating == 1) 
							$rating = 'one';
						if($info->rating == 2) 
							$rating = 'two';
						if($info->rating == 3) 
							$rating = 'three';
						if($info->rating == 4) 
							$rating = 'four';
						if($info->rating == 1.5) 
							$rating = 'onehalf';
						if($info->rating == 2.5) 
							$rating = 'twohalf';
						if($info->rating == 3.5) 
							$rating = 'threehalf';
		?>		
			
					<h1 class="ftnGotus title-plcOrder"><?php echo $info->name; ?></h1>
					<div id="choisir_restau">
						<p class="classement <?php echo $rating; ?>" style="margin-left: 0px"><?php echo $info->rating; ?></p>
					</div>
					<div class="clbt">
						<!--<p>Location: </p>-->
						<ul class="fl location-brd">
					<?php foreach($info->location as $l) { ?>
							<li> <em class="ico-location fl"></em> <?php echo $l->name; ?></li>
					<?php } ?>
						</ul>
						<!--<p> On the menu: </p>-->
						<ul class="fl menu-brd">
					<?php foreach($info->food as $f) { ?>
							<li><em class="ico-menu fl"></em><?php echo $f->name; ?></li>
					<?php } ?>
						</ul>
					</div>
				<?php	
					break;
				}
			}
		?>	
		</div>
		<!-- end food and location -->		
	</div><!-- /grid-a -->
	<!--<hr/>-->

	<div id="foodlist">
		<!--<div class="flhead">Menu</div>-->
		<div class="flbody">
			<?php 
				$foodname_arr = array();
				$foodlist = '';
				 foreach($info->food as $f) {
				 	if(!empty($f->name)) {
			 			$foodselect = 'Burger'; // set default value
			 			// Sushi
				 		if($f->name === 'Sushi') 
				 			$foodselect = 'Sushi'; 
				 		if($f->name === 'Pho') 
				 			$foodselect = 'Pho';
				 		if($f->name === 'Pizza') 
				 			$foodselect = 'Pizza'; ?>
				 		<ul class="parent-foodlist" id="<?php echo $foodselect;?>">
		 					<?php foreach ($foodinfo->$foodselect->details as $finfo) { ?>
				 					<li class="item-foodlist">
				 					<?php 
				 							// echo $finfo->name; 
				 							// array_push($foodname_arr, $finfo->name); // store food name in array
				 							// $foodlist = implode(',',$foodname_arr);
				 						?>
				 						<ul class="child-foodlist" id="<?php echo $foodinfo->$foodselect->prefix . $finfo->id; ?>">
				 							<?php
			 									array_push($foodname_arr, $finfo->name); // store food name in array
					 							$foodlist = implode(',',$foodname_arr);
				 							?>
						 					<li class="item-foodlist clbt">
						 						<span class="thumb-order"><img src="<?php echo $finfo->image; ?>" alt="" /></span>
						 						<div class="ctn-order-foodlist">
						 							<h4 class="name-foodlist ftnGotus">
 							 							<?php echo $finfo->name; ?>
						 							</h4>
							 						<div id="qty_<?php echo $foodinfo->$foodselect->prefix . $finfo->id; ?>">0</div>
							 						<div id="price_<?php echo $foodinfo->$foodselect->prefix . $finfo->id; ?>">price: <span class="clBrow fntBold">$<?php echo $finfo->price; ?></span></div>
							 						<div class="clbt">
								 						<div class="add-order fr" id="inscr_<?php echo $foodinfo->$foodselect->prefix . $finfo->id; ?>"> <span class="btnAdd"> <em class="icoAdd"></em> </span> </div>
								 						<div class="minus-order fr" id="descr_<?php echo $foodinfo->$foodselect->prefix . $finfo->id; ?>"> <span class="btnAdd btnMinus"><em class="icoAdd"></em></span> </div>
							 						</div>
						 						</div>
						 					</li>
				 						</ul>
				 					</li>	
			 				<?php } ?>
		 				</ul>
			<?php
				 	}
				 }
			?>
		</div>
		<div class="flfooter clbt">
			<hr/>
			<div id="total" class="text-right">Total: <span class="prc-total">$<span class="totalval">0</span></span>
			<span class="textError hidden" id="foodsel_err">No food selected</span>
			</div>
			<div class="clbt">
				<div id="submitOrder" class="fr">Submit</div>
				<div id="resetOrder" class="fr">Reset</div>
			</div>
		</div>	
	</div>

	</div> <!-- /content -->


	
	<script src="js/jquery.cookie.min.js"></script>
	<script src="js/functions.js"></script>
	<!-- client script -->
	<script type="text/javascript">
	// global variable
	var foodnamelength = <?php echo sizeOf($foodname_arr); ?>;
	var restaurantname = "<?php echo rawurlencode(strtolower($restaurant));?>";
	</script>
	<script src="js/showfoodlist.js"></script>
	<!-- end client script -->

</div><!-- /page -->
</body>
</html>