<?php 
	session_start();
	
	require "include/functions/form_class.php";
	require "include/functions/string_class.php";
	require "include/functions/database_class.php";
	
	$str = new str();
	$form = new form();
	
	if(!isset($_SESSION['agajan_lang'])){ $_SESSION['agajan_lang'] = 'türkmençe';}
	
	if(isset($_POST['btn_next'])){
		$_SESSION['agajan_lang'] =  $_POST['lang'];
		if(!empty($_POST['firstname_field']) && !empty($_POST['address_field']) && !empty($_POST['password_field_1']) && !empty($_POST['password_field_2'])){
			$s = $str->clean(trim($_POST['address_field']));
			$bool = $form->number_email($s);
			if(($bool == 'mobilenumber' && $form->valid_mobilenumber($s) == true ) || ($bool == 'email' && $form->valid_email($s) == true)){
				if($_POST['password_field_1'] == $_POST['password_field_2']){
					$db = new database('agajan_circle');
					if(!$db) die('There was a problem connecting to database');
					$PDO_user = $db->conn->query('SELECT id FROM users WHERE ' . $bool . ' = "' . $s . '";');
					if($PDO_user->rowcount() == 0){
						$_SESSION['agajan_firstname'] = $_POST['firstname_field'];
						$_SESSION['agajan_lastname'] = $_POST['lastname_field'];
						$_SESSION['agajan_' . $bool] = $s;
						$_SESSION['agajan_password'] = $_POST['password_field_1'];
						$_SESSION['agajan_lang'] =  $_POST['lang'];
						$_SESSION['agajan_code'] = rand(1000000, 999999999);
						$_SESSION['agajan_bool'] = $bool;
						header("location: register2.php");
					}
					else if($PDO_user->rowcount() == 1){
						$status = '<li id="have_' . $bool . '">There is an account already connected to this ' . $bool . '!</li>';
					}else{
						$db->conn->query('INSERT INTO errors(error,user_id, user_mobilenumber,) values(' . //Haçanda bir yalňyşlyk ýüze çyksa (kod bilen bagly) admine habar berýär
								'\'' . 'more than one user in signin.php' . '\', ' .
								'\'' . $str->clean($_SESSION['agajan_' . $bool]) . '\', ' .
								'\'' . $str->clean($_SESSION['agajan_password']) . '\');'
						);
					}
				}else{
					$status = '<li id="status_passwords">Passwords doesn\'t match!</li>';
				}
			}else{
				$status = '<li id="type_' . $bool . '_correctly">Please type your ' . $bool . ' correctly!</li>';
			}
		}
		else{
			$status = '<li id="status_empty">Please provide all informations!</li>';
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
		<link rel="stylesheet" href="include/css/register1.css"/>
	</head>
	<body id="body">
		<form method="POST" action="" id="form">
			<div class="header">
				<li><img src="assets/logo_2.png" id="logo"/></li>
				
					<a href="login.php">
						<div class="field_back_all"><div class="field_back"><img src="assets/back.png" id="back_icon"/></div></div>
					</a>
					<select name="lang" id="lang" size="1">
						<?php 
							if(!empty($_SESSION['agajan_lang'])){
								echo "<option selected='selected'>" . $_SESSION['agajan_lang'] ."</option>";
								if($_SESSION['agajan_lang']!='english') echo '<option>english</option>';
								if($_SESSION['agajan_lang']!='türkmençe') echo '<option>türkmençe</option>';
								if($_SESSION['agajan_lang']!='русский') echo '<option>русский</option>';
								if($_SESSION['agajan_lang']!='türkçe') echo '<option>türkçe</option>';
							}
						?>
					</select>
					
			</div>
			<div class="section">
					<div class="section_header">
						<li id="app_name"><?php echo $str->get_site_name() . '.com'; ?></li>
						<li id="registration">Registration</li>
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
						<li>
							<label id="lbl_firstname">Firstname :</label><br/>
							<input type="text" name="firstname_field" id="PHfirstname" class="txt_field" placeholder="Type your firstname" value="<?php echo $form->old('firstname'); ?>"><br/>
							<?php echo $form->controller('firstname', 'Type your firstname!');?>
						</li>
						<li>
							<label id="lbl_lastname">Lastname :</label><br/>
							<input type="text" name="lastname_field" id="PHlastname" class="txt_field" placeholder="Type your lastname" value="<?php echo $form->old('lastname'); ?>"><br/>
							<?php echo $form->controller('lastname', 'Type your lastname!');?>
						</li>
						<li>
							<label id="phone_number">Mobile number or Email address:</label><br/>
							<input type="text" name="address_field" id="phone_number_field" class="txt_field" value="<?php if(!empty($_REQUEST['address_field'])){echo $_REQUEST['address_field'];}?>"placeholder="Mobile number or email address"/>
							<?php echo $form->controller('phone_number', 'Type your mobile number!');?>
						</li>
						<li>
							<label id="password">Password :</label><br/>
							<input type="password" name="password_field_1" id="password_field_1" class="txt_field" value="<?php if(!empty($_REQUEST['password_field_1'])){echo $_REQUEST['password_field_1'];} ?>" placeholder="Type your password">
							<?php echo $form->controller('password_field_1', 'Type your password!');?>
						</li>
						<li>
							<label id="password_correction">Type your password again :</label><br/>
							<input type="password" id="password_field_2" name="password_field_2" class="txt_field"  value="<?php if(!empty($_REQUEST['password_field_2'])){echo $_REQUEST['password_field_2'];} ?>" placeholder="Type your password again">
							<?php echo $form->controller('password_field_2', 'Type your password again!');?>
							<?php echo $form->controller('password_2', 'This password doesn\'t match with the other!');?>
						</li>
						<p align="right"><input type="submit" name="btn_next" id="btn_next" class="btn" value="Next"/></p>
					</div>
			</div>
		</form>
	</body>
	<script src="include/js/objects.js"></script>
	<script src="include/js/registration_lang.js"></script>
	<script src="include/js/register1_control.js"></script>
</html>