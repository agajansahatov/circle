<?php
	SESSION_START();
	
	$this_page = 'home';
	
	require "include/functions/string_class.php";
	require "include/functions/database_class.php";
	require "include/functions/form_class.php";
	require "include/functions/file_class.php";
	require "include/functions/HTML_class.php";
	require "include/templates/upload_ini.php";
			
	if(!isset($_SESSION['Agajan_Circle_id'])){
		header('location: index.php');
	}
	$str = new str();
	$HTML = new HTML();
	$form = new form();
	$file = new file();
	$db = new database('agajan_circle');
	if(!$db) die('There was a problem connecting to database');
	if($db){
		//Uploading a new image
		if((isset($_POST['btn_upload_image']) && $_POST['btn_upload_image'] == 'Upload') && !empty($_FILES['image'])){
			$PDO_user_images_sum = $db->conn->query('SELECT images_sum from user_images_sum WHERE user_id = ' . $_SESSION['Agajan_Circle_id'] . ' and year = "'. date('Y') .'";');
			if($PDO_user_images_sum->rowcount() == 1){
				foreach($PDO_user_images_sum as $t){
					$user_imgs_sum = $t['images_sum'];
				}
			}else if($PDO_user_images_sum->rowcount() == 0){ // Eger on shu yylda doredilmedik bolsa taze gosyar
				if($db->conn->query('INSERT INTO user_images_sum values(null, ' . //sets id
									$_SESSION['Agajan_Circle_id'] . ', ' . //sets user_id
									'\'' . date('Y') . '\', ' . //sets year
									0 . ');' //sets sum
					)){
						$user_imgs_sum = 0;
					}
			}else{
				die('Something went wrong when getting image_sum! Please contact with the admin');
			}
			$file_name = basename($_FILES['image']['name']);
			$file_size = $_FILES['image']['size'];
			$file_tmp = $_FILES['image']['tmp_name'];
			$file_type = $_FILES['image']['type'];
			$file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
			$errors = "";
			if($file_ext == 'jpg' || $file_ext == 'jpeg' || $file_ext == 'png' || $file_ext == 'gif'){
				$errors = "";
			}else{
				$errors = "Extension is not allowed!<br>Please choose a JPEG, JPG, GIF or PNG file!";
			}
			if(empty($errors) && isset($user_imgs_sum)){
					$user_imgs_sum++;
					$file_name = 'user_' . $_SESSION['Agajan_Circle_id'] . '_' . date('Y') . '_' . $user_imgs_sum . '.' . $file_ext; //It changes the file name
					$result = @move_uploaded_file($file_tmp,"uploads/user_images/" . $file_name);
					if($result == 1){
						date_default_timezone_set('Asia/Ashgabat');
						//First add a new row to "user_images" table
						$db->conn->query('INSERT INTO user_images values(null, "' .//sets id
									$_SESSION['Agajan_Circle_id'] . '", ' //sets user_id
									. '\'' . $file_name . '\', ' . // sets image
									'\'' . 'not set' . '\', ' . //sets description
									'\'' . 'not set' . '\', ' . //sets month 
									'\'' . date('Y') . '\', ' . //sets year
									'\'' . date('m') . '\', ' . //sets month
									'\'' . date('d') . '\', ' . //sets day
									'\'' . date('D') . '\', ' . //sets day_name
									'\'' . date('H') . '\', ' . //sets hour
									'\'' . date('i') . '\', ' . //sets minute
									'\'' . date('s') . '\');' //sets second
								);
						//Second updates user_images_sum in "user_images_sum" table in this year
						$db->conn->query('UPDATE user_images_sum SET images_sum = ' . $user_imgs_sum . ' WHERE user_id = ' . $_SESSION['Agajan_Circle_id'] . ' and year = "'. date('Y') .'";');
						$notification_status = 'The image is uploaded';
					}
			}
		}
		//OPERATIONS--------------------------------------------------------------------------------------------------------------------------
		$alert = '';
		$my_alert = 0;
		$my_alert_style = '';
		require "include/templates/home_set_email.php";		
		require "include/templates/home_set_mobile_number.php";		
		require "include/templates/home_set_password.php";		
		require "include/templates/home_view_image.php";		
		
		//OPERATIONS MUST BE ABOVE, AND INFORMATIONS MUST BE GOTTON BELOW
		//Getting the user images
		$user_all_images = '';
		$PDO_user_images = $db->conn->query('SELECT * from user_images WHERE user_id = ' . $_SESSION['Agajan_Circle_id'] . ' ORDER BY id ASC;');
		$user_all_images_sum = $PDO_user_images->rowcount();//GETTING THE SUM OF USER IMAGES
		if($PDO_user_images->rowcount()>0){
			$img_number = 0;
			$i = 0;
			$js_img = 'var user_img_sum = "' . $user_all_images_sum . '";';
			$js_img .= 'var ui = ' . $_SESSION['Agajan_Circle_id'] . ';';
			$center_img  = '';
			foreach ($PDO_user_images as $inf){
				$i++;
				$js_img .= 'url_all_imgs[' . $i . '] = "' . $inf['image'] . '";'; //Sets urls to js
				if($img_number < 5){
					$img_number += 1; // i-nyn rolyny yerine yetiryar
					$user_all_images .= ('<div class="nav_user_all_images" id="nav_user_all_images">' .
											'<img src="uploads/user_images/' . $inf['image'] . '" class="user_all_images" onclick="view_img(url_all_imgs, ' . $img_number . ', ' . $_SESSION['Agajan_Circle_id'] . ', 1);"/>' .
										'</div>');
				}
			}
		}
		//Getting the user informations
		$PDO_user = $db->conn->query('SELECT * FROM users WHERE id = ' . $_SESSION['Agajan_Circle_id'] . ';');
		if($PDO_user->rowcount()>0){
			$user_inf = array();
			foreach ($PDO_user as $inf){
				$user_inf = $inf; 
			}
		}
		//Getting the friends
		$user_all_friends = '';
		$friends1 = $db->conn->query('SELECT user2_id from friends WHERE user1_id = "' . $_SESSION['Agajan_Circle_id'] . 
					'" and user1_accepted = 1 and user2_accepted = 1 and user1_block = 0 and user2_block = 0 and user1_del = 0 and user2_del = 0');
		$friends2 = $db->conn->query('SELECT user1_id from friends WHERE user2_id = "' . $_SESSION['Agajan_Circle_id'] . 
					'" and user1_accepted = 1 and user2_accepted = 1 and user1_block = 0 and user2_block = 0 and user1_del = 0 and user2_del = 0');
		$friends_sum = $friends1->rowcount() + $friends2->rowcount();
		foreach($friends1 as $t){
			$PDO = $db->conn->query('SELECT id, firstname, lastname, default_image FROM users WHERE id = ' . $t['user2_id']);
			foreach($PDO as $user){
				$user_all_friends .='<div class="friend_field">' .
										'<script>' .
												 'var img_array_' . $user['id'] . ' = [];' .
												 'img_array_' . $user['id'] . '[1] = "' . $user['default_image'] . '";' .
										'</script>' .
										'<img src="uploads/user_images/' . $user['default_image'] . '" class="friend_image" onclick="view_img(img_array_' . $user['id'] . ', ' . 1 . ', ' . $user['id'] . ', 1);"/>' .
										'<br/>' .
										'<a class="friend_name">' . $user['firstname'] . '</a>' .
									'</div>';
			
			}
		}
		foreach($friends2 as $t){
			$PDO = $db->conn->query('SELECT id, firstname, lastname, default_image FROM users WHERE id = ' . $t['user1_id']);
			foreach($PDO as $user){
				$user_all_friends .='<div class="friend_field">' .
										'<script>' .
												 'var img_array_' . $user['id'] . ' = [];' .
												 'img_array_' . $user['id'] . '[1] = "' . $user['default_image'] . '";' .
										'</script>' .
										'<img src="uploads/user_images/' . $user['default_image'] . '" class="friend_image" onclick="view_img(img_array_' . $user['id'] . ', ' . 1 . ', ' . $user['id'] . ', 1);"/>' .
										'<br/>' .
										'<a class="friend_name">' . $user['firstname'] . '</a>' .
									'</div>';
			
			}
		}
		//Getting the followers
		$followers1 = $db->conn->query('SELECT user2_id from friends WHERE user1_id = "' . $_SESSION['Agajan_Circle_id'] . 
					'" and user1_accepted = 0 and user2_accepted = 1 and user1_block = 0 and user2_block = 0 and user1_del = 0 and user2_del = 0');
		$followers2 = $db->conn->query('SELECT user1_id from friends WHERE user2_id = "' . $_SESSION['Agajan_Circle_id'] . 
					'" and user1_accepted = 1 and user2_accepted = 0 and user1_block = 0 and user2_block = 0 and user1_del = 0 and user2_del = 0');
		$followers_sum = $followers1->rowcount() + $followers2->rowcount();
	}
		
	require "include/templates/home_html.php";
?>