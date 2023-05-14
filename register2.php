<?php 
	//IP adres(just reminder) - $_SERVER['SERVER_ADDR'];
	//Haýsy engine-dan register bolanyny save etmeli, başga zatdan girende habar berer yaly...
	session_start();
	
	$_SESSION['agajan_register_or_login'] = '';
	
	require "include/functions/form_class.php";
	require "include/functions/string_class.php";
	require "include/functions/database_class.php";
	require "include/languages/register2_lang.php";
	
	$str = new str();
	$form = new form();

	if(empty($_SESSION['agajan_firstname']) || empty($_SESSION['agajan_lastname']) || empty($_SESSION['agajan_' . $_SESSION['agajan_bool']]) || empty($_SESSION['agajan_password']) || empty($_SESSION['agajan_lang']) || empty($_SESSION['agajan_code'])){
		header('location: register1.php');
	}
	if(isset($_POST['btn_next'])){
		if(!empty($_POST['code_field'])){
			if(isset($_POST['agree'])){
				if($_POST['code_field'] == $_SESSION['agajan_code']){
					$db = new database('agajan_circle');
					if(!$db) die('There was a problem connecting to database');
					
					if($db){
						if( !empty($_SESSION['agajan_firstname']) && 
							!empty($_SESSION['agajan_lastname']) &&
							!empty($_SESSION['agajan_lang']) &&
							!empty($_SESSION['agajan_' . $_SESSION['agajan_bool']]) &&
							!empty($_SESSION['agajan_password'])
						){
							//Öň şul nomer bamy? Barlaýar. Eger ýok bolsa täze user goşýar.
							$PDO_user = $db->conn->query('SELECT id FROM users WHERE ' . $_SESSION['agajan_bool'] . ' = "' . $str->clean($_SESSION['agajan_' . $_SESSION['agajan_bool']]) . '";');
							if($PDO_user->rowcount() == 0){
								date_default_timezone_set('Asia/Ashgabat');
								
								if($_SESSION['agajan_bool'] == 'mobilenumber'){
									$mobilenumber = $str->clean($_SESSION['agajan_' . $_SESSION['agajan_bool']]);
								}else{
									$mobilenumber = 'not set';
								}
								
								if($_SESSION['agajan_bool'] == 'email'){
									$email = $str->clean($_SESSION['agajan_' . $_SESSION['agajan_bool']]);
								}else{
									$email = 'not set';
								}
								$db->conn->query('INSERT INTO users values(null, ' . 
										'\'' . $str->clean($_SESSION['agajan_firstname']) . '\', ' . //sets firstname
										'\'' . $str->clean($_SESSION['agajan_lastname']) . '\', ' . //sets lastname
										'\'' . 'not set' . '\', ' . //sets birthday
										'\'' . 'not set' . '\', ' . //sets birthmonth
										'\'' . 'not set' . '\', ' . //sets birthyear
										'\'' . 'not set' . '\', ' . //sets gender
										'\'' . 'no_image.png' . '\', ' . //sets default_image
										'\'' . 'not set' . '\', ' . //sets country
										'\'' . 'not set' . '\', ' . //sets region
										'\'' . 'not set' . '\', ' . //sets city
										'\'' . 'not set' . '\', ' . //sets street_village
										'\'' . $mobilenumber . '\', ' . //sets mobilenumber
										'\'' . $email . '\', ' . //sets email
										'\'' . $str->clean($_SESSION['agajan_password']) . '\', ' . //sets password
										'\'' . 'not set' . '\', ' . //sets status
										'\'' . 'not set' . '\', ' . //sets profession
										'\'' . 'not set' . '\', ' . //sets education_place
										'\'' . 'not set' . '\', ' . //sets languages
										'\'' . 'not set' . '\', ' . //sets hobby
										'\'' . 'not set' . '\', ' . //sets work_place
										'\'' . date("d.m.Y") . '\', ' . //sets registration_date
										'\'' . 'not set' . '\');' //sets online
								);
								//Settings-e parametrlerini goşmak üçin ýaňky useriň id-sini alýar. 
								$PDO_user_id = $db->conn->query('SELECT id FROM users WHERE ' . $_SESSION['agajan_bool'] . ' = "' . $str->clean($_SESSION['agajan_' . $_SESSION['agajan_bool']]) . '" and password = "' . $str->clean($_SESSION['agajan_password']) . '"');
								if($PDO_user_id->rowcount() == 1){
									foreach($PDO_user_id as $t){
										$user_id = $t['id'];
									}
									//Öň şul user-e bir row döredilipdirmi diýip barlaýar. Eger ýok bolsa goşýar.
									$PDO_setting_id = $db->conn->query('SELECT id FROM settings WHERE user_id = "' . $user_id . '";');
									
									if(!empty($_SESSION['agajan_lang']) && !empty($user_id) && $PDO_setting_id->rowcount() == 0 ){
										$db->conn->query('INSERT INTO settings(' .
											'user_id, ' .										
											'app_language' .
											') values(' .
											'\'' . $user_id . '\', ' .
											'\'' . $str->clean($_SESSION['agajan_lang']) . '\');'
										);
										$bool =  $str->clean($_SESSION['agajan_bool']);
										setcookie(('Agajan_Circle_' . $bool), $str->clean($_SESSION['agajan_' . $_SESSION['agajan_bool']]), time() + 60*60*24*30);/* , time() + 60*60*24, path, www.salam.com */
										setcookie('Agajan_Circle_password', $str->clean($_SESSION['agajan_password']), time() + 60*60*24*30);
										setcookie('Agajan_Circle_bool', $bool, time() + 60*60*24*30);
										$_SESSION['agajan_register_or_login'] = 'register';
										header('location:index.php');//hemme zat dogry bolansoň index.php gidýär.
									}
								}
							}
							else if($PDO_user->rowcount() == 1){
								$status = $lang[$_SESSION['agajan_lang']]['have_' . $_SESSION['agajan_bool']]; //Translate this
							}else{
								$db->conn->query('INSERT INTO errors(' .
										'error, ' . 									
										'user_id, ' .																			
										'user_' . $_SESSION['agajan_bool'] . ',' .	
									') values(' . 
										'\'' . 'more than one user in signin.php' . '\', ' .
										'\'' . $str->clean($_SESSION['agajan_' . $_SESSION['agajan_bool']]) . '\', ' .
										'\'' . $str->clean($_SESSION['agajan_password']) . '\');'
								);
							}
						}
					}
				}
				else{
					$status = $lang[$_SESSION['agajan_lang']]['incorrect_code'];
				}
			}
			else{
				$status = $lang[$_SESSION['agajan_lang']]['do_not_agree'];
			}
		}
		else{
			$status = $lang[$_SESSION['agajan_lang']]['empty_code'];
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
		<link rel="stylesheet" href="include/css/register2.css"/>
	</head>
	<body id="body">
		<form method="POST" action="" id="form">
			<div class="header">
				<li><img src="assets/logo_2.png" id="logo"/></li>
				
				<a href="register1.php">
					<div class="field_back_all"><div class="field_back"><img src="assets/back.png" id="back_icon"/></div></div>
				</a>
			</div>
			<div class="section">
					<div class="section_header">
						<li id="app_name"><?php echo $str->get_site_name() . '.com'; ?></li>
						<li id="registration"><?php echo $lang[$_SESSION['agajan_lang']]['registration']?></li>
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
							<label id="lbl_code"><?php echo $lang[$_SESSION['agajan_lang']]['lbl_code'] . ':'?></label><br/>
							<input type="text" name="code_field" id="code_field" class="txt_field" placeholder="<?php echo $lang[$_SESSION['agajan_lang']]['lbl_code'];?>" value="<?php echo $form->old('code', 'session'); ?>"><br/>
							<?php echo $form->controller('code_field', $lang[$_SESSION['agajan_lang']]['fill_out']);?>
						</li>
						<li id="terms_field">
							<?php echo $lang[$_SESSION['agajan_lang']]['terms_field'];?>
						</li>
						<div class="check">
							<input type="checkbox" id="agree" name="agree" checked = "true">
							<label for="agree" id="i_agree"> <?php echo $lang[$_SESSION['agajan_lang']]['I_agree'];?></label>
							<?php echo $form->controller('agree', $lang[$_SESSION['agajan_lang']]['do_not_agree']);?>
						</div>
						<p align="right"><input type="submit" name="btn_next" id="btn_next" class="btn" value="<?php echo $lang[$_SESSION['agajan_lang']]['btn_next'];?>"/></p>
					</div>
			</div>
		</form>
		<!-- Personal informations
		#Filled in sign in
		-Firstname
		-Phone number
		-password
		-registration_date
		-app_language
		#Filled after the sign in
		-Lastname
		-Birthday
		-Gender
		-Place
		-Nation
		-Email
		-Status
		-Work office
		-Job
		-Education
		-How many languages does he/she know
		-hobby
		-->
	</body>
	<script src="include/js/objects.js"></script>
	<script src="include/js/register2_control.js"></script>
</html>