<?php
	$restaurant = $_GET['rn'];
	$restaurant = empty($restaurant) ? '' : $restaurant;
	$url = './db/data.json';
	$str = file_get_contents($url);
	// decode json
	$data = json_decode($str, false);
	$resinfo = $data->restaurant;
	
	
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
		<a class="btnBack" href="javascript:(history.length > 1) ? history.back() : window.location = 'index.php';" data-transition="slideup"></a>
		<h1> Restaurant Picker</h1>
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
			
					<h1><?php echo $info->name; ?></h1>
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
		<a class="btn-order" href="showfoodlist.php?rn=<?php echo rawurlencode(strtolower($restaurant)); ?>" data-transition="slidedown"></a>
		</div>
		<!-- end food and location -->
		<!-- shop image & website -->
		<div class="ui-block-b map-nx">
		<?php
			foreach($resinfo as $info) {
				if(strtolower($info->name) == $restaurant) {
					foreach($info->shop_img as $img) {
		?>
						<p><img src="./img/<?php echo $img->big; ?>" alt="jeannette photo" class="resinfo_img"/></p>
		<?php
						break;
					}
				}
			}
		?>
		<p>
			<?php
				
				foreach($resinfo as $info) {
					if(strtolower($info->name) == $restaurant) {
			?>
						<a class="btnLightBlue" href="<?php echo $info->website; ?>" rel="external" data-role="button"> See our website</a>
			<?php
						break;
					}
				}
			?>
		</p>
		</div>
		<!-- end shop image & website -->
	</div><!-- /grid-a -->
	<div class="topShoresinfo">
	<div class="ui-grid-a" id="contact_infos">	
		<h2> Contact us</h2>
		<!--<div class="ui-block-a">
		<h2> Contact us</h2>
		<p>30 Rue des Tonneliers</p>
		<p> 67000 Strasbourg	</p>-->	
		<?php
			$tel = '';
			foreach($resinfo as $info) {
				if(strtolower($info->name) == $restaurant) {
					$tel = $info->tel;
					foreach($info->location as $l) {
		?>
						<div class="ui-block-a add-bx">
						<?php echo $l->name; ?> 
						<br/>  
						<?php echo $l->address; ?>
						</div>
						<div class="ui-block-b map-nx">
						<iframe src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCQxAXTFtrDosDF34pM5ss_5JlMWm-Uxtw&q=<?php echo $l->address; ?>" frameBorder="0" width="300" height="240"></iframe>
						</div>
		<?php
					}
					break;
				}
			}
		?>
		<!--<div class="ui-block-b">
		<img src="01_maps.jpg" alt="plan jeanette"/>
		</div>-->
	</div><!-- /grid-a -->
	<div id="contact_buttons">
		<!--<a href="http://maps.google.fr/maps?q=jeannette+et+les+cycleux&hl=fr&sll=46.75984,1.738281&sspn=10.221882,18.764648&hq=jeannette+et+les+cycleux&t=m&z=13&iwloc=A" data-role="button" data-icon="maps"> Find us on Google Maps </a> 	-->
		<a class="btnBlue clRed" href="tel:<?php echo $tel ?>"  data-role="button" data-icon="tel"> Call us </a>	
	</div>
	<hr/>
	<div id="commentbox">
		<?php
			foreach($resinfo as $info) {
				if(strtolower($info->name) == $restaurant) {
					foreach($info->comment as $i) {
						$rating = '';
						if($i->rating == 1) 
							$rating = 'one';
						if($i->rating == 2) 
							$rating = 'two';
						if($i->rating == 3) 
							$rating = 'three';
						if($i->rating == 4) 
							$rating = 'four';
						if($i->rating == 1.5) 
							$rating = 'onehalf';
						if($i->rating == 2.5) 
							$rating = 'twohalf';
						if($i->rating == 3.5) 
							$rating = 'threehalf';
		?>
						<div class="grp-cmt">
							<div class="clbt author-cmt">
								<div class="name-cmt fl fntBold clDark"><?php echo $i->name; ?></div>
								<div id="choisir_restau" class="rating-cmt fr">
									<p class="classement <?php echo $rating; ?>" style="margin-left: 0px"><?php echo $i->rating; ?></p>
								</div>
							</div>
							<div class="text-cmt"><?php echo $i->text; ?></div>
						</div>
		<?php
					}
				}
			}
			
		?>
	</div>
	<div id="notation">	
	<form id="commentfrm"  data-ajax="false">
	<label for="select-choice-0" class="select"><h2 class="titleNormal"> User rating </h2></label>
		<select id="note_utilisateur" data-native-menu="false" data-theme="c" name="rating">
		   <option value="1" class="one"> Not good at all </option>
		   <option value="2" class="two">Average </option>
		   <option value="3" class="three">Pretty good </option>
		   <option value="4" class="four"> Excellent </option>
		</select>
		<input class="bgWhite" type="text" placeholder="Enter your name here!" name="author" id="txtauthor"/>
		<span class="textError hidden" id="txtauthor_err">Required field</span>
		<input type="hidden" name="rn" value="<?php echo rawurlencode($restaurant); ?>"/>
		<textarea class="bgWhite" rows="4" name="comment" placeholder="Enter your comment here!" id="txtcomment"></textarea>
		<span class="textError hidden" id="txtcmt_err">Required field</span>
		<input class="btn-submit" type="submit" name="submit" value="Submit" id="commentsubmit">
	</form>
	</div>
	</div>


	<script type="text/javascript">

	$( '#restau' ).live( 'pageinit',function(event){
		var SelectedOptionClass = $('option:selected').attr('class');
		$('div.ui-select').addClass(SelectedOptionClass);
		
		$('#note_utilisateur').live('change', function(){	 
			$('div.ui-select').removeClass(SelectedOptionClass);
			
			SelectedOptionClass = $('option:selected').attr('class');
			$('div.ui-select').addClass(SelectedOptionClass);		
			
		 });
		
	  
	});

	

	// submit form
	$('#commentfrm').on('submit', function(e){  

		e.preventDefault();

		var formData = $('#commentfrm').serialize();
		var txtauthor = $('#txtauthor').val();
		var txtcmt = $('#txtcomment').val();
		if(txtauthor !== '' & txtcmt !== '') {
			$.ajax({
				type: 'POST',
				url: './comment.php?do=add',
				cache: false,
				data: formData,
				success: function (ret) {
					//alert('Thank you!!');
					location.reload();
				},
				error: function (request,error) {
					alert('Network error has occurred please try again!');
				}        

			});    
		}
		
		if(txtauthor === '')
			if($('#txtauthor_err').hasClass('hidden'))
				$('#txtauthor_err').removeClass('hidden');
			
		if(txtcmt === '')
			if($('#txtcmt_err').hasClass('hidden'))
				$('#txtcmt_err').removeClass('hidden');	
		
		return false;
	});
	</script>
	

	</div>


</div><!-- /page -->
</body>
</html>