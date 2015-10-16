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
<div data-role="page" id="home" data-theme="c">

	<div data-role="content">
	
	<div id="branding">
		<h1>Restaurant Picker </h1>
		<a class="info" href="intro.php"><span class="icoInfo"></span></a>
	</div>
	
	<div class="choice_list"> 
	<h1> What would you'd like to eat? </h1>
	
	<ul data-role="listview" data-inset="true" class="reshome">
		<li>
			<a class="shushi-hp" href="showloc.php?f=sushi" data-transition="slidedown"> 
			<!--<img src="./img/sushis.jpg"/> -->
			<h3> Sushi</h3>
			</a>
		</li>
		<li>
			<a class="pizza-hp" href="showloc.php?f=pizza"  data-transition="slidedown"> 
			<!--<img src="./img/pizza.jpg"/> -->
			<h3> Pizza </h3>
			</a>
		</li>
		<li>
			<a class="burger-hp" href="showloc.php?f=burger"  data-transition="slidedown"> 
			<img src="./img/burger.jpg"/>
			<h3> Burger</h3>
			</a>
		</li>
		<li>
			<a class="pho-hp" href="showloc.php?f=pho"  data-transition="slidedown"> 
			<!--<img src="./img/pho5.jpg"/> -->
			<h3> Pho</h3>
			</a>
		</li>
	<!--<li><a href="choose_town.html"  data-transition="slidedown"> <img src="nems.jpg"/> <h3> Some Nems </h3></a></li>
	<li><a href="choose_town.html"  data-transition="slidedown"> <img src="tradi.jpg"/> <h3> Something more traditional</h3></a></li>-->	
	</ul>	
	
	</div>
	</div>

</div><!-- /page -->
</body>
</html>
