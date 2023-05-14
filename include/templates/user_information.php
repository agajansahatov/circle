<?php 
	$bool = 'none';
	for($i=0; $i<=strlen($selected_user)-1;$i++){
		if($selected_user[$i] >= '0' && $selected_user[$i] <= '9'){
			if($bool == 'none'){$bool = 'number';}
		}else{$bool = 'text';break;}
	}
	if($bool == 'number' && !empty($selected_user) && $selected_user !== 0){
		//Getting inf from the friends table
		$fr1 = $db->conn->query('SELECT * from friends WHERE user1_id = ' . $_SESSION['Agajan_Circle_id'] . ' and user2_id = ' . $selected_user . ';');
		$fr2 = $db->conn->query('SELECT * from friends WHERE user1_id = ' . $selected_user . ' and user2_id = ' . $_SESSION['Agajan_Circle_id'] . ';');
		date_default_timezone_set('Asia/Ashgabat');
		
		if($fr1->rowcount() == 1 && $fr2->rowcount() == 1){
			die('Something went wrong! Contact with our official website about this problem');
		}
		
		//Sets the $user1 and $user2
		if($fr1->rowcount() == 1){
			$user1 = $_SESSION['Agajan_Circle_id'];
			$user2 = $selected_user;
			$u = '1';
		}else if($fr2->rowcount() == 1){
			$user1 = $selected_user;
			$user2 = $_SESSION['Agajan_Circle_id'];
			$u = '2';
		}
		
		//Cases on which button is submitted
		if(isset($_POST['btn_chat'])){
			header('location: messages?selected_user=' . $selected_user);
		}
		if(isset($_POST['btn_send_request'])){
			if($fr1->rowcount() == 0 && $fr2->rowcount() == 0){
				$db->conn->query('INSERT INTO friends(user1_id, user2_id, user1_accepted, user2_accepted, time_accepted_1, time_accepted_2, user1_block, user2_block, time_blocked_1, time_blocked_2, user1_del, user2_del) ' .
					'values(' . $_SESSION['Agajan_Circle_id'] . ', ' .  
					$selected_user . ', 1, 0, "' . date("d.m.Y") . '", "not set", 0, 0, "not set", "not set", 0, 0)');
					$notification_status = 'You have sent a request to';
			}
		}
		if(isset($_POST['btn_send_request_update'])){
			if(!empty($user1) && !empty($user2)){
				//Beylekinin dostlarynda bar bolanson gonumel gosyar - notification ugratmayar
				$db->conn->query('UPDATE friends SET user' . $u . '_del = 0 WHERE user1_id = ' .$user1 . ' and user2_id = ' . $user2 . ';');
				$db->conn->query('UPDATE friends SET user' . $u . '_accepted = 1 WHERE user1_id = ' . $user1 . ' and user2_id = ' . $user2 . ';');
				$db->conn->query('UPDATE friends SET time_accepted_' . $u . ' = "' . date("d.m.Y") . '" WHERE user1_id = ' . $user1 . ' and user2_id = ' . $user2 . ';');
				//Bloklanan bolaymasyn diyip iki yagday hem bolsa BLOKDAN ACYAR
				$db->conn->query('UPDATE friends SET user' . $u . '_block = 0 WHERE user1_id = ' . $user1 . ' and user2_id = ' . $user2 . ';');
				$db->conn->query('UPDATE friends SET time_blocked_' . $u . ' = "not set" WHERE user1_id = ' . $user1 . ' and user2_id = ' . $user2 . ';');
				$notification_status = 'You have added ';
			}
		}
		if(isset($_POST['btn_accept_friend'])){
			if(!empty($user1) && !empty($user2)){
				$db->conn->query('UPDATE friends SET user' . $u . '_accepted = 1 WHERE user1_id = ' . $user1 . ' and user2_id = ' . $user2 . ';');
				$db->conn->query('UPDATE friends SET time_accepted_' . $u . ' = "' . date("d.m.Y") . '" WHERE user1_id = ' . $user1 . ' and user2_id = ' . $user2 . ';');
				$notification_status = 'You have accepted request of';
			}
		}
		if(isset($_POST['btn_del_friend'])){
			if(!empty($user1) && !empty($user2)){
				$db->conn->query('UPDATE friends SET user' . $u . '_del = 1 WHERE user1_id = ' . $user1 . ' and user2_id = ' . $user2 . ';');
				$notification_status = 'You have deleted';
			}
		}
		if(isset($_POST['btn_unblock_and_del_friend'])){
			if(!empty($user1) && !empty($user2)){
				$db->conn->query('UPDATE friends SET user' . $u . '_block = 0 WHERE user1_id = ' . $user1 . ' and user2_id = ' . $user2 . ';');
				$db->conn->query('UPDATE friends SET user' . $u . '_del = 1 WHERE user1_id = ' . $user1 . ' and user2_id = ' . $user2 . ';');
				$notification_status = 'You have deleted';
			}
		}
		if(isset($_POST['btn_full_del_friend'])){
			if(!empty($user1) && !empty($user2)){
				$db->conn->query('DELETE FROM friends WHERE user1_id = ' . $user1 . ' and user2_id = ' . $user2 . ';');
				$notification_status = 'You have deleted';
			}
		}
		if(isset($_POST['btn_block_friend'])){
			if(!empty($user1) && !empty($user2)){
				$db->conn->query('UPDATE friends SET user' . $u . '_block = 1 WHERE user1_id = ' . $user1 . ' and user2_id = ' . $user2 . ';');
				$db->conn->query('UPDATE friends SET time_blocked_' . $u . ' = "' . date("d.m.Y") . '" WHERE user1_id = ' . $user1 . ' and user2_id = ' . $user2 . ';');
				$notification_status = 'You have blocked';
			}
			
		}
		if(isset($_POST['btn_unblock_friend'])){
			if(!empty($user1) && !empty($user2)){
				$db->conn->query('UPDATE friends SET user' . $u . '_block = 0 WHERE user1_id = ' . $user1 . ' and user2_id = ' . $user2 . ';');
				$notification_status = 'You have unblocked';
			}
		}
		//Analizing what/which button should be displayed
	
		//Getting inf from the friends table
		$fr1 = $db->conn->query('SELECT * from friends WHERE user1_id = ' . $_SESSION['Agajan_Circle_id'] . ' and user2_id = ' . $selected_user . ';');
		$fr2 = $db->conn->query('SELECT * from friends WHERE user1_id = ' . $selected_user . ' and user2_id = ' . $_SESSION['Agajan_Circle_id'] . ';');
		
		//Sets $u1, $u2 and $fr
		if($fr1->rowcount() == 1){
			$u1 = '1'; $u2 = '2'; $fr = $fr1;
		}else if($fr2->rowcount() == 1){
			$u1 = '2'; $u2 = '1'; $fr = $fr2;
		}
		
		if(($fr1->rowcount() == 0 && $fr2->rowcount() == 0) && ($selected_user !== $_SESSION['Agajan_Circle_id'])){
			$btn_operations = '<li><input type="submit" name="btn_send_request" id="btn_operations" value="Add to friends"/></li>';
		}
		if(!empty($u1) && !empty($u2) && !empty($fr)){
			$t = '';
			foreach($fr as $t){
				//Men ony pozan bolup bilern( Ol meni pozmadyk, blogam etmedik - add to friends, chat)
				if($t['user' . $u1 . '_del'] == 1 && $t['user' . $u2 . '_del'] == 0 && $t['user' . $u2 . '_block'] == 0){
					$btn_operations = '<li><input type="submit" name="btn_send_request_update" id="btn_operations" value="Add to friends"/></li>';
				}
				//Ikimiz hem dost bolsak(Poz, blokla, chat)
				if($t['user' . $u1 . '_accepted'] == 1 && $t['user' . $u2 . '_accepted'] == 1 && $t['user' . $u1 . '_block'] == 0 && $t['user' . $u2 . '_block'] == 0 && $t['user' . $u1 . '_del'] == 0 && $t['user' . $u2 . '_del'] == 0){
					$btn_operations = '<li><input type="submit" name="btn_del_friend" id="btn_del" value="Delete"/></li>' . 
									  '<li><input type="submit" name="btn_block_friend" id="btn_block" value="Block"/></li>';
				}
				//Ol meni kabul etmedik bolup biler (Poz, chat) - Pozamda tutus pozmaly 
				if($t['user' . $u1 . '_accepted'] == 1 && $t['user' . $u2 . '_accepted'] == 0 && $t['user' . $u2 . '_block'] == 0 && $t['user' . $u2 . '_del'] == 0){
					$btn_operations = '<li><input type="submit" name="btn_full_del_friend" id="btn_del" value="Delete"/></li>';
				}
				//Men ony kabul etmedik bolup bilern (add to friends, Poz, chat)
				if($t['user' . $u1 . '_accepted'] == 0 && $t['user' . $u2 . '_accepted'] == 1 && $t['user' . $u2 . '_block'] == 0 && $t['user' . $u2 . '_del'] == 0){
					$btn_operations = '<li><input type="submit" name="btn_accept_friend" id="btn_accept_friend" value="Accept request"/></li>' . 
									  '<li><input type="submit" name="btn_full_del_friend" id="btn_del" value="Delete"/></li>';
				}
				//Ol meni kabul edip pozan bolup biler ( add to friends, chat)
				if($t['user' . $u1 . '_del'] == 0 && $t['user' . $u2 . '_accepted'] == 1 && $t['user' . $u2 . '_del'] == 1){
					$btn_operations = '<li><input type="submit" name="btn_full_del_friend" id="btn_del" value="Delete"/></li>' . 
									  '<li><input type="submit" name="btn_block_friend" id="btn_block" value="Block"/></li>';
				}
				//Men ony block eden bolup bilern (Blockdan ac, Poz, chat)
				if($t['user' . $u1 . '_block'] == 1 && $t['user' . $u2 . '_accepted'] == 1 && $t['user' . $u2 . '_block'] == 0){
					$btn_operations = '<li><input type="submit" name="btn_unblock_and_del_friend" id="btn_del" value="Delete"/></li>' . 
									  '<li><input type="submit" name="btn_unblock_friend" id="btn_block" value="Unblock"/></li>';
				}				
				//Ol meni blocklan bolup biler(Block, Poz)
				if($t['user' . $u2 . '_block'] == 1 && $t['user' . $u1 . '_block'] == 0 && $t['user' . $u2 . '_del'] == 0  && $t['user' . $u1 . '_del'] == 0){
					$btn_operations = '<li><input type="submit" name="btn_del_friend" id="btn_del" value="Delete"/></li>' . 
									  '<li><input type="submit" name="btn_block_friend" id="btn_block" value="Block"/></li>';
					$btn_chat = 'blocked';
				}
				//Ol meni block eden bolsa, menem ony pozan bolsam
				if($t['user' . $u2 . '_block'] == 1 && $t['user' . $u1 . '_block'] == 0 && $t['user' . $u1 . '_del'] == 1){
					$btn_chat = '<li><div type="submit" name="blocked" id="btn_chat_blocked">Not available</div></li>';	
				}
				//Eger ol meni block eden bolsa menem ony block eden bolsam
				if($t['user' . $u1 . '_block'] == 1 && $t['user' . $u2 . '_accepted'] == 1 && $t['user' . $u2 . '_del'] == 0 && $t['user' . $u2 . '_block'] == 1){
					$btn_operations = '<li><input type="submit" name="btn_unblock_and_del_friend" id="btn_del" value="Delete"/></li>' . 
									  '<li><input type="submit" name="btn_unblock_friend" id="btn_block" value="Unblock"/></li>';
					$btn_chat = 'blocked';
				}
				//Ol meni block eden bolsa, menem ony block eden bolsam menem ony pozmadyk
				if($t['user' . $u2 . '_block'] == 1 && $t['user' . $u1 . '_block'] == 1 && $t['user' . $u1 . '_del'] == 0){
					$btn_operations = '<li><input type="submit" name="btn_unblock_and_del_friend" id="btn_del" value="Delete"/></li>';
					$btn_chat = '<li><div type="submit" name="blocked" id="btn_chat_blocked">Not available</div></li>';	
				}
			}	
		}
		
		//Writes the users informations
		//Getting the informations
		$table_users = $db->conn->query('SELECT ' .
			 'firstname, lastname, status, ' . 
			 'country, region, city, street_village, default_image, ' . 
			 'birthday, birthmonth, birthyear, gender, online, ' . 
			 'profession, education_place, languages, hobby, work_place ' .
			 'FROM users WHERE id = "' . $selected_user . '";'); //online my dalmi bilmeli 
		//$table_friends =  $db->conn->query();
		//$table_settings = $db->conn->query();
		//$table_user_images = $db->conn->query();
		//...
		$t = '';
		foreach ($table_users as $t){
			if(empty($btn_operations)){
				$btn_operations = '<li><div type="submit" name="blocked" id="btn_operations_blocked">Not available</div></li>';
			}
			if(empty($btn_chat)){
				if($selected_user == $_SESSION['Agajan_Circle_id']){
					$btn_chat = '<li><div type="submit" name="blocked" id="btn_chat_blocked">Not available</div></li>';	
				}else{
					$btn_chat = '<li><input type="submit" name="btn_chat" id="btn_chat" value="Chat"/></li>';
				}
			}else if($btn_chat == 'blocked'){
				$btn_chat = '';
			}
			if(!empty($notification_status)){
				$notification_status = $notification_status . ' - ' . $t['firstname'] . ' ' . $t['lastname'];
			}
			$friends_informations = '<div class="basic_informations">' .
										'<img src="uploads/user_images/' . $t['default_image'] . '" id="basic_user_image" align="center"/>' .
										'<div class="basic_nav_1">' .
											'<div id="basic_name">' . $t['firstname'] . ' ' . $t['lastname'] . '</div>' .
											'<div id="basic_status">"' . $t['status'] . '"</div>' .
											'<div class="nav_inline"><li style="margin-left: 0.3cm;">0</li><p>Friends</p></div>' .//needs repair
											'<div class="nav_inline"><li style="margin-left: 0.5cm;">0</li><p>Followers</p></div>' .//needs repair
											'<div class="nav_inline" style="text-align: center"><li>0</li><p>Images</p></div>' .//needs repair
											'<div class="nav_inline" style="text-align: center"><li>0</li><p>Videos</p></div>' .//needs repair
										'</div>' .
										'<div class="buttons_field">' .
											$btn_operations .
											$btn_chat .
										'</div>' .
									'</div>' .
									'<div class="inf_field">' . 
										'<div class="infs">' .
											'<li class="li_inline">Place:&nbsp;</li>' .
											'<li class="li_inline"><p class="answer">' .
												$t['country'] . '/' . $t['region'] . '/' . $t['city'] . '/' . $t['street_village'] . 
											'</p></li>' .
										'</div>'.
										'<div class="infs">' . 
											'<li class="li_inline">Gender:&nbsp;</li>' . 
											'<li class="li_inline"><p class="answer">' . 
													$t['gender'] . 
											'</p></li>' .
										'</div>'.
										'<div class="infs">' . 
											'<li class="li_inline">Birthday:&nbsp;</li>' . 
											'<li class="li_inline"><p class="answer">' . 
												$t['birthday'] . '/' . $t['birthmonth'] . '/' . $t['birthyear'] .
											'</p></li>' . 
										'</div>'.
										'<div class="infs">' . 
											'<li class="li_inline">Profession:&nbsp;</li>' . 
											'<li class="li_inline"><p class="answer">' . 
												$t['profession'] .
											'</p></li>' . 
										'</div>'.
										'<div class="infs">' . 
											'<li class="li_inline">Place of work:&nbsp;</li>' . 
											'<li class="li_inline"><p class="answer">' . 
												$t['work_place'] .
											'</p></li>' . 
										'</div>' .
										'<div class="infs">' . 
											'<li class="li_inline">Education place:&nbsp;</li>' . 
											'<li class="li_inline"><p class="answer">' . 
												$t['education_place'] .
											'</p></li>' . 
										'</div>' .
										'<div class="infs">' . 
											'<li class="li_inline">Foreign languages:&nbsp;</li>' . 
											'<li class="li_inline"><p class="answer">' . 
												$t['languages'] .
											'</p></li>' . 
										'</div>' .
										'<div class="infs">' . 
											'<li class="li_inline">Hobbies:&nbsp;</li>' . 
											'<li class="li_inline"><p class="answer">' . 
												$t['hobby'] .
											'</p></li>' . 
										'</div>' .
									'</div>' .
									'<div class="images_field">' .
										'<h1>No photos</h1>' .
									'</div>';
		}
	}		
?>