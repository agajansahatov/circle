var languages = [];
//ENGLISH
languages['english'] = [];
	//register1.php
		languages['english']['registration'] = 'Registration';
		languages['english']['lbl_firstname'] = 'Firstname :';
		languages['english']['PHfirstname'] = 'Type your Firstname';
		languages['english']['phone_number'] = 'Mobile number or Email address:';
		languages['english']['phone_number_field'] = 'Mobile number or email';
		languages['english']['password'] = 'Password :';
		languages['english']['password_field_1'] = 'Type your password';
		languages['english']['password_correction'] = 'Type your password again :';
		languages['english']['password_field_2'] = 'Type your password again ';
		languages['english']['btn_next'] = 'Next';
		languages['english']['warner_firstname'] = 'Type your Firstname!';
		languages['english']['warner_phone_number'] = 'Type your mobile number or email address!';//---------------------------
		languages['english']['warner_password_field_1'] = 'Type your password!';
		languages['english']['warner_password_field_2'] = 'Type your password again';
		languages['english']['warner_password_2'] = 'This password doesn\'t match with the other!';
		languages['english']['have_mobilenumber'] = 'There is an account already connected to this mobile number!';
		languages['english']['type_mobilenumber_correctly'] = 'Please type your mobilenumber correctly!';
		languages['english']['have_email'] = 'There is an account already connected to this email address!';
		languages['english']['type_email_correctly'] = 'Please type your email address correctly!';
		languages['english']['lbl_lastname'] = 'Lastname :';
		languages['english']['warner_lastname'] = 'Type your Lastname!';
		languages['english']['PHlastname'] = 'Type your Lastname';
				
//TÜRKMENÇE
languages['türkmençe'] = [];
	//register1.php
		languages['türkmençe']['registration'] = 'Ýazylyş';
		languages['türkmençe']['lbl_firstname'] = 'Adyňyz :';
		languages['türkmençe']['PHfirstname'] = 'Adyňyzy ýazyň';
		languages['türkmençe']['phone_number'] = 'Telefon nomeriňiz ýa-da email adresiňiz:';
		languages['türkmençe']['phone_number_field'] = 'Tel nomeriňiz ýa-da emailiňiz';
		languages['türkmençe']['password'] = 'Açar söz :';
		languages['türkmençe']['password_field_1'] = 'Açar sözüňizi ýazyň';
		languages['türkmençe']['password_correction'] = 'Açar sözüňizi tassyklaň :';
		languages['türkmençe']['password_field_2'] = 'Açar sözüňizi ýene-de ýazyň';
		languages['türkmençe']['btn_next'] = 'Indiki';
		languages['türkmençe']['warner_firstname'] = 'Adyňyzy ýazyň!';
		languages['türkmençe']['warner_phone_number'] = 'Telefon nomeriňizi ýa-da email adresiňizi ýazyň!';
		languages['türkmençe']['warner_password_field_1'] = 'Açar sözüňizi ýazyň!';
		languages['türkmençe']['warner_password_field_2'] = 'Açar sözüňizi ýene-de ýazyň!';
		languages['türkmençe']['warner_password_2'] = 'Bu açar sözi beýleki bilen gabat gelenok!';
		languages['türkmençe']['have_mobilenumber'] = 'Bu telefon nomer bilen eýýäm bir akkaunt açylypdyr!';
		languages['türkmençe']['type_mobilenumber_correctly'] = 'Telefon nomeriňizi dogry ýazyň!';
		languages['türkmençe']['have_email'] = 'Bu email adres bilen eýýäm bir akkaunt açylypdyr!';
		languages['türkmençe']['type_email_correctly'] = 'Email adresiňizi dogry ýazyň!';
		languages['türkmençe']['lbl_lastname'] = 'Familiýaňyz :';
		languages['türkmençe']['warner_lastname'] = 'Familiýaňyzy ýazyň!';
		languages['türkmençe']['PHlastname'] = 'Familiýaňyzy ýazyň';
		
//TÜRKÇE
languages['türkçe'] = [];
	//register1.php
		languages['türkçe']['registration'] = 'Kayıt olma';
		languages['türkçe']['lbl_firstname'] = 'Adınız :';
		languages['türkçe']['PHfirstname'] = 'Adınızı yazın';
		languages['türkçe']['phone_number'] = 'Telefon numaranız veya email adresiniz:';
		languages['türkçe']['phone_number_field'] = 'Tel numaranız veya emailiniz';
		languages['türkçe']['password'] = 'Parola :';
		languages['türkçe']['password_field_1'] = 'Parolanızı yazın';
		languages['türkçe']['password_correction'] = 'Parolanızı tekrar yazın :';
		languages['türkçe']['password_field_2'] = 'Parolanızı tekrar yazın';
		languages['türkçe']['btn_next'] = 'Sonraki';
		languages['türkçe']['warner_firstname'] = 'Adınızı yazın!';
		languages['türkçe']['warner_phone_number'] = 'Telefon numaranızı veya emailinizi yazın!';
		languages['türkçe']['warner_password_field_1'] = 'Parolanızı yazın!';
		languages['türkçe']['warner_password_field_2'] = 'Parolanızı tekrar yazın!';
		languages['türkçe']['warner_password_2'] = 'Bu parola diğeriyle eşleşmiyor!';
		languages['türkçe']['have_mobilenumber'] = 'Bu telefon numarayla açılmış bir akkaunt var!';
		languages['türkçe']['type_mobilenumber_correctly'] = 'Telefon numaranızı dogru yazın!';
		languages['türkçe']['have_email'] = 'Bu email adresle açılmış bir akkaunt var!';
		languages['türkçe']['type_email_correctly'] = 'Email adresinizi dogru yazın!';
		languages['türkçe']['lbl_lastname'] = 'Soyadınız :';
		languages['türkçe']['warner_lastname'] = 'Soyadınızı yazın!';
		languages['türkçe']['PHlastname'] = 'Soyadınızı yazın';
		
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