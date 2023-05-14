<?php 
	require "../include/functions/database_class.php";
	$db = new database('a');
	if(!$db){
		echo "Open the 'database_class.php' with your text editor and set there configuration options" . '<br/>';
		die('There was a problem with connecting to database');
	}else{
		$dtb = $db->conn->query('SHOW DATABASES');
		$agajan_circle = 0;
		if(!empty($dtb)){
			foreach($dtb as $t){
				$db_names = $t;
				if($db_names['Database'] == 'agajan_circle' ){ $agajan_circle = 1;}
			}
		}
		if($agajan_circle == 0){			
			$db->conn->query('CREATE DATABASE agajan_circle');
			$dtb = $db->conn->query('SHOW DATABASES');
			$agajan_circle = 0;
			if(!empty($dtb)){
				foreach($dtb as $t){
					$db_names = $t;
					if($db_names['Database'] == 'agajan_circle' ){ $agajan_circle = 1;}
				}
			}
		}
		
		if($agajan_circle == 1){	
			$db = new database('agajan_circle');
			
			$d_tbl = $db->conn->query('SHOW TABLES');
			$table_users  = 0;
			$table_friends = 0;
			$table_settings = 0;
			$table_errors = 0;
			$table_user_images = 0;
			$table_user_image_comments = 0;
			$table_user_image_likes = 0;
			$table_user_images_sum = 0;
			$table_chats = 0;
			$table_group_users = 0;
			$table_groups = 0;
			$table_messages = 0;
			$table_group_messages = 0;
			if($d_tbl->rowcount()>0){
				foreach($d_tbl as $t){
					if($t['Tables_in_agajan_circle'] == 'users' ){ $table_users = 1;}
					if($t['Tables_in_agajan_circle'] == 'friends' ){ $table_friends = 1;}
					if($t['Tables_in_agajan_circle'] == 'user_images' ){ $table_user_images = 1;}
					if($t['Tables_in_agajan_circle'] == 'user_images_sum' ){ $table_user_images_sum = 1;}
					if($t['Tables_in_agajan_circle'] == 'user_image_comments' ){ $table_user_image_comments = 1;}
					if($t['Tables_in_agajan_circle'] == 'user_image_likes' ){ $table_user_image_likes = 1;}
					if($t['Tables_in_agajan_circle'] == 'settings' ){ $table_settings = 1;}
					if($t['Tables_in_agajan_circle'] == 'errors' ){ $table_errors = 1;}
					if($t['Tables_in_agajan_circle'] == 'chats' ){ $table_chats = 1;}
					if($t['Tables_in_agajan_circle'] == 'messages' ){ $table_messages = 1;}
					if($t['Tables_in_agajan_circle'] == 'c_groups' ){ $table_groups = 1;}
					if($t['Tables_in_agajan_circle'] == 'group_users' ){ $table_group_users = 1;}
					if($t['Tables_in_agajan_circle'] == 'group_messages' ){ $table_group_messages = 1;}
				}
			}
			if($table_users == 0){
				$db->conn->query('CREATE TABLE users(id INT AUTO_INCREMENT PRIMARY KEY, ' . 
								'firstname varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' . 
								'lastname varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' . 
								'birthday varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' . 
								'birthmonth varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' . 
								'birthyear varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' . 
								'gender varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' .
								'default_image varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' .
								'country varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' .
								'region varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' .
								'city varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' .
								'street_village varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' .					
								'mobilenumber varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' .
								'email varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' . 
								'password varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' . 					
								'status TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' . 	
								'profession varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' . 	
								'education_place varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' . 
								'languages TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' . 
								'hobby TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' . 
								'work_place TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' .
								'registration_date varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' . 
								'online varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL);'
				);
			}
			if($table_friends == 0){
				$db->conn->query('CREATE TABLE friends(id INT AUTO_INCREMENT PRIMARY KEY, ' .
								'user1_id INT, ' . 
								'user2_id INT, ' . 
								'user1_accepted INT,' .
								'user2_accepted INT,' . 
								'time_accepted_1 varchar(50), ' . 
								'time_accepted_2 varchar(50), ' .
								'user1_block INT, ' .
								'user2_block INT, ' .
								'time_blocked_1 varchar(50), ' . 
								'time_blocked_2 varchar(50), ' .
								'user1_del INT, ' . 
								'user2_del INT ' . 
								');'
				);
			}
			if($table_user_images == 0){
				$db->conn->query('CREATE TABLE user_images(id INT AUTO_INCREMENT PRIMARY KEY, ' .
								'user_id INT, ' . 
								'image varchar(200), ' . 	
								'folder TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' . 
								'description TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL, ' . 
								'year varchar(4), ' . 
								'month varchar(2), ' . 
								'day varchar(2), ' . 
								'day_name varchar(30), ' . 
								'hour varchar(2), ' . 
								'minute varchar(2), ' . 
								'second varchar(2) ' .  
								');'
				);
			}
			if($table_user_images_sum == 0){
				$db->conn->query('CREATE TABLE user_images_sum(id INT AUTO_INCREMENT PRIMARY KEY, ' .
								'user_id INT, ' . 
								'year varchar(4), ' . 
								'sum INT ' .  
								');'
				);
			}
			if($table_user_image_comments == 0){
				$db->conn->query('CREATE TABLE user_image_comments(id INT AUTO_INCREMENT PRIMARY KEY, ' .
								'user_id INT, ' . 
								'image varchar(200), ' . 	
								'folder TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' . 
								'comment TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' . 
								'commented_user_id INT, ' . 
								'year varchar(4), ' . 
								'month varchar(2), ' . 
								'day varchar(2), ' . 
								'day_name varchar(30), ' . 
								'hour varchar(2), ' . 
								'minute varchar(2), ' . 
								'second varchar(2) ' . 
								');'
				);
			}
			if($table_user_image_likes == 0){
				$db->conn->query('CREATE TABLE user_image_likes(id INT AUTO_INCREMENT PRIMARY KEY, ' .
								'user_id INT, ' . 
								'image varchar(200), ' . 	
								'liked_user_id INT, ' .
								'year varchar(4), ' . 
								'month varchar(2), ' . 
								'day varchar(2), ' .
								'day_name varchar(30), ' . 								
								'hour varchar(2), ' . 
								'minute varchar(2), ' . 
								'second varchar(2) ' . 							
								');'
				);
			}
			if($table_settings == 0){
				$db->conn->query('CREATE TABLE settings(id INT AUTO_INCREMENT PRIMARY KEY, ' .
								'user_id INT, ' . 
								'app_language varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL);'
				);
			}
			if($table_errors == 0){
				$db->conn->query('CREATE TABLE errors(id INT AUTO_INCREMENT PRIMARY KEY, ' .
								'error TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' .
								'user_id INT, ' . 
								'user_mobilenumber varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL);'
				);
			}
			if($table_chats == 0){
				$db->conn->query('CREATE TABLE chats(id INT AUTO_INCREMENT PRIMARY KEY, ' .
								'user1_id INT, ' . 
								'user2_id INT ' .
								');'
				);
			}
			if($table_messages == 0){
				$db->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$db->conn->query('CREATE TABLE messages(id INT AUTO_INCREMENT PRIMARY KEY, ' .
								'message TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' .
								'user_id INT, ' . 
								'chat_id INT, ' .
								'user2_readn INT, ' .
								'year varchar(4) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' .
								'month varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' .
								'day varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' .
								'day_name varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' .	
								'hour varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' .
								'minute varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' .
								'second varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ' .
								');'
				);
			}
			if($table_groups == 0){
				$db->conn->query('CREATE TABLE c_groups(id INT AUTO_INCREMENT PRIMARY KEY, ' .
								'group_name TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' .
								'group_default_image TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' .
								'group_status TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' .
								'year varchar(4), ' . 
								'month varchar(2), ' . 
								'day varchar(2), ' .
								'day_name varchar(30), ' . 								
								'hour varchar(2), ' . 
								'minute varchar(2), ' . 
								'second varchar(2) ' . 
								');'
				);
			}
			if($table_group_users == 0){
				$db->conn->query('CREATE TABLE group_users(id INT AUTO_INCREMENT PRIMARY KEY, ' .
								'group_id INT, ' .
								'user_id INT, ' . 
								'year varchar(4), ' . 
								'month varchar(2), ' . 
								'day varchar(2), ' .
								'day_name varchar(30), ' . 								
								'hour varchar(2), ' . 
								'minute varchar(2), ' . 
								'second varchar(2) ' . 
								');'
				);
			}
			if($table_group_messages == 0){
				$db->conn->query('CREATE TABLE group_messages(id INT AUTO_INCREMENT PRIMARY KEY, ' .
								'message TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, ' .
								'user_id INT, ' .
								'group_id INT, ' .	
								'readn INT, ' .
								'year varchar(4), ' . 
								'month varchar(2), ' . 
								'day varchar(2), ' .
								'day_name varchar(30), ' . 								
								'hour varchar(2), ' . 
								'minute varchar(2), ' . 
								'second varchar(2) ' .						
								');'
				);
			}
		
		}
		if($agajan_circle == 1){
			echo "You have already installed the agajan_circle!!!";
		}
	}
?>