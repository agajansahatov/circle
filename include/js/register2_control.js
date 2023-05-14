document.getElementById('btn_next').onclick = function(){
	if(form.controll('code_field', 'css_status_code_field') == false){ return false; }
	if(document.getElementById('agree').checked == false){
		document.getElementById('css_status_agree').style.display = 'block';
		document.getElementById('agree').focus();
		return false;
	}
}
document.getElementById('agree').onchange = function(){
	if(document.getElementById('agree').checked == false){
		document.getElementById('css_status_agree').style.display = 'block';
		document.getElementById('agree').focus();
		return false;
	}
	if(document.getElementById('agree').checked == true){
		document.getElementById('css_status_agree').style.display = 'none';
		return false;
	}
}