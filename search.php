<?php 
	SESSION_START();
	require "include/functions/string_class.php";
	require "include/functions/database_class.php";
	require "include/functions/form_class.php";
	$db = new database('agajan_circle');
	if(!$db) die('There was a problem connecting to database');
	
	$str = new str();
	$form = new form();
	
	if(!isset($_SESSION['Agajan_Circle_id'])){
		header('location: index.php');
	}
	
	if(empty($_REQUEST['menu_top'])){
		$_REQUEST['menu_top'] = 'people';
	}
	if(!empty($_REQUEST['menu_top'])){
		if($_REQUEST['menu_top'] == 'people'){
			require "include/templates/search_people.php";
		}
	}
?>