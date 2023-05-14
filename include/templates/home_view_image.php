<?php 
	if(isset($_REQUEST['view_user_image']) && $_REQUEST['view_user_image'] == 'true'){
		
		if(!empty($_REQUEST['image']) && !empty($_REQUEST['ui'])){
			$image = htmlspecialchars($_REQUEST['image']); //hakykatdanam sonyn oz suratymy? barlag gecirmeli guycli
			$ui = htmlspecialchars($_REQUEST['ui']);
			$PDO_img = $db->conn->query('SELECT * from user_images WHERE user_id = ' . $ui . ' and image = "' . $image . '";');// Gerek bolsa eger $_SESSION['Agajan_Circle_id']
			if($PDO_img->rowcount()==1){
				//First OPERATIONS
				$deleted = false;
				if(isset($_POST['vui_btn_comment_own']) && !empty($_POST['vui_comment_field_own'])){
					date_default_timezone_set('Asia/Ashgabat');
					$db->conn->query('INSERT INTO user_image_comments values(null, ' . 
											'\'' . $ui . '\', ' . //sets user_id
											'\'' . $image . '\', ' . //sets image
											'\'' . 'not set' . '\', ' . //sets folder
											'\'' . $str->clean($_POST['vui_comment_field_own']) . '\', ' . //sets comment
											'\'' . $_SESSION['Agajan_Circle_id'] . '\', ' . //sets commented_user_id
											'\'' . date('Y') . '\', ' . //sets year
											'\'' . date('m') . '\', ' . //sets month
											'\'' . date('d') . '\', ' . //sets day
											'\'' . date('D') . '\', ' . //sets day_name
											'\'' . date('H') . '\', ' . //sets hour
											'\'' . date('i') . '\', ' . //sets minute
											'\'' . date('s') . '\');' //sets second
									);
				}
				if(isset($_POST['vui_btn_set_description']) && !empty($_POST['vui_description_text_field']) && $ui == $_SESSION['Agajan_Circle_id']){
					$description = $str->clean($_POST['vui_description_text_field']);
					$db->conn->query('UPDATE user_images SET description = "' . $description . '" WHERE user_id = ' . $_SESSION['Agajan_Circle_id'] . ' and image = "' . $image . '";');
					//Gets informations from the user_images table because they have changed
					$PDO_img = $db->conn->query('SELECT * from user_images WHERE user_id = ' . $ui . ' and image = "' . $image . '";');
					if($PDO_img->rowcount() !== 1){
						die('Something went wrong while viewing the image');
					}
				}
				if(isset($_REQUEST['btn_set_as_default']) && $_REQUEST['btn_set_as_default'] == 'true' && $ui == $_SESSION['Agajan_Circle_id']){
					if($db->conn->query('UPDATE users SET default_image = "' . $image . '" WHERE id = ' . $_SESSION['Agajan_Circle_id'] . ';')){
						$_SESSION['Agajan_Circle_default_image'] = $image;
						//Notification
					}else{
						die('This image has not been setted as default');
					}
				}
				if(isset($_REQUEST['btn_delete_image']) && $_REQUEST['btn_delete_image'] == 'true' && $ui == $_SESSION['Agajan_Circle_id']){
					//First delete the image from "Uploads" folder
					if($file->delete('uploads/user_images/' . $image)){
						//Then set the default_image to no_image
						if($image == $_SESSION['Agajan_Circle_default_image']){
							if(isset($_SESSION['Agajan_Circle_gender'])){
								if($_SESSION['Agajan_Circle_gender'] == 'Male'){
									$no_image = 'male.png';
								}else if($_SESSION['Agajan_Circle_gender'] == 'Female'){
									$no_image = 'female.png';
								}else{
									$no_image = 'no_image.png';
								}
								if(isset($no_image)){
									$db->conn->query('UPDATE users SET default_image = "' . $no_image . '" WHERE id = ' . $_SESSION['Agajan_Circle_id'] . ';');
									$_SESSION['Agajan_Circle_default_image'] = $no_image;
								}
							}else{
								header('location: index.php');
							}
						}
						//And after that delete that image from "user_images" table
						if($db->conn->query('DELETE FROM user_images WHERE user_id = ' . $_SESSION['Agajan_Circle_id'] . ' and image = "' . $image . '";')){
							$deleted = true;
						}else{
							$deleted = false;
						}
						//Then delete the comments of that image from "user_image_comments" table
						if($db->conn->query('DELETE FROM user_image_comments WHERE user_id = ' . $_SESSION['Agajan_Circle_id'] . ' and image = "' . $image . '";')){
							$deleted = true;
						}else{
							$deleted = false;
						}
						//Then delete the likes of that image from "user_image_likes" table
						if($db->conn->query('DELETE FROM user_image_likes WHERE user_id = ' . $_SESSION['Agajan_Circle_id'] . ' and image = "' . $image . '";')){
							$deleted = true;
						}else{
							$deleted = false;
						}
						
					}
				}
				// Then Getting the INFORMATIONS ----
				
				if($deleted == false){
					
					//GETTING THE ui default_image
					$d_img = $db->conn->query('SELECT default_image FROM users WHERE id=' . $ui . ';');
					foreach($d_img as $key){
						$default_image = $key['default_image'];
					}
					
					//GETTING WHEN(TIME) THE IMAGE IS UPLOADED...
					$t = '';
					foreach($PDO_img as $t){
						$uploaded_date = $form->get_time($t['year'], $t['month'], $t['day'], $t['day_name'], $t['hour'], $t['minute'], $t['second']);
						if(!empty(trim($t['description'])) && trim($t['description']) !== 'not set'){
							$image_description = '<img src="uploads/user_images/' . $default_image . '" class="vui_description_image">' .
												'<div id="image_description">' . $t['description'] . '</div>';
						}else{
							if($ui == $_SESSION['Agajan_Circle_id']){
								$image_description = '<img src="uploads/user_images/' . $_SESSION['Agajan_Circle_default_image'] . '" class="vui_little_img">' .
													'<form method="POST" action="">' . 
														'<input type="text" class="vui_description_text_field" name="vui_description_text_field" placeholder="Set the image description..."/>' . 
														'<input type="submit" class="vui_btn_set_description" name="vui_btn_set_description" value="Send"/>' . 
													'</form>';
							}else{
								$image_description = '<img src="uploads/user_images/' . $default_image . '" class="vui_description_image">' .
												'<div id="image_description">' . 'This image has no description' . '</div>'; //Biraz design etmeli - sebabi description yoklugyny biraz bildirmeli
							}
						}
					}
					//GETTING THE IMAGE COMMENTS
					$t = '';
					if(empty($ui)) die('aaaa');
					if(isset($_REQUEST['show_all_comments']) && $_REQUEST['show_all_comments'] == 'true'){
						$PDO_image_comments = $db->conn->query('SELECT * from user_image_comments WHERE user_id = ' . $ui . ' and image = "' . $image . '" ORDER BY id DESC;');
					}else{
						$PDO_image_comments = $db->conn->query('SELECT * from user_image_comments WHERE user_id = ' . $ui . ' and image = "' . $image . '" ORDER BY id DESC LIMIT 3;');
					}
					$comments = '';
					if($PDO_image_comments->rowcount()>0){
						foreach ($PDO_image_comments as $t){
							//Gettting the commented user's firstname, lastname and the image
							$PDO_users = $db->conn->query('SELECT firstname, lastname, default_image from users WHERE id = ' . $t['commented_user_id'] . ';');
							foreach ($PDO_users as $user){
								$firstname = $user['firstname'];
								$lastname = $user['lastname'];
								$fr_image = $user['default_image'];
							}
							//Takes the time in street language
							$comment_date = $form->get_time($t['year'], $t['month'], $t['day'], $t['day_name'], $t['hour'], $t['minute'], $t['second']);
							
							$comments = ('<div class="vui_comment_field">' .
											'<img src="uploads/user_images/' . $user['default_image'] . '" class="user_img" onclick="view_img(\'uploads/user_images/' . $user['default_image'] . '\', ' . 1 . ', \'' . $user['default_image'] . '\', ' . 1 . ');">' .
											'<div class="field_left">' . 
													'<li class="user_name">' . $user['firstname'] . ' ' . $user['lastname'] . '</li>' .
													'<li class="comment">' . $t['comment'] . '</li>' .
											'</div>' .
											'<div class="field_right">' . 
												'<li class="date">' . $comment_date . '</li>' .
											'</div>' .
										'</div>') . $comments;
						}
					}
					
					$my_alert = 1;
					$my_alert_style_main = '<link rel="stylesheet" href="include/css/home_view_image_alert.css">';
					$my_alert_style = 'include/css/home_view_user_image.css';
					$users_possible_buttons = '';
					if($ui == $_SESSION['Agajan_Circle_id']){
						$users_possible_buttons = '<li id="btn_more_field">' .
													'<div id="btn_more">...</div>' .
													'<div id="vui_more_buttons_field">' .
														'<img src="assets/left_triangle.png" id="left_icon"/>' .
														'<div class="buttons">' .
															'<a id="btn_set_as_default" href="?view_user_image=true&image=' . $image . '&btn_set_as_default=true&ui=' . $ui . '">Set as default image</a>'.
														'</div>' .
														'<div class="buttons">' .
															'<a id="btn_download_image" href="uploads/user_images/' . $image . '">Download</a>' .
														'</div>' .
														'<div class="buttons">' .
															'<a id="btn_delete_image" href="?view_user_image=true&image=' . $image . '&btn_delete_image=true&ui=' . $ui . '">Delete</a>' .
														'</div>' .
													'</div>' .
												'</li>' .
												'<li id="btn_share">' .
													'<div id="btn_share_field">' .
														'<img src="assets/shares.png" id="btn_shares_icon"/>' . 
														'<p id="btn_shares_text">Share</p>' .
													'</div>' .
													'<div id="share_buttons_field">' .
														'<img src="assets/left_triangle.png" id="left_triangle_icon"/>' .
														'<img src="assets/info_icon.png" id="info_icon"/>' .
														'<form method="POST" action="">' . 
															'<input type="submit" class="share_button" name="" value="Share to friends"/>' . 
															'<input type="submit" class="share_button" name="" value="Share via"/>' . 
														'</form>' .
													'</div>' .
												'</li>';
					}
					$alert .= '<div id="img_background">' .
									'<div id="alert_header">' .
										'<div id="text_header">View image</div>' . 
										'<a href="?" id="close_anchor"><div id="close_button">x</div></a>' .
									'</div>' .
									'<div id="alert_body">' .
										'<div id="vui_description_field">' . 
											$image_description . 
										'</div>' .
										'<div id="vui_uploaded_time">' . 
											'#Uploaded: ' . $uploaded_date .
										'</div>' .
										'<div id="vui_user_image">' .
											'<img src="uploads/user_images/' . $image . '" id="vui_image_huge">' .
										'</div>' . 
										'<div id="vui_buttons_field">' . 
											'<li id="btn_likes_field"><img src="assets/likes.png" id="btn_likes_icon"/><p id="btn_likes_text">Likes 2300000</p></li>' .
											'<li id="btn_comments_field"><img src="assets/comments.png" id="btn_comments_icon"/><p id="btn_comments_text">Comments 9899888978979</p></li>' .
											$users_possible_buttons .
										'</div>' .
										'<div id="vui_comments">' .
											'<a href="?view_user_image=true&image=' . $image . '&show_all_comments=true&ui=' . $ui . '&#vui_leave_comment_field"><div id="btn_show_more_comment">Show all comments</div></a>' . 
											$comments . 
										'</div>' . // width - 100% edip, border-top goymaly
										'<div id="vui_leave_comment_field">' .
											'<img src="uploads/user_images/' . $_SESSION['Agajan_Circle_default_image'] . '" class="vui_little_img">' .
											'<form method="POST" action="#vui_leave_comment_field">' . 
												'<input type="text" class="vui_comment_field_own" name="vui_comment_field_own" placeholder="Leave a comment..."/>' . 
												'<input type="submit" class="vui_btn_comment_own" name="vui_btn_comment_own" value="Send"/>' . 
											'</form>' .
										'</div>' . // width - 100% edip, border-top goymaly
									'</div>' .
								'</div>' .
								'<script>' . 
									'var margin_left = "0cm";' .
									'var maxwidth = 0;' .
									'var width = 0;' .
									'maxwidth = 20*94/100;' . //24 cm "img_background"-yn width-i, eger sol uytgese muny hem hokman uytgetmeli
															  //94 % "#vui_user_image" field-in width-i
									'var vui_image_huge = document.getElementById("vui_image_huge");' .
									'width = vui_image_huge.width;' .
									'height = vui_image_huge.height;' .
									'if(width == 0){ width = vui_image_huge.style.width; }' .
									'if(height == 0){ height = vui_image_huge.style.height; }' .
									'if(width>0){' .
										'width = width/37;' . //converts the width to centimeters
										'if(width<maxwidth){' .
											'margin_left = ((maxwidth-width)/2) + "cm";' .
											'document.getElementById(\'vui_image_huge\').style.marginLeft = margin_left;' .
										'}'.
										'if(height>0){' .
											'document.getElementById(\'vui_image_huge\').style.minHeight = (width/2) + "cm";' .
										'}' .
									'}'.
									'document.getElementById("btn_share").onclick = function(){ ' .
										'if(document.getElementById("share_buttons_field").style.display !== "block"){' .
											'document.getElementById("share_buttons_field").style.display = "block";' .
											"document.getElementById('btn_share_field').style.backgroundColor = '#e3e3e3';" .
											"return false;" .
										'}else{' . 
											'document.getElementById("share_buttons_field").style.display = "none";' .
											"document.getElementById('btn_share_field').style.backgroundColor = '';" .
										'}' .
									'}
									' .
									'document.getElementById("btn_more").onclick = function(){ ' .
										'if(document.getElementById("vui_more_buttons_field").style.display !== "block"){' .
											'document.getElementById("vui_more_buttons_field").style.display = "block";' .
											"document.getElementById('btn_more').style.color = '#008aee';" .
											"return false;" .
										'}else{' . 
											'document.getElementById("vui_more_buttons_field").style.display = "none";' .
											"document.getElementById('btn_more').style.color = '#505050';" .
											"return false;" .
										'}' .
									'}' .
								'</script>';
				}
			}else{
				die('This image is not found or repeated more than one time');
			}
		}
	}
?>