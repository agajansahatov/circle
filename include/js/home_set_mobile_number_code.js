if(error == 0){
	document.getElementById("li_code_mobile_number_field").style.display = 'none';
	document.getElementById("li_code_mobile_number_field").style.opacity = '0';
}
if(error == 1){
	document.getElementById("li_code_mobile_number_field").style.display = 'block';
	document.getElementById("li_code_mobile_number_field").style.opacity = '1';
	document.getElementById("img_background").style.height = "73%"; // 2 yerde bar
	form.text_field_anim("code_mobile_number_field", code, "Type the code we have sent");
}
if(error == 0){
	form.button_anim("btn_set_mobile_number_code", 2);
	document.getElementById("img_background").style.height = "60%";
	var t = '';
	t += 'opacity: 0;';
	t += 'display: none;';
	t += '-webkit-transition: opacity 0.5s;';
	t += '-moz-transition: opacity 0.5s;';
	t += 'transition: opacity 0.5s;';
	document.getElementById("li_code_mobile_number_field").setAttribute('style', t);

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
			document.getElementById("li_code_mobile_number_field").style.display = 'block';
			document.getElementById("btn_set_mobile_number_code").style.marginTop = '-1.3cm';
		}
		if(j == 5){
			var t = '';
			t += 'margin-top: 1cm;';
			t += '-webkit-transition: margin-top 0.5s;';
			t += '-moz-transition: margin-top 0.5s;';
			t += 'transition: margin-top 0.5s;';
			document.getElementById("btn_set_mobile_number_code").setAttribute('style', t);
			
			document.getElementById("li_code_mobile_number_field").style.opacity = '1';
			form.text_field_anim("code_mobile_number_field", code, "Type the code we have sent");
			clearInterval(timeln);
		}
		j++;
	}, 300);
}