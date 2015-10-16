
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

	<h2 class="titleNormal">Introduction</h2>

		<div class="video-container"><iframe src="//www.youtube.com/embed/QMJh2_2a5TI?autoplay=1" frameborder="0"></iframe></div>
		
	</div> <!-- /content -->


</div><!-- /page -->
</body>
</html>