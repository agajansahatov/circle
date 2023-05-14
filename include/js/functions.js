function view_img(images, default_img, img_user_id, btn_more_value){
	//Getting the sum of all images
	var default_img_bool = false;
	var sum = 0;
	for(var key in images){
		if(key == default_img){
			default_img_bool = true;
		}
		sum++;
	}
	if(default_img_bool == true){
		var src = images[default_img];//SETTING THE DEFAULT SRC
		var deleted = 0;
		var view_image_field = document.createElement('div');
		
		var elements = '';
		if(btn_more_value == 1){
			elements += '<a id="vi_a" href="?view_user_image=true&image=' + src + '&ui=' + img_user_id + '"><div id="btn_show_full_img_inf">Show all informations</div></a>';
		}
		elements += '<div id="btn_close_img">x</div>';
		elements += '<div id="btn_prev"><</div>';
		elements += '<div id="btn_next">></div>';
		elements += '<img src="uploads/user_images/' + src + '" id="vi_image"/>';
		
		view_image_field.innerHTML = elements;	//Setting the inner_elements of the view_img_field
		document.body.appendChild(view_image_field);//AFTER ALL ADDING THE ELEMENTS TO THE BODY
	}	
	//STYLING--------------------------------------------------------------------------------------------------------------------------------------------------
	var screen_height = window.screen.height-148;
	var screen_width = document.body.offsetWidth+17;
	//Styling - view_img_field
	var t = '';
	t += 'z-index: 4;';
	t += 'position: fixed;';
	t += 'background-color: rgba(0,0,0,.4);';
	t += 'min-width: ' + screen_width+ 'px;';
	t += 'min-height: ' + screen_height + 'px;';
	t += 'height: 100%;';
	t += 'width: 100%;';
	t += 'left: 0px;';
	t += 'top: 1.25cm;';
	view_image_field.setAttribute('style', t);
	if(btn_more_value == 1){
		//Styling - vi_a
		t = '';
		t += 'text-decoration: none;';
		t += 'color: none;';
		document.getElementById('vi_a').setAttribute('style', t);
			
		//Styling - btn_show_full_img_inf
		t = '';
		t += 'position: fixed;';
		t += 'width: 4.5cm;';
		t += 'height: 0.8cm;';
		t += 'line-height: 0.8cm;';
		t += 'text-align: center;';
		t += 'color: #ffffff;';
		t += 'text-shadow: 0px 1px 0px #008aee;';
		t += 'box-shadow: 0px 1px 1px 0px #008aee;';
		t += 'font-size: 16px;';
		t += 'font-family: Segoe UI Semilight;';
		t += 'left: 0.2cm;';
		t += 'top: 1.75cm;';
		t += 'padding: 0px;';
		t += 'border: 2px solid #ffffff;';
		t += 'border-radius: 10px;';
		t += 'border-color: #ffffff;';
		t += 'cursor: pointer;';
		t += 'transition: border-color 0.5s, color 0.5s;';
		t += '-webkit-transition: border-color 0.5s, color 0.5s;';
		t += '-moz-transition: border-color 0.5s, color 0.5s;';
		document.getElementById('btn_show_full_img_inf').setAttribute('style', t);
			document.getElementById('btn_show_full_img_inf').onmouseover = function(){
			document.getElementById('btn_show_full_img_inf').style.color = '#cccccc';
			document.getElementById('btn_show_full_img_inf').style.borderColor = '#cccccc';
		}
		document.getElementById('btn_show_full_img_inf').onmouseout = function(){
			if(deleted == 0){
				document.getElementById('btn_show_full_img_inf').style.color = '#ffffff';
				document.getElementById('btn_show_full_img_inf').style.borderColor = '#ffffff';
			}
		}
	}
	
	
	//Styling - btn_close_img
	t = '';
	t += 'position: fixed;';
	t += 'width: 1.25cm;';
	t += 'height: 1.25cm;';
	t += 'line-height: 1.25cm;';
	t += 'text-align: center;';
	t += 'color: #ffffff;';
	t += 'text-shadow: 0px 0px 20px #008aee;';
	t += 'font-size: 35px;';
	t += 'font-family: Levenim MT, Sans Serif;';
	t += 'top: 1.5cm;';
	t += 'left: ' + (screen_width-75) + 'px;';
	t += 'padding: 0px;';
	t += 'border-radius: 50%;';
	t += 'cursor: pointer;';
	t += 'transition: background 0.3s, color 0.6s;';
	t += '-webkit-transition: background 0.3s, color 0.6s;';
	t += '-moz-transition: background 0.3s, color 0.6s;';
	document.getElementById('btn_close_img').setAttribute('style', t);
	document.getElementById('btn_close_img').onmouseover = function(){
		if(deleted == 0){
			document.getElementById('btn_close_img').style.background = '#ffffff';
			document.getElementById('btn_close_img').style.color = '#000000';
			document.getElementById('btn_close_img').style.textShadow = 'none';
		}
	}
	document.getElementById('btn_close_img').onmouseout = function(){
		if(deleted == 0){
			document.getElementById('btn_close_img').style.background = 'none';
			document.getElementById('btn_close_img').style.color = '#ffffff';
			document.getElementById('btn_close_img').style.textShadow = '0px 0px 20px #008aee';
		}
	}
	
	//Styling - btn_prev
	t = '';
	t += 'position: fixed;';
	t += 'padding: 0px;';
	t += 'width: 1.75cm;';
	t += 'height: 3cm;';
	t += 'line-height: 3cm;';
	t += 'text-align: center;';
	t += 'text-shadow: 0px 0px 20px #008aee;';
	t += 'font-size: 55px;';
	t += 'font-family: Euphemia, FangSong, MS UI Gothic, Sans Serif;';
	t += 'margin-left: -0.15cm;';
	t += 'top: ' + (screen_height/2) + 'px;';
	t += 'background: none;';
	t += 'transition: background 0.1s;';
	t += '-webkit-transition: background 0.1s;';
	t += '-moz-transition: background 0.1s;';
	if(default_img-1>0){
		t += 'color: #ffffff;';
		t += 'cursor: pointer;';
		document.getElementById('btn_prev').onmouseover = function(){
			document.getElementById('btn_prev').style.background = '#515151';
		}
		document.getElementById('btn_prev').onmouseout = function(){
			document.getElementById('btn_prev').style.background = 'none';
		}
	}else{
		t += 'color: #c3c3c3;';
		t += 'cursor: not-allowed;';
	}
	document.getElementById('btn_prev').setAttribute('style', t);
	
	//Styling - btn_next
	t = '';
	t += 'position: fixed;';
	t += 'padding: 0px;';
	t += 'width: 1.75cm;';
	t += 'height: 3cm;';
	t += 'line-height: 3cm;';
	t += 'text-align: center;';
	t += 'text-shadow: 0px 0px 20px #008aee;';
	t += 'font-size: 55px;';
	t += 'font-family: Euphemia, FangSong, MS UI Gothic, Sans Serif;';
	t += 'left: ' + (screen_width-75) + 'px;';
	t += 'top: ' + (screen_height/2) + 'px;';
	t += 'background: none;';
	t += 'transition: background 0.1s;';
	t += '-webkit-transition: background 0.1s;';
	t += '-moz-transition: background 0.1s;';
	if(default_img+1<=sum){
		t += 'color: #ffffff;';
		t += 'cursor: pointer;';
		document.getElementById('btn_next').onmouseover = function(){
			document.getElementById('btn_next').style.background = '#515151';
		}
		document.getElementById('btn_next').onmouseout = function(){
			document.getElementById('btn_next').style.background = 'none';
		}
	}else{
		t += 'color: #c3c3c3;';
		t += 'cursor: not-allowed;';
	}
	document.getElementById('btn_next').setAttribute('style', t);
	
	//Styling - vi_image
	document.getElementById('vi_image').style.display = 'block';
	document.getElementById('vi_image').style.maxWidth = '90%';
	document.getElementById('vi_image').style.maxHeight = '90%';
	document.getElementById('vi_image').style.marginLeft = 'auto';
	document.getElementById('vi_image').style.marginRight = 'auto';
	document.getElementById('vi_image').style.marginTop = '20px';
	//document.getElementById('vi_image').style.boxShadow = '0px 0px 2px 2px #c3c3c3';
		
	//OPERATIONS------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//Viewing the next image
	if(sum>1){
		document.getElementById('btn_next').onclick = function(){
			if(default_img+1<=sum && default_img_bool == true){
				document.getElementById('btn_next').style.backgroundColor = '#e3e3e3';
				default_img++;
				view_image_field.remove();
				view_img(images, default_img, img_user_id);
			}
		}
		//Viewing the previous image
		document.getElementById('btn_prev').onclick = function(){
			if(default_img-1>0 && default_img_bool == true){ 
				document.getElementById('btn_next').style.backgroundColor = '#e3e3e3';
				default_img--;
				view_image_field.remove();
				view_img(images, default_img, img_user_id);
			}
		}
	}
	//Closing the image player
	document.getElementById('btn_close_img').onclick = function(){
		deleted = 1;
		view_image_field.remove();
	}
}

//==============================================================================================================================================================================
//==============================================================================================================================================================================
//==============================================================================================================================================================================
//=============================================================================ANOTHER FUNCTION=================================================================================
//==============================================================================================================================================================================
//==============================================================================================================================================================================
//==============================================================================================================================================================================

//FUNCTION - SHOW_IMAGES_ACCORDING TO THE GIVEN AMOUNT
function show_images_according_to_given_number(field, given_number, sum, urls, ui){
	//This function displays the bunch of images or etc. according to the given number in innerHTML of the given field
	//And displays prev and next buttons where they needed
		
	var s = '';
	for(var i=1; i<=parseInt(given_number); i++){
		if(i<=sum){
			s += '<div class="nav_user_all_images" id="nav_user_all_images">';
				s += '<img src="uploads/user_images/' + urls[i] + '" class="user_all_images" onclick="view_img(url_all_imgs, ' + i + ', ' + ui + ', 1)"/>';
			s += '</div>';
		}
	}
	if(s !== ''){
		document.getElementById(field).innerHTML = s;
	}
	
	var last_image = given_number;
	if((sum-last_image)<=0){
		document.getElementById('next_btn').style.display = 'none';
	}else{
		document.getElementById('next_btn').style.display = 'block';
	}
	if(last_image<=given_number){
		document.getElementById('prev_btn').style.display = 'none';
	}else{
		document.getElementById('prev_btn').style.display = 'block';
	}
	
	document.getElementById('next_btn').onclick = function(){
		function show_part(last, show_number, urls, sum){
			if(last<sum){
				var s = '';
				for(var i=(parseInt(last)+1); i<=parseInt(last)+show_number; i++){
					if(i<=sum){
						s += '<div class="nav_user_all_images" id="nav_user_all_images">';
							s += '<img src="uploads/user_images/' + urls[i] + '" class="user_all_images" onclick="view_img(url_all_imgs, ' + i + ', ' + ui + ', 1)"/>';
						s += '</div>';
					}
				}
				if(s !== ''){
					document.getElementById(field).innerHTML = s;
				}
				return last+show_number;
			}else{
				return last;
			}
		}
		last_image = show_part(last_image, given_number, url_all_imgs, sum);
		
		if((sum-last_image)<=0){
			document.getElementById('next_btn').style.display = 'none';
		}else{
			document.getElementById('next_btn').style.display = 'block';
		}
		if(last_image<=given_number){
			document.getElementById('prev_btn').style.display = 'none';
		}else{
			document.getElementById('prev_btn').style.display = 'block';
		}
		console.log(last_image);
	}

	document.getElementById('prev_btn').onclick = function(){
		function show_part(last, show_number, urls, sum){
			if(last>show_number){
				var s = '';
				for(var i=(parseInt(last)-parseInt(show_number)); i>=(parseInt(last)-(parseInt(show_number)*2)+1); i--){
					if(i>=1){
						var t = '';
						t += '<div class="nav_user_all_images" id="nav_user_all_images">';
							t += '<img src="uploads/user_images/' + urls[i] + '" class="user_all_images" onclick="view_img(url_all_imgs, ' + i + ', ' + ui + ', 1)"/>';
						t += '</div>';
						s = t + s;
					}
				}
				if(s !== ''){
					document.getElementById(field).innerHTML = s;
				}
				return last-show_number;
			}else{
				return last;
			}
		}
		last_image = show_part(last_image, given_number, urls, sum);
		
		if((sum-last_image)<=0){
			document.getElementById('next_btn').style.display = 'none';
		}else{
			document.getElementById('next_btn').style.display = 'block';
		}
		if(last_image<=given_number){
			document.getElementById('prev_btn').style.display = 'none';
		}else{
			document.getElementById('prev_btn').style.display = 'block';
		}
	}
}