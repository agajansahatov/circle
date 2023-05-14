<?php 
	
	if(!empty($_REQUEST['selected_id'])){
		$selected_id = $_REQUEST['selected_id'];
	}else{
		$selected_id = '0';
	}
	
	$this_page = 'friends';	
	
	if($db){
		if(isset($_POST['btn_search']) || (isset($_REQUEST['js']) && $_REQUEST['js'] == 'not_available')){
			if(!empty($_REQUEST['search_list'])){
				$case1 = 'firstname = ' . '"' . $_REQUEST['search_list'] . '"';
				$case1 .= ' or ' . 'lastname = ' . '"' . $_REQUEST['search_list'] . '"';
			}
			if(!empty($case1)){
				require "include/functions/HTML_class.php";
				$HTML = new HTML();
				$PDO_users = $db->conn->query('SELECT id FROM users WHERE ' . $case1);
				$t = '';
				$friends_list = '';
				$indicator = $PDO_users->rowcount();
				foreach($PDO_users as $t){
					$PDO_user = $db->conn->query('SELECT id, firstname, lastname, status, default_image from users WHERE id = "' . $t['id'] . '"');
					$friends_list .= $HTML->make_standart_form($PDO_user, $selected_id,  ('&search_list=' . $_REQUEST['search_list'] . '&menu_top=' . 'people&js=not_available'));
				}
			}
		}
		else{
			$PDO_users = $db->conn->query('SELECT ' .
					 'id, firstname, lastname, status, ' . 
					 'country, region, city, street_village, default_image, ' . 
					 'birthday, birthmonth, birthyear, gender, email, mobilenumber, ' . 
					 'profession, education_place, languages, hobby, work_place ' .
					 'FROM users');
			$users = array();
			$js_users = '';
			foreach ($PDO_users as $users){
				$js_users .= 'users[' . $users['id'] . '] = [];';
				$js_users .= 'users[' . $users['id'] . '][\'firstname\'] = "' . $str->clean($users['firstname']) . '";';//searched
				$js_users .= 'users[' . $users['id'] . '][\'lastname\'] = "' . $str->clean($users['lastname']) . '";';//searched
				$js_users .= 'users[' . $users['id'] . '][\'birthday\'] = "' . $str->clean($users['birthday']) . '";';
				$js_users .= 'users[' . $users['id'] . '][\'birthmonth\'] = "' . $str->clean($users['birthmonth']) . '";';
				$js_users .= 'users[' . $users['id'] . '][\'birthyear\'] = "' . $str->clean($users['birthyear']) . '";';
				$js_users .= 'users[' . $users['id'] . '][\'gender\'] = "' . $str->clean($users['gender']) . '";';
				$js_users .= 'users[' . $users['id'] . '][\'default_image\'] = "' . $str->clean($users['default_image']) . '";';//searched
				$js_users .= 'users[' . $users['id'] . '][\'email\'] = "' . $str->clean($users['email']) . '";';//searched
				$js_users .= 'users[' . $users['id'] . '][\'mobilenumber\'] = "' . $str->clean($users['mobilenumber']) . '";';//searched
				$js_users .= 'users[' . $users['id'] . '][\'status\'] = "' . $str->clean($users['status']) . '";';
				$js_users .= 'users[' . $users['id'] . '][\'country\'] = "' . $str->clean($users['country']) . '";';
				$js_users .= 'users[' . $users['id'] . '][\'region\'] = "' . $str->clean($users['region']) . '";';
				$js_users .= 'users[' . $users['id'] . '][\'city\'] = "' . $str->clean($users['city']) . '";';
				$js_users .= 'users[' . $users['id'] . '][\'street_village\'] = "' . $str->clean($users['street_village']) . '";';
				$js_users .= 'users[' . $users['id'] . '][\'profession\'] = "' . $str->clean($users['profession']) . '";';
				$js_users .= 'users[' . $users['id'] . '][\'education_place\'] = "' . $str->clean($users['education_place']) . '";';
				$js_users .= 'users[' . $users['id'] . '][\'languages\'] = "' . $str->clean($users['languages']) . '";';
				$js_users .= 'users[' . $users['id'] . '][\'hobby\'] = "' . $str->clean($users['hobby']) . '";';//searched
				$js_users .= 'users[' . $users['id'] . '][\'work_place\'] = "' . $str->clean($users['work_place']) . '";
				';
				if((isset($_REQUEST['value_u'])) && ($users['id'] == $_REQUEST['value_u'])){ // Anyklamaly
					$friend_new = $users['firstname'] . ' ' . $users['lastname'];
				}
			}
		}
	}
	if($db && !empty($_REQUEST['selected_id'])){
		$selected_user = $_REQUEST['selected_id'];
		require "include/templates/user_information.php";
	}
	require "include/templates/search_people_html.php";
?>