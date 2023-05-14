<?php
	if($db){
		$friends1 = $db->conn->query('SELECT user2_id from friends WHERE user1_id = "' . $_SESSION['Agajan_Circle_id'] . 
					'" and user1_accepted = 1 and user2_accepted = 1 and user1_block = 0 and user2_block = 0 and user1_del = 0 and user2_del = 0');
		$friends2 = $db->conn->query('SELECT user1_id from friends WHERE user2_id = "' . $_SESSION['Agajan_Circle_id'] . 
					'" and user1_accepted = 1 and user2_accepted = 1 and user1_block = 0 and user2_block = 0 and user1_del = 0 and user2_del = 0');
		$friends_list = '';
		if(!empty($_REQUEST['selected_id'])){
			$selected_id = $_REQUEST['selected_id'];
		}else{
			$selected_id = '0';
		}
		if($friends1->rowcount() > 0){
			foreach ($friends1 as $friend){
				$PDO_user = $db->conn->query('SELECT id, firstname, lastname, status, default_image from users WHERE id = "' . $friend['user2_id'] . '"');
				$friends_list .= $HTML->make_standart_form($PDO_user, $selected_id, '&page=friends&menu_top=all_friends');
			}
		}
		if($friends2->rowcount() > 0){
			foreach ($friends2 as $friend){
				$PDO_user = $db->conn->query('SELECT id, firstname, lastname, status, default_image from users WHERE id = "' . $friend['user1_id'] . '"');
				$friends_list .= $HTML->make_standart_form($PDO_user, $selected_id, '&page=friends&menu_top=all_friends');
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
		<link rel="stylesheet" href="include/css/bottom.css"/>
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
						<li class="menu_top_selected_elem">All friends</li>
						<a href="?menu_top=requests&menu_list=came" class="menu_top_elem">Requests</a>
						<a href="?menu_top=possible_friends" class="menu_top_elem">Possible friends</a>
						<a href="?menu_top=blocked" class="menu_top_elem">Blocked users</a>
						<a href="search.php" class="menu_top_elem">Search people</a>
					</div>
					<div class="friends_list" id="friends_list">
						<?php 
							echo '<li id="search_indicator">You have ' . ($friends1->rowcount() +  $friends2->rowcount());
								if($friends1->rowcount() +  $friends2->rowcount() == 1){
									echo ' friend</li>';
								}else{ echo ' friends</li>'; }
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