<?php
	session_start();
	require "include/functions/form_class.php";
	require "include/functions/string_class.php";
	require "include/functions/database_class.php";
	require "include/languages/pass_forgotten_lang.php";
	$str = new str();
	$form = new form();
	$password = '';
	if(isset($_POST['btn_send'])){
		if(!empty($_POST['address_field'])){
			$password = '';
			$s = $str->clean(trim($_POST['address_field']));
			$bool = $form->number_email($s);
			if(($bool == 'mobilenumber') || ($bool == 'email' && $form->valid_email($s) == true)){
				$db = new database('agajan_salam');
				if(!$db) die('There was a problem connecting to database');
				
				$PDO_user = '';
				$PDO_user = $db->conn->query('SELECT password FROM users WHERE ' . $bool . ' = "' . $s . '";');
				
				if($PDO_user->rowcount() == 1){
					foreach($PDO_user as $pass){
						$password = $pass['password'];
					}
				}else{
					$status = $lang[$_SESSION['agajan_lang']]['not_found_' . $bool];
				}
			}else{
				$status = $lang[$_SESSION['agajan_lang']]['valid_information'];
			}
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="description" content=""/>
        <meta name="author" content="">
        <title><?php echo $str->get_site_name() . ".com";?></title>
        <link href="assets/ico.png" rel="shortcut icon" type="image/x-icon" />    
		<link rel="stylesheet" href="include/css/pass_forgotten.css"/>
	</head>
	<script src="include/js/objects.js"></script>
	<body id="body">
		<form method="POST" action="" id="form">
			<div class="header">
				<li><img src="assets/logo_2.png" id="logo"/></li>
				
				<a href="login.php">
					<div class="field_back_all"><div class="field_back"><img src="assets/back.png" id="back_icon"/></div></div>
				</a>
			</div>
			<?php
				if(!empty($password)){
					echo '<div class="password_notification" id="password_notification">' . 
							'<li id="password_notification_message">' . $lang[$_SESSION['agajan_lang']]['your_password_is'] . ' - ' . $password . '</li>' .
						'</div>' .
						'<script>form.flash("password");</script>';
					$status = $lang[$_SESSION['agajan_lang']]['we_have_sent'];
				}
			?>
			<div class="section">
					<div class="section_header">
						<li id="app_name"><?php echo $str->get_site_name() . '.com'; ?></li>
						<li id="pass_forgotten"><?php echo $lang[$_SESSION['agajan_lang']]['pf_header']?></li>
					</div>
					<div id="section_main" class="section_main">
						<?php 
							if(!empty($status)){
								echo '<div class="status">' . 
										'<img src="assets/warner.png">' .
										$status . 
									'</div>'; 
							}
						?>
						<li id="field_1">
							<label id="lbl_address"><?php echo $lang[$_SESSION['agajan_lang']]['lbl_address'] . ':'?></label><br/>
							<input type="text" name="address_field" id="address_field" class="txt_field" placeholder="<?php echo $lang[$_SESSION['agajan_lang']]['lbl_address'];?>" value="<?php echo $form->old('code'); ?>"><br/>
							<?php echo $form->controller('address_field', $lang[$_SESSION['agajan_lang']]['fill_out']);?>
						</li>
						<li id="field_2">
							<?php echo $lang[$_SESSION['agajan_lang']]['we_will_send'];?>
						</li>
						<p align="right"><input type="submit" name="btn_send" id="btn_send" class="btn" value="<?php echo $lang[$_SESSION['agajan_lang']]['btn_send'];?>"/></p>
					</div>
			</div>
		</form>
	</body>
	<script src="include/js/pass_forgotten_control.js"></script>
</html>