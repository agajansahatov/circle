<?php
	SESSION_START();
	
	require "include/functions/string_class.php";
	require "include/functions/database_class.php";
	
	$str = new str();
	$this_page = '';
	if(empty($_COOKIE['Agajan_Circle_' . $_COOKIE['Agajan_Circle_bool']]) || empty($_COOKIE['Agajan_Circle_password'])){
		session_destroy();
		$_SESSION = array();
		header('location: login.php');
	}
	else{
		$db = new database('agajan_circle');
		if(!$db) die('There was a problem connecting to database');
		
		if($db){
			$PDO_user = $db->conn->query('SELECT * FROM users WHERE ' . $str->clean($_COOKIE['Agajan_Circle_bool']) . ' = "' . $str->clean($_COOKIE['Agajan_Circle_' . $_COOKIE['Agajan_Circle_bool']]) . '" and password = "' . $str->clean($_COOKIE['Agajan_Circle_password']) . '";');
			if($PDO_user->rowcount()>0){
				foreach ($PDO_user as $inf){
					$user_inf = $inf; 
				}
				$_SESSION['Agajan_Circle_id'] = $user_inf['id'];
				$_SESSION['Agajan_Circle_firstname'] = $user_inf['firstname'];
				$_SESSION['Agajan_Circle_lastname'] = $user_inf['lastname'];
				//Asagy gerekdal
				$_SESSION['Agajan_Circle_birthday'] = $user_inf['birthday'];
				$_SESSION['Agajan_Circle_birthmonth'] = $user_inf['birthmonth'];
				$_SESSION['Agajan_Circle_birthyear'] = $user_inf['birthyear'];
				$_SESSION['Agajan_Circle_gender'] = $user_inf['gender'];
				$_SESSION['Agajan_Circle_country'] = $user_inf['country'];
				$_SESSION['Agajan_Circle_region'] = $user_inf['region'];
				$_SESSION['Agajan_Circle_city'] = $user_inf['city'];
				$_SESSION['Agajan_Circle_street_village'] = $user_inf['street_village'];
				//Dine sul 4-si gerek
				$_SESSION['Agajan_Circle_mobilenumber'] = $user_inf['mobilenumber'];
				$_SESSION['Agajan_Circle_email'] = $user_inf['email'];
				$_SESSION['Agajan_Circle_password'] = $user_inf['password'];
				$_SESSION['Agajan_Circle_status'] = $user_inf['status'];
				$_SESSION['Agajan_Circle_default_image'] = $user_inf['default_image'];
				
				$_SESSION['Agajan_Circle_profession'] = $user_inf['profession'];
				$_SESSION['Agajan_Circle_education_place'] = $user_inf['education_place'];
				$_SESSION['Agajan_Circle_languages'] = $user_inf['languages'];
				$_SESSION['Agajan_Circle_hobby'] = $user_inf['hobby'];
				$_SESSION['Agajan_Circle_work_place'] = $user_inf['work_place'];
				if(empty($_SESSION['Agajan_Circle_email']) || empty($_SESSION['Agajan_Circle_password'])){
					session_destroy();
					$_SESSION = array();
					header('location: login.php');
				}else{
					$bool = 'email';
					setcookie(('Agajan_Circle_' . $bool), $_SESSION['Agajan_Circle_email'], time() + 60*60*24*30);/* , time() + 60*60*24, path, www.salam.com */
					setcookie('Agajan_Circle_password', $_SESSION['Agajan_Circle_password'], time() + 60*60*24*30);
					setcookie('Agajan_Circle_bool', $bool, time() + 60*60*24*30);
					header('location: home');
				}
			}else{
				//COOKIE - lary pozmaly - Hökman
				session_destroy();
				$_SESSION = array();
				header('location: login.php');
			}
		}
	}
?>