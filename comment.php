<!--Student Name: Thanh Nhan Nguyen
	Student ID: 212540002
-->
<?php
	echo $_POST['rn'];
	echo $_POST['rating'];
	echo $_POST['author'];
	echo $_POST['comment'];
	
	$restaurant = empty($_POST['rn']) ? '' : $_POST['rn'];// restaurant name
	$restaurant = rawurldecode($restaurant); // decide space in string
	$do = empty($_GET['do']) ? '' : $_GET['do']; // action
	$commentid = empty($_GET['cid']) ? '' : $_GET['cid'];
	$txtcomment = empty($_POST['comment']) ? '' : $_POST['comment'];
	$rating = empty($_POST['rating']) ? '' : $_POST['rating'];
	$author = empty($_POST['author']) ? '' : $_POST['author'];
	//$txtcomment = 'test comment cai coi';
	//$rating = '2';

	$url = './db/data.json';
	$str = file_get_contents($url);
	
	// decode json
	$data = json_decode($str, false);
	$resinfo = $data->restaurant;
	
	$rating_arr = array();
	$avgrating = 0;// average rating
	$totalrating = 0;
	
	// param: do=add&rn=resname
	if($do == 'add'){
		foreach ($resinfo as $info) {
			if(strtolower($info->name) == $restaurant) {
				$txt = json_decode('{"name": "' . $author . '","rating": ' . $rating . ',"text": "' . $txtcomment .'"}');
				array_push($info->comment, $txt); // remove to test
				break;
			}
		}
		
		// re-calculate rating score
		foreach ($resinfo as $info) {
			if(strtolower($info->name) == $restaurant) {
				foreach ($info->comment as $c) {
					array_push($rating_arr, $c->rating);
				}
				break;
			}
		}
		foreach ($rating_arr as $i) {
			$totalrating += $i;
		}
		$avgrating = 0;
		if(sizeOf($rating_arr) != 0)
			$avgrating = round(round($totalrating/sizeOf($rating_arr), 1)*2, 0)/2; // return new average after added
		
		// update new average
		foreach ($resinfo as $info) {
			if(strtolower($info->name) == $restaurant) {
				$info->rating = $avgrating;
				break;
			}
		}
	}
	
	if($do == 'edit'){
		
	}
	// param: do=delete&rn=resname&cid=commentid
	if($do == 'delete'){
		foreach ($resinfo as $info) {
			if(strtolower($info->name) == $restaurant) {
				unset($info->comment[$commentid]);
				break;
			}
		}
		$info->comment = array_merge($info->comment);
		
		// re-calculate rating score
		foreach ($resinfo as $info) {
			if(strtolower($info->name) == $restaurant) {
				foreach ($info->comment as $c) {
					array_push($rating_arr, $c->rating);
				}
				break;
			}
		}
		foreach ($rating_arr as $i) {
			$totalrating += $i;
		}
		$avgrating = round(round($totalrating/sizeOf($rating_arr), 1)*2, 0)/2; // return new average after added
		
		// update new average
		foreach ($resinfo as $info) {
			if(strtolower($info->name) == $restaurant) {
				$info->rating = $avgrating;
				break;
			}
		}
	}
	
	$newdata = json_encode($data);
	file_put_contents('./db/data.json', $newdata);
?>
	
