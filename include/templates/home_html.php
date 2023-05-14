<!DOCTYPE html>
<html>
	<head>
        <?php require "include/templates/head_informations.php"?> 
		<link rel="stylesheet" href="include/css/head.css">
		<link rel="stylesheet" href="include/css/menu.css">
		<link rel="stylesheet" href="include/css/bottom.css">
		<link rel="stylesheet" href="include/css/home.css">
		<link rel="stylesheet" href="<?php if($my_alert == 1 && empty($my_alert_style_main)) echo 'include/css/my_alert_1.css';?>" id="my_alert_style">
		<link rel="stylesheet" href="include/css/home_all_images1.css" id="home_all_images_style">
		<?php
			if(!empty($my_alert_style_main)){
				echo $my_alert_style_main;
			}
			if(!empty($my_alert_style)){
				echo '<link rel="stylesheet" href="' . $my_alert_style . '">';
			}
		?>
		<script src="include/js/objects.js"></script>
		<script src="include/js/functions.js"></script>
		<script src="include/js/flashes.js"></script>
	</head>
	<body id="body">
		<?php require "include/templates/head.php"?>
		<?php 
			if(!empty($_SESSION['Agajan_Circle_register_or_login'])){
				if($_SESSION['Agajan_Circle_register_or_login'] == 'register'){
					echo '<div class="first_notification" id="first_notification">' . 
							'<li id="first_notification_message">You are now signed in!</li>' . 
						 '</div><script>flash.loading1("first", 1, 8)</script>';
					$_SESSION['Agajan_Circle_register_or_login'] = 'already done';
				}
				if($_SESSION['Agajan_Circle_register_or_login'] == 'login'){
					echo '<div class="first_notification" id="first_notification">' . 
							'<li id="first_notification_message">You are now logged in!</li>' .
						 '</div><script>flash.loading1("first", 1, 8)</script>';
					$_SESSION['Agajan_Circle_register_or_login'] = 'already done';
				}
			}
			if(!empty($notification_status)){
				echo '<div id="notification_status" style="opacity: 0">' . 
						$notification_status . 
					'</div>' . 
					'<script src="include/js/flashes.js"></script>' .
					'<script>' .
						'flash.status1("notification_status", 1, 6, "1cm", "16.3cm");' . 
					'</script>';
			}
		?>
		
		
		<div class="main" id="main">
			<?php require "include/templates/menu.php"?>
			<div class="main_body" id="main_body">
				<form method="POST" action="" enctype="multipart/form-data">
					<div class="main_first" id="main_first">
						<div class="default_img_field">
							<div id="default_img_header">
								<li id="default_img_label">Default image</li>
							</div>
							<div id="default_img_place">
								<?php 
									if(empty($_SESSION['Agajan_Circle_default_image'])){
										die('Bir zada boldy');
									}else{
										echo '<script>' .
												 'var img_in_array = [];' .
												 'img_in_array[1] = "' . $_SESSION['Agajan_Circle_default_image'] . '";' .
											 '</script>' .
											 '<img src="uploads/user_images/' . $_SESSION['Agajan_Circle_default_image'] . '" id="default_image" onclick="view_img(img_in_array, ' . 1 . ', ' . $_SESSION['Agajan_Circle_id'] . ', 1);">';
									}
								?>
							</div>
							<a href="?view_user_image=true&image=<?=$_SESSION['Agajan_Circle_default_image']?>&ui=<?=$_SESSION['Agajan_Circle_id']?>" id="anchor_edit_default_image">
								<div id="edit_default_image">Edit</div>
							</a>
						</div>
						<div class="main_inf_field" id="main_inf_field">
							<?php 
								if(!empty($user_inf)){
									echo '<div id="basic_inf">' .
											'<div id="user_name">' . $user_inf['firstname'] . ' ' . $user_inf['lastname'] . '</div>' .
											'<div id="user_status">"' . $user_inf['status'] . '"</div>' .
										'</div>' .
										'<div id="main_inf">' .
											'<div class="subjects">' .
												'<li>Email:</li>' .
												'<li>Mobile number:</li>' .
												'<li>Password:</li>' .
												'<li>Gender:</li>' .
												'<li>Firstname:</li>' .
												'<li>Lastname:</li>' .
												'<li>Country:</li>' .
												'<li>Region:</li>' .
												'<li>City:</li>' .
												'<li>Street/Village:</li>' .
												'<li>Status:</li>' .
												'<li>Profession:</li>' .
												'<li>Place of education:</li>' .
												'<li>Languages:</li>' .
												'<li>Hobbies:</li>' .
												'<li>Place of work:</li>' .
											'</div>' .
											'<div class="values">' .
												'<li>' .  $user_inf['email'] . '</li>' .
												'<li>' .  $user_inf['mobilenumber'] . '</li>' .
												'<li>' .  $user_inf['password'] . '</li>' .
												'<li>' .  $user_inf['gender'] . '</li>' .
												'<li>' .  $user_inf['firstname'] . '</li>' .
												'<li>' .  $user_inf['lastname'] . '</li>' .
												'<li>' .  $user_inf['country'] . '</li>' .
												'<li>' .  $user_inf['region'] . '</li>' .
												'<li>' .  $user_inf['city'] . '</li>' .
												'<li>' .  $user_inf['street_village'] . '</li>' .
												'<li>' .  $user_inf['status'] . '</li>' .
												'<li>' .  $user_inf['profession'] . '</li>' .
												'<li>' .  $user_inf['education_place'] . '</li>' .
												'<li>' .  $user_inf['languages'] . '</li>' .
												'<li>' .  $user_inf['hobby'] . '</li>' .
												'<li>' .  $user_inf['work_place'] . '</li>' .
											'</div>' .
											'<div class="operations">' .
												'<li><a href="?set_email=true">Change email</a></li>' .
												'<li><a href="?set_mobile_number=true">Change mobile number</a></li>' .
												'<li><a href="?set_password=true&full_information=true">Change password</a></li>' .
												'<li><a>Change gender</a></li>' .
												'<li><a>Change firstname</a></li>' .
												'<li><a>Change lastname</a></li>' .
												'<li><a>Change country</a></li>' .
												'<li><a>Change region</a></li>' .
												'<li><a>Change city</a></li>' .
												'<li><a>Change street/village</a></li>' .
												'<li><a>Change status</a></li>' .
												'<li><a>Change profession</a></li>' .
												'<li><a>Change place of education</a></li>' .
												'<li><a>Add languages</a></li>' .
												'<li><a>Add a hobby</a></li>' .
												'<li><a>Change place of work</a></li>' .
											'</div>' .
											'<div class="edit_more">' .
												'<div class="btn_edit_all" id="btn_edit_all">Edit all</div>' .
												'<div class="btn_show_more" id="btn_show_more"><img src="assets/down_icon.png" id="show_more_icon"></div>' .
											'</div>' .
										'</div>' .
										'<div id="indicators">' .
											'<div class="nav_inline"><li>' . $friends_sum . '</li><p>Friends</p></div>' .//needs repair
											'<div class="nav_inline"><li>' . $followers_sum . '</li><p>Followers</p></div>' .//needs repair
											'<div class="nav_inline"><li>0</li><p>Accounts</p></div>' .//needs repair
											'<div class="nav_inline"><li>' . $user_all_images_sum . '</li><p>Images</p></div>' .//needs repair
											'<div class="nav_inline"><li>0</li><p>Videos</p></div>' .//needs repair
											'<div class="nav_inline"><li>0</li><p>Audios</p></div>' .//needs repair
										'</div>';
								}
							?>
						</div>
						<div class="all_images_field" id="all_images_field">
							<script>
								var url_all_imgs = [];
								var user_img_sum = 0;
								<?=$js_img;?>
							</script>
							<div id="all_images_header">
								<li id="all_images_header_label">All images</li>
								<li id="all_images_header_indicator"><?=$user_all_images_sum?></li>
								<a id="btn_add_image">Add new</a>
							</div>
							<div class="images_field" id="images_field">
								<?php
									if(!empty($user_all_images)){
										echo $user_all_images;
									}
								?>
							</div>
							<div id="prev_btn"><img src="assets/prev.png" alt="" id="prev_icon"></div>
							<div id="next_btn"><img src="assets/next.png" alt="" id="next_icon"></div>
						</div>
					</div>
					<div class="main_second">
						<div class="my_friends_field">
							<div id="friends_header">
								<li id="friends_label">Friends</li>
								<li id="friends_indicator"><?=$friends_sum?></li>
							</div>
							<?php 
								if(!empty($user_all_friends)){
									echo $user_all_friends;
								}
							?>
						</div>
						<div class="my_favourite_accounts">
							<div id="favourite_accounts_header">
								<li id="favourite_accounts_label">Favourite accounts</li>
								<li id="favourite_accounts_indicator"><?="0"?></li>
							</div>
						</div>
						<div class="my_posts_field">
							<div id="my_posts_header">
								<li id="my_posts_label">My posts</li>
								<li id="my_posts_indicator"><?="0"?></li>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<footer>
			<?php require "include/templates/bottom.php"?>
		</footer>
		<div id="div_background" style="<?php if($my_alert == 0) echo 'display: none;' ?>">
			<?php  if(!empty($alert)){ echo $alert; } ?>
		</div>
		<div id="bbbb"></div>
		<script src="include/js/home.js"></script>
		
		
		<!-- Scripts included in php -->
		<?php 
			//FULL INFORMATIONS HERE, WHEN IT IS DONE AUTOMATICALLY BY PHP
			if(isset($_REQUEST['full_information']) && $_REQUEST['full_information'] == 'true'){
				echo '<script>' .
						"hover = 0;" .
						"document.getElementById('home_all_images_style').setAttribute('href', 'include/css/home_all_images2.css');" .
						"show_images_according_to_given_number('images_field', 12, user_img_sum, url_all_imgs);" .
						"document.getElementById('main_body').style.height = '31cm';" .
						"document.getElementById('main_first').style.height = '22cm';" .
						"document.getElementById('main_inf_field').style.height = '21.75cm';" .
						"document.getElementById('main_inf').style.height = '18.4cm';" .
						
						"document.getElementById('btn_show_more').style.backgroundColor = '#999999';" .
						"document.getElementById('btn_show_more').style.borderColor = '#e3e3e3';" .
						"var counter = 0;" .
						"var interval = setInterval(function(){" .
							"counter++;" .
							"if(counter == 1){" .
								"document.getElementById('btn_show_more').style.backgroundColor = '#1faeff';" .
								"document.getElementById('btn_show_more').style.borderColor = '#c8f6fe';" .
								"document.getElementById('show_more_icon').setAttribute('src', 'assets/up_icon.png');" .
								"document.getElementById('indicators').style.boxShadow = 'none';" .
								"hover = 1;" .
								"clearInterval(interval);" .
							"}" .
						"}, 1000);" .
					 '</script>';
			}
			//IF there is an ERROR when uploading the image
			if(!empty($errors)){
				echo "<script>" .
						"var t = '';" .
						"t += '<li id=\"header_upload\">New image</li>';" .
						"t += '<li><input type = \"file\" name = \"image\" id=\"file\"/></li>';" .
						"t += '<li id=\"error_upload\">" . $errors . "</li>';" .
						"t += '<li><input type = \"submit\" value=\"Upload\" id=\"btn_upload_image\" name=\"btn_upload_image\"/></li>';" .
						"form.my_alert(t, \"30%\", \"10cm\");" .
					"</script>";
			}
		?>
	</body>
</html>