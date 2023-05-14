<?php 
	if(isset($_REQUEST['close_password']) && $_REQUEST['close_password'] == 'true'){
		$_SESSION['Agajan_Circle_old_password'] = '';
	}
	if(isset($_REQUEST['set_password']) && $_REQUEST['set_password'] == 'true'){
		if(isset($_SESSION['Agajan_Circle_old_password']) && $_SESSION['Agajan_Circle_old_password'] !== $_SESSION['Agajan_Circle_password']){
			$_SESSION['Agajan_Circle_old_password'] = '';
		}
		//SETTING THE OLD PASSWORD --- IT HELPS TO KNOW THIS IS THE REAL USER
		if(empty($_SESSION['Agajan_Circle_old_password'])){
			$display = 'none';
			$height = '60%';
			$my_alert = 1;
			$my_alert_style = 'include/css/home_set_password_style.css';
			$set_password_2 = '?set_password=true&full_information=true';
			$status = '';
			
			if(isset($_POST['btn_set_password_old'])){
				if(!empty($_POST['password_old_field'])){
					if($_POST['password_old_field'] == $_SESSION['Agajan_Circle_password']){
						$_SESSION['Agajan_Circle_old_password'] = $_POST['password_old_field'];
					}else{
						$status = 'Please, type your current password correctly!';
					}
				}else{
					$status = 'Please, type your current password!';
				}
			}
			if(!empty($status)){
				$warn = $form->controller('password', $status, '', 'block');
			}else{
				$warn = $form->controller('password', $status, '', 'none');
			}
			$alert .= '<div id="img_background" style="height: ' . $height . '">' .
						'<div id="alert_header">' .
							'<div id="text_header">Setting the password</div>' . 
							'<a href="?full_information=true" id="close_anchor"><div id="close_button">x</div></a>' .
						'</div>' .
						'<div id="alert_body">' . 
							'<div id="alert_body_header">Current Password</div>' .
							'<form method="POST" action="' . $set_password_2 . '" id="frm_new_password">' .
								'<div id="alert_buttons_field">' .
									'<li>' .
										'<label id="lbl_password_field">Current Password:</label><br/>' .
										'<input type="password" id="password_field" name="password_old_field" placeholder="Type here your password">' .
										$warn .
									'</li>' .
									'<li>' .
										'<input type="submit" id="btn_set_password" name="btn_set_password_old" value="Go">' .
									'</li>' .
								'</div>' .
							'</form>' .
						'</div>' . 
					'</div>';
		}
		
		if(isset($_SESSION['Agajan_Circle_old_password']) && $_SESSION['Agajan_Circle_old_password'] == $_SESSION['Agajan_Circle_password']){
			$alert = '';
			$my_alert = 0;
			$my_alert_style = '';
			
			$display = 'none';
			$height = '60%';
			$my_alert = 1;
			$my_alert_style = 'include/css/home_set_password_style.css';
			$scripts = '<script src="include/js/home_set_password_1.js"></script>';
			$set_password_2 = '?set_password=true&full_information=true';
			$status = '';$status_2 = '';
			if(isset($_POST['btn_set_password'])){
				if(empty($_POST['password_field'])){
					$status = 'Type your password here, please!';
				}else{
					$set_password_2 .= '&set_password_2=true';
					$display = 'block';
					$height = '73%';
					$scripts .= '<script>' . 'var error = 0;' .  '</script>' .
								'<script src="include/js/home_set_password.js"></script>';
					if(isset($_REQUEST['set_password_2']) && $_REQUEST['set_password_2'] == 'true'){
						if(empty($_POST['password_2_field'])){
							$status_2 = 'Type your password again, please!';
							$scripts .= '<script>document.getElementById("btn_set_password").onclick = function(){form.button_anim("btn_set_password", 0);}</script>';
						}else{
							if($_POST['password_field'] == $_POST['password_2_field']){
								//THE LAST DESTINATION
								if($db->conn->query('UPDATE users SET password = "' . $_POST['password_field'] . '" WHERE id = ' . $_SESSION['Agajan_Circle_id'] . ';')){
									$_SESSION['Agajan_Circle_password'] = $_POST['password_field'];
									setcookie('Agajan_Circle_password', $_SESSION['Agajan_Circle_password'], time() + 60*60*24*30);
									$notification_status = 'Your password has changed';
									$set_password_2 = '';
									$_SESSION['Agajan_Circle_old_password'] = '';
								}
							}else{
								$status_2 = 'This password doesn\'t match with first!';
								$scripts .= '<script>document.getElementById("btn_set_password").onclick = function(){form.button_anim("btn_set_password", 0);}</script>';
							}
						}
					}
				}
			}

			if(!empty($status)){
				$warn = $form->controller('password', $status, '', 'block');
			}else{
				$warn = $form->controller('password', $status, '', 'none');
			}
			if(!empty($status_2)){
				$warn_2 = $form->controller('password_2', $status_2, '', 'block');
			}else{
				$warn_2 = $form->controller('password_2', $status_2, '', 'none');
			}
			
			$alert .= '<div id="img_background" style="height: ' . $height . '">' .
						'<div id="alert_header">' .
							'<div id="text_header">Setting the password</div>' . 
							'<a href="?full_information=true&close_password=true" id="close_anchor"><div id="close_button">x</div></a>' .
						'</div>' .
						'<div id="alert_body">' . 
							'<div id="alert_body_header">New Password</div>' .
							'<form method="POST" action="' . $set_password_2 . '" id="frm_new_password">' .
								'<div id="alert_buttons_field">' .
									'<li>' .
										'<label id="lbl_password_field">Password:</label><br/>' .
										'<input type="password" id="password_field" name="password_field" placeholder="Type here your password" value="' . $form->old('password', 'request') . '">' .
										$warn .
									'</li>' .
									'<li id="li_password_2_field" style="display:' . $display . '">' .
										'<label id="lbl_password_2_field">Type your password again:</label><br/>' .
										'<input type="password" id="password_2_field" name="password_2_field" placeholder="Type your password again" value="' . $form->old('password_2', 'request') . '">' .
										$warn_2 .
									'</li>' .
									'<li>' .
										'<input type="submit" id="btn_set_password" name="btn_set_password" value="Go">' .
									'</li>' .
								'</div>' .
							'</form>' .
						'</div>' . 
					'</div>' . 
					$scripts;
			if(empty($set_password_2)){
				$alert = '';
				$my_alert = 0;
				$my_alert_style = '';
			}
		}
	}
?>