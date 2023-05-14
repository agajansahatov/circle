<?php 
	$menu = array();
	$menu['home'] = 'menu_element';
	$menu['news'] = 'menu_element';
	$menu['messages'] = 'menu_element';
	$menu['friends'] = 'menu_element';
	$menu['accounts'] = 'menu_element';
	$menu['diary'] = 'menu_element';
	$menu['images'] = 'menu_element';
	$menu['audios'] = 'menu_element';
	$menu['videos'] = 'menu_element';
	$menu['media'] = 'menu_element';
	$menu['hazyna'] = 'menu_element';
	$menu['log_out'] = 'menu_element';
	$menu[$this_page] = 'menu_selected_element';
	if(empty($_SESSION['Agajan_Circle_status'])){
		header('location: index');
	}
?>
<div class="main_menu" id="main_menu">
	<div class="menu_status">
		<img src="assets/menu_status_icon.png" class="menu_status_icon"/>
		<a href="" class="menu_linker">
			<?=
				'<li class="skopka">"</li>' . 
					'<li class="menu_status_text">' . 
						$_SESSION['Agajan_Circle_status'] . 
					'</li>'.
				'<li class="skopka">"</li>';
			?>
		</a>
	</div>
	<a href="home" class="menu_linker">
		<div class="<?=$menu['home'];?>">
			<?php
				if($menu['home'] == 'menu_selected_element'){
					echo '<img src="assets/left_menu_white/home.png" class="element_ico"/>';
				}else{
					echo '<img src="assets/left_menu_original/home.png" class="element_ico"/>';
				}
			?>
			<div class="menu_element_text" id="first_element">Моя страница</div>
		</div>
	</a>
	<a href="" class="menu_linker">
		<div class="<?=$menu['news'];?>">
			<img src="assets/left_menu_original/news.png" class="element_ico"/>
			<div class="menu_element_text">Новости</div>
		</div>
	</a>
	<a href="messages" class="menu_linker">
		<div class="<?=$menu['messages'];?>">
			<?php
				if($menu['messages'] == 'menu_selected_element'){
					echo '<img src="assets/left_menu_white/mail.png" class="element_ico"/>';
				}else{
					echo '<img src="assets/left_menu_original/mail.png" class="element_ico"/>';
				}
			?>
			<div class="menu_element_text">Сообщения</div>
		</div>
	</a>
	<a href="friends" class="menu_linker">
		<div class="<?=$menu['friends'];?>">
			<?php
				if($menu['friends'] == 'menu_selected_element'){
					echo '<img src="assets/left_menu_white/friends.png" class="element_ico"/>';
				}else{
					echo '<img src="assets/left_menu_original/friends.png" class="element_ico"/>';
				}
			?>
			<div class="menu_element_text">Друзья</div>
		</div>
	</a>
	<div class="<?=$menu['accounts'];?>">
		<img src="assets/left_menu_original/groups.png" class="element_ico"/>
		<div class="menu_element_text">Сообщества</div>
	</div>
	<div class="<?=$menu['diary'];?>">
		<img src="assets/left_menu_original/diaries.png" class="element_ico"/>
		<div class="menu_element_text">Дневник</div>
	</div>
	<div class="<?=$menu['images'];?>">
		<img src="assets/left_menu_original/images.png" class="element_ico"/>
		<div class="menu_element_text">Фотографии</div>
	</div>
	<div class="<?=$menu['audios'];?>">
		<img src="assets/left_menu_original/music.png" class="element_ico"/>
		<div class="menu_element_text">Аудиозаписи</div>
	</div>
	<div class="<?=$menu['videos'];?>">
		<img src="assets/left_menu_original/video_play.png" class="element_ico"/>
		<div class="menu_element_text">Видеозаписи</div>
	</div>
	<div class="<?=$menu['media'];?>">	
		<img src="assets/left_menu_original/media.png" class="element_ico"/>
		<div class="menu_element_text">Media</div>
	</div>
	<div class="<?=$menu['hazyna'];?>">	
		<img src="assets/left_menu_original/hazyna.png" class="element_ico"/>
		<div class="menu_element_text">Marketing</div>
	</div>
	<a href="login.php" class="menu_linker">
		<div class="<?=$menu['log_out'];?>">	
			<img src="assets/left_menu_original/close.png" class="element_ico"/>
			<div class="menu_element_text">Log out</div>
		</div>
	</a>
</div>
<div class="main_menu_fake"></div>