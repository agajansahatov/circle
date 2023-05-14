<!DOCTYPE html>
<html>
	<head>
         <?php require "include/templates/head_informations.php"?> 
		<link rel="stylesheet" href="include/css/menu.css"/>
		<link rel="stylesheet" href="include/css/head.css"/>
		<link rel="stylesheet" href="include/css/bottom.css"/>
		<link rel="stylesheet" href="include/css/search_people.css"/>
		<link rel="stylesheet" href="include/css/display_in_standart_form1.css"/>
		<link rel="stylesheet" href="include/css/show_user_informations1.css"/>
		<script src="include/js/objects.js"></script>
	</head>
	<body>
		<?php require "include/templates/head.php"?>
		<div class="main" id="main">
			<?php require "include/templates/menu.php"?>
			<div class="main_body" id="main_body" >
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
						<li class="menu_top_selected_elem">People</li>
						<a href="?menu_top=accounts<?php if(!empty($_REQUEST['selected_id']) && !empty($_REQUEST['search_list'])){ echo '&search_list=' . $_REQUEST['search_list'] . '&selected_id=' . $_REQUEST['selected_id']; }?>" class="menu_top_elem">Accounts</a>
						<a href="?menu_top=audios<?php if(!empty($_REQUEST['selected_id']) && !empty($_REQUEST['search_list'])){ echo '&search_list=' . $_REQUEST['search_list'] . '&selected_id=' . $_REQUEST['selected_id']; }?>" class="menu_top_elem">Audios</a>
						<a href="?menu_top=videos<?php if(!empty($_REQUEST['selected_id']) && !empty($_REQUEST['search_list'])){ echo '&search_list=' . $_REQUEST['search_list'] . '&selected_id=' . $_REQUEST['selected_id']; }?>" class="menu_top_elem">Videos</a>
						<a href="?menu_top=images<?php if(!empty($_REQUEST['selected_id']) && !empty($_REQUEST['search_list'])){ echo '&search_list=' . $_REQUEST['search_list'] . '&selected_id=' . $_REQUEST['selected_id']; }?>" class="menu_top_elem">Images</a>
					</div>
					<div class="search_friends">
						<img src="assets/menu_blue.png" id="btn_down"/>
						<img src="assets/search_ico.png" id="search_ico"/>
						<input type="search" name="search_list" id="search_list" value="<?php if(!empty($_REQUEST['search_list'])){echo $_REQUEST['search_list'];} ?>" placeholder="Type a firstname, a lastname or both to search"/>
						<input type="submit" id="btn_search" name="btn_search" value="Search"/>
					</div>
					<div class="friends_list" id="friends_list" >
						<li id="search_indicator">
							<?php 
								if(!empty($indicator)){
									echo  $indicator . ' people are found';
								}else{
									echo '0 people are found';
								}
							?>
						</li>	
						<?php
							if(!empty($friends_list)){
								echo $friends_list;
							}
						?>
					</div>
					<div class="friends_informations" id="friends_informations">
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
		<?php require "include/templates/search_people_js.php"; ?>
	</body>
</html>