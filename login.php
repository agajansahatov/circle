<?php 
	session_start();
	if(isset($_POST['btn_signup'])){
		$_SESSION['agajan_lang'] = $_POST['lang'];
		header('location: register1.php');
	}
	if(isset($_POST['pass_forgot'])){
		$_SESSION['agajan_lang'] = $_POST['lang'];
		header('location: pass_forgotten.php');
	}
	require "include/functions/form_class.php";
	require "include/functions/string_class.php";
	require "include/functions/database_class.php";
	
	$str = new str();
	$form = new form();
	
	if(!isset($_SESSION['agajan_lang'])){ $_SESSION['agajan_lang'] = 'english';}
	
	if(isset($_POST['btn_login'])){
		$_SESSION['agajan_lang'] = $str->clean($_POST['lang']);
		$db = new database('agajan_circle');
		if(!$db) die('There was a problem connecting to database');
		
		if($db){
			if( !empty($_POST['address_field']) && !empty($_POST['password_field']) && !empty($_POST['lang']) ){
				
				$s = $str->clean(trim($_POST['address_field']));
				$bool = $form->number_email($s);
				
				if(($bool == 'mobilenumber' && $form->valid_mobilenumber($s) == true ) || ($bool == 'email' && $form->valid_email($s) == true)){
				
					$PDO_user1 = $db->conn->query('SELECT id FROM users WHERE ' . $bool . ' = "' . $s . '";');// bool 'mobilenumber'-mi yada 'email'-e gora tapmalymy? \ony gorkezyar
					if($PDO_user1->rowcount() == 1){ //Ilki şol user barmy diyip barlayar
						$PDO_user2 = $db->conn->query('SELECT id FROM users WHERE ' . $bool . ' = "' . $s . '" and password = "' . $str->clean($_POST['password_field']) . '";');
					
						if($PDO_user2->rowcount() == 1){ // Son şol user tapylsa, password bilen gabat gelyärmi diýip barlaýar
								setcookie(('Agajan_Circle_' . $bool), $s, time() + 60*60*24*30);/* , time() + 60*60*24, path, www.salam.com */
								setcookie('Agajan_Circle_password', $str->clean($_POST['password_field']), time() + 60*60*24*30);
								setcookie('Agajan_Circle_bool', $bool, time() + 60*60*24*30);
								$_SESSION['Agajan_Circle_register_or_login'] = 'login';
								header('location: index.php'); //hemme zat dogry bolansoň index.php gidýär.
							
							
						}else if($PDO_user2->rowcount() == 0){
							$status = '<li id="incorrect_pass">Your password is incorrect!</li>';
						}else{
						$db->conn->query('INSERT INTO errors(error, user_id, user_mobilenumber,) values(' . //Haçanda bir yalňyşlyk ýüze çyksa (kod bilen bagly) admine habar berýär
											'\'' . 'more than one user in login.php where the password is incorrect' . '\', ' .
											'\'' . $s . '\', ' .
											'\'' . $str->clean($_SESSION['agajan_password']) . '\');'
									);
							$status = '<li id="no_' . $bool .'">There is no account connected to this ' . $bool . '</li>';
						}
					}else if( $PDO_user1->rowcount() == 0 ){
						$status = '<li id="no_' . $bool .'">There is no account connected to this ' . $bool . '</li>';
					}else{
						$db->conn->query('INSERT INTO errors(error, user_id, user_mobilenumber,) values(' . //Haçanda bir yalňyşlyk ýüze çyksa (kod bilen bagly) admine habar berýär
											'\'' . 'more than one user in login.php where there is no account' . '\', ' .
											'\'' . $s . '\', ' .
											'\'' . $str->clean($_SESSION['agajan_password']) . '\');'
									);
						$status = '<li id="no_' . $bool .'">There is no account connected to this ' . $bool . '</li>';
					}	
				}else{
					$status = '<li id="address_incorrect">Please provide your informations correctly!</li>';
				}
			}else{
				$status = '<li id="provide_all">Please provide all informations!</li>';
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
        <title><?php echo $str->get_site_name();?></title>
        <link href="assets/ico.png" rel="shortcut icon" type="image/x-icon" />    
		<link rel="stylesheet" href="/include/css/login.css"/>
	</head>
	<body id="body">
		<form method="POST" action="" id="frm">
			<div class="header">
				<img src="assets/logo_2.png" id="logo"/>
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
				</div>
				<div class="section_main">
						<?php 
							if(!empty($status)){
								echo '<div class="status">' . 
										'<img src="/assets/warner.png">' .
										$status . 
									'</div>'; 
							}
						?>
						<li>
							<label id="phone_number">Mobile number or email address:</label><br/>
							<input type="text" name="address_field" id="phone_number_field" class="txt_field" value="<?php if(!empty($_REQUEST['address_field'])){echo $_REQUEST['address_field'];}?>" placeholder="Type your mobile number or email address"/>
							<?php echo $form->controller('phone_number', 'Type your mobile number!', '', 'none');?>
						</li>
						<li>
							<label id="password">Password :</label><br/>
							<input type="password" name="password_field" id="password_field" class="txt_field" value="<?php if(!empty($_REQUEST['password_field'])){echo $_REQUEST['password_field'];} ?>" placeholder="Type your password">
							<?php echo $form->controller('password_field', 'Type your password!');?>
						</li>
						<p align="left">
							<input type="submit" name="pass_forgot" id="pass_forgot" class="btn" value="Forgotten_password?"/>
						</p>
						<p align="right">
							<input type="submit" name="btn_login" id="btn_login" class="btn" value="Log in"/>
						</p>
				</div>
				<div class="footer">
					<p align="center"><input type="submit" name="btn_signup" id="btn_signup" class="btn" value="Create new account"/></p>
				</div>
			</div>
		</form>
	</body>
	<script src="include/js/objects.js"></script>
	<script src="include/js/login_controll.js"></script>
	<script src="include/js/login_lang.js"></script>
</html>