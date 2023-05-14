<?php
	if($db){
		//Birinji menin oz dostlarymy alyar(Sanyny we id-sini(arrayda))
		$my_friends = array();
		$friends_sum = 0;
		$PDO_friends = $db->conn->query('SELECT user2_id from friends WHERE user1_id = "' . $_SESSION['Agajan_Circle_id'] . '" and user1_accepted = 1 and user2_accepted = 1 and user1_del = 0  and user2_del = 0 and user2_block = 0');
		foreach($PDO_friends as $t){
			$friends_sum++;
			$my_friends[$friends_sum] = $t['user2_id'];
		}
		$PDO_friends = $db->conn->query('SELECT user1_id from friends WHERE user2_id = "' . $_SESSION['Agajan_Circle_id'] . '" and user2_accepted = 1 and user1_accepted = 1 and user2_del = 0 and user1_del = 0 and user1_block = 0');
		foreach($PDO_friends as $t){
			$friends_sum++;
			$my_friends[$friends_sum] = $t['user1_id'];
		}
		//Son dostlarymyn dostlaryny alyar
		$possible_sum = 0;
		$possible_id = array();
		for($i=1; $i<=$friends_sum; $i++){
			$PDO_friends = $db->conn->query('SELECT user1_id from friends WHERE user2_id = "' . $my_friends[$i] . '" and user2_accepted = 1 and user1_accepted = 1 and user2_del = 0 and user1_del = 0');
			foreach($PDO_friends as $t){
				$test = 0;
				for($j=1; $j<=$possible_sum; $j++){
					if($possible_id[$j] == $t['user1_id']) $test = 1;
				}
				if($test == 0 && $t['user1_id'] !== $_SESSION['Agajan_Circle_id']){
					$possible_sum++;
					$possible_id[$possible_sum] = $t['user1_id'];
				}
			}
			$PDO_friends = $db->conn->query('SELECT user2_id from friends WHERE user1_id = "' . $my_friends[$i] . '" and user1_accepted = 1  and user2_accepted = 1 and user1_del = 0 and user2_del = 0');
			foreach($PDO_friends as $t){
				$test = 0;
				for($j=1; $j<=$possible_sum; $j++){
					if($possible_id[$j] == $t['user2_id']) $test = 1;
				}
				if($test == 0 && $t['user2_id'] !== $_SESSION['Agajan_Circle_id']){
					$possible_sum++;
					$possible_id[$possible_sum] = $t['user2_id'];
				}
			}
		}
		//Son possible friends menin druzyamda bar bolsa ayyryar
		$indicator = 0;
		$friends_list = '';
		$possible_friends = array();
		for($i=1; $i<=$possible_sum; $i++){
			$test = 0;
			for($j=1; $j<=$friends_sum; $j++){
				if($my_friends[$j] == $possible_id[$i]) $test = 1;
			}
			if($test == 0){
				$indicator++;
				$possible_friends[$indicator] = $possible_id[$i];
			}
		}
		//possible_friends-in hersiniň statusynda näçe sany 'Common friends' bardygyny kesgitleyar. we link yasamak ucin olaryn id-lerini alyar
		$common_friends = array();
		for($i=1; $i<=$indicator; $i++){
			$n = 0;
			$PDO_friends = $db->conn->query('SELECT user1_id from friends WHERE user2_id = "' . $possible_friends[$i] . '" and user2_accepted = 1 and user1_accepted = 1 and user2_del = 0 and user1_del = 0');
			foreach($PDO_friends as $t){
				for($j=1; $j<=$friends_sum; $j++){
					if($my_friends[$j] == $t['user1_id']){
						$n++;
						$common_friends[$possible_friends[$i]][$n] = $t['user1_id'];
					}
				}
			}
			$PDO_friends = $db->conn->query('SELECT user2_id from friends WHERE user1_id = "' . $possible_friends[$i] . '" and user1_accepted = 1  and user2_accepted = 1 and user1_del = 0 and user2_del = 0');
			foreach($PDO_friends as $t){
				for($j=1; $j<=$friends_sum; $j++){
					if($my_friends[$j] == $t['user2_id']){
						$n++;
						$common_friends[$possible_friends[$i]][$n] = $t['user2_id'];
					}
				}
			}
			$common_friends[$possible_friends[$i]]['sum'] = $n;
		}
		//Possible_friends-in id-lerini alandan son, olary bir standart formada $friends_list-e gosyar
		if(!empty($_REQUEST['selected_id'])){ $selected_id = $_REQUEST['selected_id']; } else{ $selected_id = '0'; }
		
		if(isset($_REQUEST['common_friends']) && $_REQUEST['common_friends'] == 'true' && !empty($_REQUEST['common_with_id'])){
			for($i=1; $i<=$common_friends[$_REQUEST['common_with_id']]['sum']; $i++){
				$PDO_user = $db->conn->query('SELECT id, firstname, lastname, status, default_image from users WHERE id = "' . $common_friends[$_REQUEST['common_with_id']][$i] . '"');
				$friends_list .= $HTML->make_standart_form($PDO_user, $selected_id, '&menu_top=possible_friends&common_friends=true&common_with_id=' . $_REQUEST['common_with_id']);
			}
			$PDO_user = $db->conn->query('SELECT firstname, lastname from users WHERE id = "' . $_REQUEST['common_with_id'] . '"');
			foreach($PDO_user as $t){
				$friends_list = '<a href="?menu_top=possible_friends">' . 
									'<div class="field_back_all"><div class="field_back"><img src="assets/back.png" id="back_icon"/></div></div>' .
								'</a>' .
								'<li id="search_indicator">' . $common_friends[$_REQUEST['common_with_id']]['sum'] . ' common friends with - #' . $t['firstname'] . ' ' . $t['lastname'] . '</li>' . $friends_list;
			}
			//Back button goymaly
		}
		else{
			for($i=1; $i<=$indicator; $i++){
				$PDO_user = $db->conn->query('SELECT id, firstname, lastname, status, default_image from users WHERE id = "' . $possible_friends[$i] . '"');
				$friends_list .= $HTML->make_standart_form($PDO_user, $selected_id, '&menu_top=possible_friends', '<a href="?menu_top=possible_friends&common_friends=true&common_with_id=' . $possible_friends[$i] . '">' . $common_friends[$possible_friends[$i]]['sum'] . ' common friends</a>');
			}
			if(isset($indicator)){
				$friends_list = '<li id="search_indicator">' . $indicator . ' people can be your friend</li>' . $friends_list;
			}
		}
	}
	
?>
<!DOCTYPE html>
<html>
	<head>
         <?php require "include/templates/head_informations.php"?> 
		<link rel="stylesheet" href="include/css/menu.css"/>
		<link rel="stylesheet" href="include/css/head.css"/>
		<link rel="stylesheet" href="include/css/bottom.css"/>
		<link rel="stylesheet" href="include/css/friends.css"/>
		<link rel="stylesheet" href="include/css/display_in_standart_form1.css"/>
		<link rel="stylesheet" href="include/css/show_user_informations1.css"/>
		<script src="include/js/objects.js"></script>
	</head>
	<body>
		<?php require "include/templates/head.php"?>
		<div class="main" id="main">
			<?php require "include/templates/menu.php"?>
			<div class="main_body" id="main_body">
				<?php 
					if(!empty($notification_status)){
						echo '<div id="notification_status" style="opacity: 0">' . 
								$notification_status . 
							'</div>' . 
							'<script src="include/js/flashes.js"></script>' .
							'<script>' .
								'flash.status1("notification_status", 1, 6);' . 
							'</script>';
					}
				?>
				<form method="POST" action="">
					<div class="menu_top">
						<a href="?menu_top=all_friends" class="menu_top_elem">All friends</a>
						<a href="?menu_top=requests&menu_list=came" class="menu_top_elem">Requests</a>
						<li class="menu_top_selected_elem">Possible friends</li>
						<a href="?menu_top=blocked" class="menu_top_elem">Blocked users</a>
						<a href="search.php" class="menu_top_elem">Search people</a>
					</div>
					<div class="friends_list" id="friends_list">
						<?php 
							if(!empty($friends_list)){ echo $friends_list; }
						?>
					</div>
					<div class="friends_informations">
						<?php 
							if(!empty($_REQUEST['selected_id']) && !empty($friends_informations)){
								echo $friends_informations;
							}else{
								echo '<img src="assets/no_image/no_image_1.png" id="no_image_1"/>' .
									 '<h1 id="none_found" align="center">No user is selected!</h1>';
							}
						?>
					</div>
				</form>
				<div class="foot" id="foot">
				</div>
			</div>
		</div>
		<footer>
			<?php require "include/templates/bottom.php"?>
		</footer>
	</body>
</html>