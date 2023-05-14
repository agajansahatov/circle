var password_2_displayed = 0;

document.getElementById("btn_set_password").onclick = function(){
	if(document.getElementById("password_field").value !== ''){
		if(document.getElementById("password_field").value === document.getElementById("password_2_field").value){
			document.getElementById('frm_new_password').setAttribute('action', '?set_password=true&full_information=true&set_password_2=true');
			return true;
		}else{
			if(password_2_displayed === 1){
				if(document.getElementById("password_2_field").value !== ''){
					document.getElementById("css_status_password_2").style.display = 'block';
					document.getElementById("warner_password_2").innerHTML = 'This password doesn\'t match with first!';
					document.getElementById("password_2_field").focus();
					password_2_displayed = 1;
					
				}else{
					document.getElementById("css_status_password_2").style.display = 'block';
					document.getElementById("warner_password_2").innerHTML = 'Type your new password AGAIN, please!';
					document.getElementById("password_2_field").focus();
					password_2_displayed = 1;
				}
				return false;
			}
		}
		if(password_2_displayed === 0){
			form.button_anim("btn_set_password", 2);
			document.getElementById("img_background").style.height = "60%";
			var t = '';
			t += 'opacity: 0;';
			t += 'display: none;';
			t += '-webkit-transition: opacity 0.5s;';
			t += '-moz-transition: opacity 0.5s;';
			t += 'transition: opacity 0.5s;';
			document.getElementById("li_password_2_field").setAttribute('style', t);

			var j = 0;
			var timeln = setInterval(function(){	
				if(j == 3){
					var t = '';
					t += 'height: 73%;'; // 2 yerde bar
					t += '-webkit-transition: height 0.5s;';
					t += '-moz-transition: height 0.5s;';
					t += 'transition: height 0.5s;';
					document.getElementById("img_background").setAttribute('style', t);
				}
				if(j == 4){
					document.getElementById("li_password_2_field").style.display = 'block';
					document.getElementById("btn_set_password").style.marginTop = '-1.3cm';
				}
				if(j == 5){
					var t = '';
					t += 'margin-top: 1cm;';
					t += '-webkit-transition: margin-top 0.5s;';
					t += '-moz-transition: margin-top 0.5s;';
					t += 'transition: margin-top 0.5s;';
					document.getElementById("btn_set_password").setAttribute('style', t);
					
					document.getElementById("li_password_2_field").style.opacity = '1';
					form.text_field_anim("password_2_field", "Type your password again", "Type your password again");
					clearInterval(timeln);
				}
				j++;
			}, 300);
			password_2_displayed = 1;
			return false;
		}
	}else{
		document.getElementById("css_status_password").style.display = 'block';
		document.getElementById("warner_password").innerHTML = 'Type your new password please!';
		document.getElementById("password_field").focus();
		return false;
	}
}