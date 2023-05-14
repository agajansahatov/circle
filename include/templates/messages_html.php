<?php
	$PDO_chats = $db->conn->query('SELECT * FROM chats WHERE user1_id=' . $_SESSION['Agajan_Circle_id'] . ' or user2_id=' . $_SESSION['Agajan_Circle_id'] . ';');
			$chats = '';
			if($PDO_chats->rowcount() > 0){
				
				foreach ($PDO_chats as $key) {
					//setting $u --- chat_id
					$u = $key['id'];
					
					
					//setting $user_name, $user_image
					//Firstly, define that user is on "user1_id or user2_id"
					if ($key['user1_id'] == $_SESSION['Agajan_Circle_id']) {
						$user = $key['user2_id'];
					}else if ($key['user2_id'] == $_SESSION['Agajan_Circle_id']) {
						$user = $key['user1_id'];
					}
					if(isset($user)){
						$PDO_user =  $db->conn->query('SELECT firstname, lastname, default_image FROM users WHERE id=' . $user . ';');
						$t = '';
						foreach ($PDO_user as $t) {
							$user_name = $t['firstname'] . ' ' . $t['lastname'];
							$user_image = $t['default_image'];
						}
					}

					//Rest of informations must taken from 'messages' table
					$PDO_messages =  $db->conn->query('SELECT * FROM messages WHERE chat_id=' . $u . ' ORDER BY id asc;');
					if ($PDO_messages->rowcount()>0) {
						$t = '';
						$unread_sum = 0;
						$last_id = 0;
						foreach ($PDO_messages as $t) {
							//Setting the $unread_sum
							if ( ($t['user_id'] !== $_SESSION['Agajan_Circle_id']) && ($t['user2_readn'] == 0) ) {
								$unread_sum++;
							}
							//setting the $last_message, $owner_last_message, $last_chatted_time
							if ($t['id'] > $last_id) {
								$last_id = $t['id'];
								$last_message = $t['message'];
								$last_chatted_time = $form->get_time($t['year'], $t['month'], $t['day'], $t['day_name'], $t['hour'], $t['minute'], $t['second']);
								if($t['user_id'] == $_SESSION['Agajan_Circle_id']){
									$owner_last_message = 'msg_own';
								}else{
									$owner_last_message = 'msg_friend';
								}
							}
						}
					}else{
						$unread_sum = 0;
						$last_message = '';
						$last_chatted_time = '';
						$owner_last_message = '';
						$last_id = 1;
					}
					
					if($unread_sum == 0){
						$div_unread_sum = '';
					}else{
						$div_unread_sum = '<div class="chat_notification">' . $unread_sum . '</div>';
					}
					$chats .= '<a href="?u=' . $u . '#' . $last_id . '" class="chat_anchor">' .
								'<div class="chat">' .
									'<img src="uploads/user_images/' . $user_image . '" class="user_image">' .
									'<div class="chat_inf1">' .
										'<div class="user_name">' . $user_name . '</div>' .
										'<div class="' . $owner_last_message . '">' . $last_message . '</div>' .
									'</div>' .
									'<div class="chat_inf2">' .
										'<a href="?delete_chat_u=' . $u . '" class="delete_anchor">
											<div class="delete_chat_field">x</div>
										</a>' .
										'<div class="last_chatted_time">' . $last_chatted_time . '</div>' .
										$div_unread_sum .
									'</div>' .
								'</div>' .
							'</a>';
				}
			}
		
?>
<!DOCTYPE html>
<html>
	<head>
        <?php require "include/templates/head_informations.php"?> 
		<link rel="stylesheet" href="include/css/head.css">
		<link rel="stylesheet" href="include/css/menu.css">
		<link rel="stylesheet" href="include/css/bottom.css">
		<link rel="stylesheet" href="include/css/messages.css">
	</head>
	<body id="body">
		<?php require "include/templates/head.php"?>
		<div class="main" id="main">
			<?php require "include/templates/menu.php"?>
				<div class="main_body">
					<div class="chats_field_top_outside">
						<div class="chats_field_top">
							<div class="chats_menu">
								<a href="">
									<div class="chats_selected_menu_element">
										<li class="cme_header">All messages</li>
										<li class="cme_indicator">0</li>
									</div>
								</a>
								<a href="">
									<div class="chats_menu_element">
										<li class="cme_header">Unread</li>
										<li class="cme_indicator">0</li>
									</div>
								</a>
								<a href="">
									<div class="chats_menu_element">
										<li class="cme_header">Starred</li>
										<li class="cme_indicator">0</li>
									</div>
								</a>
							</div>
							<div class="chats_top">
								<img src="assets/search_ico.png" id="search_ico"/>
								<input type="search" id="search_field" placeholder="Type a name from your chat list"/>
								<div id="add_new_chat_field">+</div>
							</div>
						</div>
					</div>
					<div class="chats_field">
						<?=$chats?>
					</div>
			</div>
		</div>
		<footer>
			<?php require "include/templates/bottom.php"?>
		</footer>
	</body>
</html>