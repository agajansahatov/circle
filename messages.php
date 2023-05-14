<?php
	SESSION_START();
	
	$this_page = 'messages';
	
	date_default_timezone_set('Asia/Ashgabat');

	if(!isset($_SESSION['Agajan_Circle_id'])){
		header('location: index.php');
	}
	require "include/functions/string_class.php";
	require "include/functions/database_class.php";
	require "include/functions/form_class.php";
	require "include/functions/file_class.php";
	require "include/functions/HTML_class.php";
	require "include/templates/upload_ini.php";
	
	$str = new str();
	$HTML = new HTML();
	$form = new form();
	$file = new file();
	$db = new database('agajan_circle');
	if(!$db) die('There was a problem connecting to database');
	if($db){

		if(isset($_REQUEST['selected_user']) && !empty($_REQUEST['selected_user'])){
			$selected_user = $str->clean($_REQUEST['selected_user']);
			$PDO_chats1 = $db->conn->query('SELECT id FROM chats WHERE user1_id=' . $_SESSION['Agajan_Circle_id'] . ' and user2_id=' . $selected_user . ';');
			$PDO_chats2 = $db->conn->query('SELECT id FROM chats WHERE user1_id=' . $selected_user . ' and user2_id=' . $_SESSION['Agajan_Circle_id'] . ';');
			if($PDO_chats1->rowcount() == 1 && $PDO_chats2->rowcount() == 0){
				foreach ($PDO_chats1 as $key) {
					$u = $key['id'];
				}
			}else if($PDO_chats1->rowcount() == 0 && $PDO_chats2->rowcount() == 1){
				foreach ($PDO_chats2 as $key) {
					$u = $key['id'];
				}
			}else if($PDO_chats1->rowcount() == 0 && $PDO_chats2->rowcount() == 0){
				$db->conn->query('INSERT INTO chats values(null, ' . 
									'\'' . $str->clean($_SESSION['Agajan_Circle_id']) . '\', ' . //sets user1_id
									'\'' . $selected_user . '\' ' . //sets user2_id
									');' 
								);
				$key = '';
				$PDO_chats = $db->conn->query('SELECT id FROM chats WHERE user1_id=' . $_SESSION['Agajan_Circle_id'] . ' and user2_id=' . $selected_user . ';');
				if($PDO_chats->rowcount() == 1){
					foreach ($PDO_chats as $key) {
						$u = $key['id'];
					}
				}
			}
			else{
				die('Someting went wrong with the app, please contact with the admin about this problem in messages');
			}
		}

		if((isset($_REQUEST['u']) && !empty($_REQUEST['u'])) || (isset($u) && !empty($u))){
			if(!empty($u)){
				$chat_id = $str->clean($u);
			}else if(!empty($_REQUEST['u'])){
				$chat_id = $str->clean($_REQUEST['u']);
			}
			require "include/templates/message.php";
		}else{
			require "include/templates/messages_html.php";
		}

	}
?>