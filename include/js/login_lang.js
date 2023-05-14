var languages = [];
//ENGLISH
languages['english'] = [];
		languages['english']['incorrect_pass'] = 'Your password is incorrect!';
		languages['english']['no_mobilenumber'] = 'There is no account connected to this mobile number!';
		languages['english']['provide_all'] = 'Please provide all informations!';
		languages['english']['phone_number'] = 'Mobile number or email address :';
		languages['english']['phone_number_field'] = 'Mobile number or email';
		languages['english']['password'] = 'Password :';
		languages['english']['password_field'] = 'Type your password';
		languages['english']['pass_forgot'] = 'Forgotten password?';
		languages['english']['btn_login'] = 'Log in';
		languages['english']['btn_signup'] = 'Register';
		languages['english']['warner_phone_number'] = 'Type your mobile number or email address!';
		languages['english']['warner_password_field'] = 'Type your password!';
		languages['english']['no_email'] = 'There is no account connected to this email address!';
		languages['english']['address_incorrect'] = 'Please provide your informations correctly!';
		
//TÜRKMENÇE
languages['türkmençe'] = [];
		languages['türkmençe']['incorrect_pass'] = 'Siziň açar sözüňiz ýalňyş!';
		languages['türkmençe']['no_mobilenumber'] = 'Bu telefon nomera birikdirilen bir akkaunt ýok!';
		languages['türkmençe']['provide_all'] = 'Hemme maglumatlary üpjün ediň!';
		languages['türkmençe']['phone_number'] = 'Telefon nomeriňiz ýa-da emailiňiz :';
		languages['türkmençe']['phone_number_field'] = 'Tel nomeriňiz ýa-da emailiňiz';
		languages['türkmençe']['password'] = 'Açar söz :';
		languages['türkmençe']['password_field'] = 'Açar sözüňizi ýazyň';
		languages['türkmençe']['pass_forgot'] = 'Açar sözüňizi unutdyňyzmy?';
		languages['türkmençe']['btn_login'] = 'Gir';
		languages['türkmençe']['btn_signup'] = 'Ýazyl';
		languages['türkmençe']['warner_phone_number'] = 'Telefon nomeriňizi ýazyň ýa-da email adresiňizi ýazyň!';
		languages['türkmençe']['warner_password_field'] = 'Açar sözüňizi ýazyň!';
		languages['türkmençe']['no_email'] = 'Bu email adresa birikdirilen bir akkaunt ýok!';
		languages['türkmençe']['address_incorrect'] = 'Maglumatlaryňyzy dogry ýazyň!';
		
//TÜRKÇE
languages['türkçe'] = [];
		languages['türkçe']['incorrect_pass'] = 'Sizin şifreniz yanlış!';
		languages['türkçe']['no_mobilenumber'] = 'Bu numarayla açılmış bir akkaunt bulunamadı!';
		languages['türkçe']['provide_all'] = 'Bilgilerin hepsizi doldurun!';
		languages['türkçe']['phone_number'] = 'Telefon numaranız veya emailiniz:';
		languages['türkçe']['phone_number_field'] = 'Tel numaranız veya emailiniz:';
		languages['türkçe']['password'] = 'Şifre :';
		languages['türkçe']['password_field'] = 'Şifrenizi yazın';
		languages['türkçe']['pass_forgot'] = 'Şifrenizi\'mi unuttunuz?';
		languages['türkçe']['btn_login'] = 'Giriş yap';
		languages['türkçe']['btn_signup'] = 'Yeni sayfa aç';
		languages['türkçe']['warner_phone_number'] = 'Telefon numaranızı veya email adresinizi yazın!';
		languages['türkçe']['warner_password_field'] = 'Şifrenizi yazın!';		
		languages['türkçe']['no_email'] = 'Bu email ile açılmış bir akkaunt bulunamadı!';
		languages['türkçe']['address_incorrect'] = 'Bilgilerinizi dogru yazın!';
		
var body = document.getElementById('body');
var select_lang = document.getElementById('lang');
body.onload = function(){
	var lang = select_lang.children[select_lang.selectedIndex].innerHTML;
	var language = languages[lang];
	for(key in language){
		if(document.getElementById(key) !== null){
			if(document.getElementById(key).getAttribute('class') === 'btn'){
				document.getElementById(key).setAttribute('value', language[key]);
			}else if(document.getElementById(key).getAttribute('class') === 'txt_field' || document.getElementById(key).getAttribute('class') === 'number_field'){
				document.getElementById(key).setAttribute('placeholder', language[key]);
			}else{
				document.getElementById(key).innerHTML = language[key];
			}
		}
	}
}
select_lang.onchange = function(){
	var lang = select_lang.children[select_lang.selectedIndex].innerHTML;
	var language = languages[lang];
	for(key in language){
		if(document.getElementById(key) !== null){
			if(document.getElementById(key).getAttribute('class') === 'btn'){
				document.getElementById(key).setAttribute('value', language[key]);
			}else if(document.getElementById(key).getAttribute('class') === 'txt_field' || document.getElementById(key).getAttribute('class') === 'number_field'){
				document.getElementById(key).setAttribute('placeholder', language[key]);
			}else{
				document.getElementById(key).innerHTML = language[key];
			}
		}
	}
}