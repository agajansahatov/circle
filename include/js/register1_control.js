document.getElementById('btn_next').onclick = function(){
	if(form.controll('PHfirstname', 'css_status_firstname') == false){ return false; }
	if(form.controll('phone_number_field', 'css_status_phone_number') == false){ return false; }
	if(form.controll('password_field_1', 'css_status_password_field_1') == false){ return false; }
	if(form.controll('password_field_2', 'css_status_password_field_2') == false){ return false; }
	if(document.getElementById('password_field_1').value !== document.getElementById('password_field_2').value){
		document.getElementById('css_status_password_2').style.display = 'block';
		document.getElementById('password_field_2').focus();
		
		document.getElementById('password_field_2').onkeyup = function(){
			if(document.getElementById('css_status_password_2').style.display = 'block'){
				document.getElementById('css_status_password_2').style.display = 'none';
			}
		}
		return false;
	}
}