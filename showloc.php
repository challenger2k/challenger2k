<?php
	$food = empty($_GET['f']) ? '' : $_GET['f'];
	$url = './db/data.json';
	$str = file_get_contents($url);
	// decode json
	$data = json_decode($str, false);
	$resinfo = $data->restaurant;
	$location = array();
	
	foreach ($resinfo as $info) {
		foreach ($info->food as $f){
			if(strtolower($f->name) == $food) {
				foreach($info->location as $l){
					array_push($location, $l->name); // push location name to location array
				}
			}
		}
		
	}
	$location = array_unique($location); // remove duplicated value
	$location = array_merge($location); // reset key
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
<div id="choisir_ville" data-role="page" data-add-back-btn="false">
	
	<div data-role="header"> 
		<a class="btnBack" href="javascript:(history.length > 1) ? history.back() : window.location = 'index.php';" data-transition="slideup"></a>
		<h1> Restaurant Picker</h1>
	</div> 

	<div data-role="content">
	
	<div class="choice_list"> 
	<h1> In which town do you want to eat? </h1>
	
	<ul class="parent-foodlist" data-role="listview" data-inset="true" data-filter="true"  class="ctown">
		<!--<li><a href="choose_restaurant.html"  data-transition="slidedown"> Amiens <span class="ui-li-count" > 3 </span></a> </li>-->
		<?php foreach($location as $locname) { ?>
				<li class="item-foodlist">
				<a href="showres.php?f=<?php echo $food; ?>&l=<?php echo strtolower($locname) ?>"  data-transition="slidedown">
				<?php echo $locname;?>
				<!--<span class="ui-li-count" > 3 </span>-->
				</a>
				</li>
		<?php } ?>
	</ul>
	</div>
	
	</div>

</div><!-- /page -->
</body>
</html>