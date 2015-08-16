<!--Student Name: Thanh Nhan Nguyen
	Student ID: 212540002
-->
<?php
	$food = $_GET['f'];
	$loc = $_GET['l'];
	$food = empty($food) ? '' : $food;
	$loc = empty($loc) ? '' : $loc;
	$url = './db/data.json';
	$str = file_get_contents($url);
	// decode json
	$data = json_decode($str, false);
	$resinfo = $data->restaurant;
	$res = array();
	
	foreach ($resinfo as $info) {
		foreach ($info->food as $f){
			if(strtolower($f->name) == $food) {
				foreach($info->location as $l) {
					if(strtolower($l->name) == $loc)
						array_push($res, $info->name); // push restaurant name to location array
				}
			}
		}
	}
	$res = array_unique($res); // remove duplicated value
	$res = array_merge($res); // reset key


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
<div id="choisir_restau" data-role="page" data-add-back-btn="true">
	
	<div data-role="header"> 
		<h1> Restaurant Picker</h1>
	</div> 

	<div data-role="content">
	
	<div class="choice_list"> 
	<h1> Please choose a restaurant.</h1>
	
	<ul data-role="listview" data-inset="true" >
	<!--<li><a href="restaurant.html" data-transition="slidedown"> <img src="restau01_mini.jpg"/> <h2> Le Mouffetard</h2> <p class="classement four"> 4 stars  </p></a></li>-->
	<?php foreach($res as $n) { ?>
			<li>
			<a href="showresinfo.php?rn=<?php echo rawurlencode(strtolower($n)); ?>" data-transition="slidedown">
			<?php foreach ($resinfo as $info) {
				if(strtolower($info->name) == strtolower($n)) {
					// img
					foreach($info->shop_img as $i_img) {
						if(strtolower($info->name) == strtolower($n)) {
			?>
							<img src="./img/<?php echo $i_img->small ?>"/>
			<?php
							break;
						}
					}
			?>
					<!-- title -->
					<h2><?php echo $n; ?></h2>
			<?php
					// rating
					if($info->rating != 0 && $info->rating != '') {
						if($info->rating == 1) {
			?>
							<p class="classement one"> 1 star  </p>
						<?php }?>				
				<?php	if($info->rating == 2) { ?>
							<p class="classement two"> 2 stars  </p>
				<?php 	} ?>					
				<?php	if($info->rating == 3) { ?>
							<p class="classement three"> 3 stars  </p>
				<?php 	} ?>								
				<?php	if($info->rating == 4) { ?>
							<p class="classement four"> 4 stars  </p>
				<?php 	} ?>								
				<?php	if($info->rating == 1.5) { ?>
							<p class="classement onehalf"> 1.5 star  </p>
				<?php 	} ?>								
				<?php	if($info->rating == 2.5) { ?>
							<p class="classement twohalf"> 2.5 stars  </p>
				<?php 	} ?>								
				<?php	if($info->rating == 3.5) { ?>
							<p class="classement threehalf"> 3.5 stars  </p>
				<?php 	} ?>								
			<?php
					}
					//break;
				}
			}
			?>
			</a></li>
	<?php } ?>
	</ul>	
	
	</div>
	</div>

</div><!-- /page -->
</body>
</html>
