var hover = 1;
document.getElementById('btn_add_image').onclick = function(){
	var t = '';
		t += '<form method="POST" action="" enctype="multipart/form-data">';
			t += '<li id="header_upload">New image</li>';
			t += '<li><input type = "file" name = "image" id="file"/></li>'; //size
			t += '<li><input type = "submit" value="Upload" id="btn_upload_image" name="btn_upload_image"/></li>';
		t += '</form>';
	form.my_alert(t, '30%', '40%');
	return false;
}

document.getElementById('btn_show_more').onclick = function(){
	if(document.getElementById('show_more_icon').getAttribute('src') == 'assets/down_icon.png'){
		hover = 0;
		
		document.getElementById('home_all_images_style').setAttribute('href', 'include/css/home_all_images2.css');
		
		//Images field
		show_images_according_to_given_number('images_field', 12, user_img_sum, url_all_imgs);
		
		document.getElementById('main_body').style.height = '31cm';
		document.getElementById('main_first').style.height = '22cm';
		document.getElementById('main_inf_field').style.height = '21.75cm';
		document.getElementById('main_inf').style.height = '18.4cm';
		
		document.getElementById('btn_show_more').style.backgroundColor = '#999999';
		document.getElementById('btn_show_more').style.borderColor = '#e3e3e3';
		
		var counter = 0;
		var interval = setInterval(function(){
			counter++;
			if(counter == 1){
				document.getElementById('btn_show_more').style.backgroundColor = '#008aee';
				document.getElementById('show_more_icon').setAttribute('src', 'assets/up_icon.png');
				document.getElementById('indicators').style.boxShadow = 'none';
				hover = 1;
				clearInterval(interval);
			}
		}, 1000);/* Eger-de 1000 etsen sagat(sekunt) bilen den bolyar*/
		
		
		
	}else if(document.getElementById('show_more_icon').getAttribute('src') == 'assets/up_icon.png'){
		hover = 0;
		
		document.getElementById('home_all_images_style').setAttribute('href', 'include/css/home_all_images1.css');
		//Images field
		show_images_according_to_given_number('images_field', 5, user_img_sum, url_all_imgs);
		
		document.getElementById('main_body').style.height = '19cm';
		document.getElementById('main_first').style.height = '10.5cm';
		document.getElementById('main_inf_field').style.height = '5.7cm';
		document.getElementById('main_inf').style.height = '2.5cm';
		document.getElementById('btn_show_more').style.backgroundColor = '#999999';
		document.getElementById('btn_show_more').style.borderColor = '#e3e3e3';
		document.getElementById('indicators').style.boxShadow = '0px -5px 15px 5px #f4f4f4';
		var counter = 0;
		var interval = setInterval(function(){
			counter++;
			if(counter == 1){
				document.getElementById('btn_show_more').style.backgroundColor = '#008aee';
				document.getElementById('show_more_icon').setAttribute('src', 'assets/down_icon.png');
				hover = 1;
				clearInterval(interval);
			}
		}, 1000);/* Eger-de 1000 etsen sagat(sekunt) bilen den bolyar*/
	}
}
document.getElementById('btn_show_more').onmouseover = function(){
	if(hover == 1){
		document.getElementById('btn_show_more').style.backgroundColor = '#006dbc';
	}
}
document.getElementById('btn_show_more').onmouseout = function(){
	if(hover == 1){
		document.getElementById('btn_show_more').style.backgroundColor = '#008aee';  /* - täze*/ 
	}
}



//Images field
if(user_img_sum>0){
	show_images_according_to_given_number('images_field', 6, user_img_sum, url_all_imgs, ui);
}