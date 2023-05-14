<?php 
class form{
	public function __construct(){
		
	}
	public function old($key, $selector = 'request'){ // Duzetmeli
		if($selector == 'request'){
			if(!empty($_REQUEST[$key . '_field'])){
				return htmlspecialchars($_REQUEST[$key . '_field']);
			}
			else return '';
		}else if($selector == 'session'){
			if(!empty($_SESSION['agajan_' . $key])){
				return htmlspecialchars($_SESSION['agajan_' . $key]);
			}
			else return '';
		}
	}
	public function valid_email($email){
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	}
	public function controller($name, $message, $path = '', $display = 'none'){
		$controller = '<div id="css_status_' . $name .'" class="css_status_js" style="display: ' . $display . '">' . 
						'<img src="assets/status_top.png" class="status_top_png"/>' .
						'<div class="js_status_field">' .  
							'<img src="' . $path . 'assets/warner.png" class="warner_png"/>' .
							'<p id="warner_' . $name . '" class="warner_text">' . $message . '</p>' . 
						'</div>' .
					 '</div>';
		return $controller;
	}
	
	public function number_email($s){// Nomermi ya-da email-mi diyip barlaýar
		$bool = 'none';
		for($i=0; $i<=strlen($s)-1;$i++){
			if(($s[$i] == '+') || ($s[$i] >= '0' && $s[$i] <= '9')){
				if($bool == 'none'){
					$bool = 'mobilenumber';
				}
			}else{
				$bool = 'email';
				break;
			}
		}
		return $bool;
	}
	public function valid_mobilenumber($number){
		$istext = 0;
		$s = '';
		for($i = 0; $i <= strlen($number)-1; $i++){
			if(($number[$i] >= '0' && $number[$i] <= '9')){
				if($i == 0 && $number[$i] !== '+'){
					$istext = 1;
					break;
				}
				$s .= $number[$i];
			}
			else if($i == 0 && $number[$i] == '+'){
				$s .= $number[$i];
			}
			else{
				$istext = 1;
				break;
			}
		}
		if($istext == 0 && strlen($s) == 12){
			return true;
		}else{
			return false;
		}
	}
	public function get_time($year, $month, $day, $day_name, $hour, $minute, $second){
		//This function gives me the time in the street language
		date_default_timezone_set('Asia/Ashgabat');
		if(date('Y') == $year){
			if(date('m') == $month){
				if(date('d') == $day){
					if(date('H') == $hour){
						if(date('i') == $minute){
							if(date('s')-$second < 30){
								return 'Just a few seconds before';
							}else{
								return date('s')-$second . ' seconds before';
							}
						}else{
							if(date('i')-$minute == 1){
								return 'Just a minute before';
							}else{
								return date('i')-$minute . ' minutes before';
							}
							
						}
					}else{
						return 'Today at ' . $hour . ':' . $minute . ':' . $second;
					}
				}else if(date('d')-1 == $day){
					return 'Yesterday<br/>at ' . $hour . ':' . $minute . ':' . $second;
				}else if(date('d')-7 < $day){
					return $day_name . ' at ' . $hour . ':' . $minute . ':' . $second;
				}else{
					return $day .  '.' . $month .  '.' . $year . '<br/>' . ' at ' . $hour . ':' . $minute . ':' . $second;
				}
			}else if(date('m') > $month){
				return $day .  '.' . $month .  '.' . $year;
			}else{
				die('Something went wrong with DATE');
			}
		}else if(date('Y') > $year){
			return $day .  '.' . $month .  '.' . $year;
		}else{
			die('Something went wrong with DATE');
		}
	}
	public function app_name(){
		echo 'Circle';
	}
}