<?php 
	if(isset($_REQUEST['set_email']) && $_REQUEST['set_email'] == 'true'){
		$alert = '';
		$my_alert = 0;
		$my_alert_style = '';
		$display_form = 0;
		if(empty($alert)){
			$display_form = 1;
		}
		if(isset($_POST['btn_set_email_code']) && !empty($_SESSION['Agajan_Circle_email_not_set']) && !empty($_SESSION['Agajan_Circle_set_email_code'])){
			if(!empty($_POST['code_email_field'])){
				if($_POST['code_email_field'] == $_SESSION['Agajan_Circle_set_email_code']){
					//THE LAST DESTINATION
					if($db->conn->query('UPDATE users SET email = "' . $_SESSION['Agajan_Circle_email_not_set'] . '" WHERE id = ' . $_SESSION['Agajan_Circle_id'] . ';')){
					
						$_SESSION['Agajan_Circle_email'] = $_SESSION['Agajan_Circle_email_not_set'];
						
						$bool = 'email';
						setcookie(('Agajan_Circle_' . $bool), $_SESSION['Agajan_Circle_email'], time() + 60*60*24*30);/* , time() + 60*60*24, path, www.salam.com */
						setcookie('Agajan_Circle_password', $_SESSION['Agajan_Circle_password'], time() + 60*60*24*30);
						setcookie('Agajan_Circle_bool', $bool, time() + 60*60*24*30);
						
						$display_form = 0;
						
						$notification_status = 'Your email address has changed';
					}
				}else{
					$display_form = 2;
					$status = 'Please type the code correctly! If you didn\'t get it in a few seconds, please contact us.';
				}
			}else{
				$display_form = 2;
				$status = 'Please type the code we have sent to your email address! If you didn\'t get it in a few seconds, please contact us.';
			}
		}
		if(isset($_POST['btn_set_email']) || $display_form == 2){
			if((isset($_POST['email_field']) && !empty($_POST['email_field'])) || $display_form == 2){
				if(!empty($status)){
					$warn = $form->controller('email', $status, '', 'block');
					$if_warn_js = 'var error = 1;';
				}else{
					$warn = '';
					$if_warn_js = 'var error = 0;';
				}
				if(!empty($_POST['email_field'])){
					$email = $str->clean(trim($_POST['email_field']));
				}else if(!empty($_SESSION['Agajan_Circle_email_not_set'])){
					$email = $_SESSION['Agajan_Circle_email_not_set'];
				}
				if($form->valid_email($email) == true){
					$_SESSION['Agajan_Circle_email_not_set'] = $email;
					if(empty($_SESSION['Agajan_Circle_set_email_code'])){
						$_SESSION['Agajan_Circle_set_email_code'] = rand(10000, 99999);
					}
					$display_form = 0;
					$alert = '';
					$my_alert = 1;
					$my_alert_style = 'include/css/home_set_email_style.css';
					$alert .= '<div id="img_background" style="height=50%;">' .
									'<div id="alert_header">' .
										'<div id="text_header">Setting the email</div>' . 
										'<a href="?" id="close_anchor"><div id="close_button">x</div></a>' .
									'</div>' .
									'<div id="alert_body">' . 
										'<div id="alert_body_header">Email address</div>' .
										'<form method="POST" action="?set_email=true">' .
											'<div id="alert_buttons_field">' .
												'<li>' .
													'<label id="lbl_email_field">Email address:</label><br/>' .
													'<input type="email" id="email_field_blocked" name="email_field" value="' . $email. '" disabled="disabled">' .
												'</li>' .
												'<li id="li_code_email_field">' .
													'<label id="lbl_code_email_field">Type the code we have sent:</label><br/>' .
													'<input type="text" id="code_email_field" name="code_email_field" placeholder="Type the code we have sent" value = "' . $form->old('code_email', 'request') . '"/>' .
													$warn .
												'</li>' .
												'<li>' .
													'<input type="submit" id="btn_set_email_code" name="btn_set_email_code" value="Save">' .
												'</li>' .
											'</div>' .
										'</form>' .
									'</div>' . 
								'</div>' .
								'<script>' .
									'var code = "' . $_SESSION['Agajan_Circle_set_email_code'] . '";' .
									$if_warn_js .
								'</script>' .
								'<script src="include/js/home_set_email_code.js"></script>';
				}else{
					$status = 'Please enter a valid email address';
				}
			}else{
				$status = 'Please type your email address';
			}
		}
		
		if($display_form == 1){
			$my_alert = 1;
			$_SESSION['Agajan_Circle_set_email_code'] = '';
			$my_alert_style = 'include/css/home_set_email_style.css';
			if(!empty($status)){
				$warn = $form->controller('email', $status, '', 'block');
			}else{
				$warn = '';
			}
			$alert .= '<div id="img_background">' .
				'<div id="alert_header">' .
					'<div id="text_header">Setting the email</div>' . 
					'<a href="?" id="close_anchor"><div id="close_button">x</div></a>' .
				'</div>' .
				'<div id="alert_body">' . 
					'<div id="alert_body_header">Email address</div>' .
					'<form method="POST" action="?set_email=true">' .
						'<div id="alert_buttons_field">' .
							'<li>' .
								'<label id="lbl_email_field">Email address:</label><br/>' .
								'<input type="text" id="email_field" name="email_field" placeholder="Example@mail.com" value = "' . $form->old('email', 'request') . '">' .
								$warn .
							'</li>' .
							'<li>' .
								'<input type="submit" id="btn_set_email" name="btn_set_email" value="Go">' .
							'</li>' .
						'</div>' .
					'</form>' .
				'</div>' . 
			'</div>' .
			'<script src="include/js/home_set_email.js"></script>';
		}
	}
?>