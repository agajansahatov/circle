<?php
	if (isset($chat_id)) {
		$last_id = '1';
		$PDO_control1 = $db->conn->query('SELECT * FROM chats WHERE id=' . $chat_id . ' and user2_id = ' . $_SESSION['Agajan_Circle_id'] . ';');
		$PDO_control2 = $db->conn->query('SELECT * FROM chats WHERE id=' . $chat_id . ' and user1_id = ' . $_SESSION['Agajan_Circle_id'] . ';');
		if(($PDO_control1->rowcount() == 0 && $PDO_control2->rowcount() == 0) || ($PDO_control1->rowcount() > 1 || $PDO_control2->rowcount() > 1)){
			die('Someting went wrong with the app, please contact with the admin about this problem in messages');
		}else{
			if($PDO_control1->rowcount() == 1 && $PDO_control2->rowcount() == 1){
				die('Someting went wrong with the app, please contact with the admin about this problem in messages');
			}
			
			if(isset($_POST['btn_send']) && (!empty($_POST['message']))){
				date_default_timezone_set('Asia/Ashgabat');
						
				//INSERTING A NEW ROW TO messages TABLE
				$db->conn->query('INSERT INTO messages values(null, ' . 
										'\'' . $str->clean($_POST['message']) . '\', ' . //sets message
										$_SESSION["Agajan_Circle_id"] . ', ' . //sets user_id
										$chat_id . ', ' . //sets chat_id
										'\'' . 0 . '\', ' . //sets user2_readn
										'\'' . date('Y') . '\', ' . //sets year
										'\'' . date('m') . '\', ' . //sets month
										'\'' . date('d') . '\', ' . //sets day
										'\'' . date('D') . '\', ' . //sets day_name
										'\'' . date('H') . '\', ' . //sets hour
										'\'' . date('i') . '\', ' . //sets minute
										'\'' . date('s') . '\');' //sets second
								);
				
			}
			
			//GETTING THE MESSAGES
			$PDO_messages = $db->conn->query('SELECT * FROM messages WHERE chat_id=' . $chat_id . ';');	
			$messages = '';
			$t = '';
			foreach ($PDO_messages as $t) {
				if($t['user_id'] == $_SESSION['Agajan_Circle_id']){
					$user_id = $_SESSION['Agajan_Circle_id'];
					if($t['user2_readn'] == 0){ $read = 'Unread';}elseif($t['user2_readn'] == 1){
						$read = 'Read';
					}
					$time = $form->get_time($t['year'], $t['month'], $t['day'], $t['day_name'], $t['hour'], $t['minute'], $t['second']);
					$message = $t['message'];
					$last_id = $t['id'];
					$PDO_users = $db->conn->query('SELECT firstname, default_image, id FROM users WHERE id=' . $user_id . ';');
					$key = '';
					foreach ($PDO_users as $key) {
						$messages .= '<div class="my_msg_field">' .
										'<div class="my_msg_image_field">' .
											'<script>' .
												 'var img_array_' . $key['id'] . ' = [];' .
												 'img_array_' . $key['id'] . '[1] = "' . $key['default_image'] . '";' .
											'</script>' .
											'<img src="uploads/user_images/' . $key['default_image'] . '" class="my_msg_image" onclick="view_img(img_array_' . $key['id'] . ', ' . 1 . ', ' . $key['id'] . ', 0);">' .
										'</div>' .
										'<div class="mmi_user_name">' . $key['firstname'] . '</div>' .
										'<div class="my_msg_outside">' .
											'<div class="my_msg">' . $message . '</div>' .
											'<div class="my_msg_inf">' .
												'<li class="mmi_time">' . $time . '</li>' .
												'<li class="mmi_read">' . $read . '</li>' .
											'</div>' .
										'</div>' .
									'</div>';	
					}
				}else{
					$user_id = $t['user_id'];
					//Eger-de men entak bu sms-i okamadyk bolsam okady etya
					if($t['user2_readn'] == 0){
						if($db->conn->query('UPDATE messages SET user2_readn = 1 WHERE id = ' . $t['id'] . ';')){ //$t['id'] = message's id
							//Eger-de okamadyk bolsam okady etya, we...
							$read = 'Read';
						}
					}else{
						$read = 'Read';
					}
					$time = $form->get_time($t['year'], $t['month'], $t['day'], $t['day_name'], $t['hour'], $t['minute'], $t['second']);
					$message = $t['message'];
					$last_id = $t['id'];
					$PDO_users = $db->conn->query('SELECT firstname, default_image, id FROM users WHERE id=' . $user_id . ';');
					$key = '';
					foreach ($PDO_users as $key) {
						$messages .= '<div class="friend_msg_field">' .
										'<div class="friend_msg_image_field">' .
											'<script>' .
												 'var img_array_' . $key['id'] . ' = [];' .
												 'img_array_' . $key['id'] . '[1] = "' . $key['default_image'] . '";' .
											'</script>' .
											'<img src="uploads/user_images/' . $key['default_image'] . '" class="friend_msg_image" onclick="view_img(img_array_' . $key['id'] . ', ' . 1 . ', ' . $key['id'] . ', 0);">' .
										'</div>' .
										'<div class="fmi_user_name">' . $key['firstname'] . '</div>' .
										'<div class="friend_msg_outside">' .
											'<div class="friend_msg">' . $message . '</div>' .
											'<div class="friend_msg_inf">' .
												'<li class="fmi_read">' . $read .'</li>' .
												'<li class="fmi_time">' . $time . '</li>' .
											'</div>' .
										'</div>' .
									'</div>';
					}
				}
			}
			//GETTING THE DEFAULT USER'S INFORMATIONS THAT I AM CHATTING WITH
			//DEFINING WHETHER I AM THE user1 or user2
			$PDO_chats = $db->conn->query('SELECT * FROM chats WHERE id=' . $chat_id . ';');
			if ($PDO_chats->rowcount()>0) {
				$key = '';
				foreach ($PDO_chats as $key) {
					if($key['user1_id'] == $_SESSION['Agajan_Circle_id']){
						$default_user_id = $key['user2_id'];
					}elseif($key['user2_id'] == $_SESSION['Agajan_Circle_id']){
						$default_user_id = $key['user1_id'];
					}
				}
			}
			

			$PDO_users = $db->conn->query('SELECT firstname, lastname, default_image, online, id FROM users WHERE id=' . $default_user_id . ';');

			if ($PDO_users->rowcount()>0) {
				$key = '';
				foreach ($PDO_users as $key) {
					$default_user_name = $key['firstname'] . ' ' . $key['lastname'];
					$default_user_image = $key['default_image'];
					if($key['online'] == '1'){
						$default_user_status = 'Online';
					}else{
						$default_user_status = 'Offline';
					}
				}
			}
		}
	}
	require "include/templates/home_view_image.php";
?>
<!DOCTYPE html>
<html>
	<head>
        <?php require "include/templates/head_informations.php"?> 
		<link rel="stylesheet" href="include/css/head.css">
		<link rel="stylesheet" href="include/css/menu.css">
		<link rel="stylesheet" href="include/css/bottom.css">
		<link rel="stylesheet" href="include/css/message.css">

		<script src="include/js/functions.js"></script>
	</head>
	<body id="body">
		<?php require "include/templates/head.php"?>
		<div class="main" id="main">
			<?php require "include/templates/menu.php"?>
				<div class="main_body">
					<div class="message_field_top_outside">
						<div class="message_field_top">
							<a href="messages">
								<div class="back_field">
									<li class="back_icon"><</li>
									<li class="back_field_text">Back</li>
								</div>
							</a>
							<div class="msg_user_inf_field">
								<li class="msg_user_name"><?=$default_user_name;?></li>
								<li class="msg_user_status"><?=$default_user_status;?></li>
							</div>
							<script>
								 var img_in_array = [];
								 img_in_array[1] = "<?=$default_user_image;?>";
							</script>
							<img src="uploads/user_images/<?=$default_user_image;?>" class="msg_user_image" onclick="view_img(img_in_array, 1, <?=$default_user_id?>, 0)"/>
						</div>
					</div>
					<div class="message_field">
						<?php
							if(!empty($messages)){
								echo $messages;
							}
						?>						
					</div>
					<div class="message_field_bottom_outside">
						<div class="message_field_bottom">
							<form method="POST" action="#<?=$last_id?>" enctype="multipart/form-data">
								<div class="write_msg_field">
									<input type="text" name="message" id="message" class="message" placeholder="Write your message...">
									<img src="assets/file_ico.png" class="file_ico"/>
									<img src="assets/emoji_ico.png" class="emoji_ico"/>
								</div>
								<img src="assets/send_icon.png" id="send_icon">
								<input type="submit" name="btn_send" class="btn_send" value=".">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<footer>
			<?php require "include/templates/bottom.php"?>
		</footer>
	</body>
</html>