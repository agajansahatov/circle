<?php
	SESSION_START();
	
	$this_page = 'friends';
	
	require "include/functions/string_class.php";
	require "include/functions/database_class.php";
	require "include/functions/HTML_class.php";
	require "include/functions/form_class.php";
	
	if(!isset($_SESSION['Agajan_Circle_id'])){
		header('location: index.php');
	}
	
	$str = new str();
	$HTML = new HTML();
	$form = new form();
	$db = new database('agajan_circle');
	if(!$db) die('There was a problem connecting to database');
	
	if($db && !empty($_REQUEST['selected_id'])){
		$selected_user = $_REQUEST['selected_id'];
		require "include/templates/user_information.php";
	}
	if(isset($_REQUEST['menu_top']) && $_REQUEST['menu_top'] == 'requests'){
		require "include/templates/friend_requests.php";
	}else if(isset($_REQUEST['menu_top']) && $_REQUEST['menu_top'] == 'blocked'){
		require "include/templates/blocked_users.php";
	}else if(isset($_REQUEST['menu_top']) && $_REQUEST['menu_top'] == 'possible_friends'){
		require "include/templates/possible_friends.php";
	}else{
		require "include/templates/all_friends.php";
	}
?>