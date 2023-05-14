document.getElementById('btn_login').onclick = function(){
	if(form.controll('phone_number_field', 'css_status_phone_number') == false){ return false; }
	if(form.controll('password_field', 'css_status_password_field') == false){ return false; }
}