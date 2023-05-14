<?php 
	if(isset($_REQUEST['set_mobile_number']) && $_REQUEST['set_mobile_number'] == 'true'){
		$alert = '';
		$my_alert = 0;
		$my_alert_style = '';
		$display_form = 0;
		if(empty($alert)){
			$display_form = 1;
		}
		if(isset($_POST['btn_set_mobile_number_code']) && !empty($_SESSION['Agajan_Circle_mobile_number_not_set']) && !empty($_SESSION['Agajan_Circle_set_mobile_number_code'])){
			if(!empty($_POST['code_mobile_number_field'])){
				if($_POST['code_mobile_number_field'] == $_SESSION['Agajan_Circle_set_mobile_number_code']){
					//THE LAST DESTINATION
					if($db->conn->query('UPDATE users SET mobilenumber = "' . $_SESSION['Agajan_Circle_mobile_number_not_set'] . '" WHERE id = ' . $_SESSION['Agajan_Circle_id'] . ';')){
					
						$_SESSION['Agajan_Circle_mobilenumber'] = $_SESSION['Agajan_Circle_mobile_number_not_set'];
						
						$bool = 'mobilenumber';
						setcookie(('Agajan_Circle_' . $bool), $_SESSION['Agajan_Circle_mobilenumber'], time() + 60*60*24*30);/* , time() + 60*60*24, path, www.salam.com */
						setcookie('Agajan_Circle_password', $_SESSION['Agajan_Circle_password'], time() + 60*60*24*30);
						setcookie('Agajan_Circle_bool', $bool, time() + 60*60*24*30);
						
						$display_form = 0;
						
						$notification_status = 'Your mobile number has changed';
					}
				}else{
					$display_form = 2;
					$status = 'Please type the code correctly! If you didn\'t get it in a few seconds, please contact us.';
				}
			}else{
				$display_form = 2;
				$status = 'Please type the code we have sent to your Mobile number! If you didn\'t get it in a few seconds, please contact us.';
			}
		}
		if(isset($_POST['btn_set_mobile_number']) || $display_form == 2){
			if((isset($_POST['mobilenumber_field']) && !empty($_POST['mobilenumber_field'])) || $display_form == 2){
				if(!empty($status)){
					$warn = $form->controller('mobilenumber', $status, '', 'block');
					$if_warn_js = 'var error = 1;';
				}else{
					$warn = '';
					$if_warn_js = 'var error = 0;';
				}
				if(!empty($_POST['mobilenumber_field'])){
					$mobilenumber = $str->clean(trim($_POST['mobilenumber_field']));
				}else if(!empty($_SESSION['Agajan_Circle_mobile_number_not_set'])){
					$mobilenumber = $_SESSION['Agajan_Circle_mobile_number_not_set'];
				}
				if($form->valid_mobilenumber($mobilenumber) == true){
					$_SESSION['Agajan_Circle_mobile_number_not_set'] = $mobilenumber;
					if(empty($_SESSION['Agajan_Circle_set_mobile_number_code'])){
						$_SESSION['Agajan_Circle_set_mobile_number_code'] = rand(10000, 99999);
					}
					$display_form = 0;
					$alert = '';
					$my_alert = 1;
					$my_alert_style = 'include/css/home_set_mobile_number_style.css';
					$alert .= '<div id="img_background" style="height=50%;">' .
									'<div id="alert_header">' .
										'<div id="text_header">Setting the mobile number</div>' . 
										'<a href="?" id="close_anchor"><div id="close_button">x</div></a>' .
									'</div>' .
									'<div id="alert_body">' . 
										'<div id="alert_body_header">Mobile number</div>' .
										'<form method="POST" action="?set_mobile_number=true">' .
											'<div id="alert_buttons_field">' .
												'<li>' .
													'<label id="lbl_mobilenumber_field">Mobile number:</label><br/>' .
													'<input type="text" id="mobilenumber_field_blocked" name="mobilenumber_field" value="' . $mobilenumber. '" disabled="disabled">' .
												'</li>' .
												'<li id="li_code_mobile_number_field">' .
													'<label id="lbl_code_mobile_number_field">Type the code we have sent:</label><br/>' .
													'<input type="text" id="code_mobile_number_field" name="code_mobile_number_field" placeholder="Type the code we have sent" value = "' . $form->old('code_mobilenumber', 'request') . '"/>' .
													$warn .
												'</li>' .
												'<li>' .
													'<input type="submit" id="btn_set_mobile_number_code" name="btn_set_mobile_number_code" value="Save">' .
												'</li>' .
											'</div>' .
										'</form>' .
									'</div>' . 
								'</div>' .
								'<script>' .
									'var code = "' . $_SESSION['Agajan_Circle_set_mobile_number_code'] . '";' .
									$if_warn_js .
								'</script>' .
								'<script src="include/js/home_set_mobile_number_code.js"></script>';
				}else{
					$status = 'Please enter a valid Mobile number';
				}
			}else{
				$status = 'Please type your Mobile number';
			}
		}
		if($display_form == 1){
			$my_alert = 1;
			$_SESSION['Agajan_Circle_set_mobile_number_code'] = '';
			$my_alert_style = 'include/css/home_set_mobile_number_style.css';
			if(!empty($status)){
				$warn = $form->controller('mobilenumber', $status, '', 'block');
			}else{
				$warn = '';
			}
			$alert .= '<div id="img_background">' .
				'<div id="alert_header">' .
					'<div id="text_header">Setting the mobile number</div>' . 
					'<a href="?" id="close_anchor"><div id="close_button">x</div></a>' .
				'</div>' .
				'<div id="alert_body">' . 
					'<div id="alert_body_header">Mobile number</div>' .
					'<form method="POST" action="?set_mobile_number=true">' .
						'<div id="alert_buttons_field">' .
							'<li>' .
								'<label id="lbl_mobilenumber_field">Mobile number:</label><br/>' .
								'<input type="text" id="mobilenumber_field" name="mobilenumber_field" placeholder="Type your mobile number" value = "' . $form->old('mobilenumber', 'request') . '">' .
								$warn .
							'</li>' .
							'<li>' .
								'<input type="submit" id="btn_set_mobile_number" name="btn_set_mobile_number" value="Go">' .
							'</li>' .
						'</div>' .
					'</form>' .
				'</div>' . 
			'</div>' .
			'<script src="include/js/home_set_mobile_number.js"></script>';
		}
	}
?>